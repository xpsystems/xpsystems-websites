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

<!-- HERO -->
<section class="hero">
  <div class="container hero-inner">
    <p class="hero-eyebrow reveal"><?= $e($brand['domains'][0] ?? 'xpsystems.eu') ?> / <?= $e($brand['domains'][1] ?? 'xpsystems.de') ?></p>
    <h1 class="hero-title reveal" style="--delay:60ms"><?= $e($brand['name']) ?></h1>
    <p class="hero-tagline reveal" style="--delay:120ms"><?= $e($brand['tagline']) ?></p>
    <p class="hero-description reveal" style="--delay:180ms"><?= $e($brand['description']) ?></p>
    <div class="hero-ctas reveal" style="--delay:240ms">
      <?php foreach ($heroCtas as $cta): ?>
        <a
          href="<?= $e($cta['href']) ?>"
          class="btn <?= !empty($cta['primary']) ? 'btn-primary' : 'btn-secondary' ?>"
          target="_blank"
          rel="noopener noreferrer"
        >
          <?php if (empty($cta['primary'])): ?>
            <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.34-3.369-1.34-.454-1.154-1.11-1.462-1.11-1.462-.907-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836a9.59 9.59 0 0 1 2.504.337c1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.741 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
            </svg>
          <?php endif; ?>
          <?= $e($cta['label']) ?>
          <?php if (!empty($cta['primary'])): ?>
            <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,0 C360,70 1080,70 1440,0 L1440,70 L0,70 Z" class="divider-fill-alt"/>
    </svg>
  </div>
</section>

<!-- SERVICES -->
<section class="services-section" id="services">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">Services &amp; Partners</h2>
      <p class="section-subtitle reveal" style="--delay:60ms">Infrastructure and tools we build, run, and stand behind.</p>
    </div>

    <div class="services-grid">
      <?php foreach ($services as $i => $service): ?>
        <article
          class="card <?= $service['type'] === 'partner' ? 'card-partner' : '' ?> reveal"
          style="--delay:<?= $i * 60 ?>ms"
        >
          <span class="card-badge <?= $service['type'] === 'service' ? 'card-badge-service' : '' ?>">
            <?= $service['type'] === 'partner' ? 'Partner' : 'Service' ?>
          </span>

          <div class="card-top">
            <h3 class="card-name">
              <a class="card-name-link" href="<?= $e($service['url']) ?>" target="_blank" rel="noopener noreferrer">
                <?= $e($service['name']) ?>
                <svg class="icon-ext" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
              </a>
            </h3>
            <p class="card-tagline"><?= $e($service['tagline']) ?></p>
          </div>

          <?php if (!empty($service['links'])): ?>
            <ul class="card-links">
              <?php foreach ($service['links'] as $link): ?>
                <li>
                  <a class="card-sublink" href="<?= $e($link['href']) ?>" target="_blank" rel="noopener noreferrer">
                    <svg class="icon-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <?= $e($link['label']) ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider" style="margin-top:-30px;">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,70 C360,0 1080,0 1440,70 L1440,70 L0,70 Z" class="divider-fill-bg"/>
    </svg>
  </div>
</section>

<!-- TEAM -->
<section class="team-section" id="team">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">The Team</h2>
      <p class="section-subtitle reveal" style="--delay:60ms">Two developers. One mission.</p>
    </div>

    <div class="team-grid">
      <?php foreach ($team as $i => $member): ?>
        <article class="card team-card reveal" style="--delay:<?= $i * 80 ?>ms">
          <div class="team-avatar-wrap">
            <img
              class="team-avatar-img"
              src="<?= $e($member['img_url']) ?>"
              alt="<?= $e($member['name']) ?>"
              width="84"
              height="84"
              loading="lazy"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
            >
            <div class="team-avatar-fallback" aria-hidden="true">
              <?= $e(mb_strtoupper(mb_substr($member['name'], 0, 1))) ?>
            </div>
          </div>

          <h3 class="team-name"><?= $e($member['name']) ?></h3>
          <p class="team-role"><?= $e($member['role']) ?></p>

          <a class="team-link" href="<?= $e($member['url']) ?>" target="_blank" rel="noopener noreferrer">
            Portfolio
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
          </a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider" style="margin-top:-30px;">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,0 C360,70 1080,70 1440,0 L1440,70 L0,70 Z" class="divider-fill-alt"/>
    </svg>
  </div>
</section>

<!-- STATS -->
<section class="stats-section">
  <div class="container">
    <div class="stats-grid">
      <?php foreach ($stats as $i => $stat): ?>
        <a class="stat-item reveal" href="<?= $e($stat['url']) ?>" target="_blank" rel="noopener noreferrer" style="--delay:<?= $i * 60 ?>ms">
          <span class="stat-value"><?= $e($stat['value']) ?></span>
          <span class="stat-label"><?= $e($stat['label']) ?></span>
          <span class="stat-cta">
            <?= $e($stat['link_label']) ?>
            <svg class="icon-arrow-sm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" data-status-url="<?= $e($statusCheckUrl) ?>" defer></script>
</body>
</html>
