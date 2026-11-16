Set-Location "C:\OSPanel\home\Genla"
$ErrorActionPreference = "Stop"
$msgFile = "$env:TEMP\genla_commit_msg.txt"

function Commit-WithFile([string]$text) {
    Set-Content -Path $msgFile -Value $text -Encoding UTF8 -NoNewline
    git commit -F $msgFile
    if ($LASTEXITCODE -ne 0) { throw "git commit failed" }
}

# ──────────────────────────────────────────────────────────
# 1 — LARAVEL SKELETON
# ──────────────────────────────────────────────────────────
Write-Host "[1/10] Laravel skeleton" -ForegroundColor Cyan
git add .editorconfig .env.example .gitattributes .gitignore .npmrc README.md
git add artisan phpunit.xml vite.config.js
git add composer.json composer.lock
git add package.json package-lock.json
git add bootstrap/
git add storage/
git add tests/
git add app/Http/Controllers/Controller.php
git add app/Models/User.php
git add app/Providers/AppServiceProvider.php
git add database/.gitignore
git add database/factories/UserFactory.php
git add database/seeders/DatabaseSeeder.php
git add "database/migrations/0001_01_01_000000_create_users_table.php"
git add "database/migrations/0001_01_01_000001_create_cache_table.php"
git add "database/migrations/0001_01_01_000002_create_jobs_table.php"

Commit-WithFile @"
feat: init Laravel 12 skeleton

Sets up the complete Laravel 12 application skeleton:

Framework bootstrap and tooling:
  Root files: .editorconfig, .gitignore, .gitattributes, .npmrc
  Entry: artisan, phpunit.xml, vite.config.js
  PHP deps: composer.json / composer.lock (Laravel 12, HTTP client, Tinker)
  JS deps: package.json / package-lock.json (Vite 6, Alpine.js)
  Bootstrap: bootstrap/app.php with HTTP / Console / Exception bindings

Storage scaffolding:
  public/, framework/, logs/ skeleton with .gitignore stubs
  framework/cache, framework/sessions, framework/views directories

Base application:
  app/Http/Controllers/Controller.php (base)
  app/Models/User.php with HasFactory, HasApiTokens
  app/Providers/AppServiceProvider.php

Initial migrations (Laravel defaults):
  0001_01_01_000000_create_users_table.php
  0001_01_01_000001_create_cache_table.php
  0001_01_01_000002_create_jobs_table.php

Factories and seeders:
  database/factories/UserFactory.php
  database/seeders/DatabaseSeeder.php

Test scaffold:
  tests/Feature/ExampleTest.php
  tests/Unit/ExampleTest.php
"@

# ──────────────────────────────────────────────────────────
# 2 — GENLA UI
# ──────────────────────────────────────────────────────────
Write-Host "[2/10] Genla UI" -ForegroundColor Cyan
git add resources/views/home.blade.php
git add resources/views/layouts/base.blade.php
git add resources/views/components/
git add resources/views/partials/bottom-bar.blade.php
git add resources/views/partials/chat-overlay.blade.php
git add resources/views/partials/mobile-nav.blade.php
git add resources/css/
git add resources/js/
git add app/Http/Controllers/HomeController.php
git add app/Support/Genla.php
git add app/Http/Middleware/SetLocale.php

Commit-WithFile @"
feat(ui): Genla home page, design system, Alpine.js frontend, Blade components

CSS design system (resources/css/):
  tokens.css     - CSS custom properties (colours, spacing, type scale, radii)
  base.css       - reset, html/body defaults, scrollbar styling
  layout.css     - container, section, grid, flex utilities
  header.css     - sticky nav, lang switcher, CTA button
  footer.css     - site footer, brand logo, nav columns, legal row
  buttons.css    - btn variants (primary, ghost, icon) with gradient hover
  modal.css      - consultation form modal, honeypot hide, success state
  os.css         - OS home grid (.os__grid), hero logo (.os__logo), tile cards
  lab.css        - lab page hero, feature list, product cards, media block
  animations.css - reveal scroll animation, shimmer hue-rotate keyframes
  responsive.css - mobile/tablet breakpoints for all components
  tabbar.css     - mobile bottom tab-bar (Home / AI / Menu)
  chat.css       - inline chat overlay styles
  legal.css      - privacy and legal page typography
  app.css        - entry point that imports all partials

