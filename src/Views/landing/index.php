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
<?php $component('header'); ?>
<?php $component('transition-banner'); ?>

<!-- ═══════════════════════════════════════════════════════════ HERO -->
<section class="hero">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">

    <div class="hero-eyebrow">
      <span class="status-dot green"></span>
      <span><?= $e($brand['domains'][0] ?? 'xpsystems.eu') ?> &bull; <?= $e($brand['domains'][1] ?? 'xpsystems.de') ?></span>
      <span class="eyebrow-separator">&bull;</span>
      <span>Sub-Entity of <a href="https://ternis.dev" target="_blank" rel="noopener noreferrer">ternis.dev</a></span>
    </div>

    <h1 class="hero-title">
      European infrastructure<br>
      <span class="hero-title-accent">engineered for sovereignty.</span>
    </h1>

    <p class="hero-tagline">
      High-performance hosting, sovereign Anycast domain routing, and developer-first open source tooling — operated from Germany under strict GDPR standards.
    </p>

    <div class="hero-ctas">
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
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="2" y1="12" x2="22" y2="12"/>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
        <span>Domain Registry</span>
      </a>
    </div>

    <!-- ── Interactive Dual-Mode Shell (XP-CLI Terminal & Edge PoP Radar) -->
    <div class="hero-interactive-shell">
      <div class="shell-header">
        <div class="shell-window-controls" aria-hidden="true">
          <span class="shell-dot red"></span>
          <span class="shell-dot yellow"></span>
          <span class="shell-dot green"></span>
        </div>

        <div class="shell-tabs" role="tablist">
          <button type="button" class="shell-tab-btn active" data-tab="terminal" role="tab" aria-selected="true">
            &gt;_ XP-CLI Terminal
          </button>
          <button type="button" class="shell-tab-btn" data-tab="radar" role="tab" aria-selected="false">
            [ European Edge Nodes ]
          </button>
        </div>

        <div class="shell-title-tag mono">
          <span>SEC:TLS_1.3 &bull; ANYCAST_DNS</span>
        </div>
      </div>

      <!-- Mode 1: In-Browser Interactive Terminal -->
      <div class="shell-content-terminal" id="terminal-cli-container">
        <div class="terminal-history" id="terminal-cli-history">
          <div class="terminal-line accent-line">xpsystems sovereign telemetry v3.4.0 [x86_64-linux-gnu]</div>
          <div class="terminal-line output-line">Connected to Frankfurt Core (DE-CIX Anycast Mesh). Type "help" for commands.</div>
          <div class="terminal-line success-line">&#10003; 4/4 edge nodes reporting 100% operational status.</div>
        </div>

        <div class="terminal-input-row">
          <span class="terminal-prompt">$</span>
          <input
            type="text"
            class="terminal-input"
            id="terminal-cli-input"
            placeholder="Type 'help', 'status', 'ping fra', 'domains', or 'team'..."
            autocomplete="off"
            spellcheck="false"
            aria-label="XP-CLI command input"
          >
        </div>
      </div>

      <!-- Mode 2: European Edge PoP Radar -->
      <div class="shell-content-radar">
        <div class="radar-grid">
          <div class="radar-node-card is-selected" data-node="fra">
            <div class="node-code">[DE-FRA]</div>
            <div class="node-city">Frankfurt am Main</div>
            <div class="node-role">Primary Core &bull; DE-CIX</div>
            <div class="node-latency-pill">
              <span class="status-dot green"></span>
              <span>~3.8ms Anycast</span>
            </div>
          </div>

          <div class="radar-node-card" data-node="fsn">
            <div class="node-code">[DE-FSN]</div>
            <div class="node-city">Falkenstein</div>
            <div class="node-role">Bare-Metal &bull; Dedicated</div>
            <div class="node-latency-pill">
              <span class="status-dot green"></span>
              <span>~6.2ms Dedicated</span>
            </div>
          </div>

          <div class="radar-node-card" data-node="ams">
            <div class="node-code">[NL-AMS]</div>
            <div class="node-city">Amsterdam</div>
            <div class="node-role">AMS-IX Edge &bull; Transit</div>
            <div class="node-latency-pill">
              <span class="status-dot green"></span>
              <span>~8.9ms Edge</span>
            </div>
          </div>

          <div class="radar-node-card" data-node="hel">
            <div class="node-code">[FI-HEL]</div>
            <div class="node-city">Helsinki</div>
            <div class="node-role">Cold Vault &bull; Backup</div>
            <div class="node-latency-pill">
              <span class="status-dot green"></span>
              <span>~14.1ms Vault</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Trust Strip -->
    <div class="hero-trust">
      <div class="trust-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
        <span>100% GDPR / DSGVO Compliant</span>
      </div>

      <div class="trust-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
          <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
          <line x1="6" y1="6" x2="6.01" y2="6"/>
          <line x1="6" y1="18" x2="6.01" y2="18"/>
        </svg>
        <span>Bare-Metal in Germany &amp; EU</span>
      </div>

      <div class="trust-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="16 18 22 12 16 6"/>
          <polyline points="8 6 2 12 8 18"/>
        </svg>
        <span>Open Source Core</span>
      </div>

      <div class="trust-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
        </svg>
        <span>Zero Tracking Cookies</span>
      </div>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════════════════════ SERVICES & BLUEPRINT -->
