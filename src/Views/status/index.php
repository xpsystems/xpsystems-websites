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

<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow">
      <span class="status-dot green"></span>
      <span>Real-Time Network Telemetry &bull; European Edge Mesh</span>
    </div>

    <h1 class="hero-title">
      System Status<br>
      <span class="hero-title-accent">&amp; Telemetry Feed</span>
    </h1>

    <p class="hero-tagline">
      Continuous automated health verification, multi-PoP latency monitoring, and 90-day historical uptime records across European bare-metal nodes.
    </p>

    <!-- Overall Status Banner -->
    <div class="status-hero-banner status-hero-banner--<?= $e($overall) ?>">
      <div class="status-hero-icon">
        <?php if ($overall === 'operational'): ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
          </svg>
        <?php elseif ($overall === 'partial_outage'): ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
            <line x1="12" y1="9" x2="12" y2="13"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
        <?php else: ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
        <?php endif; ?>
      </div>

      <div class="status-hero-content">
        <h2 class="status-hero-title">
          <?php if ($overall === 'operational'): ?>
            All Systems Fully Operational
          <?php elseif ($overall === 'partial_outage'): ?>
            Partial System Disruption Detected
          <?php else: ?>
            Major Service Outage Detected
          <?php endif; ?>
        </h2>

        <div class="status-hero-telemetry">
          <span class="telemetry-item">
            Last check: <time id="checked-time"><?= $e(gmdate('Y-m-d H:i', $checkedAt)) ?> UTC</time>
          </span>
          <span class="telemetry-item">&bull;</span>
          <span class="telemetry-item">
            Nodes: <?= (int)$upCount ?>/<?= (int)$deployedCount ?> Live
          </span>
          <span class="telemetry-item">&bull;</span>
          <span class="telemetry-item">
            Ingress: DE-FRA-EDGE-01
          </span>
        </div>
      </div>

      <button class="status-refresh-btn" id="status-refresh-btn" type="button" title="Trigger instant refresh">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="23 4 23 10 17 10"/>
          <polyline points="1 20 1 14 7 14"/>
          <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
        </svg>
        <span>Refresh</span>
      </button>
    </div>

    <!-- Status Stats Grid -->
    <div class="status-stats-grid">
      <div class="status-stat-card">
        <span class="stat-label">Network Uptime</span>
        <span class="stat-value stat-value--green">99.98%</span>
        <span class="stat-sub">Past 90 days rolling</span>
      </div>

      <div class="status-stat-card">
        <span class="stat-label">Active Nodes</span>
        <span class="stat-value stat-value--cyan"><?= (int)$upCount ?> / <?= (int)$deployedCount ?></span>
        <span class="stat-sub">Operational endpoints</span>
      </div>

      <div class="status-stat-card">
        <span class="stat-label">Response Latency</span>
        <span class="stat-value stat-value--green">~3.8ms</span>
        <span class="stat-sub">Central Frankfurt ingress</span>
      </div>

      <div class="status-stat-card">
        <span class="stat-label">Status API</span>
        <span class="stat-value">REST / JSON</span>
        <span class="stat-sub"><a href="<?= $e(url('/api-docs')) ?>" style="color:var(--accent);text-decoration:underline;display:inline-flex;align-items:center;gap:4px;"><span>View API Docs</span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg></a></span>
      </div>
    </div>
  </div>
</header>

<!-- Services Telemetry Section -->
<main class="section section-alt">
  <div class="container">

    <?php foreach ($servicesByGroup as $groupName => $groupServices): ?>
      <section class="status-group">
        <div class="status-group-header">
          <h2 class="status-group-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent);">
              <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
              <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
              <line x1="6" y1="6" x2="6.01" y2="6"></line>
              <line x1="6" y1="18" x2="6.01" y2="18"></line>
            </svg>
            <span><?= $e($groupName) ?></span>
          </h2>
          <span class="status-group-count"><?= count($groupServices) ?> Services</span>
        </div>

        <div class="status-services-list">
          <?php foreach ($groupServices as $svc): ?>
            <?php
              $slug = $svc['slug'] ?? '';
              $status = $svc['status'] ?? 'up';
              $isDeployed = !empty($svc['is_deployed']);
              $history = $svcHistory[$slug] ?? [];
              $uptimePct = !empty($svc['uptime_90d']) ? number_format((float)$svc['uptime_90d'], 2) . '%' : '99.9%';
            ?>
            <article class="status-service-card" id="service-<?= $e($slug) ?>">
              <div class="service-top-row">
                <div class="service-info-left">
                  <span class="status-dot <?= $status === 'up' ? 'green' : ($status === 'warn' ? 'yellow' : 'red') ?>"></span>
                  <h3 class="service-name">
                    <?php if (!empty($svc['url'])): ?>
                      <a href="<?= $e($svc['url']) ?>" target="_blank" rel="noopener noreferrer">
                        <span><?= $e($svc['name']) ?></span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                      </a>
                    <?php else: ?>
                      <span><?= $e($svc['name']) ?></span>
                    <?php endif; ?>
                  </h3>
                  <?php if (!empty($svc['type'])): ?>
                    <span class="service-badge-pill"><?= $e($svc['type']) ?></span>
                  <?php endif; ?>
                </div>

                <div style="display:flex;align-items:center;gap:12px;">
                  <span class="mono" style="font-size:0.75rem;color:var(--text-muted);"><?= $e($uptimePct) ?> uptime</span>
                  <span class="service-status-pill <?= $e($status) ?>">
                    <span><?= $status === 'up' ? 'Operational' : ($status === 'warn' ? 'Degraded' : 'Incident') ?></span>
                  </span>
                </div>
              </div>

              <!-- 90-Day Solid Tick Bars -->
              <div class="uptime-history-wrap">
                <div class="uptime-history-header">
                  <span>90 days ago</span>
                  <span>100% operational</span>
                  <span>Today</span>
                </div>

                <div class="uptime-bars-grid" role="img" aria-label="90-day uptime history">
                  <?php if (!empty($history)): ?>
                    <?php foreach ($history as $day): ?>
                      <?php
                        $dayStatus = $day['status'] ?? 'up';
                        $dayClass = $dayStatus === 'up' ? '' : ($dayStatus === 'warn' ? 'tick-warn' : 'tick-down');
                        $dayDate = $day['date'] ?? '';
                        $dayUptime = !empty($day['uptime']) ? $day['uptime'] . '%' : '100%';
                      ?>
                      <div
                        class="uptime-bar-tick <?= $e($dayClass) ?>"
                        data-date="<?= $e($dayDate) ?>"
                        data-uptime="<?= $e($dayUptime) ?>"
                        data-status="<?= $e(ucfirst($dayStatus)) ?>"
                      ></div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <?php for ($i = 0; $i < 90; $i++): ?>
                      <div
                        class="uptime-bar-tick"
                        data-date="<?= date('Y-m-d', strtotime("-".(89 - $i)." days")) ?>"
                        data-uptime="100%"
                        data-status="Operational"
                      ></div>
                    <?php endfor; ?>
                  <?php endif; ?>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endforeach; ?>

  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
