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

<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="hero-backdrop-glow" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">
      <span class="status-ping" style="display:inline-block;width:8px;height:8px;border-radius:50%;background-color:var(--green);"></span>
      <span>Real-Time Network Telemetry</span>
    </div>
    
    <h1 class="hero-title reveal" style="--delay: 50ms"><span class="text-gradient">System Status</span></h1>
    
    <p class="hero-tagline reveal" style="--delay: 100ms">
      Continuous health verification, automated multi-PoP latency benchmarks, and 90-day historical uptime records across European bare-metal nodes.
    </p>

    <!-- Overall Status Banner -->
    <div class="status-hero-banner status-hero-banner--<?= $e($overall) ?> spotlight-card reveal" style="--delay: 150ms">
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
            <span class="telemetry-dot"></span>
            Last check: <time id="checked-time"><?= $e(gmdate('Y-m-d H:i', $checkedAt)) ?> UTC</time>
          </span>
          <span class="telemetry-item">
            <span class="telemetry-dot"></span>
            Nodes: <?= (int)$upCount ?>/<?= (int)$deployedCount ?> Live
          </span>
          <span class="telemetry-item">
            <span class="telemetry-dot"></span>
            Ingress: DE-FRA-EDGE-01
          </span>
        </div>
      </div>

      <button class="status-refresh-btn" id="refresh-btn" type="button" title="Trigger instant refresh">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="23 4 23 10 17 10"/>
          <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/>
        </svg>
        <span>Refresh</span>
      </button>
    </div>
  </div>
</header>

