<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <script>
  (function(){
    try {
      var s = localStorage.getItem('xps-theme') || 'dark';
      document.documentElement.setAttribute('data-theme', s);
    } catch(e) {}
  })();
  </script>

  <link rel="icon" type="image/svg+xml" href="/assets/img/icon.svg">
  <link rel="alternate icon" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>
<?php $component('transition-banner'); ?>
<?php $component('header'); ?>

<!-- Hero Section -->
<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow">
      <span class="status-dot green"></span>
      <span>Autonomous System &bull; Domain Intelligence &amp; Registry</span>
    </div>

    <h1 class="hero-title">
      Our Digital Footprint<br>
      <span class="hero-title-accent">&amp; Sovereign Namespaces</span>
    </h1>

    <p class="hero-tagline">
      A comprehensive registry of European domains, dedicated infrastructure nodes, and authoritative nameserver clusters &mdash; synchronized directly with <a href="https://dnbx.de" target="_blank" rel="noopener noreferrer" style="color:var(--accent);text-decoration:underline;">DNBX.de Public JSON API</a>.
    </p>

    <!-- Nameserver Hub Card -->
    <div class="domain-ns-card">
      <div class="ns-card-left">
        <div class="ns-card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
        </div>
        <div>
          <h2 class="ns-card-title">Authoritative Nameservers</h2>
          <p class="ns-card-sub">Redundant DNS infrastructure hosted under the ternis ecosystem</p>
        </div>
      </div>

      <div class="ns-card-pills">
        <button type="button" class="ns-pill mono" data-copy="one.ns.ternis.net" data-copy-label="Primary NS" title="Click to copy primary nameserver">
          <span>one.ns.ternis.net</span>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
        </button>

        <button type="button" class="ns-pill mono" data-copy="two.ns.ternis.net" data-copy-label="Secondary NS" title="Click to copy secondary nameserver">
          <span>two.ns.ternis.net</span>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
        </button>
      </div>
    </div>
  </div>
</header>

<!-- Main Explorer -->
<main class="section section-alt">
  <div class="container">

    <!-- Search & Filter Toolbar -->
    <div class="domain-toolbar">
      <div class="domain-search-wrap">
        <svg class="domain-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/>
          <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input
          type="text"
          class="domain-search-input mono"
          id="domain-search-input"
          placeholder="Search domains (e.g. 'ternis', '.eu', 'mtex', 'mail')..."
          autocomplete="off"
          spellcheck="false"
          aria-label="Filter domain names"
        >
      </div>

      <div class="domain-filters-bar" role="tablist">
        <button type="button" class="domain-filter-pill active" data-category="all">
          <span>All Namespaces</span>
        </button>
        <button type="button" class="domain-filter-pill" data-category="parent">
          <span>Parent &amp; Identity</span>
        </button>
        <button type="button" class="domain-filter-pill" data-category="xpsystems">
          <span>XP-Systems</span>
        </button>
        <button type="button" class="domain-filter-pill" data-category="europehost">
          <span>EuropeHost</span>
        </button>
        <button type="button" class="domain-filter-pill" data-category="mtex">
          <span>MTEX.dev</span>
        </button>
        <button type="button" class="domain-filter-pill" data-category="official">
          <span>Official &amp; Protection</span>
        </button>
        <button type="button" class="domain-filter-pill" data-category="other">
          <span>Other Active</span>
        </button>
        <button type="button" class="domain-filter-pill" data-category="legacy">
          <span>Archive / Legacy</span>
        </button>
      </div>

      <div class="domain-counter-status mono" id="domain-counter-status">
        All 100+ domains indexed &amp; actively monitored
      </div>
    </div>

    <!-- Domain Groups Grid -->
    <?php $domainGroups = array_merge($activeGroups ?? [], !empty($legacyGroup) ? [$legacyGroup] : []); ?>
    <div class="domain-groups-grid" id="domain-groups-container">
      <?php foreach ($domainGroups as $group): ?>
        <?php
          $catSlug = 'other';
          $titleLower = strtolower($group['title']);
          if (str_contains($titleLower, 'parent') || str_contains($titleLower, 'ternis')) {
            $catSlug = 'parent';
          } elseif (str_contains($titleLower, 'xp-systems') || str_contains($titleLower, 'network')) {
            $catSlug = 'xpsystems';
          } elseif (str_contains($titleLower, 'europehost')) {
            $catSlug = 'europehost';
          } elseif (str_contains($titleLower, 'mtex')) {
            $catSlug = 'mtex';
          } elseif (str_contains($titleLower, 'official') || str_contains($titleLower, 'protection')) {
            $catSlug = 'official';
          } elseif (!empty($group['legacy'])) {
            $catSlug = 'legacy';
          }
        ?>
        <article class="domain-card <?= !empty($group['highlight']) ? 'domain-card--highlight' : '' ?>" data-category="<?= $e($catSlug) ?>">
          <div class="domain-card-header">
            <h3 class="domain-category-title"><?= $e($group['title']) ?></h3>
            <span class="domain-count-badge mono"><?= count($group['domains']) ?></span>
          </div>

          <div class="domain-items-list">
            <?php foreach ($group['domains'] as $item): ?>
              <?php
                $domName = is_array($item) ? $item['domain'] : $item;
                $domBadge = is_array($item) ? ($item['badge'] ?? null) : null;
                $domUrl = str_starts_with($domName, 'http') ? $domName : 'https://' . $domName;
              ?>
              <div class="domain-item-row">
                <a class="domain-item-link" href="<?= $e($domUrl) ?>" target="_blank" rel="noopener noreferrer">
                  <span><?= $e($domName) ?></span>
                  <?php if ($domBadge): ?>
                    <span class="domain-badge badge-<?= strtolower($domBadge) ?>"><?= $e($domBadge) ?></span>
                  <?php endif; ?>
                </a>

                <div class="domain-item-actions">
                  <button type="button" data-copy="<?= $e($domName) ?>" data-copy-label="<?= $e($domName) ?>" title="Copy domain name">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                      <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                  </button>

                  <a href="<?= $e($domUrl) ?>" target="_blank" rel="noopener noreferrer" title="Open domain in new tab">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                      <polyline points="15 3 21 3 21 9"></polyline>
                      <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
