/*
 | Живое нейронное поле (Canvas 2D).
 | — узлы дрейфуют мягкими волнами, соединяются линиями вблизи;
 | — реагируют на курсор; 60 FPS; без визуального шума;
 | — авто-упрощение на слабых устройствах, пауза на скрытой вкладке,
 |   уважение prefers-reduced-motion.
*/

const ACCENT = { r: 122, g: 92, b: 255 };
const ACCENT2 = { r: 255, g: 93, b: 162 };

function deviceTier() {
    const cores = navigator.hardwareConcurrency || 4;
    const mem = navigator.deviceMemory || 4;
    const small = Math.min(window.innerWidth, window.innerHeight) < 720;
    if (cores <= 4 || mem <= 4 || small) return 'low';
    if (cores <= 8) return 'mid';
    return 'high';
}

export function initNeuralField(canvas) {
    if (!canvas || !canvas.getContext) return null;

    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const ctx = canvas.getContext('2d', { alpha: true });

    const tier = deviceTier();
    const settings = {
        low: { divisor: 9000, min: 120, max: 320, radius: 64, fps: 30, dpr: 1 },
        mid: { divisor: 4200, min: 320, max: 600, radius: 70, fps: 60, dpr: 1.5 },
        high: { divisor: 2600, min: 500, max: 900, radius: 76, fps: 60, dpr: 2 },
    }[tier];

    const mouse = { x: -9999, y: -9999, active: false };
    const mouseRadius = 150;

    let nodes = [];
    let width = 0;
    let height = 0;
    let dpr = 1;
    let rafId = null;
    let running = false;
    let lastFrame = 0;
    const frameInterval = 1000 / settings.fps;

    function size() {
        const rect = canvas.getBoundingClientRect();
        width = Math.max(1, rect.width);
        height = Math.max(1, rect.height);
        dpr = Math.min(window.devicePixelRatio || 1, settings.dpr);
        canvas.width = Math.round(width * dpr);
        canvas.height = Math.round(height * dpr);
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    function build() {
        const count = Math.round(
            Math.max(settings.min, Math.min(settings.max, (width * height) / settings.divisor))
        );
        nodes = new Array(count);
        for (let i = 0; i < count; i++) {
            nodes[i] = {
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.22,
                vy: (Math.random() - 0.5) * 0.22,
                // фазы для мягких волн
                px: Math.random() * Math.PI * 2,
                py: Math.random() * Math.PI * 2,
            };
        }
    }

    function step(t) {
        const radius = settings.radius;
        const cell = radius;
        const cols = Math.max(1, Math.ceil(width / cell));
        const grid = new Map();

        // движение + раскладка по пространственной сетке
        for (let i = 0; i < nodes.length; i++) {
            const n = nodes[i];

            // мягкая волна
            n.px += 0.004;
            n.py += 0.005;
            n.x += n.vx + Math.cos(n.px) * 0.08;
            n.y += n.vy + Math.sin(n.py) * 0.08;

            // мягкое притяжение к курсору
            if (mouse.active) {
                const dx = mouse.x - n.x;
                const dy = mouse.y - n.y;
                const d2 = dx * dx + dy * dy;
                if (d2 < mouseRadius * mouseRadius && d2 > 1) {
                    const f = (1 - Math.sqrt(d2) / mouseRadius) * 0.35;
                    n.x += (dx / Math.sqrt(d2)) * f;
                    n.y += (dy / Math.sqrt(d2)) * f;
                }
            }

            // отражение от краёв
            if (n.x < 0) { n.x = 0; n.vx *= -1; }
            else if (n.x > width) { n.x = width; n.vx *= -1; }
            if (n.y < 0) { n.y = 0; n.vy *= -1; }
            else if (n.y > height) { n.y = height; n.vy *= -1; }

            const key = (n.x / cell | 0) + (n.y / cell | 0) * cols;
            let bucket = grid.get(key);
            if (!bucket) grid.set(key, (bucket = []));
            bucket.push(i);
        }

        ctx.clearRect(0, 0, width, height);

        // линии между близкими узлами
        ctx.lineWidth = 1;
        for (let i = 0; i < nodes.length; i++) {
            const a = nodes[i];
            const cx = (a.x / cell | 0);
            const cy = (a.y / cell | 0);
            for (let gx = cx - 1; gx <= cx + 1; gx++) {
                for (let gy = cy - 1; gy <= cy + 1; gy++) {
                    const bucket = grid.get(gx + gy * cols);
                    if (!bucket) continue;
                    for (let k = 0; k < bucket.length; k++) {
                        const j = bucket[k];
                        if (j <= i) continue;
                        const b = nodes[j];
                        const dx = a.x - b.x;
                        const dy = a.y - b.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist > radius) continue;
                        const alpha = (1 - dist / radius) * 0.16;
                        const mix = (a.x / width);
                        const r = ACCENT.r + (ACCENT2.r - ACCENT.r) * mix;
                        const g = ACCENT.g + (ACCENT2.g - ACCENT.g) * mix;
                        const bl = ACCENT.b + (ACCENT2.b - ACCENT.b) * mix;
                        ctx.strokeStyle = `rgba(${r | 0},${g | 0},${bl | 0},${alpha})`;
                        ctx.beginPath();
                        ctx.moveTo(a.x, a.y);
                        ctx.lineTo(b.x, b.y);
                        ctx.stroke();
                    }
                }
            }
        }

        // узлы
        for (let i = 0; i < nodes.length; i++) {
            const n = nodes[i];
            let near = 0;
            if (mouse.active) {
                const dx = mouse.x - n.x;
                const dy = mouse.y - n.y;
                const d = Math.sqrt(dx * dx + dy * dy);
                if (d < mouseRadius) near = 1 - d / mouseRadius;
            }
            const rad = 1.1 + near * 1.8;
            const alpha = 0.35 + near * 0.5;
            ctx.fillStyle = `rgba(${ACCENT.r},${ACCENT.g},${ACCENT.b},${alpha})`;
            ctx.beginPath();
            ctx.arc(n.x, n.y, rad, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    function loop(t) {
        if (!running) return;
        rafId = requestAnimationFrame(loop);
        if (t - lastFrame < frameInterval) return;
        lastFrame = t;
        step(t);
    }

    function start() {
        if (running) return;
        running = true;
        lastFrame = 0;
        rafId = requestAnimationFrame(loop);
    }

    function stop() {
        running = false;
        if (rafId) cancelAnimationFrame(rafId);
        rafId = null;
    }

    // статичный кадр для reduced-motion
    function renderStatic() {
        size();
        build();
        step(0);
    }

    // события
    let resizeTimer = null;
    function onResize() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            size();
            build();
            if (reduced) step(0);
        }, 200);
    }

    function onMove(e) {
        const rect = canvas.getBoundingClientRect();
        const cx = (e.touches ? e.touches[0].clientX : e.clientX);
        const cy = (e.touches ? e.touches[0].clientY : e.clientY);
        mouse.x = cx - rect.left;
        mouse.y = cy - rect.top;
        mouse.active = true;
    }

    function onLeave() {
        mouse.active = false;
        mouse.x = mouse.y = -9999;
    }

    function onVisibility() {
        if (document.hidden) stop();
        else if (!reduced) start();
    }

    window.addEventListener('resize', onResize, { passive: true });
    window.addEventListener('mousemove', onMove, { passive: true });
    window.addEventListener('touchmove', onMove, { passive: true });
    window.addEventListener('mouseout', onLeave, { passive: true });
    document.addEventListener('visibilitychange', onVisibility);

    if (reduced) {
        renderStatic();
    } else {
        size();
        build();
        // запускаем только когда поле в зоне видимости
        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver((entries) => {
                entries.forEach((en) => (en.isIntersecting ? start() : stop()));
            }, { threshold: 0 });
            io.observe(canvas);
        } else {
            start();
        }
    }

    return { start, stop };
}
