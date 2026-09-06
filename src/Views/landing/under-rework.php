<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle ?? 'xpsystems — Under Rework') ?></title>
  <meta name="description" content="<?= $e($brand['transition_notice']) ?>">
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

<?php
$sub = $request->getSubdomainNormalized();
$reqTarget = ($sub !== 'main')
    ? $sub . '.' . ($brand['domains'][0] ?? 'xpsystems.eu')
    : ($request->path !== '/' ? $request->path : 'xpsystems ecosystem');
?>
<main class="rework-page">
  <div class="rework-container">

    <!-- Eyebrow Status Badge -->
    <div class="rework-hero-badge">
      <span class="rework-badge-dot"></span>
      <span>SYSTEM NOTICE // <?= strtoupper($e($reqTarget)) ?> UNDER REWORK</span>
    </div>

    <!-- Monumental Headline -->
    <h1 class="rework-headline">
      System Under Rework<span class="rework-dot">.</span>
    </h1>

    <!-- Core Lead -->
    <p class="rework-lead">
      <?= $e($brand['transition_notice']) ?>
    </p>

    <!-- Prominent Transition Notice Box -->
    <section class="rework-notice-card" aria-label="Transition Briefing">
      <div class="rework-notice-header">
        <div class="rework-notice-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
            <line x1="12" y1="9" x2="12" y2="13"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
          <span>Ecosystem Transition Notice</span>
        </div>
        <span class="rework-notice-tag">IN EFFECT</span>
      </div>

      <div class="rework-notice-body">
        <p>
          <strong>xpsystems</strong> (<code>xpsystems.eu</code> &bull; <code>xpsystems.de</code>) operates as a dedicated sub-entity of <strong>ternis-edv</strong> (<a href="https://ternis.dev" target="_blank" rel="noopener noreferrer">ternis.dev</a>). All infrastructure, authoritative DNS zones, and open-source operations remain fully operational under German jurisdiction.
        </p>
        <p>
          Authoritative nameservers <code><?= $e($brand['nameservers'][0] ?? 'one.ns.ternis.net') ?></code> and <code><?= $e($brand['nameservers'][1] ?? 'two.ns.ternis.net') ?></code> continue to serve all managed DNS delegations without interruption.
        </p>
        <p style="font-size:0.8125rem;color:var(--text-muted);margin-top:10px;">
          Provider Identification &amp; Imprint: <a href="https://ternis.dev/en/legal/imprint" target="_blank" rel="noopener noreferrer"><strong>ternis.dev/en/legal/imprint ↗</strong></a>
        </p>
      </div>

      <div class="rework-notice-actions">
        <button type="button" class="btn btn-primary announcement-btn" onclick="window.openTransitionModal && window.openTransitionModal()">
          <span>Open Full Transition Briefing</span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </button>
        <a href="https://ternis.dev" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">
          <span>Visit ternis.dev</span>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="7" y1="17" x2="17" y2="7"></line>
            <polyline points="7 7 17 7 17 17"></polyline>
          </svg>
        </a>
      </div>
    </section>

    <!-- Operational Directory Grid -->
    <div class="rework-grid">
      <!-- Status -->
      <a href="<?= htmlspecialchars(url('status')) ?>" class="rework-card">
        <div class="rework-card-top">
          <div class="rework-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
            </svg>
          </div>
          <h2 class="rework-card-title">Live Infrastructure Telemetry</h2>
          <p class="rework-card-desc">Real-time uptime, response latencies, and service health across all bare-metal nodes in Germany.</p>
        </div>
        <div class="rework-card-bottom">
          <span>status.xpsystems.eu</span>
          <svg class="rework-card-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>
      </a>

      <!-- Domains -->
      <a href="<?= htmlspecialchars(url('domains')) ?>" class="rework-card">
        <div class="rework-card-top">
          <div class="rework-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <line x1="2" y1="12" x2="22" y2="12"/>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
          </div>
          <h2 class="rework-card-title">Authoritative Domains</h2>
          <p class="rework-card-desc">Domain portfolio index and routing managed via authoritative nameservers one.ns.ternis.net &amp; two.ns.ternis.net.</p>
        </div>
        <div class="rework-card-bottom">
          <span>domains.xpsystems.eu</span>
          <svg class="rework-card-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>
      </a>

      <!-- Open Source -->
      <a href="<?= htmlspecialchars(url('opensource')) ?>" class="rework-card">
        <div class="rework-card-top">
          <div class="rework-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="16 18 22 12 16 6"/>
              <polyline points="8 6 2 12 8 18"/>
            </svg>
          </div>
          <h2 class="rework-card-title">Open Source Operations</h2>
          <p class="rework-card-desc">Public software tooling, developer utilities, and ecosystem repositories operated under ternis open-source.</p>
        </div>
        <div class="rework-card-bottom">
          <span>opensource.xpsystems.eu</span>
          <svg class="rework-card-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>
      </a>

      <!-- Contact -->
      <a href="<?= htmlspecialchars(url('contact')) ?>" class="rework-card">
        <div class="rework-card-top">
          <div class="rework-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
          </div>
          <h2 class="rework-card-title">Operations Desk</h2>
          <p class="rework-card-desc">Direct communication channels, technical support escalations, and PGP key verification.</p>
        </div>
        <div class="rework-card-bottom">
          <span>contact.xpsystems.eu</span>
          <svg class="rework-card-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </div>
      </a>
    </div>

    <!-- Architectural System Specs -->
    <div class="rework-specs-card">
      <div class="rework-specs-header">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
          <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
          <line x1="6" y1="6" x2="6.01" y2="6"/>
          <line x1="6" y1="18" x2="6.01" y2="18"/>
        </svg>
        <span>Infrastructure Architecture Telemetry</span>
      </div>
      <div class="rework-specs-grid">
        <div class="rework-spec-item">
          <span class="rework-spec-label">Primary Operator</span>
          <span class="rework-spec-value">Fabian Ternis (ternis-edv)</span>
        </div>
        <div class="rework-spec-item">
          <span class="rework-spec-label">Parent Ecosystem</span>
          <span class="rework-spec-value"><a href="https://ternis.dev" target="_blank" rel="noopener noreferrer" style="color:var(--accent);">ternis.dev</a></span>
        </div>
        <div class="rework-spec-item">
          <span class="rework-spec-label">Authoritative DNS</span>
          <span class="rework-spec-value">one.ns.ternis.net &bull; two.ns.ternis.net</span>
        </div>
        <div class="rework-spec-item">
          <span class="rework-spec-label">Jurisdiction</span>
          <span class="rework-spec-value">Federal Republic of Germany (DE / EU)</span>
        </div>
        <div class="rework-spec-item">
          <span class="rework-spec-label">Platform Engine</span>
          <span class="rework-spec-value">xpsystems v<?= $e($brand['version'] ?? '5.4.0') ?></span>
        </div>
        <div class="rework-spec-item">
          <span class="rework-spec-label">Legal / Imprint</span>
          <span class="rework-spec-value"><a href="https://ternis.dev/en/legal/imprint" target="_blank" rel="noopener noreferrer" style="color:var(--accent);">ternis.dev/en/legal/imprint ↗</a></span>
        </div>
        <div class="rework-spec-item">
          <span class="rework-spec-label">Status</span>
          <span class="rework-spec-value" style="color:var(--signal);">Under Rework // Active</span>
        </div>
      </div>
    </div>

  </div>
</main>

<!-- Footer Component -->
<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
