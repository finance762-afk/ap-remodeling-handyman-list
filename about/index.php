<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'about';
$pageType    = 'about';

$pageTitle       = 'About AP Remodeling Handyman List | Elkhart, Indiana';
$pageDescription = 'AP Remodeling Handyman List is a small Elkhart, IN company owned by Charles Poe: 30+ years of handyman repairs and remodeling. Call for a free estimate today.';
$canonicalUrl    = $siteUrl . '/about/';
$ogImage         = '/assets/images/og-default-v1.jpg';

$schemaMarkup = [
    [
        '@context'   => 'https://schema.org',
        '@type'      => 'AboutPage',
        '@id'        => $canonicalUrl . '#webpage',
        'url'        => $canonicalUrl,
        'name'       => $pageTitle,
        'about'      => ['@id' => rtrim($siteUrl, '/') . '/#organization'],
        'mainEntity' => ['@id' => rtrim($siteUrl, '/') . '/#organization'],
    ],
    generateBreadcrumbSchema([
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'About', 'url' => '/about/'],
    ]),
];

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
.page-figure { margin: 0; position: relative; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-lg); aspect-ratio: 4 / 5; }
.page-figure img { width: 100%; height: 100%; object-fit: cover; }
.page-figure figcaption { position: absolute; inset: auto 0 0 0; padding: var(--space-xl) var(--space-md) var(--space-sm); background: linear-gradient(to top, color-mix(in srgb, var(--color-dark) 88%, transparent), transparent); color: var(--color-white); font-size: var(--fs-small); }
@media (max-width: 900px) { .page-figure { aspect-ratio: 4 / 3; } }
.about-story .split { align-items: start; }
.about-story .story-copy { display: grid; gap: var(--space-md); }
.about-story .story-copy p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.about-story .story-copy p.answer-block { color: var(--color-ink); }
.about-story .page-figure { clip-path: polygon(0 0, 100% 0, 100% 88%, 86% 100%, 0 100%); }

/* Mid-page estimate band: sized to its content */
.cta-band { color: var(--color-white); padding-block: var(--space-xl); }
.cta-band__inner { display: grid; grid-template-columns: minmax(240px, .85fr) minmax(0, 1.75fr); gap: var(--space-xl); align-items: center; }
.cta-band__copy { display: grid; gap: var(--space-xs); }
.cta-band__copy h2 { font-size: var(--fs-h3); }
.cta-band__copy .answer-block { background: transparent; color: color-mix(in srgb, var(--color-white) 86%, transparent); font-size: var(--fs-small); margin: 0; }
.cta-band__card { background: var(--color-surface); color: var(--color-ink); border-radius: var(--radius-lg); padding: var(--space-lg); box-shadow: var(--shadow-lg); }
.cta-band-form { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-sm); align-items: start; }
.cta-band-form .form-row + .form-row { margin-top: 0; }
.cta-band-form .cta-band-service { grid-column: 1 / 3; }
.cta-band-form .cta-band-submit { grid-column: 3; grid-row: 2; min-height: 46px; margin-top: 0; }
.cta-band-form .cta-band-consent { grid-column: 1 / 3; margin: 0; }
.cta-band-form .cta-band-note { grid-column: 3; margin: 0; }
.cta-band .cta-band-note { color: var(--color-muted); }
.cta-band .consent { color: var(--color-ink-2); }
.cta-band .consent a { color: var(--color-primary); }
@media (min-width: 901px) and (max-width: 1100px) { .cta-band-submit svg { display: none; } .cta-band-submit { font-size: .92rem; } }
@media (max-width: 900px) {
  .cta-band__inner { grid-template-columns: 1fr; }
  .cta-band-form { grid-template-columns: 1fr; }
  .cta-band-form .cta-band-service, .cta-band-form .cta-band-submit, .cta-band-form .cta-band-consent, .cta-band-form .cta-band-note { grid-column: 1; grid-row: auto; }
}

