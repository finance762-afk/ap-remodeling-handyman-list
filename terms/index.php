<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'terms';
$pageType    = 'other';

$pageTitle       = 'Terms of Service | AP Remodeling Handyman List, Elkhart, IN';
$pageDescription = 'Terms of Service for the AP Remodeling Handyman List website and services in Elkhart, IN: estimates, project work, warranties, payment and governing law.';
$canonicalUrl    = $siteUrl . '/terms/';
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
        ['name' => 'Terms of Service', 'url' => '/terms/'],
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
<section class="hero hero--legal texture-grain legal-hero" aria-label="Terms of Service">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <span class="eyebrow">Legal</span>
    <h1 class="hero-title">Terms of Service</h1>
    <p>The terms for using this site and hiring our services.</p>
    <p>Last Updated: <?php echo h($lastUpdated); ?></p>
  </div>
</section>

<nav class="breadcrumb legal-crumb" aria-label="Breadcrumb">
  <div class="container">
    <ol>
      <li><a href="/">Home</a></li>
      <li class="breadcrumb-sep" aria-hidden="true">›</li>
      <li aria-current="page">Terms of Service</li>
    </ol>
  </div>
</nav>

<div class="legal-wrap">
  <div class="container-narrow">
    <article class="legal-prose content-narrow">

    <h2>What are you agreeing to by using this site?</h2>
    <p>By using <?php echo h($domain); ?> or asking <?php echo h($siteName); ?> for an estimate or for work, you agree to these Terms of Service. If you do not agree, please do not use the site or our services.</p>

    <h2>How may you use this website?</h2>
    <p>You may use this site to learn about our services and to contact us. You may not use it for unlawful purposes, try to reach non-public systems, copy its content without written permission, submit false information through a form, or use automated tools to pull data from it.</p>

    <h2>How do estimates and quotes work?</h2>
    <p>Estimates are based on the information you give us and the conditions we can see at the visit. The price can change if the scope changes, hidden damage is found, material costs change before work starts, or code requirements differ from what was assumed. Only a written agreement for the job sets a final price.</p>

    <h2>How is project work handled?</h2>
    <ul>
      <li>Each job is covered by the written estimate or agreement for that job.</li>
      <li>Work is performed in line with the building codes and permit requirements that apply to it.</li>
      <li>Dates depend on weather, material delivery and the condition of the work area, so they are targets unless the agreement says otherwise.</li>
    </ul>

    <h2>What about warranties?</h2>
    <p>Any workmanship warranty is stated in your written estimate or agreement. Manufacturer warranties on materials come from the manufacturer and are honored according to their terms. Warranties do not cover damage from neglect, changes made by others, conditions disclosed before work began, or events beyond the manufacturer's ratings.</p>

    <h2>How does payment work?</h2>
    <p>Payment terms are set out in the written agreement for each job. Past-due balances may carry interest where Indiana law allows it.</p>

    <h2>What happens if you cancel?</h2>
    <p>Cancellation terms are set out in your written agreement. In general, materials already ordered for your job and work already done may still be billed.</p>

    <h2>Is there a limit on liability?</h2>
    <p>To the extent Indiana law allows, the total liability of <?php echo h($siteName); ?> for any claim tied to this site or our services is limited to the amount you paid for the specific service behind the claim. We are not liable for indirect, incidental or consequential damages.</p>

    <h2>Who owns the content on this site?</h2>
    <p>The text, photographs and graphics on this site belong to <?php echo h($siteName); ?> or are used with permission. Please do not reproduce them without written permission.</p>

    <h2>Which law governs these terms?</h2>
    <p>These Terms are governed by the laws of the State of Indiana. Disputes will be heard in the state or federal courts located in Elkhart County, Indiana.</p>

    <h2>How will changes to these terms be shown?</h2>
    <p>We may update these Terms at any time. The "Last Updated" date shows the latest version, and continued use of the site means you accept the update.</p>

    <h2>How do you contact us about these terms?</h2>
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
