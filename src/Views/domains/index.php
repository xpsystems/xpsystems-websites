<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

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

  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div id="preload-bar"></div>

<?php $component('header'); ?>

<!-- Hero Section -->
<header class="hero">
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">Domain Portfolio</div>
    <h1 class="hero-title reveal" style="--delay: 50ms">Our Digital Footprint</h1>
    <p class="hero-description reveal" style="--delay: 100ms">
      A comprehensive registry of domains and cloud infrastructure owned and operated by xpsystems.
    </p>
  </div>

  <div class="section-divider">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M0,0 C300,100 900,0 1200,100 L1200,120 L0,120 Z" class="divider-fill-alt"></path>
    </svg>
  </div>
</header>

<!-- Active Domains Grid -->
<main class="services-section">
  <div class="container">
    <div class="domain-search-wrap reveal">
      <svg class="domain-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      <input type="text" id="domain-search" class="domain-search-input" placeholder="Filter domains (e.g. host, eu, ptero)…" autocomplete="off">
    </div>

    <div class="services-grid">
      <?php foreach ($activeGroups as $index => $category): ?>
        <div class="card <?= !empty($category['highlight']) ? 'card-partner' : '' ?> reveal" style="--delay: <?= 100 + ($index * 40) ?>ms">
          <div class="card-top">
            <span class="card-badge <?= !empty($category['highlight']) ? 'card-badge-service' : '' ?>">
              <?= $e($category['title']) ?>
            </span>
            <h3 class="card-name"><?= count($category['domains']) ?> Domains</h3>
          </div>
          <ul class="link-list">
            <?php foreach ($category['domains'] as $item): ?>
              <?php $dName = $item['domain']; ?>
              <li>
                <a href="https://<?= $e($dName) ?>" target="_blank" rel="noopener noreferrer" class="card-sublink">
                  <span class="mono"><?= $e($dName) ?></span>
                  <?php if (!empty($item['badge'])): ?>
                    <span class="badge badge-<?= strtolower($item['badge']) ?>"><?= $e($item['badge']) ?></span>
                  <?php endif; ?>
                  <svg class="icon-ext" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="7 7 17 17"/><polyline points="17 7 17 17 7 17"/>
                  </svg>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider" style="margin-top:-30px;">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M0,60 C300,0 900,120 1200,40 L1200,120 L0,120 Z" class="divider-fill-bg"></path>
    </svg>
  </div>
</main>

<!-- Legacy Section -->
<?php if (!empty($legacyGroup)): ?>
  <section class="legacy-section">
    <div class="container">
      <div class="section-header reveal">
        <h2 class="section-title"><?= $e($legacyGroup['title']) ?></h2>
        <p class="section-subtitle">Historical domains previously part of the network.</p>
      </div>
      <div class="legacy-grid reveal" style="--delay: 100ms">
        <?php foreach ($legacyGroup['domains'] as $item): ?>
          <div class="legacy-item">
            <span class="expired-link">
              <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
              </svg>
              <?= $e($item['domain']) ?>
            </span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<div class="section-divider" style="margin-top:-30px;">
  <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
    <path d="M0,0 L1200,80 L1200,120 L0,120 Z" class="divider-fill-footer"></path>
  </svg>
</div>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
