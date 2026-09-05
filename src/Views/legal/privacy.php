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

  <link rel="stylesheet" href="/assets/css/build.css">
</head>
<body>

<?php $component('loader'); ?>

<?php $component('header'); ?>

<header class="hero hero--subpage">
  <div class="hero-backdrop-glow" aria-hidden="true"></div>
  <div class="container hero-inner">
    <div class="hero-eyebrow reveal">
      <svg class="eyebrow-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
      </svg>
      <span>DSGVO / GDPR Konformität</span>
    </div>
    <h1 class="hero-title reveal" style="--delay: 50ms">Datenschutzerklärung</h1>
    <p class="hero-tagline reveal" style="--delay: 100ms">
      Transparente Informationen über die Art, den Umfang und die Zwecke der Verarbeitung personenbezogener Daten im xpsystems-Netzwerk.
    </p>
  </div>
</header>

<main class="legal-page">
  <div class="container">

    <!-- Privacy Guarantees Strip -->
    <div class="privacy-highlights reveal">
      <div class="privacy-highlight-card">
        <div class="highlight-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <div class="highlight-content">
          <span class="highlight-title">Zero Trackers</span>
          <span class="highlight-sub">Keine Werbenetzwerke oder Tracking-Pixel</span>
        </div>
      </div>

      <div class="privacy-highlight-card">
        <div class="highlight-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </div>
        <div class="highlight-content">
          <span class="highlight-title">Keine Third-Party Cookies</span>
          <span class="highlight-sub">Nur lokale UI-Präferenzen (LocalStorage)</span>
        </div>
      </div>

      <div class="privacy-highlight-card">
        <div class="highlight-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
        </div>
        <div class="highlight-content">
          <span class="highlight-title">EU Bare-Metal Standorte</span>
          <span class="highlight-sub">Hosting in Frankfurt am Main &amp; Falkenstein</span>
        </div>
      </div>
    </div>

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
            <span>Themenübersicht</span>
          </div>
          <ul class="legal-toc-list">
            <li><a href="#overview" class="legal-toc-link"><span class="toc-num">01</span><span>Überblick &amp; Prinzipien</span></a></li>
            <li><a href="#controller" class="legal-toc-link"><span class="toc-num">02</span><span>Verantwortliche Stelle</span></a></li>
            <li><a href="#serverlogs" class="legal-toc-link"><span class="toc-num">03</span><span>Server-Log-Dateien</span></a></li>
            <li><a href="#encryption" class="legal-toc-link"><span class="toc-num">04</span><span>Verschlüsselung (TLS)</span></a></li>
            <li><a href="#storage" class="legal-toc-link"><span class="toc-num">05</span><span>Cookies &amp; LocalStorage</span></a></li>
            <li><a href="#rights" class="legal-toc-link"><span class="toc-num">06</span><span>Ihre Rechte (DSGVO)</span></a></li>
          </ul>
        </nav>

        <div class="legal-meta-card">
          <div class="legal-meta-row">
            <span>Rechtsrahmen:</span>
            <span class="meta-val">EU-DSGVO / BDSG</span>
          </div>
          <div class="legal-meta-row">
            <span>Analytics:</span>
            <span class="meta-val">Deaktiviert</span>
          </div>
          <div class="legal-meta-row">
            <span>Tracking-Cookies:</span>
            <span class="meta-val">Keine</span>
          </div>
          <div class="legal-meta-row">
            <span>Stand:</span>
            <span class="meta-val">2026-09</span>
          </div>
        </div>
      </aside>

      <!-- Main Legal Articles -->
      <div class="legal-main">
        
        <!-- 01 Overview -->
        <section id="overview" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">01</span>
            <h2 class="legal-sec-title">Datenschutz auf einen Blick</h2>
          </div>
          <div class="legal-body">
            <p>
              Der Schutz Ihrer persönlichen Daten genießt bei <strong>xpsystems</strong> höchste Priorität. Wir verarbeiten personenbezogene Daten stets im Einklang mit der Datenschutz-Grundverordnung (DSGVO) sowie den anwendbaren nationalen Datenschutzvorschriften (Bundesdatenschutzgesetz BDSG).
            </p>
            <p>
              Als Betreiber moderner Web-Infrastruktur verfolgen wir das Prinzip der <em>Datensparsamkeit</em>: Es werden ausschließlich diejenigen technischen Protokolldaten erfasst, die zur fehlerfreien und sicheren Bereitstellung der Dienste zwingend erforderlich sind.
            </p>

            <div class="legal-callout legal-callout--green">
              <svg class="callout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
              </svg>
              <div class="callout-text">
                <strong>Verzicht auf Profiling &amp; Third-Party Tracker</strong>
                Wir verzichten bewusst auf Google Analytics, Meta Pixel, Werbenetzwerke oder Fingerprinting-Skripte. Ihr Surfverhalten wird von uns weder analysiert noch kommerziell verwertet.
              </div>
            </div>
          </div>
        </section>

        <!-- 02 Controller -->
        <section id="controller" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">02</span>
            <h2 class="legal-sec-title">Verantwortliche Stelle</h2>
          </div>
          <div class="legal-body">
            <p>Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:</p>
            <div class="legal-kv-grid">
              <div class="kv-label">Verantwortlicher</div>
              <div class="kv-value"><strong>Fabian Ternis</strong></div>

              <div class="kv-label">Organisation &amp; Träger</div>
              <div class="kv-value"><strong>ternis-edv</strong> (<a href="https://ternis.dev" target="_blank" rel="noopener">ternis.dev</a> &middot; <a href="https://ternis-edv.de" target="_blank" rel="noopener">ternis-edv.de</a>) &mdash; Geschäftsbereich <strong>xpsystems</strong></div>

              <div class="kv-label">E-Mail (Datenschutz)</div>
              <div class="kv-value"><a href="mailto:contact@xpsystems.eu">contact@xpsystems.eu</a></div>

              <div class="kv-label">Standort</div>
              <div class="kv-value">Deutschland (Germany)</div>
            </div>
            <p>
              Die verantwortliche Stelle ist die natürliche oder juristische Person, die allein oder gemeinsam mit anderen über die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten entscheidet.
            </p>
          </div>
        </section>

        <!-- 03 Server Logs -->
        <section id="serverlogs" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">03</span>
            <h2 class="legal-sec-title">Datenerfassung &amp; Server-Log-Dateien</h2>
          </div>
          <div class="legal-body">
            <p>
              Beim Zugriff auf unsere Webseiten erfasst der Webserver (Apache / Edge Reverse Proxy) automatisch technische Protokolldaten in sogenannten Server-Log-Dateien. Dies ist technisch bedingt und für den stabilen Betrieb unseres Netzwerks unerlässlich.
            </p>
            <ul>
              <li>Browsertyp, Version und Render-Engine</li>
              <li>Betriebssystem des zugreifenden Geräts</li>
              <li>Referrer URL (zuvor besuchte Seite)</li>
              <li>Hostname / IP-Adresse des zugreifenden Rechners</li>
              <li>Datum und genaue Uhrzeit der Serveranfrage</li>
              <li>HTTP-Statuscode (z. B. 200 OK, 404 Not Found)</li>
              <li>Übertragene Datenmenge in Bytes</li>
            </ul>
            <p>
              <strong>Rechtsgrundlage:</strong> Die Verarbeitung erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an der Gewährleistung der Netzsicherheit, Abwehr von DDoS-Angriffen und Sicherstellung der Systemstabilität).
            </p>
            <p>
              Eine Zusammenführung dieser Protokolldaten mit anderen Datenquellen wird nicht vorgenommen. Die Server-Logs werden nach Ablauf der gesetzlichen bzw. betriebsnotwendigen Fristen (in der Regel 7 bis 14 Tage) automatisch rotiert und gelöscht.
            </p>
          </div>
        </section>

        <!-- 04 Encryption -->
        <section id="encryption" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">04</span>
            <h2 class="legal-sec-title">SSL- bzw. TLS-Verschlüsselung</h2>
          </div>
          <div class="legal-body">
            <p>
              Diese Seite nutzt aus Sicherheitsgründen und zum Schutz der Übertragung vertraulicher Inhalte eine lückenlose Transportverschlüsselung via TLS 1.3 / TLS 1.2 mit modernen Cipher-Suites und HSTS (HTTP Strict Transport Security).
            </p>
            <p>
              Eine verschlüsselte Verbindung erkennen Sie daran, dass die Adresszeile des Browsers von <code>http://</code> auf <code>https://</code> wechselt und an dem geschlossenen Schloss-Symbol in Ihrer Browserzeile. Wenn die Verschlüsselung aktiviert ist, können die Daten, die Sie an uns übermitteln, nicht von Dritten mitgelesen werden.
            </p>
          </div>
        </section>

        <!-- 05 Cookies & Storage -->
        <section id="storage" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">05</span>
            <h2 class="legal-sec-title">Cookies &amp; Lokaler Speicher (LocalStorage)</h2>
          </div>
          <div class="legal-body">
            <p>
              Unsere Website setzt <strong>keine Tracking-Cookies</strong>, keine Marketing-Cookies und keine Third-Party-Cookies ein.
            </p>
            <p>
              Zur Speicherung Ihrer gewünschten Theme-Einstellung (Dark Mode, Light Mode oder Systemstandard) nutzen wir den lokalen Web Storage Ihres Browsers (<code>HTML5 LocalStorage</code>) unter dem Schlüssel <code>xps-theme</code>.
            </p>
            <ul>
              <li><strong>Zweck:</strong> Vermeidung von Bildschirmflackern beim Seitenwechsel und Beibehaltung Ihres bevorzugten Kontrastmodus.</li>
              <li><strong>Speicherort:</strong> Ausschließlich lokal auf Ihrem Endgerät. Diese Information wird zu keinem Zeitpunkt an unsere Webserver gesendet.</li>
              <li><strong>Rechtsgrundlage:</strong> § 25 Abs. 2 Nr. 2 TDDDG (technisch erforderlich zur Bereitstellung des vom Nutzer ausdrücklich gewünschten Telemediendienstes).</li>
            </ul>
          </div>
        </section>

        <!-- 06 Rights -->
        <section id="rights" class="legal-section reveal">
          <div class="legal-sec-header">
            <span class="legal-sec-num">06</span>
            <h2 class="legal-sec-title">Rechte der betroffenen Person</h2>
          </div>
          <div class="legal-body">
            <p>Ihnen stehen gemäß DSGVO die folgenden Rechte gegenüber der verantwortlichen Stelle zu:</p>
            <ul>
              <li><strong>Auskunftsrecht (Art. 15 DSGVO):</strong> Sie haben das Recht, jederzeit Bestätigung und unentgeltliche Auskunft über Ihre von uns verarbeiteten Daten zu erhalten.</li>
              <li><strong>Recht auf Berichtigung (Art. 16 DSGVO):</strong> Sie können unverzüglich die Berichtigung unrichtiger Daten verlangen.</li>
              <li><strong>Recht auf Löschung (Art. 17 DSGVO):</strong> Sie können die unverzügliche Löschung Ihrer Daten fordern, sofern keine gesetzlichen Aufbewahrungspflichten entgegenstehen.</li>
              <li><strong>Recht auf Einschränkung der Verarbeitung (Art. 18 DSGVO):</strong> Sie haben das Recht, die Einschränkung der Verarbeitung zu verlangen.</li>
              <li><strong>Recht auf Datenübertragbarkeit (Art. 20 DSGVO):</strong> Sie haben das Recht, Ihre Daten in einem strukturierten, gängigen Format zu erhalten.</li>
              <li><strong>Widerspruchsrecht (Art. 21 DSGVO):</strong> Sie haben das Recht, aus Gründen, die sich aus Ihrer besonderen Situation ergeben, jederzeit gegen die Verarbeitung Widerspruch einzulegen.</li>
            </ul>
            <p>
              Zur Ausübung Ihrer Rechte genügt eine formlose Nachricht per E-Mail an <a href="mailto:contact@xpsystems.eu">contact@xpsystems.eu</a>.
            </p>
            <p>
              Des Weiteren steht Ihnen gemäß Art. 77 DSGVO ein Beschwerderecht bei der zuständigen Datenschutz-Aufsichtsbehörde zu.
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

