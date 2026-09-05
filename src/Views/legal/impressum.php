<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $e($pageTitle) ?></title>
  <meta name="description" content="<?= $e($pageDescription) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

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

  <link rel="icon" type="image/svg+xml" href="/assets/img/icon.svg">
  <link rel="alternate icon" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>

<?php $component('header'); ?>
<?php $component('transition-banner'); ?>

<header class="hero hero--subpage">
  <div class="grid-backdrop" aria-hidden="true"></div>
  <div class="hero-backdrop-glow" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">
      <svg class="eyebrow-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
        <line x1="16" y1="13" x2="8" y2="13"/>
        <line x1="16" y1="17" x2="8" y2="17"/>
        <polyline points="10 9 9 9 8 9"/>
      </svg>
      <span>Rechtliche Angaben &middot; § 5 DDG</span>
    </div>
    <h1 class="hero-title reveal" style="--delay: 50ms"><span class="text-gradient">Impressum</span></h1>
    <p class="hero-tagline reveal" style="--delay: 100ms">
      Gesetzliche Pflichtangaben gemäß § 5 Digitale-Dienste-Gesetz (DDG) und § 18 Abs. 2 MStV für alle Dienste unter xpsystems.eu und xpsystems.de.
    </p>
  </div>
</header>

<main class="legal-page">
  <div class="container">
    <div class="legal-layout">
      
      <!-- Sticky Navigation Sidebar -->
      <aside class="legal-sidebar reveal">
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

        <div class="legal-meta-card">
          <div class="legal-meta-row">
            <span>Jurisdiktion:</span>
            <span class="meta-val">Deutschland (DE/EU)</span>
          </div>
          <div class="legal-meta-row">
            <span>Rechtsform:</span>
            <span class="meta-val">Einzelunternehmung</span>
          </div>
          <div class="legal-meta-row">
            <span>Infrastruktur:</span>
            <span class="meta-val">EU Bare-Metal</span>
          </div>
          <div class="legal-meta-row">
            <span>Stand:</span>
            <span class="meta-val">2026-09</span>
          </div>
        </div>
      </aside>

      <!-- Main Legal Articles -->
      <div class="legal-main">
        
        <!-- 01 Provider -->
        <section id="provider" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">01</span>
            <h2 class="legal-sec-title">Angaben gemäß § 5 DDG</h2>
          </div>
          <div class="legal-body">
            <p>Diensteanbieter und Betreiber dieser Website sowie der zugehörigen Web-Dienste:</p>
            <div class="legal-kv-grid">
              <div class="kv-label">Organisation</div>
              <div class="kv-value"><strong>xpsystems</strong> &mdash; Sub-Entity / Geschäftsbereich der <strong>ternis-edv</strong></div>

              <div class="kv-label">Übergeordnete Einheit</div>
              <div class="kv-value"><strong>ternis-edv</strong> (<a href="https://ternis.dev" target="_blank" rel="noopener">ternis.dev</a> &middot; <a href="https://ternis-edv.de" target="_blank" rel="noopener">ternis-edv.de</a>)</div>

              <div class="kv-label">Inhaber / Leitung</div>
              <div class="kv-value">Fabian Ternis</div>

              <div class="kv-label">Tätigkeitsbereich</div>
              <div class="kv-value">IT-Dienstleistungen, Web-Infrastructure &amp; Hosting Services, Software Engineering</div>

              <div class="kv-label">Standort</div>
              <div class="kv-value">Deutschland (Germany)</div>
            </div>
          </div>
        </section>

        <!-- 02 Contact -->
        <section id="contact" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">02</span>
            <h2 class="legal-sec-title">Kontaktmöglichkeiten</h2>
          </div>
          <div class="legal-body">
            <p>Für allgemeine, technische sowie vertragliche Anfragen stehen folgende Kommunikationswege zur Verfügung:</p>
            <div class="legal-kv-grid">
              <div class="kv-label">E-Mail (Hauptadresse)</div>
              <div class="kv-value"><a href="mailto:xpsystems@ternismail.de">xpsystems@ternismail.de</a></div>

              <div class="kv-label">E-Mail (International)</div>
              <div class="kv-value"><a href="mailto:contact@xpsystems.eu">contact@xpsystems.eu</a></div>

              <div class="kv-label">E-Mail (Deutschland)</div>
              <div class="kv-value"><a href="mailto:contact@xpsystems.de">contact@xpsystems.de</a></div>

              <div class="kv-label">Direktkontakt Inhaber</div>
              <div class="kv-value"><a href="mailto:f.ternis@xpsystems.eu">f.ternis@xpsystems.eu</a></div>

              <div class="kv-label">Nameserver (DNS)</div>
              <div class="kv-value"><code>one.ns.ternis.net</code> &middot; <code>two.ns.ternis.net</code></div>

              <div class="kv-label">Webseiten &amp; Hubs</div>
              <div class="kv-value"><a href="https://xpsystems.eu" target="_blank" rel="noopener">https://xpsystems.eu</a> &middot; <a href="https://xpsystems.de" target="_blank" rel="noopener">https://xpsystems.de</a> &middot; <a href="https://ternis.dev" target="_blank" rel="noopener">https://ternis.dev</a> &middot; <a href="https://oss.ternis.org" target="_blank" rel="noopener">https://oss.ternis.org</a></div>
            </div>

            <div class="legal-callout">
              <svg class="callout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
              </svg>
              <div class="callout-text">
                <strong>Direktes Anfrage-Routing</strong>
                Nutzen Sie unsere zentrale <a href="/contact">Kontaktseite</a>, um Ihr Anliegen direkt an die zuständige Fachabteilung (Infrastruktur, NOC, Domainverwaltung oder allgemeine Anfragen) zu übermitteln.
              </div>
            </div>
          </div>
        </section>

        <!-- 03 Responsible for Content -->
        <section id="responsible" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">03</span>
            <h2 class="legal-sec-title">Verantwortlich für den redaktionellen Inhalt</h2>
          </div>
          <div class="legal-body">
            <p>Verantwortlich für die redaktionell-journalistischen Inhalte gemäß § 18 Abs. 2 MStV (Medienstaatsvertrag):</p>
            <div class="legal-kv-grid">
              <div class="kv-label">Name</div>
              <div class="kv-value"><strong>Fabian Ternis</strong></div>

              <div class="kv-label">E-Mail</div>
              <div class="kv-value"><a href="mailto:f.ternis@xpsystems.eu">f.ternis@xpsystems.eu</a></div>

              <div class="kv-label">Anschrift</div>
              <div class="kv-value">Deutschland (Anschrift wie oben)</div>
            </div>
          </div>
        </section>

        <!-- 04 Dispute Resolution -->
        <section id="dispute" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">04</span>
            <h2 class="legal-sec-title">EU-Streitschlichtung &amp; Verbraucherschutz</h2>
          </div>
          <div class="legal-body">
            <p>
              Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
              <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr/</a>.<br>
              Unsere E-Mail-Adresse finden Sie oben im Impressum.
            </p>
            <p>
              Wir sind weder bereit noch verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
            </p>
          </div>
        </section>

        <!-- 05 Disclaimer -->
        <section id="disclaimer" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">05</span>
            <h2 class="legal-sec-title">Haftungsausschluss (Disclaimer)</h2>
          </div>
          <div class="legal-body">
            <h3>Haftung für Inhalte</h3>
            <p>
              Als Diensteanbieter sind wir gemäß § 7 Abs. 1 DDG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 DDG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
            </p>
            <p>
              Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
            </p>

            <h3>Haftung für Hyperlinks</h3>
            <p>
              Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich.
            </p>
            <p>
              Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.
            </p>
          </div>
        </section>

        <!-- 06 Copyright -->
        <section id="copyright" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">06</span>
            <h2 class="legal-sec-title">Urheberrecht &amp; Open Source</h2>
          </div>
          <div class="legal-body">
            <p>
              Die durch die Seitenbetreiber erstellten Inhalte, Codes und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.
            </p>
            <p>
              Sämtliche von uns als Open-Source freigegebenen Repositories und Bibliotheken (abrufbar unter <a href="/opensource">xpsystems Open Source</a>) unterliegen den in den jeweiligen Repositories hinterlegten Open-Source-Lizenzen (in der Regel MIT- oder Apache-2.0-Lizenz).
            </p>
          </div>
        </section>

      </div>
    </div>
  </div>
</main>

<?php $component('footer'); ?>

<script src="/assets/js/main.js" defer></script>
</body>
</html>

