<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <a href="<?= htmlspecialchars(url('main')) ?>" class="footer-logo">
        <span class="logo-mark">XP</span><?= htmlspecialchars(substr($brand['name'] ?? 'xpsystems', 2)) ?>
      </a>
      <p class="footer-desc"><?= htmlspecialchars($brand['tagline'] ?? 'German Web-Provider') ?> — European infrastructure &amp; digital sovereignty.</p>
      <div class="footer-meta">
        <span class="footer-copy">&copy; <?= $currentYear ?? date('Y') ?> xpsystems. All rights reserved.</span>
        <span class="footer-version">v<?= htmlspecialchars($app['version'] ?? '3.4.0') ?></span>
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
