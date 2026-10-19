<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = '404';
$pageType    = 'other';
http_response_code(404);
$noindex = true;
$pageTitle       = 'Page Not Found | AP Remodeling Handyman List, Elkhart, IN';
$pageDescription = 'That page could not be found. Visit the AP Remodeling Handyman List homepage, services or contact page, or call (219) 296-5827 for a free estimate in Elkhart.';
$canonicalUrl    = $siteUrl . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<style>
.page-hero h1, .page-sec h2 { text-wrap: balance; }
.svc-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 72%, transparent); }
.svc-hero .breadcrumb a:hover { color: var(--color-white); }
.svc-hero .breadcrumb { align-items: center; }
.svc-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.svc-hero .link-call:hover { color: var(--color-white); }
.svc-hero .link-call svg { color: var(--color-white); }
.svc-hero .btn-primary { background: var(--color-accent); border-color: var(--color-accent); color: var(--color-white); }
.svc-hero .btn-primary:hover { background: var(--color-accent-dark); border-color: var(--color-accent-dark); }
.svc-hero .hero-copy { max-width: 40rem; }
.svc-hero .floating-ring { top: -12%; right: -6%; opacity: .1; }
.sec-head h2 { text-wrap: balance; }
.sec-body a { color: var(--color-primary); font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: var(--space-1); }
.cta-close { color: var(--color-white); }
.cta-close .answer-block { background: transparent; color: color-mix(in srgb, var(--color-white) 88%, transparent); max-width: 52ch; }
.cta-close .actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); color: var(--color-white); }
.cta-close .actions .btn-primary:hover { background: var(--color-accent-dark); }
.cta-close .floating-ring { top: -20%; right: -6%; opacity: .09; }
.nf-links .service-links { list-style: none; margin: 0; padding: 0; }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--interior texture-grain svc-hero" aria-label="Page not found">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-copy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="breadcrumb-sep" aria-hidden="true">›</li>
          <li aria-current="page">Page not found</li>
        </ol>
      </nav>
      <span class="eyebrow">Error 404</span>
      <h1 class="hero-title">That page is not here, but the work is</h1>
      <p class="hero-answer">The page you asked for could not be found. It may have moved, or the address may have a typo. The links below lead to the services, the towns served, the contact page and the phone number for AP Remodeling Handyman List in Elkhart.</p>
      <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>or call <?php echo h($phone); ?></a>
        </div>
    </div>
  </div>
</section>

<section class="section sec-body nf-links" aria-label="Where to go next">
  <div class="container-narrow">
    <div class="section-head">
      <span class="eyebrow">Try These Instead</span>
      <h2>Where would you like to go instead?</h2>
      <p class="answer-block">The page you tried to open may have moved or the address may have a typo. The pages below cover everything AP Remodeling Handyman List does in Elkhart: the service list, the company, the towns served, and a way to reach the company by phone or form.</p>
    </div>
    <ul class="service-links">
      <li><a class="service-link-card" href="/">Home</a></li>
      <li><a class="service-link-card" href="/services/">All services</a></li>
      <li><a class="service-link-card" href="/service-area/">Towns we serve</a></li>
      <li><a class="service-link-card" href="/about/">About the company</a></li>
      <li><a class="service-link-card" href="/contact/">Contact and estimates</a></li>
      <li><a class="service-link-card" href="tel:<?php echo h($phoneRaw); ?>">Call <?php echo h($phone); ?></a></li>
    </ul>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
