<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'thank-you';
$pageType    = 'other';
$noindex = true;
$pageTitle       = 'Thank You | AP Remodeling Handyman List, Elkhart, IN';
$pageDescription = 'Thanks for contacting AP Remodeling Handyman List in Elkhart, IN. Your request is in and the company will follow up by phone or email about your free estimate.';
$canonicalUrl    = $siteUrl . '/thank-you';
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
.ty-next .split { align-items: start; }
.ty-next .next-steps { margin-top: var(--space-md); }
.ty-next .ty-browse { display: grid; gap: var(--space-md); align-content: start; }
.ty-next .ty-browse .answer-block { margin: 0; }
.ty-next .service-links { list-style: none; margin: 0; padding: 0; grid-template-columns: 1fr 1fr; }
@media (max-width: 560px) { .ty-next .service-links { grid-template-columns: 1fr; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--interior texture-grain svc-hero" aria-label="Thank you">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-copy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="breadcrumb-sep" aria-hidden="true">›</li>
          <li aria-current="page">Thank you</li>
        </ol>
      </nav>
      <span class="eyebrow">Request received</span>
      <h1 class="hero-title">Thank you, your request is in</h1>
      <p class="hero-answer">AP Remodeling Handyman List has your estimate request and will follow up by phone or email. Next you pick a weekday estimate visit in a two-hour window. For anything urgent, call <?php echo phoneLink(); ?> any day between 9 AM and 6 PM.</p>
      
    </div>
  </div>
</section>

<section class="section sec-body ty-next" aria-label="What happens next">
  <div class="container">
    <div class="split">
      <div class="reveal-left">
        <span class="eyebrow">What Happens Next</span>
        <h2>What happens after I send my estimate request?</h2>
        <p class="answer-block">AP Remodeling Handyman List reads each request and follows up by phone or email. From there you pick a weekday estimate visit in a two-hour window, the job is walked through in person, and the scope and price are talked through before any work is scheduled.</p>
        <ol class="next-steps">
          <li><strong>We follow up</strong>Expect a call or email at the contact details you sent.</li>
          <li><strong>You pick a window</strong>Visits run Monday through Friday in two-hour windows between 8 AM and 6 PM.</li>
          <li><strong>You see the scope and price</strong>Nothing is scheduled until you have seen both.</li>
        </ol>
      </div>
      <div class="ty-browse reveal-right">
        <h2>Want to look around while you wait?</h2>
        <p class="answer-block">While you wait, you can browse the services AP Remodeling Handyman List offers, see which towns it covers, or read how the company works. Each page links back to the estimate form if you think of another job to add to your list.</p>
        <ul class="service-links">
          <li><a class="service-link-card" href="/services/">Browse all services</a></li>
          <li><a class="service-link-card" href="/service-area/">See the towns we serve</a></li>
          <li><a class="service-link-card" href="/about/">About AP Remodeling</a></li>
          <li><a class="service-link-card" href="/">Back to the homepage</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
