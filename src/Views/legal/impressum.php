<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <script>
  (function(){
    try {
      var s = localStorage.getItem('xps-theme') || 'dark';
      document.documentElement.setAttribute('data-theme', s);
    } catch(e) {}
  })();
  </script>

  <link rel="icon" type="image/svg+xml" href="/assets/img/icon.svg">
  <link rel="alternate icon" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>
<?php $component('transition-banner'); ?>
<?php $component('header'); ?>

<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow">
      <span class="status-dot green"></span>
      <span>Rechtliche Angaben &bull; § 5 DDG</span>
    </div>

    <h1 class="hero-title">
      Impressum<br>
      <span class="hero-title-accent">&amp; Rechtliche Hinweise</span>
    </h1>

    <p class="hero-tagline">
      Gesetzliche Pflichtangaben gemäß § 5 Digitale-Dienste-Gesetz (DDG) und § 18 Abs. 2 MStV für alle Webangebote und Dienste unter xpsystems.eu, xpsystems.de und Subdomains.
    </p>
  </div>
</header>

<main class="legal-page">
  <div class="container">
    <div class="legal-layout">

      <!-- Sticky Navigation Sidebar -->
      <aside class="legal-sidebar">
        <nav class="legal-toc-card" aria-label="Inhaltsverzeichnis">
          <div class="legal-toc-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="8" y1="6" x2="21" y2="6"/>
              <line x1="8" y1="12" x2="21" y2="12"/>
              <line x1="8" y1="18" x2="21" y2="18"/>
              <line x1="3" y1="6" x2="3.01" y2="6"/>
              <line x1="3" y1="12" x2="3.01" y2="12"/>
              <line x1="3" y1="18" x2="3.01" y2="18"/>
            </svg>
            <span>Abschnitte</span>
          </div>
          <ul class="legal-toc-list">
            <li><a href="#provider" class="legal-toc-link"><span class="toc-num">01</span><span>Diensteanbieter</span></a></li>
            <li><a href="#contact" class="legal-toc-link"><span class="toc-num">02</span><span>Kontakt</span></a></li>
            <li><a href="#responsible" class="legal-toc-link"><span class="toc-num">03</span><span>Redaktionell Verantwortlich</span></a></li>
            <li><a href="#dispute" class="legal-toc-link"><span class="toc-num">04</span><span>EU-Streitschlichtung</span></a></li>
            <li><a href="#disclaimer" class="legal-toc-link"><span class="toc-num">05</span><span>Haftungsausschluss</span></a></li>
            <li><a href="#copyright" class="legal-toc-link"><span class="toc-num">06</span><span>Urheberrecht</span></a></li>
          </ul>
        </nav>

        <div class="legal-toc-card mono" style="font-size:0.75rem;color:var(--text-muted);display:flex;flex-direction:column;gap:8px;">
          <div><strong>Jurisdiktion:</strong> Deutschland (DE/EU)</div>
          <div><strong>Rechtsform:</strong> Einzelunternehmung</div>
          <div><strong>Infrastruktur:</strong> EU Bare-Metal</div>
          <div><strong>Stand:</strong> 2026-09</div>
        </div>
      </aside>

      <!-- Main Legal Content -->
      <div class="legal-content">

        <!-- 01 Diensteanbieter -->
        <article id="provider" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[01]</span>
            <span>Angaben gemäß § 5 DDG (Diensteanbieter)</span>
          </h2>
          <div class="legal-prose">
            <p><strong>Fabian Ternis</strong><br>
            ternis-edv / ternis.dev (Ecosystem xpsystems)<br>
            Deutschland</p>
            <p>
              xpsystems (xpsystems.eu &bull; xpsystems.de) wird als Sub-Entität von ternis-edv (ternis.dev) betrieben.
            </p>
          </div>
        </article>

        <!-- 02 Kontakt -->
        <article id="contact" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[02]</span>
            <span>Kontaktmöglichkeiten</span>
          </h2>
          <div class="legal-prose">
            <p>
              <strong>E-Mail:</strong> <a href="mailto:xpsystems@ternismail.de">xpsystems@ternismail.de</a><br>
              <strong>Allgemeine Anfragen:</strong> <a href="mailto:contact@xpsystems.eu">contact@xpsystems.eu</a><br>
              <strong>Support Deutschland:</strong> <a href="mailto:contact@xpsystems.de">contact@xpsystems.de</a><br>
              <strong>Website / Portfolio:</strong> <a href="https://fabianternis.de" target="_blank" rel="noopener noreferrer">fabianternis.de</a>
            </p>
          </div>
        </article>

        <!-- 03 Verantwortlich nach § 18 Abs. 2 MStV -->
        <article id="responsible" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[03]</span>
            <span>Verantwortlich für den Inhalt nach § 18 Abs. 2 MStV</span>
          </h2>
          <div class="legal-prose">
            <p>
              <strong>Fabian Ternis</strong><br>
              ternis-edv / ternis.dev<br>
              E-Mail: <a href="mailto:f.ternis@xpsystems.eu">f.ternis@xpsystems.eu</a>
            </p>
          </div>
        </article>

        <!-- 04 EU-Streitschlichtung -->
        <article id="dispute" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[04]</span>
            <span>Verbraucherstreitbeilegung &bull; EU-Streitschlichtung</span>
          </h2>
          <div class="legal-prose">
            <p>
              Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: 
              <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr</a>.<br>
              Unsere E-Mail-Adresse finden Sie oben im Impressum.
            </p>
            <p>
              Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
            </p>
          </div>
        </article>

        <!-- 05 Haftungsausschluss -->
        <article id="disclaimer" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[05]</span>
            <span>Haftung für Inhalte &amp; Links</span>
          </h2>
          <div class="legal-prose">
            <h3>Haftung für Inhalte</h3>
            <p>
              Als Diensteanbieter sind wir gemäß § 7 Abs. 1 DDG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 DDG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
            </p>

            <h3>Haftung für Links</h3>
            <p>
              Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich.
            </p>
          </div>
        </article>

        <!-- 06 Urheberrecht -->
        <article id="copyright" class="legal-card">
          <h2 class="legal-card-title">
            <span class="mono" style="color:var(--accent);">[06]</span>
            <span>Urheberrecht</span>
          </h2>
          <div class="legal-prose">
            <p>
              Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Soweit Inhalte als Open Source gekennzeichnet sind (z. B. unter MIT- oder Apache-2.0-Lizenz auf GitHub), gelten die jeweiligen Lizenzbestimmungen des Repositoriums.
            </p>
          </div>
        </article>

      </div>
    </div>
  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>