Alpine.js frontend (resources/js/):
  app.js           - leadModal (form + honeypot), genlaChat widget,
                     ui store (\$store.ui), localeUrl, postJson,
                     escapeHtml, formatMarkdown helpers
  fluid-cursor.js  - WebGL fluid simulation canvas cursor effect
  neural-field.js  - animated neural-network particle background
  reveal.js        - Intersection Observer scroll-reveal

Blade layout and components:
  layouts/base.blade.php          - full HTML shell, Vite assets, Alpine,
                                    SEO meta, Open Graph, Twitter Card,
                                    Schema.org JSON-LD, favicon links
  components/site-header.blade.php - responsive nav, lang switcher, CTA
  components/site-footer.blade.php - footer with labs nav and social links
  components/footer-cta.blade.php  - reusable CTA section with 3 actions
  components/chat.blade.php        - inline chat widget wrapper
  components/cta.blade.php         - action button group
  components/glyph.blade.php       - decorative SVG glyph
  components/lang-switcher.blade.php - RU/EN locale toggle links
  components/media.blade.php       - responsive lab hero image/video
  components/nav-arrow.blade.php   - right-arrow SVG icon
  partials/bottom-bar.blade.php    - mobile bottom navigation bar
  partials/chat-overlay.blade.php  - floating AI chat trigger overlay
  partials/mobile-nav.blade.php    - slide-in mobile menu drawer

Controllers and support:
  HomeController   - renders home with grid labs from config
  Genla.php        - URL helpers, lab lookup, locale detection, AI host
  SetLocale.php    - detects ru/en from URL prefix, sets app locale
"@

# ──────────────────────────────────────────────────────────
# 3 — PUBLIC PAGES
# ──────────────────────────────────────────────────────────
Write-Host "[3/10] Public pages" -ForegroundColor Cyan
git add resources/views/labs/show.blade.php
git add resources/views/pages/about.blade.php
git add resources/views/pages/blog.blade.php
git add resources/views/pages/cases.blade.php
git add resources/views/pages/mission.blade.php
git add resources/views/pages/partners.blade.php
git add resources/views/privacy.blade.php
git add app/Http/Controllers/LabController.php

Commit-WithFile @"
feat(pages): lab pages, cases, blog, mission, partners, about, privacy

Lab page (resources/views/labs/show.blade.php):
  Dynamic hero with image/video, title, subtitle
  Feature list with icons and descriptions
  Product cards grid (image, name, description, CTA button)
  Inline genlaChat widget
  footer-cta component with lab-specific action buttons
  LabController resolves lab slug from config and passes data to view
  Supports subdomain routing (showSub action for {lab}.genla.tech)

Content pages (resources/views/pages/):
  about.blade.php    - company story, team section, core values
  mission.blade.php  - mission statement, goals, principles
  cases.blade.php    - client case studies grid (before / solution / result)
  blog.blade.php     - staged blog placeholder with roadmap content
  partners.blade.php - partnership info with CTA section

Privacy page (resources/views/privacy.blade.php):
  Full privacy policy for genla.tech and ai.genla.tech
  Cookie policy, data retention periods, contact details

All pages share:
  Extend layouts/base with proper title/description/content sections
  Use x-site-header and x-site-footer components
  Include x-footer-cta for conversion
  i18n via __() helper for all user-facing strings
  Reveal scroll animation classes on section elements
"@

# ──────────────────────────────────────────────────────────
# 4 — AI INTERFACE
# ──────────────────────────────────────────────────────────
Write-Host "[4/10] AI interface" -ForegroundColor Cyan
git add resources/views/ai.blade.php
git add app/Services/GenlaAi/
git add app/Http/Controllers/AiAgentController.php
git add app/Http/Controllers/ChatController.php

Commit-WithFile @"
feat(ai): standalone AI interface, GenlaAi service layer, chat controllers

Standalone AI interface (resources/views/ai.blade.php):
  Self-contained single-file SPA that does NOT extend base layout
  Inline CSS (~2200 lines): sidebar, chat bubbles, code blocks,
    file attachments preview, typing indicator, theme (dark/light)
  Inline JS (~2700 lines): Alpine.js genlaChat component with
    message history, markdown rendering, file attachment handling,
    multi-locale support (ru/en), theme toggle, PWA install prompt,
    sidebar with chat history, mobile hamburger menu
  Sidebar layout: theme + lang square buttons (top row, same size as
    hamburger), Install app button, New dialog button
  AI avatar in message bubbles uses favicon-512.png (sphere icon)
  Served at /ai in path mode and ai.<domain> in subdomain mode
  Favicon links: favicon-32.png, favicon-180.png cache-busted v=8