<section class="section section-alt" id="services">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow">Network Architecture</span>
      <h2 class="section-title">Services &amp; Sovereign Infrastructure</h2>
      <p class="section-sub">
        Bare-metal compute, low-latency European network edges, and privacy-first web platforms.
      </p>
    </div>

    <div class="services-grid">
      <?php foreach ($services as $i => $service): ?>
        <article class="card <?= $service['type'] === 'partner' ? 'card-partner' : ($service['type'] === 'parent' ? 'card-parent' : '') ?>">
          <span class="card-badge <?= $service['type'] === 'parent' ? 'card-badge-parent' : ($service['type'] === 'partner' ? 'card-badge-partner' : 'card-badge-service') ?>">
            <span class="status-dot <?= $service['type'] === 'parent' ? 'blue' : ($service['type'] === 'partner' ? 'orange' : 'green') ?>"></span>
            <?= $service['type'] === 'parent' ? 'Parent Entity (ternis.dev)' : ($service['type'] === 'partner' ? 'Partner Ecosystem' : 'Core Infrastructure') ?>
          </span>

          <div class="card-top">
            <h3 class="card-name">
              <a class="card-name-link" href="<?= $e($service['url']) ?>" target="_blank" rel="noopener noreferrer">
                <span><?= $e($service['name']) ?></span>
                <svg class="icon-ext" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                    <svg class="icon-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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


<!-- ═══════════════════════════════════════════════════════ ENGINEERING PRINCIPLES -->
<section class="section section-base" id="mission">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow">Engineering Principles</span>
      <h2 class="section-title">Why We Build Differently</h2>
      <p class="section-sub">
        We believe European digital infrastructure should be fast, private, transparent, and autonomous.
      </p>
    </div>

    <div class="mission-grid">
      <div class="mission-card">
        <span class="mission-num">[01]</span>
        <div class="mission-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h3 class="mission-title">Privacy by Default</h3>
        <p class="mission-desc">
          Zero tracking cookies, zero user surveillance, and zero third-party telemetry. All telemetry stays in Europe under full GDPR compliance.
        </p>
      </div>

      <div class="mission-card">
        <span class="mission-num">[02]</span>
        <div class="mission-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6"/>
            <polyline points="8 6 2 12 8 18"/>
          </svg>
        </div>
        <h3 class="mission-title">Open Source Core</h3>
        <p class="mission-desc">
          We publish our platforms, tools, and libraries publicly on GitHub. Transparent code fosters trust, security, and developer independence.
        </p>
      </div>

      <div class="mission-card">
        <span class="mission-num">[03]</span>
        <div class="mission-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
            <line x1="6" y1="6" x2="6.01" y2="6"/>
            <line x1="6" y1="18" x2="6.01" y2="18"/>
          </svg>
        </div>
        <h3 class="mission-title">Resilient Infrastructure</h3>
        <p class="mission-desc">
          Bare-metal compute, automated Anycast DNS orchestration, and redundant peering across Germany and the Netherlands engineered for uptime.
        </p>
      </div>

      <div class="mission-card">
        <span class="mission-num">[04]</span>
        <div class="mission-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
        </div>
        <h3 class="mission-title">Digital Sovereignty</h3>
        <p class="mission-desc">
          Independent European alternatives to mega-cloud vendor lock-in — giving developers and businesses authentic ownership of their tech stack.
        </p>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════ THE TEAM -->
<section class="section section-alt" id="team">
  <div class="container">
    <div class="section-header">
      <span class="section-eyebrow">Leadership &amp; Development</span>
      <h2 class="section-title">The Engineering Team</h2>
      <p class="section-sub">
        Dedicated developers building, maintaining, and innovating European web infrastructure.
      </p>
    </div>

    <div class="team-grid">
      <?php foreach ($team as $i => $member): ?>
        <article class="team-card">
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
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
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
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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


<!-- ═══════════════════════════════════════════════════════ STATS -->
<section class="stats-section">
  <div class="container">
    <div class="stats-grid">
      <?php foreach ($stats as $i => $stat): ?>
        <a class="stat-item" href="<?= $e($stat['url']) ?>" <?= str_starts_with($stat['url'], 'http') ? 'target="_blank" rel="noopener noreferrer"' : '' ?>>
          <span class="stat-value"><?= $e($stat['value']) ?></span>
          <span class="stat-label"><?= $e($stat['label']) ?></span>
          <span class="stat-cta">
            <span><?= $e($stat['link_label']) ?></span>
            <svg class="icon-arrow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<?php $component('footer'); ?>

<script src="/assets/js/main.js" data-status-url="<?= $e($statusCheckUrl ?? '/api/status') ?>" defer></script>
</body>
</html>
