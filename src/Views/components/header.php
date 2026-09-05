<header class="nav-header" id="nav-header">
  <div class="nav-inner">
    <a href="<?= htmlspecialchars(url('main')) ?>" class="nav-logo" aria-label="xpsystems home">
      <div class="nav-logo-icon-wrap">
        <svg width="18" height="18" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <rect width="32" height="32" rx="7" fill="currentColor"/>
          <path d="M8.5 9.5L15 22.5M15 9.5L8.5 22.5" stroke="#ffffff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M18.5 9.5V22.5M18.5 9.5H22C23.6569 9.5 25 10.8431 25 12.5C25 14.1569 23.6569 15.5 22 15.5H18.5" stroke="#ffffff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <span class="nav-logo-text">xp<span class="nav-logo-light"><?= htmlspecialchars(substr($brand['name'] ?? 'xpsystems', 2)) ?></span></span>
      <span class="nav-badge-pill">DE &bull; EU</span>
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
      <a href="https://status.xpsystems.eu" target="_blank" rel="noopener noreferrer" class="status-badge" id="status-badge" title="Live infrastructure status">
        <div class="status-dot-wrap">
          <span class="status-ping"></span>
          <span class="status-dot" id="status-dot"></span>
        </div>
        <span class="status-text" id="status-text">Operational</span>
      </a>

      <?php $component('theme-toggle'); ?>

      <button
        class="nav-hamburger"
        id="nav-hamburger"
        aria-label="Toggle navigation"
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
<div class="nav-overlay" id="nav-overlay"></div>