GenlaAi service layer (app/Services/GenlaAi/):
  Contracts/AssistantDriver.php
    Interface: reply(array messages, string locale): AssistantReply
  AssistantReply.php
    Value object: text, parentId, provider string
  Drivers/HttpAgentDriver.php
    HTTP call to external AI API (GENLA_AI_ENDPOINT, GENLA_AI_KEY)
    Handles JSON streaming response, returns AssistantReply
  Drivers/ScriptedDriver.php
    Deterministic scripted responses for fallback/demo mode
    Used when AI endpoint is not configured in .env

Controllers:
  AiAgentController - POST /api/chat, dispatches to AssistantDriver,
    returns JSON with text, parentId, provider
  ChatController - POST /ai/chat, throttled 20 per minute,
    inline chat widget endpoint for home and lab page overlays
"@

# ──────────────────────────────────────────────────────────
# 5 — LEADS
# ──────────────────────────────────────────────────────────
Write-Host "[5/10] Leads" -ForegroundColor Cyan
git add app/Models/Lead.php
git add app/Http/Controllers/LeadController.php
git add "database/migrations/2026_06_22_000001_create_leads_table.php"
git add "database/migrations/2026_06_24_000001_add_email_to_leads_table.php"
git add "database/migrations/2026_06_28_000001_add_source_to_leads_table.php"
git add resources/views/partials/modal.blade.php

Commit-WithFile @"
feat(leads): lead capture, resilient controller, honeypot, consultation modal

Lead model (app/Models/Lead.php):
  Fillable: name, contact, email, message, action, lab, source, ip, user_agent
  Casts for action string and timestamps

Migrations (incremental, safe to run individually):
  2026_06_22 - create leads table (name, contact, message, action,
               lab, ip, user_agent columns)
  2026_06_24 - add email column (nullable, after contact)
  2026_06_28 - add source column (nullable URL, max 255)

LeadController (app/Http/Controllers/LeadController.php):
  Honeypot: company_site field trap, bots receive silent ok:true
  Validation: name (req 120), contact (req 160), email (nullable),
    message (nullable 2000), action (Rule::in), lab, source
  keepExistingColumns(): reads Schema::getColumnListing and drops
    unknown keys so form still works if a migration is not yet run
  DB create wrapped in try/catch: on failure logs error and calls
    notifyWithoutPersisting() so the lead is never silently lost
  dispatch(fn)->afterResponse(): Telegram notify fires after HTTP
    response, keeping form submission fast regardless of Telegram
  Route: POST /leads, throttle:8,1 in all routing modes

Consultation modal (resources/views/partials/modal.blade.php):
  Alpine.js leadModal: name, contact (required), email, message
  Honeypot .hp-field: position absolute left -9999px, invisible to
    users, auto-filled by bots, triggers silent discard on backend
  Client-side validation with inline error display
  Sends to localeUrl('/leads') with action, lab, source metadata
  Success state: animated checkmark and translated confirmation text
  Privacy policy link rendered in form footer
  Activated from anywhere via \$store.ui.openModal(action, lab, name)
"@

# ──────────────────────────────────────────────────────────
# 6 — TELEGRAM
# ──────────────────────────────────────────────────────────
Write-Host "[6/10] Telegram" -ForegroundColor Cyan
git add app/Services/TelegramNotifier.php
git add app/Console/Commands/TelegramTest.php
git add app/Console/Commands/TelegramChats.php

Commit-WithFile @"
feat(telegram): TelegramNotifier service, artisan setup commands

TelegramNotifier (app/Services/TelegramNotifier.php):
  token() / chat() / configured() / enabled() helpers reading genla config
  send(html, chat?): POST api.telegram.org/sendMessage with parse_mode HTML,
    retry 2 times with 250ms delay, 8 second timeout
  sendLead(Lead): main lead delivery entry point
    Logs explicitly when SKIPPED (enabled=false or missing token/chat)
    so the silent-loss trap is eliminated (test command works but
    real leads were previously lost with no log entry)
    Detects migrate_to_chat_id in Telegram response (group promoted
    to supergroup), auto-retries to new chat_id and logs the new id
    with instruction to update GENLA_NOTIFY_TELEGRAM_CHAT in .env
    Catches all Throwable, never propagates exceptions, always logs
  formatLead(Lead): rich HTML with emoji labels, clickable contact
    links (email/tel/@telegram), lab hyperlink, source page URL,
    optional message body, timestamp in configured TZ, IP footer
  contactLink(): smart formatter, detects email / @handle / phone
  getMe() / getUpdates(): bot info helpers used by artisan commands

