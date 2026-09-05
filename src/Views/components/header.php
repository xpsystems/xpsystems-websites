<header class="nav-header" id="nav-header">
  <div class="nav-inner">
    <a href="<?= htmlspecialchars(url('main')) ?>" class="nav-logo" aria-label="xpsystems home">
      <span class="nav-logo-text">xpsystems</span>
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
