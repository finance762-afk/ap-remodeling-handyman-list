<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'cookie-policy';
$pageType    = 'other';

$pageTitle       = 'Cookie Policy | AP Remodeling Handyman List, Elkhart, IN';
$pageDescription = 'Which cookies the AP Remodeling Handyman List website in Elkhart, IN uses, including its first-party visit cookie and Google Analytics, and how to control them.';
$canonicalUrl    = $siteUrl . '/cookie-policy/';
$ogImage         = '/assets/images/og-default-v1.jpg';
$lastUpdated = 'October 18, 2026';
$schemaMarkup = [
    [
        '@context'      => 'https://schema.org',
        '@type'         => 'WebPage',
        '@id'           => $canonicalUrl . '#webpage',
        'url'           => $canonicalUrl,
        'name'          => $pageTitle,
        'description'   => $pageDescription,
        'dateModified'  => '2026-10-18',
        'isPartOf'      => ['@id' => rtrim($siteUrl, '/') . '/#website'],
    ],
    generateBreadcrumbSchema([
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Cookie Policy', 'url' => '/cookie-policy/'],
    ]),
];

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<style>
.legal-hero { min-height: 40vh; display: flex; align-items: center; }
.legal-hero .container { width: 100%; }
.legal-hero h1 { text-wrap: balance; max-width: 22ch; }
.legal-hero p { margin: var(--space-xs) 0 0; color: color-mix(in srgb, var(--color-white) 82%, transparent); }
.legal-wrap { background: var(--color-paper); padding-block: var(--space-2xl) var(--space-3xl); }
.legal-wrap .legal-prose { margin-inline: auto; }
.legal-prose h2 { text-wrap: balance; color: var(--color-ink); scroll-margin-top: calc(var(--nav-height) + var(--space-lg)); }
.legal-prose h3 { scroll-margin-top: calc(var(--nav-height) + var(--space-lg)); }
.legal-prose p, .legal-prose li { color: var(--color-ink-2); }
.legal-prose ul { padding-left: var(--space-lg); }
.legal-prose li { margin-bottom: var(--space-xs); }
.legal-prose a { color: var(--color-primary); font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: var(--space-1); }
.legal-crumb { background: var(--color-paper); padding-top: var(--space-md); }
.legal-crumb .breadcrumb { margin: 0; }
.legal-crumb .breadcrumb > .container { align-items: center; }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--legal texture-grain legal-hero" aria-label="Cookie Policy">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <span class="eyebrow">Legal</span>
    <h1 class="hero-title">Cookie Policy</h1>
    <p>What cookies this site uses and how to control them.</p>
    <p>Last Updated: <?php echo h($lastUpdated); ?></p>
  </div>
</section>

<nav class="breadcrumb legal-crumb" aria-label="Breadcrumb">
  <div class="container">
    <ol>
      <li><a href="/">Home</a></li>
      <li class="breadcrumb-sep" aria-hidden="true">›</li>
      <li aria-current="page">Cookie Policy</li>
    </ol>
  </div>
</nav>

<div class="legal-wrap">
  <div class="container-narrow">
    <article class="legal-prose content-narrow">

    <h2>What are cookies?</h2>
    <p>Cookies are small text files a website stores on your device. They help a site work and tell its owner how the site is used.</p>

    <h2>Which cookies does this site use?</h2>
    <h3>Strictly necessary and first-party</h3>
    <p>When you first arrive, this site sets one first-party cookie, <code>p1_ft</code>, for 30 days. It records your landing page, the site that referred you, campaign tags in the link, a random session ID and your device type, so a form submission can be tied to the page that brought you here. The "Got it" choice on the cookie notice is saved in your browser's local storage, not in a cookie.</p>
    <h3>Analytics (Google Analytics 4)</h3>
    <p>We use Google Analytics 4 to see how visitors use the site. It sets cookies whose names start with <code>_ga</code> and collects page views, device and approximate location.</p>
    <h3>Third-party embeds</h3>
    <p>The Contact and Service Area pages embed a Google map, which may set Google cookies. Fonts on this site are hosted on our own server, so no font provider sets cookies.</p>

    <h2>How can you control cookies?</h2>
    <p>Most browsers let you view, delete or block cookies. Blocking all of them can break parts of a site. Instructions are available from Google, Mozilla, Apple and Microsoft for their browsers.</p>

    <h2>How can you opt out of Google Analytics?</h2>
    <p>Install the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Browser Add-on</a> to stop GA4 tracking on all sites.</p>

    <h2>How does the cookie notice work?</h2>
    <p>A short notice appears when you first visit. Once you select "Got it", it stays hidden on later visits. Clearing your browser's site data brings it back.</p>

    <h2>How will changes to this policy be shown?</h2>
    <p>We may update this policy as the site changes. The "Last Updated" date shows the latest version.</p>

    <h2>How do you contact us about cookies?</h2>
        <p>
      <strong><?php echo h($siteName); ?></strong><br>
      Email: <a href="mailto:<?php echo h($email); ?>"><?php echo h($email); ?></a><br>
      Phone: <a href="tel:<?php echo h($phoneRaw); ?>"><?php echo h($phone); ?></a><br>
      Location: <?php echo h($address['city'] . ', Indiana'); ?>
    </p>

    </article>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
