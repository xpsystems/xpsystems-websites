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

<!-- ═══════════════════════════════════════════════════════════ HERO -->
<section class="hero">
  <div class="hero-inner">

    <div class="hero-eyebrow reveal">
      <svg class="eyebrow-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="2" y1="12" x2="22" y2="12"/>
        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
      </svg>
      <span><?= $e($brand['domains'][0] ?? 'xpsystems.eu') ?> &bull; <?= $e($brand['domains'][1] ?? 'xpsystems.de') ?></span>
      <span class="eyebrow-separator">&bull;</span>
      <span>German Web-Provider</span>
    </div>

    <h1 class="hero-title reveal" style="--delay:50ms">
      European infrastructure<br>
      <span class="hero-title-accent">engineered for sovereignty.</span>
    </h1>

    <p class="hero-tagline reveal" style="--delay:100ms">
      High-performance hosting, sovereign domain routing, and developer-first open source tooling — operated from Germany under strict GDPR standards.
    </p>

    <div class="hero-ctas reveal" style="--delay:150ms">
      <a href="#services" class="btn btn-primary btn-lg">
        <span>Explore Infrastructure</span>
        <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
        </svg>
      </a>

      <a href="<?= $e(url('/opensource')) ?>" class="btn btn-secondary btn-lg">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
        </svg>
        <span>Open Source Hub</span>
      </a>

      <a href="<?= $e(url('/domains')) ?>" class="btn btn-secondary btn-lg">
        <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="2" y1="12" x2="22" y2="12"/>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
        <span>Domain Registry</span>
      </a>
    </div>

    <!-- Quick Developer Terminal Snippet -->
    <div class="hero-terminal reveal" style="--delay:180ms" data-copy="curl -sI https://xpsystems.eu" data-copy-label="curl command">
      <span class="terminal-prompt">$</span>
      <span class="terminal-cmd">curl -sI https://xpsystems.eu | grep -i "server\|region"</span>
      <button class="terminal-copy-btn" title="Click to copy command" type="button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
          <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
        </svg>
      </button>
    </div>

    <!-- Trust strip -->
    <div class="hero-trust reveal" style="--delay:220ms">
      <span class="trust-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        100% GDPR / DSGVO Compliant
      </span>
      <span class="trust-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Bare-Metal in Germany &amp; EU
      </span>
      <span class="trust-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
        Open Source Core
      </span>
      <span class="trust-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        Zero Tracking Cookies
      </span>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════════════════════ SERVICES & BLUEPRINT -->
<section class="section section-alt" id="services">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow reveal">Network Architecture</span>
      <h2 class="section-title reveal" style="--delay:40ms">Services &amp; Sovereign Infrastructure</h2>
      <p class="section-sub reveal" style="--delay:80ms">
        Bare-metal compute, low-latency European network edges, and privacy-first web platforms.
      </p>
    </div>

    <!-- Interactive Node Topology Preview -->
    <div class="infra-blueprint reveal">
      <div class="blueprint-header">
        <div class="blueprint-title-wrap">
          <div class="blueprint-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
              <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
              <line x1="6" y1="6" x2="6.01" y2="6"></line>
              <line x1="6" y1="18" x2="6.01" y2="18"></line>
            </svg>
          </div>
          <div>
            <h3>Active European Point-of-Presence (PoP) Nodes</h3>
            <p>Monitored edge routing, Anycast DNS, and dedicated compute clusters.</p>
          </div>
        </div>
        <a href="https://status.xpsystems.eu" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
          <span>Live Telemetry</span>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        </a>
      </div>

      <div class="blueprint-regions">
        <div class="region-node">
          <div class="region-top">
            <span class="region-city">Frankfurt am Main</span>
            <span class="region-flag">DE-FRA</span>
          </div>
          <div class="region-specs">
            <span>Primary Core &bull; DE-CIX</span>
            <span class="region-status">Live</span>
          </div>
        </div>

        <div class="region-node">
          <div class="region-top">
            <span class="region-city">Falkenstein</span>
            <span class="region-flag">DE-FSN</span>
          </div>
          <div class="region-specs">
            <span>Bare-Metal &bull; Dedicated</span>
            <span class="region-status">Live</span>
          </div>
        </div>

        <div class="region-node">
          <div class="region-top">
            <span class="region-city">Amsterdam</span>
            <span class="region-flag">NL-AMS</span>
          </div>
          <div class="region-specs">
            <span>AMS-IX &bull; Edge Proxy</span>
            <span class="region-status">Live</span>
          </div>
        </div>

        <div class="region-node">
          <div class="region-top">
            <span class="region-city">Helsinki</span>
            <span class="region-flag">FI-HEL</span>
          </div>
          <div class="region-specs">
            <span>Encrypted Vault &bull; Backup</span>
            <span class="region-status">Live</span>
          </div>
        </div>
      </div>
    </div>

    <div class="services-grid">
      <?php foreach ($services as $i => $service): ?>
        <article
          class="card <?= $service['type'] === 'partner' ? 'card-partner' : '' ?> reveal"
          style="--delay:<?= $i * 50 ?>ms"
        >
          <span class="card-badge <?= $service['type'] === 'service' ? 'card-badge-service' : '' ?>">
            <span class="status-dot green" style="width:5px;height:5px;"></span>
            <?= $service['type'] === 'partner' ? 'Partner Ecosystem' : 'Core Infrastructure' ?>
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
                    <span><?= $e($link['label']) ?></span>
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
</section>


