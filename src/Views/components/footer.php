<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <span class="footer-logo"><?= htmlspecialchars($brand['name'] ?? 'xpsystems') ?></span>
      <span class="footer-copy">&copy; <?= $currentYear ?? date('Y') ?>. All rights reserved.</span>
      <span class="footer-version">v<?= htmlspecialchars($app['version'] ?? '3.4.0') ?></span>
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