.about-values { background: var(--color-surface); }
.about-values .value-cards { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-md); }
.about-values .card { display: grid; gap: var(--space-xs); align-content: start; box-shadow: none; }
.about-values .card svg { color: var(--color-accent-dark); }
.about-values .card p { margin: 0; color: var(--color-ink-2); font-size: var(--fs-small); }
.about-facts { background: var(--color-paper); }
.about-facts .split-reverse { align-items: start; }
.about-facts .fact-timeline { margin-top: var(--space-lg); }
.about-facts .fact-timeline b { display: block; font-family: var(--font-heading); }
.about-facts .fact-timeline p { margin: 0; color: var(--color-ink-2); }
.about-facts .fact-timeline a { color: var(--color-primary); font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: var(--space-1); }
.about-facts .cred-card { display: grid; gap: var(--space-sm); align-content: start; }
.about-facts .cred-card svg { color: var(--color-accent-dark); }
.about-facts .cred-card h3 { font-size: var(--fs-h3); }
.about-facts .cred-card .answer-block { margin: 0; }
.about-facts .cred-card .btn { justify-self: start; }
@media (max-width: 900px) { .about-values .value-cards { grid-template-columns: 1fr; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--interior texture-grain svc-hero" aria-label="About introduction">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-copy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="breadcrumb-sep" aria-hidden="true">›</li>
          <li aria-current="page">About</li>
        </ol>
      </nav>
      <span class="eyebrow">About the Company</span>
      <h1 class="hero-title">About AP Remodeling Handyman List in Elkhart, Indiana</h1>
      <p class="hero-answer">AP Remodeling Handyman List is a small Elkhart company owned by Charles Poe, in business for 30+ years and open seven days a week, 9 AM to 6 PM. It works in eleven towns across Northern Indiana and Southwest Michigan.</p>
      <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>or call <?php echo h($phone); ?></a>
        </div>
    </div>
  </div>
</section>

<!-- ============ STORY ============ -->
<section class="section sec-body about-story" aria-label="Company story">
  <div class="container">
    <article class="split">
      <div class="story-copy reveal-left">
        <span class="eyebrow">Our Story</span>
        <h2>Who runs <span class="text-accent">AP Remodeling Handyman List</span> in Elkhart?</h2>
        <p class="answer-block">AP Remodeling Handyman List is a small home repair and remodeling company in Elkhart, Indiana, owned by Charles Poe and in business for 30+ years. The company takes jobs from a sticking door to a tiled walk-in shower, across eleven towns in Indiana and Michigan.</p>
        <p>Charles's focus is workmanship you can see once the job is done, and honoring the warranties that come with the products installed in your home. His invitation to a new customer is short: call for a free estimate.</p>
        <p>Most of the photos on this site come from bathroom and interior jobs: shower walls in marble-look tile, a hexagon mosaic floor, drywall patched beside new tile, a sloped-ceiling bedroom with new baseboard, and an arched window return ready for paint. The list also reaches outside the house, with <a href="/services/siding-window-replacement/">siding and windows</a>, roofs, decks and fences on the <a href="/services/additional-services/">handyman and roofing</a> page.</p>
      </div>
      <figure class="page-figure reveal-right">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002111-480.avif 480w, /assets/images/1000002111-960.avif 960w, /assets/images/1000002111-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002111-960.webp" srcset="/assets/images/1000002111-480.webp 480w, /assets/images/1000002111-960.webp 960w, /assets/images/1000002111-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Walk-in shower walls finished in large marble-look porcelain tile with a recessed shelf niche" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
          <figcaption>Walk-in shower in large-format marble-look tile with a recessed niche</figcaption>
        </figure>
    </article>
  </div>
</section>

<!-- ============ MID-PAGE ESTIMATE BAND ============ -->
<section class="cta-band texture-grain" id="estimate" aria-label="Request an estimate">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="cta-band__inner">
      <div class="cta-band__copy">
        <span class="eyebrow">Free estimate</span>
        <h2>Want a free estimate on your project?</h2>
        <p class="answer-block">AP Remodeling Handyman List gives in-person estimates at no charge on handyman work, remodeling, flooring, siding, windows and roofing. Send the short form and the company follows up by phone or email to set a weekday visit. No obligation, and nothing is scheduled until you have seen the price.</p>
      </div>
      <div class="cta-band__card">
        <form action="<?php echo h($formAction); ?>" method="POST" class="hero-form cta-band-form">
          <input type="hidden" name="_next" value="<?php echo h($siteUrl); ?>/thank-you">
          <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
          <input type="hidden" name="form_location" value="cta-band">
          <input type="hidden" name="consent_version" value="v2.1">
          <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
          <?php echo p1_attribution_fields('cta-band'); ?>
          <div class="form-row"><label class="sr-only" for="cta-band-name">Name</label><input id="cta-band-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
          <div class="form-row"><label class="sr-only" for="cta-band-phone">Phone</label><input id="cta-band-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" required></div>
          <div class="form-row"><label class="sr-only" for="cta-band-email">Email</label><input id="cta-band-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
          <div class="form-row cta-band-service"><label class="sr-only" for="cta-band-service">Service</label>
            <select id="cta-band-service" name="service">
              <option value="">What do you need?</option>
<?php foreach ($services as $bandOpt): ?>
              <option value="<?php echo h($bandOpt['name']); ?>"><?php echo h($bandOpt['name']); ?></option>
<?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary cta-band-submit"><?php echo icon('arrow-right', 18); ?>Request my estimate</button>
          <label class="consent cta-band-consent"><input type="checkbox" name="terms_accepted" value="yes" required><span>I agree to the <a href="/terms/" target="_blank" rel="noopener">Terms</a> and <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and consent to be contacted. *</span></label>
          <p class="footnote cta-band-note">No obligation. Estimates are free.</p>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- ============ VALUES ============ -->
<section class="section edge-curve-top sec-body about-values" aria-label="How the company works">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">How We Work</span>
      <h2>What does <span class="text-accent">AP Remodeling Handyman List</span> stand for?</h2>
      <p class="answer-block">AP Remodeling Handyman List works from three habits. It uses one company for small fixes and big remodels, does finish work as carefully as the install, and gives a free in-person estimate before anything is scheduled. Those habits show in the job photos.</p>
    </div>
    <div class="value-cards">
      <div class="card card-tint-1 reveal-up reveal-delay-1"><?php echo icon('wrench', 28); ?><h3>One company, small to large</h3><p>A sticking door and a full bathroom both go to the same phone number, <?php echo phoneLink(); ?>.</p></div>
      <div class="card card-tint-2 reveal-up reveal-delay-2"><?php echo icon('paint-bucket', 28); ?><h3>Finish work counts</h3><p>Drywall is patched and skimmed before paint, openings are masked, and baseboard goes back, as the job photos show.</p></div>
      <div class="card card-tint-3 reveal-up reveal-delay-3"><?php echo icon('clock', 28); ?><h3>Price after the visit</h3><p>Estimates are free and in person. The scope and the price are talked through before any work is scheduled.</p></div>
    </div>
  </div>
</section>

<!-- ============ FACTS ============ -->
<section class="section sec-body about-facts" aria-label="Company facts">
  <div class="container">
    <div class="split-reverse">
      <div class="reveal-left">
        <span class="eyebrow">By the Facts</span>
        <h2>What are the facts about <span class="text-accent">AP Remodeling Handyman List</span>?</h2>
        <p class="answer-block">AP Remodeling Handyman List is based in Elkhart, Indiana, and has been in business for 30+ years. The phone is answered seven days a week from 9 AM to 6 PM, estimate visits are Monday through Friday, and the company works in eleven towns across Indiana and Michigan.</p>
        <ul class="timeline fact-timeline">
          <li><b>30+ years in business</b><p>Owned by Charles Poe and based in Elkhart, Indiana.</p></li>
          <li><b>Eleven towns, two states</b><p>Nine in Indiana and two in Michigan. See the <a href="/service-area/">service area</a> for the full list.</p></li>
          <li><b>Open seven days</b><p><?php echo h($businessHours); ?>.</p></li>
          <li><b>Weekday estimate visits</b><p>Two-hour windows from 8 AM to 6 PM, Monday through Friday. <a href="/contact/#book-visit">Request a visit</a>.</p></li>
        </ul>
      </div>
      <div class="reveal-right">
        <div class="cred-card card">
          <?php echo icon('shield-check', 28); ?>
          <h3>What credentials can AP Remodeling Handyman List show?</h3>
          <p class="answer-block">AP Remodeling Handyman List can be checked through its Google Business Profile, its phone number and its Elkhart base. Contractor license and insurance details are not listed on this site yet, so ask for them at the estimate visit and get them in writing before work starts.</p>
          <a class="btn btn-secondary" href="<?php echo h($gbpUrl); ?>" target="_blank" rel="noopener">View us on Google</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cta-banner texture-grain edge-parallelogram-top cta-close" aria-label="Request a free estimate">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate" aria-hidden="true"></span>
  <div class="container">
    <div class="reveal-up">
      <span class="eyebrow">Next step</span>
      <h2>Ready to talk through your project?</h2>
      <p class="answer-block">AP Remodeling Handyman List is open seven days a week, 9 AM to 6 PM. Call <?php echo phoneLink(); ?> or send the form to start an estimate in Elkhart or the towns around it, and ask for a weekday estimate visit in a two-hour window that suits you.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
