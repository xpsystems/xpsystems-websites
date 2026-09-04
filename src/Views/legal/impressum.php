<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

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

  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<div id="preload-bar"></div>

<?php $component('header'); ?>

<header class="hero">
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">Legal Notice</div>
    <h1 class="hero-title reveal" style="--delay: 50ms">Impressum</h1>
    <p class="hero-description reveal" style="--delay: 100ms">
      Angaben gemäß § 5 DDG (ehemals TMG) / Information pursuant to Section 5 DDG.
    </p>
  </div>
</header>

<main class="services-section">
  <div class="container">
    <div class="legal-content reveal">
      <h2>Diensteanbieter / Provider</h2>
      <p>
        <strong>xpsystems</strong><br>
        Fabian Ternis<br>
        Web-Infrastructure &amp; Hosting Services<br>
        Deutschland (Germany)
      </p>

      <h2>Kontakt / Contact</h2>
      <p>
        E-Mail: <a href="mailto:contact@xpsystems.eu">contact@xpsystems.eu</a><br>
        E-Mail (DE): <a href="mailto:contact@xpsystems.de">contact@xpsystems.de</a><br>
        Web: <a href="https://xpsystems.eu">https://xpsystems.eu</a> / <a href="https://xpsystems.de">https://xpsystems.de</a>
      </p>

      <h2>Verantwortlich für redaktionelle Inhalte</h2>
      <p>
        Fabian Ternis<br>
        E-Mail: <a href="mailto:f.ternis@xpsystems.eu">f.ternis@xpsystems.eu</a>
      </p>

      <h2>Haftungsausschluss / Disclaimer</h2>
      <h3>Haftung für Inhalte</h3>
      <p>
        Als Diensteanbieter sind wir gemäß § 7 Abs.1 DDG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 DDG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
      </p>

      <h3>Haftung für Links</h3>
      <p>
        Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich.
      </p>

      <h3>Urheberrecht</h3>
      <p>
        Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Open-Source-Softwarekomponenten sind unter ihren jeweiligen Lizenzen (in der Regel MIT-Lizenz) freigegeben.
      </p>
    </div>
  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
