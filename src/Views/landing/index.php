<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700;0,14..32,800;0,14..32,900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

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

<div id="preload-bar"></div>

<?php $component('header'); ?>

<!-- ═══════════════════════════════════════════════════════════ HERO -->
<section class="hero">
  <div class="hero-inner">

    <p class="hero-eyebrow reveal">
      <span class="eyebrow-dot"></span>
      <?= $e($brand['domains'][0] ?? 'xpsystems.eu') ?> &amp; <?= $e($brand['domains'][1] ?? 'xpsystems.de') ?>
    </p>

    <h1 class="hero-title reveal" style="--delay:50ms">
      European infrastructure<br>
      <span class="hero-title-gradient">built to last.</span>
    </h1>

    <p class="hero-tagline reveal" style="--delay:120ms">
      We build, operate, and open-source privacy-first web services — from Germany, for the open web.
    </p>

    <div class="hero-ctas reveal" style="--delay:190ms">
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

    <!-- Trust strip -->
    <div class="hero-trust reveal" style="--delay:260ms">
      <span class="trust-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        GDPR-compliant
      </span>
      <span class="trust-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Hosted in Europe
      </span>
      <span class="trust-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
        Open Source
      </span>
      <span class="trust-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
        Developer-first
      </span>
    </div>

  </div>

  <div class="section-divider">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,0 C480,60 960,60 1440,0 L1440,60 L0,60 Z" class="divider-fill-alt"/>
    </svg>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════ SERVICES -->
<section class="section section-alt" id="services">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow reveal">What we build</span>
      <h2 class="section-title reveal" style="--delay:40ms">Services &amp; Partners</h2>
      <p class="section-sub reveal" style="--delay:80ms">
        Infrastructure we build, run, and stand behind — plus the partners we trust.
      </p>
    </div>

    <div class="services-grid">
      <?php foreach ($services as $i => $service): ?>
        <article
          class="card <?= $service['type'] === 'partner' ? 'card-partner' : '' ?> reveal"
          style="--delay:<?= $i * 55 ?>ms"
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
                    <?= $e($link['label']) ?>
                    <svg class="icon-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider divider-below">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,60 C480,0 960,0 1440,60 L1440,60 L0,60 Z" class="divider-fill-bg"/>
    </svg>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════ MISSION -->
<section class="section section-base" id="mission">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow reveal">Our values</span>
      <h2 class="section-title reveal" style="--delay:40ms">Why we do this</h2>
      <p class="section-sub reveal" style="--delay:80ms">
        We believe the web should be fast, private, and in European hands.
      </p>
    </div>

    <div class="mission-grid">

      <div class="mission-card reveal" style="--delay:0ms">
        <div class="mission-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <h3 class="mission-title">Privacy by Default</h3>
        <p class="mission-desc">Every service we run is GDPR-compliant and designed to collect the minimum. Your data stays in Europe — always.</p>
      </div>

      <div class="mission-card reveal" style="--delay:60ms">
        <div class="mission-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
          </svg>
        </div>
        <h3 class="mission-title">Open Source First</h3>
        <p class="mission-desc">We open-source what we can. Transparent code means better software and a healthier internet for everyone.</p>
      </div>

      <div class="mission-card reveal" style="--delay:120ms">
        <div class="mission-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <h3 class="mission-title">Infrastructure That Scales</h3>
        <p class="mission-desc">From a single domain to a network of services, we build for reliability — not just today, but for years ahead.</p>
      </div>

      <div class="mission-card reveal" style="--delay:180ms">
        <div class="mission-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="mission-title">Digital Sovereignty</h3>
        <p class="mission-desc">European alternatives to US tech monopolies — so you can make choices that align with your values.</p>
      </div>

    </div>
  </div>

  <div class="section-divider divider-below">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,0 C480,60 960,60 1440,0 L1440,60 L0,60 Z" class="divider-fill-alt"/>
    </svg>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ TEAM -->
<section class="section section-alt" id="team">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow reveal">Who we are</span>
      <h2 class="section-title reveal" style="--delay:40ms">The Team</h2>
      <p class="section-sub reveal" style="--delay:80ms">
        Two developers. One shared mission: make the European web better.
      </p>
    </div>

    <div class="team-grid">
      <?php foreach ($team as $i => $member): ?>
        <article class="team-card reveal" style="--delay:<?= $i * 80 ?>ms">
          <div class="team-avatar-wrap">
            <img
              class="team-avatar-img"
              src="<?= $e($member['img_url']) ?>"
              alt="<?= $e($member['name']) ?>"
              width="80"
              height="80"
              loading="lazy"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
            >
            <div class="team-avatar-fallback" aria-hidden="true">
              <?= $e(mb_strtoupper(mb_substr($member['name'], 0, 1))) ?>
            </div>
          </div>

          <h3 class="team-name"><?= $e($member['name']) ?></h3>
          <p class="team-role"><?= $e($member['role']) ?></p>

          <div class="team-links">
            <a class="team-link" href="<?= $e($member['url']) ?>" target="_blank" rel="noopener noreferrer">
              Portfolio
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
              </svg>
            </a>
            <?php if (!empty($member['github'])): ?>
              <a class="team-link team-link-github" href="https://github.com/<?= $e($member['github']) ?>" target="_blank" rel="noopener noreferrer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="13" height="13">
                  <path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.34-3.369-1.34-.454-1.154-1.11-1.462-1.11-1.462-.907-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836a9.59 9.59 0 012.504.337c1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.741 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
                </svg>
                GitHub
              </a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider divider-below">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,60 C480,0 960,0 1440,60 L1440,60 L0,60 Z" class="divider-fill-bg"/>
    </svg>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ STATS -->
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
