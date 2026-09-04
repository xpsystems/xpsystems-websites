<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <a href="<?= htmlspecialchars(url('main')) ?>" class="footer-logo" aria-label="xpsystems home">
        <svg class="footer-logo-icon" width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <rect width="32" height="32" rx="7" fill="currentColor"/>
          <path d="M8.5 9.5L15 22.5M15 9.5L8.5 22.5" stroke="#ffffff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M18.5 9.5V22.5M18.5 9.5H22C23.6569 9.5 25 10.8431 25 12.5C25 14.1569 23.6569 15.5 22 15.5H18.5" stroke="#ffffff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="footer-logo-text">xp<span><?= htmlspecialchars(substr($brand['name'] ?? 'xpsystems', 2)) ?></span></span>
      </a>
      <p class="footer-desc"><?= htmlspecialchars($brand['tagline'] ?? 'German Web-Provider') ?> — European infrastructure &amp; digital sovereignty.</p>
      <div class="footer-meta">
        <span class="footer-copy">&copy; <?= $currentYear ?? date('Y') ?> xpsystems. All rights reserved.</span>
        <span class="footer-version">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
            <line x1="7" y1="7" x2="7.01" y2="7"/>
          </svg>
          v<?= htmlspecialchars($app['version'] ?? '3.4.0') ?>
        </span>
      </div>
    </div>

    <div class="footer-right">
      <nav class="footer-nav" aria-label="Footer navigation">
        <?php foreach ($footer_links as $link): ?>
          <a class="footer-link" href="<?= htmlspecialchars($link['href']) ?>">
            <?= htmlspecialchars($link['label']) ?>
          </a>
        <?php endforeach; ?>
      </nav>

      <?php $component('theme-toggle'); ?>
    </div>
  </div>
</footer>