Artisan commands:
  genla:telegram:test
    Sends a test message bypassing the enabled flag (shows warning
    if disabled), verifies token and chat_id are valid end to end
  genla:telegram:chats
    Lists all chats the bot has seen via getUpdates, showing
    id, type, title to help find the correct numeric chat_id
    for supergroups (format -100xxxxxxxxxx)
"@

# ──────────────────────────────────────────────────────────
# 7 — i18n
# ──────────────────────────────────────────────────────────
Write-Host "[7/10] i18n" -ForegroundColor Cyan
git add lang/ru/genla.php
git add lang/en/genla.php

Commit-WithFile @"
feat(i18n): ru/en localisation, full Genla content translations

lang/ru/genla.php (Russian, default locale):
  company: name, full_name, slogan, description, address
  ui: nav labels, CTA buttons, privacy link, cookie notice
  actions: consultation, presentation, call, contact
    (keys, labels, descriptions for each action type)
  action_labels: short labels for Telegram notification messages
  form: field labels, placeholders, validation errors, success texts
  labs: full data for all 6 tiles (GenUp, GenReview, GenEtics,
    GenBox, GenBlock, AI core tile)
    Each lab: name, slug, subtitle, hero image, features array,
    products array, actions array, is_ai flag, tile_image path
  cases_page: 6 client case studies with industry, scale, before,
    solution, result arrays
  about_page, mission_page, partners_page, blog_page: full content
  chat: greeting message, suggestion chips, typing indicator, errors
  footer: nav sections, social links, legal text

