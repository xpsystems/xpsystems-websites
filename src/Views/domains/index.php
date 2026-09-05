<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

  <script>
  (function(){
    try {
      var s = localStorage.getItem('xps-theme') || 'system';
      var r = s === 'system'
        ? (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark')
        : s;
      document.documentElement.setAttribute('data-theme', r);
    } catch(e) {}
  })();
  </script>

  <link rel="icon" type="image/svg+xml" href="/assets/img/icon.svg">
  <link rel="alternate icon" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>

<?php $component('header'); ?>
<?php $component('transition-banner'); ?>

<!-- Hero Section -->
<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="hero-backdrop-glow" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">
      <svg class="eyebrow-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="2" y1="12" x2="22" y2="12"/>
        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
      </svg>
      <span>Autonomous System &bull; Domain Intelligence &amp; Registry</span>
    </div>
    <h1 class="hero-title reveal" style="--delay: 50ms">
      <span class="text-gradient">Our Digital Footprint</span><br>
      <span class="hero-title-accent">&amp; Sovereign Namespaces</span>
    </h1>
    <p class="hero-tagline reveal" style="--delay: 100ms">
      A comprehensive registry of European domains, dedicated infrastructure nodes, and authoritative nameserver clusters &mdash; synchronized directly with <a href="https://dnbx.de" target="_blank" rel="noopener noreferrer" style="color:var(--accent);text-decoration:underline;">DNBX.de Public JSON API</a>.
    </p>
  </div>
</header>

<!-- Active Domains Explorer -->
<main class="section section-alt">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container" style="position:relative;z-index:2;">

    <!-- DNBX.de Live Telemetry Strip -->
    <div class="dnbx-telemetry-grid reveal" style="--delay: 10ms">
      <div class="dnbx-stat-card spotlight-card">
        <div class="dnbx-stat-header">
          <span>Active Domains</span>
          <span class="dnbx-health-badge"><span class="health-dot"></span>Live</span>
        </div>
        <div class="dnbx-stat-val dnbx-stat-val--green" id="dnbx-active-val">92</div>
        <span class="dnbx-stat-sub">Active in European mesh</span>
      </div>

      <div class="dnbx-stat-card spotlight-card">
        <div class="dnbx-stat-header">
          <span>Total Managed</span>
          <span style="color:var(--text-dim);">DNBX.de</span>
        </div>
        <div class="dnbx-stat-val dnbx-stat-val--cyan" id="dnbx-total-val">159</div>
        <span class="dnbx-stat-sub">Across primary &amp; rollout</span>
      </div>

      <div class="dnbx-stat-card spotlight-card">
        <div class="dnbx-stat-header">
          <span>Unique TLDs</span>
          <span style="color:var(--text-dim);">Portfolio</span>
        </div>
        <div class="dnbx-stat-val dnbx-stat-val--accent" id="dnbx-tlds-val">21</div>
        <span class="dnbx-stat-sub">.de, .eu, .dev, .org, .net…</span>
      </div>

      <div class="dnbx-stat-card spotlight-card">
        <div class="dnbx-stat-header">
          <span>DNBX JSON API</span>
          <span class="dnbx-health-badge" id="dnbx-api-health"><span class="health-dot"></span>Online</span>
        </div>
        <div class="dnbx-stat-val" id="dnbx-ping-val" style="font-size:1.3rem; margin-top:3px;">~4ms</div>
        <span class="dnbx-stat-sub"><a href="https://dnbx.de/api/ping" target="_blank" rel="noopener noreferrer" style="color:var(--accent);text-decoration:none;">dnbx.de/api/ping ↗</a></span>
      </div>
    </div>

    <!-- Official Authoritative Nameserver Clusters Card -->
    <div class="domain-ns-card spotlight-card reveal" style="--delay: 20ms">
      <div class="ns-card-left">
        <div class="ns-card-icon" aria-hidden="true">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
            <line x1="6" y1="6" x2="6.01" y2="6"></line>
            <line x1="6" y1="18" x2="6.01" y2="18"></line>
          </svg>
        </div>
        <div>
          <div class="ns-card-title">Authoritative Anycast Nameservers (ternis.net &amp; nameserver01–06.eu)</div>
          <div class="ns-card-desc">Redundant high-availability DNS clusters managed via DNBX.de:</div>
        </div>
      </div>
      <div class="ns-card-pills">
        <div class="ns-pill">
          <span class="ns-role">NS1:</span>
          <code class="ns-host">one.ns.ternis.net</code>
          <button class="ns-copy-btn" data-copy="one.ns.ternis.net" data-copy-label="NS1 Host" title="Copy nameserver" type="button">Copy</button>
        </div>
        <div class="ns-pill">
          <span class="ns-role">NS2:</span>
          <code class="ns-host">two.ns.ternis.net</code>
          <button class="ns-copy-btn" data-copy="two.ns.ternis.net" data-copy-label="NS2 Host" title="Copy nameserver" type="button">Copy</button>
        </div>
        <div class="ns-pill" title="Primary European Authoritative Cluster">
          <span class="ns-role" style="color:var(--green);">PRIMARY:</span>
          <code class="ns-host">nameserver01–06.eu</code>
          <button class="ns-copy-btn" data-copy="nameserver01.eu" data-copy-label="Primary NS" title="Copy primary nameserver" type="button">Copy</button>
        </div>
      </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="domain-toolbar reveal">
      <div class="domain-search-wrap">
        <svg class="domain-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" id="domain-search" class="domain-search-input" placeholder="Search domains by name or extension (e.g. host, eu, de, ptero)…" autocomplete="off">
        <div class="domain-search-kbd">
          <kbd>/</kbd>
        </div>
      </div>

      <div class="domain-filters-bar">
        <button class="domain-filter-pill active" data-filter="all" type="button">
          All Namespaces
        </button>
        <?php foreach ($activeGroups as $idx => $cat): ?>
          <button class="domain-filter-pill" data-filter="cat-<?= $idx ?>" type="button">
            <?= $e($cat['title']) ?>
            <span class="pill-count">(<?= count($cat['domains']) ?>)</span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>

    <p class="domain-counter-status" id="domain-counter-status"></p>

    <!-- Domain Category Grid -->
    <div class="services-grid">
      <?php foreach ($activeGroups as $idx => $category): ?>
        <div class="domain-card spotlight-card <?= !empty($category['highlight']) ? 'domain-card--highlight' : '' ?> reveal" data-category="cat-<?= $idx ?>" style="--delay: <?= 40 + ($idx * 30) ?>ms">
          <div class="domain-card-header">
            <h3 class="domain-category-title"><?= $e($category['title']) ?></h3>
            <span class="domain-count-badge"><?= count($category['domains']) ?> domains</span>
          </div>

          <div class="domain-list">
            <?php foreach ($category['domains'] as $item): ?>
              <?php $dName = $item['domain']; ?>
              <div class="domain-row" data-domain="<?= $e(strtolower($dName)) ?>">
                <div class="domain-left">
                  <span class="domain-status-dot" title="Operational"></span>
                  <span class="domain-name"><?= $e($dName) ?></span>
                  <?php if (!empty($item['badge'])): ?>
                    <span class="badge badge-<?= strtolower($item['badge']) ?>"><?= $e($item['badge']) ?></span>
                  <?php endif; ?>
                </div>

                <div class="domain-actions">
                  <button class="domain-copy-btn" title="Copy domain" data-copy="<?= $e($dName) ?>" data-copy-label="<?= $e($dName) ?>" type="button">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                      <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                  </button>
                  <a href="https://<?= $e($dName) ?>" target="_blank" rel="noopener noreferrer" class="domain-ext-btn" title="Open https://<?= $e($dName) ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                    </svg>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- DNBX.de Public JSON API Showcase & Live Interactive Query Terminal -->
    <section class="dnbx-api-showcase spotlight-card reveal" style="--delay: 150ms">
      <div class="dnbx-showcase-header">
        <div>
          <div class="dnbx-showcase-title-row">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent);">
              <circle cx="12" cy="12" r="10"/>
              <line x1="2" y1="12" x2="22" y2="12"/>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            <h2 class="dnbx-showcase-title">DNBX.de Public Domain API</h2>
            <span class="dnbx-api-badge">CORS Enabled &bull; REST JSON</span>
          </div>
          <p class="dnbx-showcase-desc">
            Direct programmatic access to our domain database, TLD analytics, and authoritative nameservers via <a href="https://dnbx.de" target="_blank" rel="noopener noreferrer" style="color:var(--accent);text-decoration:underline;">dnbx.de</a>. No authentication required.
          </p>
        </div>

        <a href="https://dnbx.de" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm" style="align-self:center;">
          <span>Visit DNBX.de</span>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
        </a>
      </div>

      <!-- Endpoint Selector Tabs -->
      <div class="dnbx-tabs-row" id="dnbx-tabs">
        <button class="dnbx-tab-btn active" data-endpoint="stats" type="button">GET /api/stats</button>
        <button class="dnbx-tab-btn" data-endpoint="nameservers" type="button">GET /api/nameservers</button>
        <button class="dnbx-tab-btn" data-endpoint="domains" type="button">GET /api/domains?limit=3</button>
        <button class="dnbx-tab-btn" data-endpoint="tlds" type="button">GET /api/tlds</button>
        <button class="dnbx-tab-btn" data-endpoint="ping" type="button">GET /api/ping</button>
      </div>

      <!-- Terminal Preview Box -->
      <div class="dnbx-terminal-box">
        <div class="dnbx-terminal-bar">
          <span class="dnbx-term-url" id="dnbx-term-url">
            <span style="color:var(--green);font-weight:700;">HTTP GET</span>
            <code id="dnbx-url-text">https://dnbx.de/api/stats</code>
          </span>
          <div class="dnbx-term-actions">
            <button class="dnbx-term-btn primary" id="dnbx-run-btn" type="button">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              <span>Execute Live</span>
            </button>
            <button class="dnbx-term-btn" id="dnbx-copy-btn" type="button">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
              <span>Copy</span>
            </button>
          </div>
        </div>
        <pre class="dnbx-terminal-code" id="dnbx-terminal-output">// Click "Execute Live" or select any endpoint above to query DNBX.de JSON API
{
  "status": "success",
  "data": {
    "active_domains": 92,
    "total_managed": 159,
    "unique_tlds": 21
  }
}</pre>
      </div>
    </section>

  </div>
</main>

<!-- Legacy Archive Section -->
<?php if (!empty($legacyGroup)): ?>
  <section class="legacy-section">
    <div class="container">
      <div class="section-header reveal">
        <span class="section-eyebrow">Archive &amp; Deprecated</span>
        <h2 class="section-title"><?= $e($legacyGroup['title']) ?></h2>
        <p class="section-sub">Historical domains previously part of the network, cataloged for archival integrity.</p>
      </div>
      <div class="legacy-grid reveal" style="--delay: 100ms">
        <?php foreach ($legacyGroup['domains'] as $item): ?>
          <div class="legacy-item">
            <span><?= $e($item['domain']) ?></span>
            <svg class="expired-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
            </svg>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