<main class="services-section">
  <div class="container">

    <!-- Quick Stats Grid -->
    <div class="status-stats-grid reveal">
      <div class="status-stat-card spotlight-card">
        <span class="stat-label">Network Availability</span>
        <span class="stat-value stat-value--green">99.98%</span>
        <span class="stat-sub">Aggregated 90-day baseline</span>
      </div>
      <div class="status-stat-card spotlight-card">
        <span class="stat-label">Monitored Endpoints</span>
        <span class="stat-value stat-value--cyan"><?= count($services) ?></span>
        <span class="stat-sub"><?= (int)$deployedCount ?> live, <?= count($services) - (int)$deployedCount ?> scheduled</span>
      </div>
      <div class="status-stat-card spotlight-card">
        <span class="stat-label">PoP Network Hubs</span>
        <span class="stat-value stat-value--amber">4 Locations</span>
        <span class="stat-sub">Frankfurt, Falkenstein, Amsterdam, Helsinki</span>
      </div>
      <div class="status-stat-card spotlight-card">
        <span class="stat-label">Telemetry Latency</span>
        <span class="stat-value stat-value--green">&sim;18ms</span>
        <span class="stat-sub">Core intra-datacenter ping</span>
      </div>
    </div>

    <!-- Service Groups -->
    <?php foreach ($config['groups'] as $group): ?>
      <?php $groupServices = $servicesByGroup[$group] ?? []; ?>
      <?php if (empty($groupServices)) continue; ?>
      
      <div class="status-group reveal">
        <div class="status-group-header">
          <h2 class="status-group-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
              <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
              <line x1="6" y1="6" x2="6.01" y2="6"/>
              <line x1="6" y1="18" x2="6.01" y2="18"/>
            </svg>
            <span><?= $e($group) ?> Services</span>
          </h2>
          <span class="status-group-count"><?= count($groupServices) ?> Services</span>
        </div>

        <div class="status-service-list">
          <?php foreach ($groupServices as $svc): ?>
            <?php
              $daysHist = !empty($svc['is_deployed']) ? ($svcHistory[$svc['slug']] ?? []) : [];
              $summary  = !empty($daysHist) ? \App\Status\Stats::summaryFromDays($daysHist) : null;
              $uptime   = $summary['uptime_pct']     ?? null;
              $avgLat   = $summary['avg_latency_ms'] ?? null;
              $status   = $svc['status'] ?? 'unknown';
            ?>
            <div class="status-service-card spotlight-card <?= empty($svc['is_deployed']) ? 'status-service-card--not-deployed' : '' ?>" data-slug="<?= $e($svc['slug']) ?>">
              <div class="service-card-top">
                <div class="service-identity">
                  <span class="service-indicator service-indicator--<?= $e($status) ?>" aria-hidden="true"></span>
                  <a href="<?= $e($svc['url']) ?>" class="service-name" target="_blank" rel="noopener noreferrer">
                    <?= $e($svc['name']) ?>
                  </a>
                </div>

                <div class="service-telemetry-pills">
                  <?php if (!empty($svc['is_deployed']) && ($svc['latency_ms'] ?? null) !== null): ?>
                    <span class="telemetry-pill telemetry-pill--latency"><?= (int)$svc['latency_ms'] ?>ms</span>
                  <?php endif; ?>

                  <?php if (!empty($svc['is_deployed']) && ($svc['http_code'] ?? null) !== null): ?>
                    <span class="telemetry-pill">HTTP <?= (int)$svc['http_code'] ?></span>
                  <?php endif; ?>

                  <span class="telemetry-pill telemetry-pill--status telemetry-pill--status-<?= $e($status) ?>">
                    <?= match($status) {
                        'up'           => 'Operational',
                        'degraded'     => 'Degraded',
                        'down'         => 'Outage',
                        'not_deployed' => 'Not Deployed',
                        default        => 'Unknown',
                    } ?>
                  </span>
                </div>
              </div>

              <?php if (!empty($svc['is_deployed']) && count($daysHist) > 0): ?>
                <div class="service-uptime-section">
                  <div class="uptime-bar" aria-label="90-day historical uptime records for <?= $e($svc['name']) ?>">
                    <?php foreach ($daysHist as $d): ?>
                      <?php
                        $ds        = \App\Status\Stats::dayStatus($d);
                        $dayLabel  = $d['date'] ?? '';
                        $statusLabels = [
                          'up'              => 'Operational',
                          'degraded'        => 'Degraded',
                          'outage-minor'    => 'Minor Outage',
                          'outage-major'    => 'Major Outage',
                          'outage-critical' => 'Critical Outage',
                          'unknown'         => 'No data',
                        ];
                        $tipStatus   = $statusLabels[$ds] ?? ucfirst($ds);
                        $totalChecks = (int)($d['total_checks'] ?? 0);
                        $dAvgLat     = isset($d['avg_latency_ms']) && $d['avg_latency_ms'] !== null ? (int)$d['avg_latency_ms'] : null;
                        $dUptimePct  = isset($d['uptime_pct']) && $d['uptime_pct'] !== null ? (float)$d['uptime_pct'] : null;
                        $dDownSecs   = (int)($d['down_secs'] ?? 0);
                        $dDegSecs    = (int)($d['degraded_secs'] ?? 0);
                      ?>
                      <span class="uptime-tick uptime-tick--<?= $e($ds) ?>"
                        data-tip-date="<?= $e($dayLabel) ?>"
                        data-tip-status="<?= $e($tipStatus) ?>"
                        data-tip-status-cls="<?= $e($ds) ?>"
                        data-tip-uptime="<?= $dUptimePct !== null ? $dUptimePct : '' ?>"
                        data-tip-lat="<?= $dAvgLat !== null ? $dAvgLat : '' ?>"
                        data-tip-down-secs="<?= $dDownSecs ?>"
                        data-tip-deg-secs="<?= $dDegSecs ?>"
                        data-tip-total="<?= $totalChecks ?>"
                        data-slug="<?= $e($svc['slug']) ?>"
                        data-date="<?= $e($dayLabel) ?>"
                      ></span>
                    <?php endforeach; ?>
                  </div>

                  <div class="uptime-footer-meta">
                    <div>
                      <?php if ($uptime !== null): ?>
                        <span class="uptime-highlight"><?= $uptime ?>%</span> uptime
                      <?php else: ?>
                        <span class="uptime-highlight">100%</span> operational
                      <?php endif; ?>
                      <?php if ($avgLat !== null): ?>
                        &middot; avg <?= $avgLat ?>ms
                      <?php endif; ?>
                    </div>
                    <div>90 days history &middot; click for day detail</div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</main>