<!-- ═══════════════════════════════════════════════════════ MISSION / VALUES -->
<section class="section section-base" id="mission">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow reveal">Engineering Principles</span>
      <h2 class="section-title reveal" style="--delay:40ms">Why We Build Differently</h2>
      <p class="section-sub reveal" style="--delay:80ms">
        We believe the web should be fast, private, transparent, and sovereign in European hands.
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
        <p class="mission-desc">Zero tracking cookies, zero user surveillance, and zero third-party telemetry. Your data stays in Europe under full GDPR compliance.</p>
      </div>

      <div class="mission-card reveal" style="--delay:60ms">
        <div class="mission-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
          </svg>
        </div>
        <h3 class="mission-title">Open Source First</h3>
        <p class="mission-desc">We publish our tools, libraries, and core platforms publicly on GitHub. Transparent code fosters trust, security, and true developer autonomy.</p>
      </div>

      <div class="mission-card reveal" style="--delay:120ms">
        <div class="mission-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <h3 class="mission-title">Resilient Infrastructure</h3>
        <p class="mission-desc">Bare-metal servers, automated DNS orchestration, and redundant power across Germany and Europe, architected for long-term uptime.</p>
      </div>

      <div class="mission-card reveal" style="--delay:180ms">
        <div class="mission-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="mission-title">Digital Sovereignty</h3>
        <p class="mission-desc">Independent European alternatives to mega-cloud vendor lock-in — giving builders and businesses real ownership of their digital presence.</p>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ TEAM -->
<section class="section section-alt" id="team">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow reveal">Leadership &amp; Development</span>
      <h2 class="section-title reveal" style="--delay:40ms">The Team</h2>
      <p class="section-sub reveal" style="--delay:80ms">
        Dedicated developers building, maintaining, and innovating European infrastructure.
      </p>
    </div>

    <div class="team-grid">
      <?php foreach ($team as $i => $member): ?>
        <article class="team-card reveal" style="--delay:<?= $i * 70 ?>ms">
          <div class="team-avatar-wrap">
            <img
              class="team-avatar-img"
              src="<?= $e($member['img_url']) ?>"
              alt="<?= $e($member['name']) ?>"
              width="88"
              height="88"
              loading="lazy"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
            >
            <div class="team-avatar-fallback" aria-hidden="true">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </div>
          </div>

          <h3 class="team-name"><?= $e($member['name']) ?></h3>
          <p class="team-role"><?= $e($member['role']) ?></p>

          <div class="team-links">
            <a class="team-link" href="<?= $e($member['url']) ?>" target="_blank" rel="noopener noreferrer">
              <span>Portfolio</span>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
              </svg>
            </a>
            <?php if (!empty($member['github'])): ?>
              <a class="team-link" href="https://github.com/<?= $e($member['github']) ?>" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                </svg>
                <span>@<?= $e($member['github']) ?></span>
              </a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ STATS -->
<section class="stats-section">
  <div class="container">
    <div class="stats-grid">
      <?php foreach ($stats as $i => $stat): ?>
        <a class="stat-item reveal" href="<?= $e($stat['url']) ?>" <?= str_starts_with($stat['url'], 'http') ? 'target="_blank" rel="noopener noreferrer"' : '' ?> style="--delay:<?= $i * 60 ?>ms">
          <span class="stat-value"><?= $e($stat['value']) ?></span>
          <span class="stat-label"><?= $e($stat['label']) ?></span>
          <span class="stat-cta">
            <span><?= $e($stat['link_label']) ?></span>
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

