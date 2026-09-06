<header class="nav-header" id="nav-header">
  <div class="nav-inner">
    <a href="<?= htmlspecialchars(url('main')) ?>" class="nav-logo" aria-label="xpsystems home">
      <span class="nav-logo-text">xpsystems</span>
      <span class="nav-logo-dot"></span>
    </a>

    <nav class="nav-links" id="nav-links" aria-label="Main navigation">
      <?php foreach ($nav as $item): ?>
        <a
          class="nav-link<?= !empty($item['active']) ? ' active' : '' ?>"
          href="<?= htmlspecialchars($item['href']) ?>"
          <?= !empty($item['external']) ? 'target="_blank" rel="noopener noreferrer"' : '' ?>
        ><?= htmlspecialchars($item['label']) ?></a>
      <?php endforeach; ?>
    </nav>

    <div class="nav-right">
      <!-- Live Infrastructure Status Badge with --status-color -->
      <a
        href="<?= htmlspecialchars(url('status')) ?>"
        class="status-badge"
        id="status-badge"
        data-status="<?= htmlspecialchars($overallStatus ?? 'operational') ?>"
        style="--status-color: <?= htmlspecialchars($statusColor ?? 'var(--status-up)') ?>;"
        title="Live infrastructure status"
      >
        <div class="status-dot-wrap">
          <span class="status-ping"></span>
          <span class="status-dot" id="status-dot"></span>
        </div>
        <span class="status-text" id="status-text"><?= htmlspecialchars($statusLabel ?? 'Operational') ?></span>
      </a>

      <!-- Tactile Sound FX Toggle with Hover Volume Slider Dropdown -->
      <div class="sound-control-wrap" id="sound-control-wrap">
        <button class="sound-toggle-btn" id="sound-toggle-btn" type="button" aria-label="Toggle sound feedback" title="Toggle audio feedback">
          <svg class="sound-icon sound-icon-on" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
            <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
          </svg>
          <svg class="sound-icon sound-icon-off" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
            <line x1="23" y1="9" x2="17" y2="15"></line>
            <line x1="17" y1="9" x2="23" y2="15"></line>
          </svg>
        </button>

        <div class="sound-volume-dropdown" id="sound-volume-dropdown" role="region" aria-label="Audio Volume Control">
          <div class="sound-volume-header">
            <span class="sound-volume-label">Volume</span>
            <span class="sound-volume-value mono" id="sound-volume-value">70%</span>
          </div>
          <div class="sound-slider-wrap">
            <input
              type="range"
              class="sound-volume-slider"
              id="sound-volume-slider"
              min="0"
              max="100"
              value="70"
              step="1"
              aria-label="Adjust audio volume"
            />
          </div>
        </div>
      </div>

      <!-- Theme Switcher (Dark / Light / Matrix) -->
      <?php $component('theme-toggle'); ?>

      <!-- Mobile Hamburger Button -->
      <button
        class="nav-hamburger"
        id="nav-hamburger"
        aria-label="Toggle navigation menu"
        aria-expanded="false"
        aria-controls="nav-links"
        type="button"
      >
        <svg class="icon-hamburger" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
  </div>
</header>
