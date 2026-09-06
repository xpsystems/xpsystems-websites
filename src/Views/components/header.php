<header class="nav-header" id="nav-header">
  <div class="nav-inner">
    <a href="<?= htmlspecialchars(url('main')) ?>" class="nav-logo" aria-label="xpsystems home">
      <span class="nav-logo-mark">XP</span>
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
      <!-- Live CET Clock (Frankfurt / Berlin) -->
      <div class="nav-clock" id="nav-clock" title="Operational Datacenter Time (Frankfurt am Main / Berlin)">
        <span class="status-dot green" style="width:5px;height:5px;"></span>
        <span id="nav-clock-time">--:--:-- CET</span>
      </div>

      <!-- Live Infrastructure Status Badge -->
      <a href="<?= htmlspecialchars(url('/status')) ?>" class="status-badge" id="status-badge" title="Live infrastructure status telemetry">
        <div class="status-dot-wrap">
          <span class="status-ping"></span>
          <span class="status-dot green" id="status-dot"></span>
        </div>
        <span class="status-text" id="status-text">Operational</span>
      </a>

      <!-- Tactile Sound FX Toggle -->
      <button class="sound-toggle-btn" id="sound-toggle-btn" type="button" title="Toggle tactile mechanical audio feedback">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
          <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
        </svg>
        <span class="sound-label">SOUND: OFF</span>
      </button>

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
