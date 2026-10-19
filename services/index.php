<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'services';
$pageType    = 'other';

$pageTitle       = 'Elkhart Handyman & Remodeling Services | AP Remodeling';
$pageDescription = 'Handyman repairs, bathroom and kitchen remodeling, flooring, siding and windows in Elkhart, IN from AP Remodeling Handyman List. Free estimates.';
$canonicalUrl    = $siteUrl . '/services/';
$ogImage         = '/assets/images/og-default-v1.jpg';

$schemaMarkup = [
    [
        '@context'    => 'https://schema.org',
        '@type'       => 'CollectionPage',
        '@id'         => $canonicalUrl . '#webpage',
        'url'         => $canonicalUrl,
        'name'        => $pageTitle,
        'description' => $pageDescription,
        'about'       => ['@id' => rtrim($siteUrl, '/') . '/#organization'],
        'mainEntity'  => [
            '@type' => 'ItemList',
            'itemListElement' => array_map(fn($hubRow, $hubIdx) => [
                '@type' => 'ListItem', 'position' => $hubIdx + 1, 'name' => $hubRow['name'],
                'url' => rtrim($siteUrl, '/') . '/services/' . $hubRow['slug'] . '/',
            ], $services, array_keys($services)),
        ],
    ],
    generateBreadcrumbSchema([
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Services', 'url' => '/services/'],
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
.hub-finder { background: var(--color-surface); }
.hub-finder .service-links { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
.hub-finder .service-link-card { display: flex; gap: var(--space-sm); align-items: center; }
.hub-finder .service-link-card svg { color: var(--color-accent-dark); flex: 0 0 auto; }
.hub-how { background: var(--color-paper); }
.hub-how .split-reverse { align-items: start; }
.hub-how .next-steps { margin-top: var(--space-md); }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--interior texture-grain svc-hero" aria-label="Services introduction">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-copy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="breadcrumb-sep" aria-hidden="true">›</li>
          <li aria-current="page">Services</li>
        </ol>
      </nav>
      <span class="eyebrow">Services · Elkhart, IN</span>
      <h1 class="hero-title">Home repair and remodeling services in Elkhart, Indiana</h1>
      <p class="hero-answer">AP Remodeling Handyman List handles handyman repairs, bathroom and kitchen remodeling, flooring, siding and windows for Elkhart-area homes. The company is owned by Charles Poe, has 30+ years in business, and works in eleven towns across Indiana and Michigan.</p>
      <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>or call <?php echo h($phone); ?></a>
        </div>
    </div>
  </div>
</section>

<!-- ============ SERVICES GRID ============ -->
<section class="section sec-body" id="services" aria-label="All services">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">What We Do</span>
      <h2>Which <span class="text-accent">services</span> does AP Remodeling Handyman List offer in <span class="text-accent">Elkhart</span>?</h2>
      <p class="answer-block">AP Remodeling Handyman List offers handyman repairs, bathroom and kitchen remodeling, flooring installation, and siding and window replacement in Elkhart and nearby towns. The company works in ten more towns across Northern Indiana and Southwest Michigan, and each group below links to a page on what the work includes.</p>
    </div>
    <div class="services-grid">
      <article class="service-card-with-image card-tint-1 reveal-up reveal-delay-1">
        <div class="service-card__image">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002213-480.avif 480w, /assets/images/1000002213-960.avif 960w, /assets/images/1000002213-1600.avif 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px">
            <img src="/assets/images/1000002213-960.webp" srcset="/assets/images/1000002213-480.webp 480w, /assets/images/1000002213-960.webp 960w, /assets/images/1000002213-1600.webp 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px" alt="Bathroom wall with fresh drywall patching beside new tile, ready for primer and paint" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="service-card__body">
          <div class="service-card__icon"><?php echo icon('wrench', 22); ?></div>
          <h3>Handyman Services</h3>
          <p class="service-card__desc">Drywall, paint, doors, TV mounts, shelving, fixtures, and deck and fence fixes.</p>
          <ul>
            <li>Drywall patched, taped and painted</li>
            <li>TV mounts, shelving, furniture assembly</li>
            <li>Deck and fence repairs</li>
          </ul>
          <a href="/services/additional-services/" class="service-card__cta">See Handyman Services</a>
        </div>
      </article>
      <article class="service-card-with-image card-tint-2 reveal-up reveal-delay-2">
        <div class="service-card__image">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002211-480.avif 480w, /assets/images/1000002211-960.avif 960w, /assets/images/1000002211-1600.avif 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px">
            <img src="/assets/images/1000002211-960.webp" srcset="/assets/images/1000002211-480.webp 480w, /assets/images/1000002211-960.webp 960w, /assets/images/1000002211-1600.webp 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px" alt="Tiled shower wall in marble-look porcelain with a small built-in niche above a pebble floor" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="service-card__body">
          <div class="service-card__icon"><?php echo icon('droplets', 22); ?></div>
          <h3>Bathroom &amp; Kitchen Remodeling</h3>
          <p class="service-card__desc">Bathroom and kitchen remodels, from tear-out and tile to fixtures and paint.</p>
          <ul>
            <li>Tiled showers with recessed niches</li>
            <li>Kitchen updates and full remodels</li>
            <li>Drywall and paint after tile</li>
          </ul>
          <a href="/services/remodeling-services/" class="service-card__cta">See Bathroom &amp; Kitchen Remodeling</a>
        </div>
      </article>
      <article class="service-card-with-image card-tint-3 reveal-up reveal-delay-3">
        <div class="service-card__image">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002207-480.avif 480w, /assets/images/1000002207-960.avif 960w, /assets/images/1000002207-1600.avif 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px">
            <img src="/assets/images/1000002207-960.webp" srcset="/assets/images/1000002207-480.webp 480w, /assets/images/1000002207-960.webp 960w, /assets/images/1000002207-1600.webp 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px" alt="Bathroom with a white hexagon mosaic tile floor leading to a tiled shower, walls patched for paint" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="service-card__body">
          <div class="service-card__icon"><?php echo icon('layers', 22); ?></div>
          <h3>Flooring Installation</h3>
          <p class="service-card__desc">New floors for baths, kitchens, bedrooms and living areas.</p>
          <ul>
            <li>Hex mosaic bathroom tile floors</li>
            <li>Bedrooms and living areas</li>
            <li>Baseboard and trim finished</li>
          </ul>
          <a href="/services/flooring-installation/" class="service-card__cta">See Flooring Installation</a>
        </div>
      </article>
      <article class="service-card-with-image card-tint-1 reveal-up reveal-delay-1">
        <div class="service-card__image">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002330-480.avif 480w, /assets/images/1000002330-960.avif 960w, /assets/images/1000002330-1600.avif 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px">
            <img src="/assets/images/1000002330-960.webp" srcset="/assets/images/1000002330-480.webp 480w, /assets/images/1000002330-960.webp 960w, /assets/images/1000002330-1600.webp 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px" alt="Arched window with plantation shutters and a newly finished drywall return, masked for paint" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="service-card__body">
          <div class="service-card__icon"><?php echo icon('home', 22); ?></div>
          <h3>Siding &amp; Window Replacement</h3>
          <p class="service-card__desc">Siding and window replacement for houses in Elkhart and surrounding towns.</p>
          <ul>
            <li>Exterior siding replacement</li>
            <li>Window replacement and trim</li>
            <li>Caulked and weatherproofed openings</li>
          </ul>
          <a href="/services/siding-window-replacement/" class="service-card__cta">See Siding &amp; Window Replacement</a>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ============ JOB FINDER ============ -->
<section class="section edge-curve-top sec-body hub-finder" aria-label="Find your job">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Find Your Job</span>
      <h2>Where do I find the service for my specific job?</h2>
      <p class="answer-block">Every job AP Remodeling takes on has a home. Bathroom and kitchen remodeling sit under Remodeling Services, the handyman list (plus roof repair) sits under Handyman Services, and flooring and siding each have their own page. Pick the closest match below, or call and describe the job.</p>
    </div>
    <div class="service-links reveal-up">
      <a class="service-link-card" href="/services/remodeling-services/#bathroom"><?php echo icon("droplets", 20); ?><span>Bathroom remodeling</span></a>
      <a class="service-link-card" href="/services/remodeling-services/#kitchen"><?php echo icon("hammer", 20); ?><span>Kitchen remodeling</span></a>
      <a class="service-link-card" href="/services/additional-services/#handyman"><?php echo icon("wrench", 20); ?><span>Handyman list: drywall, paint, doors, mounting, decks, fences</span></a>
      <a class="service-link-card" href="/services/additional-services/#roof-repair"><?php echo icon("house", 20); ?><span>Roof repair</span></a>
      <a class="service-link-card" href="/services/flooring-installation/"><?php echo icon("layers", 20); ?><span>Flooring installation</span></a>
      <a class="service-link-card" href="/services/siding-window-replacement/"><?php echo icon("home", 20); ?><span>Siding and window replacement</span></a>
    </div>
  </div>
</section>

<?php
/* Estimate tool: authorized in build-plan.json integrations.estimate_tool. Anchor: /services/#estimate-tool */
if (!empty($estimateTool['authorized'])):
    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/estimate-tool.php';
    echo p1_estimate_tool(['heading' => 'Want an instant estimate range for your job?']);
endif;
?>

<!-- ============ HOW ESTIMATES WORK ============ -->
<section class="section sec-body hub-how" aria-label="How estimates work">
  <div class="container">
    <div class="split-reverse">
      <div class="reveal-left">
        <span class="eyebrow">Free Estimates</span>
        <h2>How do I get an estimate from AP Remodeling Handyman List?</h2>
        <p class="answer-block">Call or send the form, then request a weekday estimate visit in a two-hour window. AP Remodeling Handyman List looks at the job in person, talks through the scope and price, and schedules nothing until you have seen both. The estimate itself is free.</p>
        <ol class="next-steps">
          <li><strong>Tell us the job</strong>Call <?php echo phoneLink(); ?> or send the form with the work you need and the town the house is in.</li>
          <li><strong>Pick an estimate window</strong>Visits run Monday through Friday in two-hour windows from 8 AM to 6 PM. <a href="/contact/#book-visit">Request an estimate visit</a> online.</li>
          <li><strong>See the scope and the price</strong>The work is walked through in person before anything goes on the schedule.</li>
        </ol>
      </div>
      <figure class="page-figure reveal-right">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002111-480.avif 480w, /assets/images/1000002111-960.avif 960w, /assets/images/1000002111-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002111-960.webp" srcset="/assets/images/1000002111-480.webp 480w, /assets/images/1000002111-960.webp 960w, /assets/images/1000002111-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Walk-in shower walls finished in large marble-look porcelain tile with a recessed shelf niche" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
          <figcaption>Walk-in shower in large-format marble-look tile with a recessed niche</figcaption>
        </figure>
    </div>
  </div>
</section>

<section class="cta-banner texture-grain edge-parallelogram-top cta-close" aria-label="Request a free estimate">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate" aria-hidden="true"></span>
  <div class="container">
    <div class="reveal-up">
      <span class="eyebrow">Next step</span>
      <h2>Not sure which service your project falls under?</h2>
      <p class="answer-block">AP Remodeling Handyman List can sort that out in one call. Describe the job to <?php echo phoneLink(); ?> or send the form, and the estimate visit will cover whatever the project turns out to include, from drywall and paint to a full bathroom.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
