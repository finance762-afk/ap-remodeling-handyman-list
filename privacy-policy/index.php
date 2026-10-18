<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'privacy-policy';
$pageType    = 'other';

$pageTitle       = 'Privacy Policy | AP Remodeling Handyman List, Elkhart, IN';
$pageDescription = 'How AP Remodeling Handyman List in Elkhart, IN collects, uses and protects your information, including form data, cookies, text messages and your privacy rights.';
$canonicalUrl    = $siteUrl . '/privacy-policy/';
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
        ['name' => 'Privacy Policy', 'url' => '/privacy-policy/'],
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
<section class="hero hero--legal texture-grain legal-hero" aria-label="Privacy Policy">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <span class="eyebrow">Legal</span>
    <h1 class="hero-title">Privacy Policy</h1>
    <p>How we collect, use and protect your information.</p>
    <p>Last Updated: <?php echo h($lastUpdated); ?></p>
  </div>
</section>

<nav class="breadcrumb legal-crumb" aria-label="Breadcrumb">
  <div class="container">
    <ol>
      <li><a href="/">Home</a></li>
      <li class="breadcrumb-sep" aria-hidden="true">›</li>
      <li aria-current="page">Privacy Policy</li>
    </ol>
  </div>
</nav>

<div class="legal-wrap">
  <div class="container-narrow">
    <article class="legal-prose content-narrow">

    <h2>What does this Privacy Policy cover?</h2>
    <p>This Privacy Policy explains how <?php echo h($siteName); ?> ("we", "us", "our") collects, uses and protects personal information when you visit <?php echo h($domain); ?>, call us, or send a request through our forms. <?php echo h($siteName); ?> is a handyman and remodeling company based in Elkhart, Indiana.</p>

    <h2>What information does AP Remodeling Handyman List collect?</h2>
    <ul>
      <li><strong>Information you give us:</strong> your name, phone number, email address, the town or address of the job, the service you want, and the details you type into a form or tell us by phone.</li>
      <li><strong>Consent records:</strong> when you submit a form, we record which consent boxes you checked, the version of the consent text, and the page you submitted from.</li>
      <li><strong>Visit information:</strong> the first page you landed on, the site that referred you, campaign tags in the link you clicked, a random session ID, and your device type. A first-party cookie holds this for 30 days so we can tell which page led to your request.</li>
      <li><strong>Analytics data:</strong> IP address, browser, pages viewed and timestamps, collected through Google Analytics 4 once it is switched on for this site.</li>
      <li><strong>Cookies:</strong> see our <a href="/cookie-policy/">Cookie Policy</a>.</li>
    </ul>

    <h2>How is your information used?</h2>
    <ul>
      <li>To answer your request and schedule an estimate visit.</li>
      <li>To talk with you during a project, by phone, email or text where you have agreed to it.</li>
      <li>To understand which pages of this site bring in requests, and to improve the site.</li>
      <li>To meet legal, tax and record-keeping obligations.</li>
    </ul>

    <h2>Who receives your information?</h2>
    <ul>
      <li>We do <strong>not</strong> sell personal information.</li>
      <li><strong>Page One Insights, LLC</strong> built and hosts this website and operates the form service that receives your submission, stores it, and forwards it to us. It keeps a copy of each submission for lead tracking and consent records.</li>
      <li><strong>Google</strong> provides Google Analytics (when enabled) and the maps shown on our Contact and Service Area pages.</li>
      <li><strong>Subcontractors and material suppliers</strong> receive only what they need to complete your job.</li>
      <li><strong>Authorities and successors:</strong> where the law requires it, or in a sale or transfer of the business.</li>
    </ul>

    <h2>What privacy rights do you have?</h2>
    <h3 id="state-rights">Indiana and Michigan residents</h3>
    <p>You may ask us what personal information we hold about you, ask us to correct it, or ask us to delete it. Contact us using the details at the end of this page.</p>
    <h3 id="ccpa-rights">California residents (CCPA / CPRA) and Do Not Sell or Share</h3>
    <p>If you are a California resident you have the right to know what we collect, to delete it, to correct it, to limit use of sensitive information, and to be free of discrimination for using these rights. We do not sell or share personal information for cross-context behavioral advertising, and you may still send an opt-out request for our records.</p>
    <p><strong>How to use your rights:</strong> email <a href="mailto:<?php echo h($email); ?>"><?php echo h($email); ?></a> or call <a href="tel:<?php echo h($phoneRaw); ?>"><?php echo h($phone); ?></a>. We will confirm when your request has been carried out and respond within 45 days.</p>
    <h3>Residents of other states</h3>
    <p>Residents of Colorado, Connecticut, Texas, Utah, Virginia and other states with privacy laws have similar rights. Use the same contact details to exercise them.</p>

    <h2>How do phone calls and text messages work?</h2>
    <p>If you check the optional text message box on a form, you agree to receive text messages from <?php echo h($siteName); ?> at the number you gave. Message frequency varies, message and data rates may apply, and consent is not a condition of purchase. Reply STOP to unsubscribe or HELP for help. You can also opt out of calls or texts by telling us or emailing <a href="mailto:<?php echo h($email); ?>"><?php echo h($email); ?></a>. We honor any reasonable opt-out request.</p>

    <h2>How long is your information kept?</h2>
    <p>We keep form submissions and job records for as long as needed to respond to you, carry out the work, and meet legal and tax obligations. Consent records are kept for as long as we may need to show that consent was given.</p>

    <h2>How is your information protected?</h2>
    <p>Forms are submitted over an encrypted (HTTPS) connection and stored with a hosted service. No system is completely secure, so we cannot promise absolute security, but we work to limit who can see your information.</p>

    <h2>Does this site collect information from children?</h2>
    <p>This site is not directed to children under 13, and we do not knowingly collect their information. If you believe a child has sent us information, contact us and we will delete it.</p>

    <h2>What about links to other sites?</h2>
    <p>This site links to third-party sites such as our Google Business Profile. We are not responsible for their privacy practices, so please read their policies.</p>

    <h2>How will changes to this policy be shown?</h2>
    <p>We may update this policy from time to time. The "Last Updated" date at the top shows the latest change.</p>

    <h2>How do you contact us about privacy?</h2>
        <p>For privacy questions or to use your rights:</p>
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
