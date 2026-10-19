<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'service-area';
$pageType    = 'other';

$pageTitle       = 'Service Area Near Elkhart, IN | AP Remodeling Handyman List';
$pageDescription = 'AP Remodeling Handyman List serves Elkhart, Mishawaka, South Bend, Osceola, Bristol, Plymouth, Warsaw, Kendallville, Ligonier, Niles and Edwardsburg. Call us.';
$canonicalUrl    = $siteUrl . '/service-area/';
$ogImage         = '/assets/images/og-default-v1.jpg';

$schemaMarkup = [
    [
        '@context'    => 'https://schema.org',
        '@type'       => 'WebPage',
        '@id'         => $canonicalUrl . '#webpage',
        'url'         => $canonicalUrl,
        'name'        => $pageTitle,
        'description' => $pageDescription,
        'about'       => ['@id' => rtrim($siteUrl, '/') . '/#organization'],
    ],
    generateBreadcrumbSchema([
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Service Area', 'url' => '/service-area/'],
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
.area-list { background: var(--color-paper); }
.area-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-md); }
.area-card { border: 1px solid var(--color-line); border-radius: var(--radius-lg); padding: var(--space-lg); display: grid; gap: var(--space-xs); align-content: start; scroll-margin-top: calc(var(--nav-height) + var(--space-lg)); }
.area-card h3 { font-size: var(--fs-h3); }
.area-card .area-county { font-family: var(--font-accent); letter-spacing: .1em; text-transform: uppercase; font-size: var(--fs-eyebrow); color: var(--color-accent-dark); }
.area-card p { margin: 0; color: var(--color-ink-2); font-size: var(--fs-small); }
.area-work { background: var(--color-surface); }
.area-work .split { align-items: start; }
.area-work .service-links { list-style: none; margin: 0; padding: 0; grid-template-columns: 1fr; }
.area-map { background: var(--color-paper-2); }
@media (max-width: 900px) { .area-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 560px) { .area-grid { grid-template-columns: 1fr; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--interior texture-grain svc-hero" aria-label="Service area introduction">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-copy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="breadcrumb-sep" aria-hidden="true">›</li>
          <li aria-current="page">Service Area</li>
        </ol>
      </nav>
      <span class="eyebrow">Service Area · Indiana &amp; Michigan</span>
      <h1 class="hero-title">Handyman and Remodeling Services in Elkhart &amp; Surrounding Communities</h1>
      <p class="hero-answer">AP Remodeling Handyman List works in eleven towns across Northern Indiana and Southwest Michigan, from Elkhart and South Bend to Warsaw, Kendallville and Niles. Call to check a town that is not on the list, or send the form with your town and the job.</p>
      <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>or call <?php echo h($phone); ?></a>
        </div>
    </div>
  </div>
</section>

<!-- ============ TOWNS ============ -->
<section class="section sec-body area-list" aria-label="Towns served">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Where We Work</span>
      <h2>Which towns does <span class="text-accent">AP Remodeling Handyman List</span> serve around Elkhart?</h2>
      <p class="answer-block">AP Remodeling Handyman List serves eleven towns: Elkhart, Mishawaka, South Bend, Osceola, Bristol, Plymouth, Warsaw, Kendallville and Ligonier in Indiana, plus Niles and Edwardsburg in Michigan. Call <?php echo phoneLink(); ?> to check a town that is not listed, or send the form with your town and the job.</p>
    </div>
    <div class="area-grid">
      <article class="area-card card-tint-1 reveal-up reveal-delay-1" id="elkhart">
        <h3>Elkhart, IN</h3>
        <span class="area-county">Elkhart County</span>
        <p>AP Remodeling Handyman List is based here. Elkhart sits where the Elkhart River meets the St. Joseph River.</p>
      </article>
      <article class="area-card card-tint-2 reveal-up reveal-delay-2" id="mishawaka">
        <h3>Mishawaka, IN</h3>
        <span class="area-county">St. Joseph County</span>
        <p>A city on the St. Joseph River, just west of Elkhart.</p>
      </article>
      <article class="area-card card-tint-3 reveal-up reveal-delay-3" id="south-bend">
        <h3>South Bend, IN</h3>
        <span class="area-county">St. Joseph County</span>
        <p>The county seat and home of the University of Notre Dame, west of Elkhart along the St. Joseph River.</p>
      </article>
      <article class="area-card card-tint-1 reveal-up reveal-delay-1" id="osceola">
        <h3>Osceola, IN</h3>
        <span class="area-county">St. Joseph County</span>
        <p>A town in Penn Township between Elkhart and Mishawaka, home to Ferrettie/Baugo Creek County Park.</p>
      </article>
      <article class="area-card card-tint-2 reveal-up reveal-delay-2" id="bristol">
        <h3>Bristol, IN</h3>
        <span class="area-county">Elkhart County</span>
        <p>A town on the St. Joseph River, a short drive northeast of Elkhart.</p>
      </article>
      <article class="area-card card-tint-3 reveal-up reveal-delay-3" id="plymouth">
        <h3>Plymouth, IN</h3>
        <span class="area-county">Marshall County</span>
        <p>The county seat, on the Yellow River, southwest of Elkhart.</p>
      </article>
      <article class="area-card card-tint-1 reveal-up reveal-delay-1" id="warsaw">
        <h3>Warsaw, IN</h3>
        <span class="area-county">Kosciusko County</span>
        <p>The county seat, set among Center Lake and Winona Lake, southeast of Elkhart.</p>
      </article>
      <article class="area-card card-tint-2 reveal-up reveal-delay-2" id="kendallville">
        <h3>Kendallville, IN</h3>
        <span class="area-county">Noble County</span>
        <p>A city at the crossroads of State Road 3 and U.S. 6, about a mile from Bixler Lake, east of Elkhart.</p>
      </article>
      <article class="area-card card-tint-3 reveal-up reveal-delay-3" id="ligonier">
        <h3>Ligonier, IN</h3>
        <span class="area-county">Noble County</span>
        <p>A city in Perry Township, east of Elkhart.</p>
      </article>
      <article class="area-card card-tint-1 reveal-up reveal-delay-1" id="niles">
        <h3>Niles, MI</h3>
        <span class="area-county">Berrien County</span>
        <p>A city on the St. Joseph River in Southwest Michigan, northwest of Elkhart and north of the state line.</p>
      </article>
      <article class="area-card card-tint-2 reveal-up reveal-delay-2" id="edwardsburg">
        <h3>Edwardsburg, MI</h3>
        <span class="area-county">Cass County</span>
        <p>A village in Ontwa Township, Michigan, right on the Indiana state line.</p>
      </article>
    </div>
  </div>
</section>

<!-- ============ WHAT WE DO ============ -->
<section class="section edge-curve-top sec-body area-work" aria-label="Services in every town">
  <div class="container">
    <div class="split">
      <div class="reveal-left">
        <span class="eyebrow">What We Do</span>
        <h2>What does AP Remodeling Handyman List do in each town?</h2>
        <p class="answer-block">In every town on the list, AP Remodeling Handyman List does the same range of work: handyman repairs, bathroom and kitchen remodeling, flooring, and siding and windows. Estimates are free, and visits are scheduled Monday through Friday in two-hour windows.</p>
        <p>The <a href="/services/">full services list</a> explains each group of work. <a href="/contact/#book-visit">Request an estimate visit</a> and name your town so the visit can be planned around it.</p>
      </div>
      <ul class="service-links reveal-right">
        <li><a class="service-link-card" href="/services/additional-services/">Handyman services</a></li>
        <li><a class="service-link-card" href="/services/remodeling-services/">Bathroom and kitchen remodeling</a></li>
        <li><a class="service-link-card" href="/services/flooring-installation/">Flooring installation</a></li>
        <li><a class="service-link-card" href="/services/siding-window-replacement/">Siding and window replacement</a></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ MAP ============ -->
<section class="section sec-body area-map" aria-label="Map">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Map</span>
      <h2>Where is AP Remodeling Handyman List based?</h2>
      <p class="answer-block">AP Remodeling Handyman List is based in Elkhart, Indiana, in the St. Joseph River valley, within a short drive of Mishawaka, South Bend, Osceola and Bristol. Warsaw, Kendallville and Plymouth are farther out, and Niles and Edwardsburg sit just across the state line in Michigan.</p>
    </div>
    <div class="map-embed reveal-scale">
      <iframe src="<?php echo h($gbpMapEmbedSrc); ?>" title="Map of the Elkhart, Indiana area served by AP Remodeling Handyman List" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

<section class="cta-banner texture-grain edge-parallelogram-top cta-close" aria-label="Request a free estimate">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate" aria-hidden="true"></span>
  <div class="container">
    <div class="reveal-up">
      <span class="eyebrow">Next step</span>
      <h2>Is your town on the list?</h2>
      <p class="answer-block">AP Remodeling Handyman List works in eleven towns across Indiana and Michigan and will tell you plainly if a job is out of range. Call <?php echo phoneLink(); ?> or send the form with your town, and ask for a free estimate visit on a weekday.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
