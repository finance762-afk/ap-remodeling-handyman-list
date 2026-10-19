<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'accessibility';
$pageType    = 'other';

$pageTitle       = 'Accessibility Statement | AP Remodeling Handyman List';
$pageDescription = 'AP Remodeling Handyman List in Elkhart, IN works toward WCAG 2.1 AA on its website. See the accessibility features and how to report a barrier or ask for help.';
$canonicalUrl    = $siteUrl . '/accessibility/';
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
        ['name' => 'Accessibility Statement', 'url' => '/accessibility/'],
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
<section class="hero hero--legal texture-grain legal-hero" aria-label="Accessibility Statement">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <span class="eyebrow">Legal</span>
    <h1 class="hero-title">Accessibility Statement</h1>
    <p>Our commitment to a website everyone can use.</p>
    <p>Last Updated: <?php echo h($lastUpdated); ?></p>
  </div>
</section>

<nav class="breadcrumb legal-crumb" aria-label="Breadcrumb">
  <div class="container">
    <ol>
      <li><a href="/">Home</a></li>
      <li class="breadcrumb-sep" aria-hidden="true">›</li>
      <li aria-current="page">Accessibility Statement</li>
    </ol>
  </div>
</nav>

<div class="legal-wrap">
  <div class="container-narrow">
    <article class="legal-prose content-narrow">

    <h2>What is our commitment to accessibility?</h2>
    <p><?php echo h($siteName); ?> wants everyone to be able to use this website, including people with disabilities. We work to improve the experience for all visitors and apply accessibility standards to <?php echo h($domain); ?>.</p>

    <h2>What standard does this site follow?</h2>
    <p>The site is designed to meet the Web Content Accessibility Guidelines (WCAG) 2.1 Level AA. It partially conforms, which means some content may not yet fully meet the standard, and we are working to close any gaps we find.</p>

    <h2>Which accessibility features does the site include?</h2>
    <ul>
      <li>Semantic page structure with header, navigation, main and footer landmarks</li>
      <li>A "Skip to main content" link at the top of every page</li>
      <li>Visible keyboard focus on links, buttons and form fields</li>
      <li>Text descriptions (alt text) on photos that carry meaning</li>
      <li>Text and button colors chosen for readable contrast</li>
      <li>A layout that adapts to phone, tablet and desktop screens and to zoom</li>
      <li>Animations that switch off for visitors who ask their device to reduce motion</li>
      <li>Labels connected to every form field</li>
    </ul>

    <h2>Are there known accessibility issues?</h2>
    <p>The embedded Google map on the Contact and Service Area pages is a third-party tool and may not fully meet WCAG. The same information is available by phone at <a href="tel:<?php echo h($phoneRaw); ?>"><?php echo h($phone); ?></a> or by email.</p>

    <h2>How do you report an accessibility problem?</h2>
    <p>If something on this site is hard to use, please tell us what page it is on and what happened. We aim to reply within five business days.</p>

    <h2>Is there another way to reach us?</h2>
    <p>Yes. If the site does not work for you, call or email us. We can share service information in another format on request.</p>

    <h2>How will changes to this statement be shown?</h2>
    <p>We review this statement as the site changes. The "Last Updated" date shows the latest version.</p>

    <h2>How do you contact us about accessibility?</h2>
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
