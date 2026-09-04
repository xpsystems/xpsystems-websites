<header class="nav-header" id="nav-header">
  <div class="nav-inner">
    <a href="<?= htmlspecialchars(url('main')) ?>" class="nav-logo">
      <?= htmlspecialchars($brand['name'] ?? 'xpsystems') ?>
    </a>

    <nav class="nav-links" id="nav-links" aria-label="Main navigation">
      <?php foreach ($nav as $item): ?>
        <a
          class="nav-link<?= !empty($item['active']) ? ' active' : '' ?>"
          href="<?= htmlspecialchars($item['href']) ?>"
          <?= !empty($item['external']) ? 'target="_blank" rel="noopener noreferrer"' : '' ?>
        ><?= htmlspecialchars($item['label']) ?></a>
      <?php endforeach; ?>

      <span class="status-badge" id="status-badge" title="Live infrastructure status">
        <span class="status-dot" id="status-dot"></span>
        <span class="status-text" id="status-text">Checking…</span>
      </span>
    </nav>

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
</header>
<div class="nav-overlay" id="nav-overlay"></div>