<!-- Open REST API Developer Showcase -->
<section class="status-api-section">
  <div class="container">
    <div class="section-eyebrow reveal">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="16 18 22 12 16 6"/>
        <polyline points="8 6 2 12 8 18"/>
      </svg>
      <span>Developer Telemetry</span>
    </div>
    <h2 class="section-title reveal" style="--delay: 50ms">Open Status REST API</h2>
    <p class="section-sub reveal" style="--delay: 100ms">
      Integrate xpsystems telemetry directly into your own dashboards, monitoring probes, or automated alerts. Unauthenticated, CORS-enabled, zero rate-limits.
    </p>

    <!-- Terminal Code Preview -->
    <div class="hero-terminal reveal" style="--delay: 150ms; margin: 32px auto 40px; max-width: 720px;">
      <div class="terminal-bar">
        <span class="terminal-dot terminal-dot--red"></span>
        <span class="terminal-dot terminal-dot--yellow"></span>
        <span class="terminal-dot terminal-dot--green"></span>
        <span class="terminal-title">bash &mdash; status-query.sh</span>
      </div>
      <div class="terminal-body" style="padding: 16px 20px;">
        <span class="terminal-prompt">$ </span><code class="terminal-cmd">curl -s https://status.xpsystems.eu/api/status | jq</code>
        <button class="terminal-copy-btn" data-copy="curl -s https://status.xpsystems.eu/api/status | jq" title="Copy command">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
          </svg>
        </button>
      </div>
    </div>

    <div class="hero-ctas reveal" style="--delay: 200ms; justify-content: center;">
      <a href="/api-docs" class="btn btn-primary">
        <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="16" y1="13" x2="8" y2="13"/>
          <line x1="16" y1="17" x2="8" y2="17"/>
        </svg>
        <span>Full API Documentation</span>
      </a>
      <a href="https://api-sandbox.de/playground.html?url=https://status.xpsystems.eu/api/status" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
        <svg class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="5 3 19 12 5 21 5 3"/>
        </svg>
        <span>Open in Interactive Sandbox</span>
      </a>
    </div>
  </div>
</section>

<!-- Floating Tooltip -->
<div id="day-tooltip" class="day-tooltip" aria-hidden="true">
  <div class="day-tooltip-header">
    <span class="day-tooltip-date" id="day-tooltip-date"></span>
    <span class="day-tooltip-badge" id="day-tooltip-badge"></span>
  </div>
  <div class="day-tooltip-rows" id="day-tooltip-rows"></div>
</div>

<!-- Day Detail Slide-Over Drawer -->
<div id="day-drawer-backdrop" class="day-drawer-backdrop"></div>
<aside id="day-drawer" class="day-drawer" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="day-drawer-title">
  <div class="day-drawer-header">
    <div class="day-drawer-title-group">
      <span class="day-drawer-label" id="day-drawer-svc"></span>
      <h2 class="day-drawer-title" id="day-drawer-title"></h2>
    </div>
    <button class="day-drawer-close" id="day-drawer-close" aria-label="Close" type="button">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <line x1="18" y1="6" x2="6" y2="18"/>
        <line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>
  </div>
  <div class="day-drawer-body" id="day-drawer-body"></div>
</aside>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
<script
  src="/assets/js/status.js"
  defer
  data-status-engine="true"
  data-api-base=""
  data-sse-url="/events"
></script>
</body>
</html>
