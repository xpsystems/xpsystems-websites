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

  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>

<?php $component('header'); ?>

<!-- Hero Section -->
<header class="hero">
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">
      <svg class="eyebrow-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="2" y1="12" x2="22" y2="12"/>
        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
      </svg>
      <span>Autonomous System &bull; Domain Portfolio</span>
    </div>
    <h1 class="hero-title reveal" style="--delay: 50ms">
      Our Digital Footprint<br>
      <span class="hero-title-accent">&amp; Sovereign Namespaces</span>
    </h1>
    <p class="hero-tagline reveal" style="--delay: 100ms">
      A comprehensive registry of European domains, dedicated infrastructure nodes, and project gateways operated by xpsystems.
    </p>
  </div>
</header>

<!-- Active Domains Explorer -->
<main class="section section-alt">
  <div class="container">
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

    <div class="services-grid">
      <?php foreach ($activeGroups as $idx => $category): ?>
        <div class="domain-card <?= !empty($category['highlight']) ? 'domain-card--highlight' : '' ?> reveal" data-category="cat-<?= $idx ?>" style="--delay: <?= 40 + ($idx * 30) ?>ms">
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

