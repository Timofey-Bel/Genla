#requires -Version 5.1
<#
    selfcheck.ps1 - regression / structure smoke test for genla.tech

    Verifies, after any change, that every section and direction:
      - responds with HTTP 200;
      - has the social preview wired to og-cover.png (not the favicon);
      - renders the unified 3-button footer CTA (.lab-cta block);
      - renders the mobile tab-bar with the central "AI" orb;
      - contains no leaked Blade tags or Laravel error output.

    ASCII-only on purpose (Cyrillic literals break .ps1 parsing on this host).
    Cyrillic markers are built at runtime from code points where needed.

    Usage:
      powershell -ExecutionPolicy Bypass -File tools/selfcheck.ps1
      powershell -File tools/selfcheck.ps1 -BaseUrl http://genla
      powershell -File tools/selfcheck.ps1 -BaseUrl https://genla.ru
#>
param(
    [string]$BaseUrl = 'https://genla.ru'
)

$ProgressPreference = 'SilentlyContinue'
[Console]::OutputEncoding = [Text.Encoding]::UTF8

$BaseUrl = $BaseUrl.TrimEnd('/')

# Sections (content pages) + the eight directions + GenReview entry point + AI.
$routes = @(
    '/', '/about', '/mission', '/capabilities', '/cases', '/become-partner', '/privacy', '/ai',
    '/genreview', '/genclaw', '/genpromo', '/genfleet', '/gencloud', '/gentype', '/gensec', '/genx'
)

# Pages that must carry the unified footer CTA (sections + labs, not /ai, not /privacy).
$ctaRoutes = @('/about', '/mission', '/capabilities', '/cases', '/become-partner',
    '/genreview', '/genclaw', '/genpromo', '/genfleet', '/gencloud', '/gentype', '/gensec', '/genx')

# Retired addresses that must keep answering with a 301 to their new home.
$movedRoutes = @{
    '/expertise' = '/capabilities'
    '/partners'  = '/become-partner'
    '/genspace'  = '/gencloud'
    '/genetics'  = '/gentype'
    '/genup'     = '/genreview'
    '/gendev'    = '/genreview'
    '/genbox'    = '/genfleet'
    '/gencube'   = '/genfleet'
    '/genbook'   = '/genfleet'
    '/genview'   = '/genfleet'
}

# Standalone full-screen app (own layout, no marketing chrome / tab-bar).
$standaloneRoutes = @('/ai')

$fail = 0
$pass = 0
$warn = 0

function Test-Case {
    param([bool]$Condition, [string]$Label)
    if ($Condition) {
        $script:pass++
        Write-Host ("  [PASS] " + $Label)
    }
    else {
        $script:fail++
        Write-Host ("  [FAIL] " + $Label) -ForegroundColor Red
    }
}

function Warn-Case {
    param([bool]$Condition, [string]$Label)
    if (-not $Condition) {
        $script:warn++
        Write-Host ("  [WARN] " + $Label) -ForegroundColor Yellow
    }
}

Write-Host ("Self-check against " + $BaseUrl)
Write-Host ("-" * 60)

foreach ($route in $routes) {
    $url = $BaseUrl + $route
    Write-Host ""
    Write-Host ("# " + $url)

    try {
        $resp = Invoke-WebRequest -Uri $url -UseBasicParsing -TimeoutSec 20
    }
    catch {
        $script:fail++
        Write-Host ("  [FAIL] request error: " + $_.Exception.Message) -ForegroundColor Red
        continue
    }

    $code = [int]$resp.StatusCode
    $html = [string]$resp.Content
    Test-Case ($code -eq 200) ("HTTP 200 (got " + $code + ")")

    # No leaked Blade / Laravel error output.
    Test-Case (-not ($html -match 'Whoops|Undefined variable|syntax error|ParseError|Symfony\\Component')) 'no server error / exception leaked'
    Test-Case (-not ($html -match '\{\{\s*\$')) 'no unrendered Blade expressions'

    # og:image must point at og-cover.png, never the favicon icon.
    $ogMatch = [regex]::Match($html, 'property="og:image"\s+content="([^"]+)"')
    if ($ogMatch.Success) {
        $ogVal = $ogMatch.Groups[1].Value
        Test-Case ($ogVal -match 'og-cover\.png') ("og:image -> og-cover.png (" + $ogVal + ")")
        Test-Case (-not ($ogVal -match 'genla-icon-no-bg')) 'og:image is not the favicon icon'
    }
    else {
        Test-Case $false 'og:image meta present'
    }

    # Footer CTA: unified 3-button block.
    if ($ctaRoutes -contains $route) {
        Test-Case ($html -match 'lab-cta__title') 'footer CTA block present (.lab-cta)'
        Test-Case ($html -match 'class="btn btn--chat btn--lg"') 'footer CTA has "discuss now" link to AI'
        Test-Case ($html -match '/ai"') 'footer CTA links to AI interface'
    }

    # Mobile tab-bar: central AI orb labelled AI (skipped for the standalone AI app).
    if ($standaloneRoutes -notcontains $route) {
        Test-Case ($html -match 'tabbar__ai-label"\s*>\s*AI\s*<') 'mobile tab-bar central label is "AI"'
        Test-Case ($html -match 'tabbar__item') 'mobile tab-bar present'
    }

    # Exactly one H1 per page is healthy for structure (warn only).
    $h1 = ([regex]::Matches($html, '<h1\b')).Count
    Warn-Case ($h1 -eq 1) ("expected 1 <h1>, found " + $h1)
}


# Retired direction slugs must 301 to their replacement, not 404.
foreach ($route in $movedRoutes.Keys) {
    $url = $BaseUrl + $route
    $want = $movedRoutes[$route]
    Write-Host ""
    Write-Host ("# " + $url + " (expect 301 -> " + $want + ")")

    # HttpWebRequest instead of Invoke-WebRequest: on PowerShell 5.1 the latter
    # throws InvalidOperationException with -MaximumRedirection 0 instead of
    # handing back the 3xx response, so the Location header is unreachable.
    $code = 0
    $loc = ''
    $resp = $null
    try {
        $req = [System.Net.HttpWebRequest]::Create($url)
        $req.AllowAutoRedirect = $false
        $req.Method = 'GET'
        $req.Timeout = 20000
        try {
            $resp = $req.GetResponse()
        }
        catch [System.Net.WebException] {
            $resp = $_.Exception.Response
        }

        if ($null -eq $resp) {
            throw 'no response'
        }

        $code = [int]$resp.StatusCode
        $loc = [string]$resp.Headers['Location']
    }
    catch {
        $script:fail++
        Write-Host ("  [FAIL] request error: " + $_.Exception.Message) -ForegroundColor Red
        continue
    }
    finally {
        if ($null -ne $resp) { $resp.Close() }
    }

    Test-Case ($code -eq 301) ("HTTP 301 (got " + $code + ")")
    Test-Case ($loc -match ([regex]::Escape($want) + '$')) ("Location -> " + $want + " (got " + $loc + ")")
}

Write-Host ""
Write-Host ("-" * 60)
Write-Host ("PASS: " + $pass + "   FAIL: " + $fail + "   WARN: " + $warn)

if ($fail -gt 0) {
    Write-Host "SELF-CHECK FAILED" -ForegroundColor Red
    exit 1
}
Write-Host "SELF-CHECK OK" -ForegroundColor Green
exit 0