lang/en/genla.php (English locale):
  Mirror structure to ru with full English translations
  Lab names: GenUp, GenReview, GenEtics, GenBox, GenBlock
  Cases, pages, form, ui fully translated
  Served at /en/* (path mode) or en.<domain> (subdomain mode)
  Locale detection: SetLocale middleware reads first URL segment
"@

# ──────────────────────────────────────────────────────────
# 8 — CONFIG / ROUTES / TOOLS
# ──────────────────────────────────────────────────────────
Write-Host "[8/10] Config / routes / tools" -ForegroundColor Cyan
git add config/
git add routes/
git add tools/

Commit-WithFile @"
feat(config): application config, web routing, genla config, selfcheck tool

config/genla.php (main application config):
  routing.mode: 'path' (local dev) or 'subdomain' (production)
  routing.base_domain: base domain for subdomain routing
  routing.ai_host: standalone AI subdomain (ai.genla.tech)
  labs: ordered map of all lab slugs with full tile/page data
  actions: available lead actions with labels and descriptions
  notify: Telegram/email settings (token, chat, enabled, TZ, invite)

Standard Laravel configs (config/):
  app.php      - locale ru, timezone Europe/Moscow, providers list
  database.php - SQLite driver, env-switchable for production
  cache.php    - file driver (production-safe, no Redis required)
  session.php  - file driver
  queue.php    - sync driver (deferred dispatch via afterResponse)
  logging.php  - daily file channel, 14-day retention
  mail.php, services.php, auth.php, filesystems.php (standard)
  timeweb.php  - Timeweb Cloud hosting-specific trusted proxy settings

routes/web.php:
  Two routing modes selected from config at boot time:
  path mode (local dev):
    All routes at / with /en prefix for EN locale
    Includes /ai route as regular path
  subdomain mode (production):
    genla.tech for home routes
    {lab}.genla.tech for individual lab pages
    ai.genla.tech for standalone AI interface
  AI subdomain registered first (domain() binding)
  Home routes: /, /privacy, /about, /mission, /cases, /blog, /partners
  Lab route: /{lab} constrained by regex of known slugs
  POST /leads throttle:8,1 and POST /ai/chat throttle:20,1
  All routes duplicated for ru (no prefix) and en (/en prefix)

tools/selfcheck.ps1:
  149-check automated health suite for local and CI validation
  Checks HTTP 200 on all public pages, absence of 500 errors,
  no unrendered Blade expressions leaked to HTML, OG meta presence,
  footer CTA block, mobile tab-bar
  Expected result: PASS 149  FAIL 0  WARN 2 (pre-existing h1 warnings)
"@

# ──────────────────────────────────────────────────────────
# 9 — ASSETS
# ──────────────────────────────────────────────────────────
Write-Host "[9/10] Public assets" -ForegroundColor Cyan
git add public/.htaccess
git add public/index.php
git add public/robots.txt
git add public/favicon.ico
git add public/favicon-16.png
git add public/favicon-32.png
git add public/favicon-180.png
git add public/favicon-512.png
git add public/genla-favicon.jpg
git add public/genla-icon.jpg
git add public/genla-icon-no-bg.png
git add public/og-cover.png

Commit-WithFile @"
chore(assets): public entry point, favicon set (sphere), brand images, OG cover

public/index.php  - Laravel HTTP kernel entry point
public/.htaccess  - Apache rewrite rules (all requests to index.php)
public/robots.txt - crawler rules, disallow /api

Favicon set (glossy purple sphere design, cache version v=8 in templates):
  favicon.ico      - 32x32 ICO container, default browser tab icon
  favicon-16.png   - 16x16, small tab and bookmark icon
  favicon-32.png   - 32x32, standard browser tab and taskbar icon
  favicon-180.png  - 180x180, Apple touch icon for iOS home screen
  favicon-512.png  - 512x512, PWA icon, Telegram AI chat avatar,
                     Schema.org Organization logo in JSON-LD
  Sphere backup stored in public/favicons-old/ (not committed)

Brand images:
  genla-favicon.jpg   - 360x360 Genla wordmark on white background
  genla-icon.jpg      - Genla wordmark with background (21 kB)
  genla-icon-no-bg.png - Transparent PNG wordmark (2.1 MB, lossless)
                         Used as home page hero logo (.os__logo),
                         site footer, mobile nav header, AI chat header
                         Width: min(538px, 78vw) -- 40% larger than initial
  og-cover.png        - 1200x630 Open Graph and Twitter Card cover image
                         Used in base layout and ai.blade.php meta tags

Cache-bust query versions in templates:
  favicon set: ?v=8 (main site and AI interface)
  genla-icon-no-bg.png: ?v=4
  genla-icon.jpg: ?v=3
  og-cover.png: ?v=1
"@

# ──────────────────────────────────────────────────────────
# 10 — FRONTEND BUILD
# ──────────────────────────────────────────────────────────
Write-Host "[10/10] Frontend build (force add)" -ForegroundColor Cyan
git add -f public/build/

Commit-WithFile @"
chore(build): Vite production build, compiled CSS/JS, Inter variable fonts

Note: public/build is in .gitignore and added with git add --force
to keep deployment-ready assets version-controlled alongside source.

public/build/manifest.json
  Vite asset manifest mapping source files to content-hashed filenames

public/build/assets/app-DC1YHWkU.css (50.8 kB, gzip 11.0 kB):
  Complete design system compiled from resources/css/*.css
  All tokens, components, animations, responsive breakpoints included
  .os__logo width: min(538px, 78vw) -- hero logo 40 percent larger

public/build/assets/app-CbC8TIat.js (75.5 kB, gzip 25.4 kB):
  Alpine.js bundled with all app.js components
  leadModal, genlaChat, ui store, postJson, escapeHtml, formatMarkdown
  fluid-cursor.js (WebGL), neural-field.js, reveal.js included

Inter variable font subset (WOFF2, all weights):
  inter-latin-wght-normal            48 kB  primary Latin glyphs
  inter-latin-ext-wght-normal        85 kB  extended Latin
  inter-cyrillic-wght-normal         19 kB  full Cyrillic for ru locale
  inter-cyrillic-ext-wght-normal     26 kB  extended Cyrillic
  inter-greek-wght-normal            19 kB  Greek subset
  inter-greek-ext-wght-normal        11 kB  extended Greek
  inter-vietnamese-wght-normal       10 kB  Vietnamese subset

Server deploy checklist:
  Upload public/build/ directory
  Run: php artisan view:clear
  Run: php artisan config:clear
"@

Write-Host "`n=== ALL COMMITS DONE ===" -ForegroundColor Green
git log --oneline
