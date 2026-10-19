<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ------------------------------------------------------------------ *
 * Homepage — AP Remodeling Handyman List (Phase 3, 2026-10-18)
 * Archetype: warm-human · Tier: basic · Script: photo-led (8 manifest photos)
 * Every fact traces to build-plan.json / config.php. Facts the page wanted but
 * intake did not supply are listed in /content-confirmations.json, not invented.
 * ------------------------------------------------------------------ */

$currentPage = 'home';
$pageType    = 'home';

$pageTitle       = 'Elkhart Handyman & Remodeling | AP Remodeling Handyman List';
$pageDescription = 'Handyman repairs, kitchen and bath remodeling, flooring, siding, and windows in Elkhart, IN from AP Remodeling Handyman List. Call for a free estimate.';
$canonicalUrl    = $siteUrl . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';

/* Hero photo (manifest): tiled walk-in shower. All manifest photos are 3:4 portrait. */
$heroImg = '1000002111';
$heroPreload = [
    'srcset' => '/assets/images/' . $heroImg . '-480.avif 480w, /assets/images/' . $heroImg . '-960.avif 960w, /assets/images/' . $heroImg . '-1600.avif 1600w',
    'sizes'  => '(max-width: 900px) 100vw, 55vw',
];
$heroPreloadImage = '/assets/images/' . $heroImg . '-960.webp';

/* Booking + estimate-tool links are authorized in build-plan.json; they render only once their target page exists. */
$homeBookLink     = !empty($bookingWindows['authorized']) && pageBuilt('/contact/');
$homeEstimateTool = !empty($estimateTool['authorized']) && pageBuilt('/services/');
$homeServicesHub  = pageBuilt('/services/');

/* FAQs — built from intake facts only (question set from research_brief; see content-confirmations.json). */
$faqs = [
    [
        'q' => 'Do you offer free estimates?',
        'a' => 'Yes. AP Remodeling Handyman List does not charge to look at a job and price it. Estimate visits are scheduled on weekdays, Monday through Friday, at a time you pick. Call ' . $phone . ' or send the estimate form to set one up.',
    ],
    [
        'q' => 'What kinds of jobs do you take on?',
        'a' => 'AP Remodeling Handyman List handles handyman repairs (drywall, interior and exterior painting, doors, TV mounting, shelving, furniture assembly, fixtures, caulking and weatherproofing, deck and fence repair), bathroom and kitchen remodeling, flooring installation, and siding and window replacement.',
    ],
    [
        'q' => 'Which towns do you serve?',
        'a' => 'AP Remodeling Handyman List is based in Elkhart and works in Mishawaka, South Bend, Osceola, Bristol, Plymouth, Warsaw, Kendallville and Ligonier in Indiana, plus Niles and Edwardsburg in Michigan. If your town is not on the list, call and ask.',
    ],
    [
        'q' => 'How is a job priced?',
        'a' => 'Each job is priced after the estimate visit, once the scope and the materials are known. There is no charge for the estimate itself, and you decide whether to go ahead.',
    ],
    [
        'q' => 'Are you open on weekends?',
        'a' => 'Yes. AP Remodeling Handyman List is open seven days a week, Monday through Sunday, 9 AM to 6 PM. Estimate visits are booked on weekdays.',
    ],
    [
        'q' => 'Can one company handle the tile, drywall and paint on a bathroom remodel?',
        'a' => 'Yes. Bathroom remodeling and the handyman trades are both on the AP Remodeling list, so the tile, the drywall patching and the painting around a new shower are handled by the same company instead of three separate contractors.',
    ],
];

$schemaMarkup = [generateFAQSchema($faqs)];

/* Service cards — one per service page (config.php $services). Photos from the manifest. */
$homeServices = [
    [
        'slug' => 'additional-services', 'name' => 'Handyman Services', 'icon' => 'wrench',
        'img'  => '1000002213',
        'alt'  => 'Bathroom wall with fresh drywall patching around new tile, ready for primer and paint',
        'desc' => 'Drywall, paint, doors, TV mounts, shelving, fixtures, and deck and fence fixes.',
        'bullets' => ['Drywall patched, taped and painted', 'TV mounts, shelving, furniture assembly', 'Deck and fence repairs'],
    ],
    [
        'slug' => 'remodeling-services', 'name' => 'Bathroom & Kitchen Remodeling', 'icon' => 'droplets',
        'img'  => '1000002211',
        'alt'  => 'Shower wall tiled in marble-look porcelain with a small built-in niche above a pebble floor',
        'desc' => 'Bathroom and kitchen remodels, from tear-out and tile to fixtures and paint.',
        'bullets' => ['Tiled showers with recessed niches', 'Kitchen updates and full remodels', 'Drywall and paint after tile'],
    ],
    [
        'slug' => 'flooring-installation', 'name' => 'Flooring Installation', 'icon' => 'layers',
        'img'  => '1000002207',
        'alt'  => 'Bathroom floor in white hexagon mosaic tile leading to a tiled walk-in shower',
        'desc' => 'New floors for baths, kitchens, bedrooms and living areas.',
        'bullets' => ['Hex mosaic bathroom tile floors', 'Bedrooms and living areas', 'Baseboard and trim finished'],
    ],
    [
        'slug' => 'siding-window-replacement', 'name' => 'Siding & Window Replacement', 'icon' => 'home',
        'img'  => '1000002330',
        'alt'  => 'Arched window with plantation shutters and a newly finished drywall return, masked for paint',
        'desc' => 'Siding and window replacement for houses in Elkhart and surrounding towns.',
        'bullets' => ['Exterior siding replacement', 'Window replacement and trim', 'Caulked and weatherproofed openings'],
    ],
];

/* Recent-work gallery — all 8 manifest photos; captions say only what the photo shows. */
$galleryItems = [
    ['img' => '1000002111', 'tag' => 'Bathroom Remodeling', 'wide' => false,
     'alt' => 'Walk-in shower walls finished in large marble-look porcelain tile with a recessed shelf niche',
     'cap' => 'Walk-in shower in large-format marble-look tile with a recessed niche'],
    ['img' => '1000002213', 'tag' => 'Drywall Repair', 'wide' => false,
     'alt' => 'Bathroom wall with fresh drywall patching beside new tile, ready for primer and paint',
     'cap' => 'Drywall patched and skimmed beside new tile, ready for paint'],
    ['img' => '1000002319', 'tag' => 'Painting', 'wide' => true,
     'alt' => 'Bedroom under a sloped ceiling with fresh paint, new white baseboard and bare subfloor ready for new flooring',
     'cap' => 'Sloped-ceiling bedroom painted, new baseboard in, subfloor ready for flooring'],
    ['img' => '1000002210', 'tag' => 'Bathroom Remodeling', 'wide' => false,
     'alt' => 'Shower corner tiled in marble-look porcelain with a long recessed niche and pebble floor',
     'cap' => 'Shower corner with a full-width tiled niche and pebble floor'],
    ['img' => '1000002330', 'tag' => 'Window Trim', 'wide' => false,
     'alt' => 'Arched window with plantation shutters and a newly finished drywall return, masked for paint',
     'cap' => 'Arched window return finished in drywall and masked for paint'],
    ['img' => '1000002207', 'tag' => 'Tile Flooring', 'wide' => true,
     'alt' => 'Bathroom with a white hexagon mosaic tile floor leading to a tiled shower, walls patched for paint',
     'cap' => 'Hex mosaic tile floor leading into the new shower'],
    ['img' => '1000002211', 'tag' => 'Bathroom Remodeling', 'wide' => false,
     'alt' => 'Tiled shower wall in marble-look porcelain with a small built-in niche above a pebble floor',
     'cap' => 'Shower back wall with a small soap niche set into the tile'],
    ['img' => '1000002321', 'tag' => 'Flooring Prep', 'wide' => false,
     'alt' => 'Room with double doors, new baseboard and exposed subfloor, tools set out for the flooring install',
     'cap' => 'Room taken down to subfloor with tools set out for the new floor'],
];

/* Ticker — the handyman list from intake, verbatim services. */
$tickerItems = [
    ['wrench', 'Drywall repair'], ['paint-bucket', 'Interior & exterior painting'], ['home', 'Door installation & repair'],
    ['ruler', 'TV mounting'], ['hammer', 'Shelving installation'], ['wrench', 'Furniture assembly'],
    ['droplets', 'Fixture replacement'], ['shield-check', 'Caulking & weatherproofing'], ['fence', 'Deck & fence repair'],
];

/* Proof strip — four facts straight from intake/config. */
$proofItems = [
    ['Charles <span>Poe</span>', 'Owner, AP Remodeling'],
    [count($serviceAreas) . ' <span>Towns</span>', 'Across Indiana &amp; Michigan'],
    ['2-Hour <span>Windows</span>', 'Weekday estimate visits'],
    [count(array_merge(...array_column($services, 'includes'))) . ' <span>Trades</span>', 'Handyman to remodeling, one number'],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<style>
/* ===== Homepage composition (tokens only — framework.css carries the components) ===== */

/* Hero: photo bleeds right, compact form floats over it */
.home-hero h1, .home-about h2, .home-cta h2, .home-faq h2, .home-estimate h2 { text-wrap: balance; }
.home-hero .hero-visual__img picture,
.home-hero .hero-visual__img img { height: 100%; }
.home-hero .hero-visual__img img { object-position: 50% 60%; }
.home-hero .hero-visual__img::after {
  content: ""; position: absolute; inset: 0; pointer-events: none;
  background: linear-gradient(200deg, transparent 55%, color-mix(in srgb, var(--color-dark) 38%, transparent) 100%);
}
.home-hero .hero-form-card { gap: var(--space-xs); }
.home-hero .hero-form-card .consent a { color: var(--color-primary); }
.home-hero .hero-book {
  font-weight: 600; color: var(--color-primary);
  text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: var(--space-1);
}
.home-hero .floating-ring { top: -10%; left: -8%; }

/* Proof strip: dark band with grain (scaffold paints .stats-band light — this page wants it dark) */
.home-proof {
  background: linear-gradient(115deg, var(--color-dark) 0%, var(--color-dark-alt) 55%, var(--color-primary-deep) 130%);
  color: var(--color-white); border-block: 0;
}
.home-proof .stat-item { border-left-color: color-mix(in srgb, var(--color-white) 14%, transparent); }
.home-proof .stat-number { color: var(--color-white); }
.home-proof .stat-number span { color: var(--color-accent-bright); }
.home-proof .stat-label { color: color-mix(in srgb, var(--color-white) 74%, transparent); }

/* Gallery: head row aligned to the container, track bleeds to the viewport edge */
.gallery-section { background: var(--color-paper); }
.gallery-head {
  display: grid; grid-template-columns: minmax(0, 1fr) auto; align-items: end;
  gap: var(--space-lg); margin-bottom: var(--space-xl);
}
.gallery-head .section-head { margin-bottom: 0; }
.gallery-section .gallery-track {
  padding-inline: max(var(--space-md), calc((100vw - var(--max-width)) / 2 + var(--space-xl)));
  scroll-padding-inline: max(var(--space-md), calc((100vw - var(--max-width)) / 2 + var(--space-xl)));
}
.gallery-section .gallery-item { box-shadow: var(--shadow); }
.gallery-section .gallery-item--wide img { object-position: 50% 62%; }
.gallery-foot { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: var(--space-md); margin-top: var(--space-lg); }
.gallery-section .floating-ring:first-of-type { top: var(--space-2xl); right: -6%; }
.gallery-section .floating-ring:last-of-type { bottom: -12%; left: 4%; border-color: var(--color-primary); }

/* Ticker */
.home-ticker .ticker-track svg { color: var(--color-accent-dark); }

/* Services */
.home-services { background: var(--color-surface); }
.home-services .section-title { max-width: 70ch; }
.home-services .section-title .hero-answer { max-width: var(--measure); }
.home-services .section-title .prose a { color: var(--color-primary); font-weight: 600; }
.home-services .service-card__cta { border: 0; background: none; padding: var(--space-xs) 0 0; font: inherit; font-weight: 600; cursor: pointer; text-align: left; }
.home-services .services-foot { display: flex; flex-wrap: wrap; gap: var(--space-md); align-items: center; margin-top: var(--space-xl); }

/* About: asymmetric 60/40, photo column dropped and outlined, clipped corner */
.home-about { background: var(--color-paper); }
.home-about .about-split { grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr); align-items: start; }
.home-about .about-split, .home-estimate .estimate { max-width: calc(var(--max-width) + var(--space-4xl)); margin-inline: auto; }
.home-about .about-left { display: grid; gap: var(--space-md); }
.home-about .about-left > p { margin: 0; color: var(--color-ink-2); max-width: var(--measure); }
.home-about .about-left h3 { margin-top: var(--space-lg); }
.home-about .about-right { margin-top: var(--space-4xl); }
.home-about .about-image-primary {
  aspect-ratio: 3 / 4;
  clip-path: polygon(0 0, 100% 0, 100% 86%, 84% 100%, 0 100%);
}
.home-about .about-image-primary img { width: 100%; height: 100%; object-fit: cover; }
.home-about .about-stat-card { display: grid; gap: var(--space-1); min-width: 11rem; }
.home-about .about-stat-card b { font-family: var(--font-accent); font-size: var(--fs-h2); line-height: 1; color: var(--color-accent-dark); }
.home-about .about-stat-card span { font-size: var(--fs-small); color: var(--color-muted); }
.home-about .process-steps { margin-top: var(--space-xs); }

/* Mid-page band: dark, grain, parallelogram edge */
.home-cta { color: var(--color-white); }
.home-cta .actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); color: var(--color-white); }
.home-cta .actions .btn-primary:hover { background: var(--color-accent-dark); }
.home-cta .floating-ring { top: -20%; right: -6%; opacity: .09; }

/* Reviews (feed-driven; renders only when Google reviews exist) */
.home-reviews { background: var(--color-paper-2); }

/* FAQ */
.home-faq { background: var(--color-surface); }
.home-faq .faq-grid { align-items: start; }
.home-faq .faq-col { display: grid; }

/* Estimate: form card + what-happens-next column */
.home-estimate { background: var(--color-paper-2); }
.home-estimate .card { display: grid; gap: var(--space-sm); }
.home-estimate .card h2 { margin-bottom: var(--space-xs); }
.home-estimate .estimate-aside { display: grid; gap: var(--space-sm); padding-top: var(--space-md); }
.home-estimate .estimate-aside h3 { font-size: var(--fs-h3); }
.home-estimate .nap a:hover { color: var(--color-primary); text-decoration: underline; }
.home-estimate .area-line { font-size: var(--fs-small); color: var(--color-muted); margin: var(--space-md) 0 0; }
.home-estimate .estimate-form .btn { margin-top: var(--space-xs); }

@media (max-width: 900px) {
  .gallery-head { grid-template-columns: 1fr; }
  .home-about .about-split { grid-template-columns: 1fr; }
  .home-about .about-right { margin-top: var(--space-lg); }
}
@media (max-width: 560px) {
  .home-hero .hero-book { display: none; }
  .gallery-foot .btn { width: 100%; }
}
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--light home-hero" aria-label="Introduction">
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid hero-grid--visual">

      <div class="hero-text">
        <span class="eyebrow">Elkhart, IN · Northern Indiana &amp; Southwest Michigan</span>
        <h1 class="hero-title">Elkhart handyman repairs and remodels</h1>
        <p class="hero-answer">AP Remodeling Handyman List does drywall, doors, tile baths, floors and siding for homes in Elkhart and nearby towns. The company is owned by Charles Poe, has 30+ years in business, and prices every job after a free in-person estimate visit.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>or call <?php echo h($phone); ?></a>
<?php if ($homeBookLink): ?>
          <a class="hero-book" href="/contact/#book-visit">Request an estimate visit</a>
<?php endif; ?>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('check-circle', 16); ?>Free estimates</li>
          <li><?php echo icon('clock', 16); ?>Open 7 days, 9–6</li>
          <li><?php echo icon('hammer', 16); ?>Small repairs to full remodels</li>
        </ul>
      </div>

      <div class="hero-visual">
        <div class="hero-visual__img">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002111-480.avif 480w, /assets/images/1000002111-960.avif 960w, /assets/images/1000002111-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 55vw">
            <img src="/assets/images/1000002111-960.webp" srcset="/assets/images/1000002111-480.webp 480w, /assets/images/1000002111-960.webp 960w, /assets/images/1000002111-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 55vw" alt="Walk-in shower by AP Remodeling Handyman List, walls in large marble-look porcelain tile with a recessed shelf niche" width="960" height="1280" loading="eager" fetchpriority="high">
          </picture>
        </div>
        <div class="photo-stack__tag"><b>Recent work</b><span>Tiled walk-in shower with recessed niche</span></div>

        <aside class="hero-form-card" id="estimate-form">
          <h2>Ready for a free estimate?</h2>
          <p class="hero-form-tagline">No obligation. Tell us what needs doing.</p>
          <form action="<?php echo h($formAction); ?>" method="POST" class="hero-form">
            <input type="hidden" name="_next" value="<?= htmlspecialchars($siteUrl) ?>/thank-you">
            <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
            <input type="hidden" name="form_location" value="hero">
            <input type="hidden" name="consent_version" value="v2.1">
            <input type="hidden" name="consent_page" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
            <?php echo p1_attribution_fields('hero'); ?>
            <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
            <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" required></div>
            <div class="form-row"><label class="sr-only" for="hero-email">Email</label><input id="hero-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
            <div class="form-row"><label class="sr-only" for="hero-service">Service</label>
              <select id="hero-service" name="service">
                <option value="">What do you need?</option>
<?php foreach ($services as $heroOpt): ?>
                <option value="<?php echo h($heroOpt['name']); ?>"><?php echo h($heroOpt['name']); ?></option>
<?php endforeach; ?>
              </select>
            </div>
            <label class="consent"><input type="checkbox" name="terms_accepted" value="yes" required><span>I agree to the <a href="/terms/" target="_blank" rel="noopener">Terms</a> and <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and consent to be contacted. *</span></label>
            <button type="submit" class="btn btn-primary btn-block">Request my estimate</button>
          </form>
        </aside>
      </div>

    </div>
  </div>
</section>

<!-- ============ PROOF STRIP ============ -->
<section class="stats-band texture-grain slant-top home-proof" aria-label="AP Remodeling at a glance">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="stats-row">
<?php foreach ($proofItems as $proofIdx => $proofItem): ?>
      <div class="stat-item reveal-up reveal-delay-<?php echo $proofIdx + 1; ?>">
        <b class="stat-number"><?php echo $proofItem[0]; ?></b>
        <span class="stat-label"><?php echo $proofItem[1]; ?></span>
      </div>
<?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ RECENT WORK GALLERY ============ -->
<section class="section gallery-section" aria-label="Recent projects">
  <span class="floating-ring float-animate" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="gallery-head reveal-left">
      <div class="section-head">
        <span class="eyebrow">Recent Work</span>
        <h2>What do recent <span class="text-accent">AP Remodeling</span> jobs look like in tile, drywall and paint?</h2>
        <p class="answer-block">Recent AP Remodeling Handyman List jobs include shower tile, a mosaic floor, patched drywall and a painted bedroom. The photos below were taken on the job: recessed niches, a hexagon mosaic bathroom floor, an arched window return ready for paint and a room taken down to subfloor.</p>
      </div>
      <p class="gallery-hint"><?php echo icon('arrow-right', 18); ?>Scroll for more</p>
    </div>
  </div>
  <div class="gallery-track" data-p1-dynamic tabindex="0" aria-label="Project photos — scroll horizontally">
<?php foreach ($galleryItems as $gal): ?>
    <figure class="gallery-item<?php echo $gal['wide'] ? ' gallery-item--wide' : ''; ?>">
      <picture>
        <source type="image/avif" srcset="/assets/images/<?php echo $gal['img']; ?>-480.avif 480w, /assets/images/<?php echo $gal['img']; ?>-960.avif 960w, /assets/images/<?php echo $gal['img']; ?>-1600.avif 1600w" sizes="(max-width: 600px) 80vw, <?php echo $gal['wide'] ? '480px' : '320px'; ?>">
        <img src="/assets/images/<?php echo $gal['img']; ?>-960.webp" srcset="/assets/images/<?php echo $gal['img']; ?>-480.webp 480w, /assets/images/<?php echo $gal['img']; ?>-960.webp 960w, /assets/images/<?php echo $gal['img']; ?>-1600.webp 1600w" sizes="(max-width: 600px) 80vw, <?php echo $gal['wide'] ? '480px' : '320px'; ?>" alt="<?php echo h($gal['alt']); ?>" width="960" height="1280" loading="lazy" decoding="async">
      </picture>
      <figcaption><span class="gallery-item__tag"><?php echo h($gal['tag']); ?></span><span class="gallery-item__cap"><?php echo h($gal['cap']); ?></span></figcaption>
    </figure>
<?php endforeach; ?>
  </div>
  <div class="container">
    <div class="gallery-foot">
      <p class="gallery-hint">Bathroom remodeling, drywall repair, painting and flooring prep.</p>
<?php if ($homeServicesHub): ?>
      <a class="btn btn-secondary" href="/services/">See all services</a>
<?php else: ?>
      <a class="btn btn-secondary" href="#services">See all services</a>
<?php endif; ?>
    </div>
  </div>
</section>

<!-- ============ TICKER ============ -->
<div class="ticker-strip home-ticker" aria-hidden="true">
  <div class="ticker-track">
<?php for ($tickPass = 0; $tickPass < 2; $tickPass++): foreach ($tickerItems as $tick): ?>
    <span><?php echo icon($tick[0], 18); ?><?php echo h($tick[1]); ?></span>
<?php endforeach; endfor; ?>
  </div>
</div>

<!-- ============ SERVICES ============ -->
<section class="section edge-curve-top home-services" id="services" aria-label="Handyman and remodeling services">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">What We Do</span>
      <h2>Which home repairs and <span class="text-accent">remodeling</span> jobs does AP Remodeling take on in <span class="text-accent">Elkhart</span>?</h2>
      <p class="hero-answer">AP Remodeling Handyman List takes on handyman repairs, bathroom and kitchen remodeling, flooring installation, and siding and window replacement for homes in and around Elkhart. The handyman list covers drywall, painting, doors, TV mounting, shelving, furniture assembly, fixtures, caulking, deck and fence repair.</p>
      <span class="section-subtitle">From a sticking door to a new bathroom</span>
<?php if ($homeEstimateTool): ?>
      <p class="prose">Wondering what a job like yours usually runs? <a href="/services/#estimate-tool">See a typical price range</a> before you call.</p>
<?php else: ?>
      <p class="prose">Pick the card closest to your project to see what that work includes, or ask about a job that falls between two of them.</p>
<?php endif; ?>
    </div>

    <div class="services-grid">
<?php foreach ($homeServices as $svcIdx => $svc): $svcTint = ($svcIdx % 3) + 1; ?>
      <article class="service-card-with-image card-tint-<?php echo $svcTint; ?> reveal-up reveal-delay-<?php echo $svcTint; ?>">
        <div class="service-card__image">
          <picture>
            <source type="image/avif" srcset="/assets/images/<?php echo $svc['img']; ?>-480.avif 480w, /assets/images/<?php echo $svc['img']; ?>-960.avif 960w, /assets/images/<?php echo $svc['img']; ?>-1600.avif 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px">
            <img src="/assets/images/<?php echo $svc['img']; ?>-960.webp" srcset="/assets/images/<?php echo $svc['img']; ?>-480.webp 480w, /assets/images/<?php echo $svc['img']; ?>-960.webp 960w, /assets/images/<?php echo $svc['img']; ?>-1600.webp 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px" alt="<?php echo h($svc['alt']); ?>" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="service-card__body">
          <div class="service-card__icon"><?php echo icon($svc['icon'], 22); ?></div>
          <h3><?php echo h($svc['name']); ?></h3>
          <p class="service-card__desc"><?php echo h($svc['desc']); ?></p>
          <ul>
<?php foreach ($svc['bullets'] as $svcBullet): ?>
            <li><?php echo h($svcBullet); ?></li>
<?php endforeach; ?>
          </ul>
<?php if (pageBuilt('/services/' . $svc['slug'] . '/')): ?>
          <a href="/services/<?php echo h($svc['slug']); ?>/" class="service-card__cta">See <?php echo h($svc['name']); ?></a>
<?php else: ?>
          <button type="button" class="service-card__cta" data-open-estimate>Ask about this job</button>
<?php endif; ?>
        </div>
      </article>
<?php endforeach; ?>
    </div>

    <div class="services-foot">
<?php if ($homeServicesHub): ?>
      <a class="btn btn-primary" href="/services/">View All Services</a>
<?php endif; ?>
      <button type="button" class="btn btn-secondary" data-open-estimate>Ask about your project</button>
      <a class="link-call" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?><?php echo h($phone); ?></a>
    </div>
  </div>
</section>

<!-- ============ ABOUT + PROCESS (asymmetric) ============ -->
<section class="section home-about" aria-label="About AP Remodeling Handyman List">
  <div class="container-wide">
    <div class="about-split">

      <div class="about-left reveal-left">
        <span class="eyebrow">About the Company</span>
        <h2>Who is <span class="text-accent">AP Remodeling</span> Handyman List?</h2>
        <p>AP Remodeling Handyman List is a small home repair and remodeling company in Elkhart, Indiana, owned by Charles Poe. The same company takes a call about a cracked drywall seam or a sticking door and a call about a full bathroom with a tiled walk-in shower, and it works on houses from South Bend and Mishawaka down to Warsaw, east to Kendallville and north to Niles and Edwardsburg, Michigan.</p>
        <p>Charles's focus is careful workmanship and honoring the product warranties on the materials that go into your home. Most of the photos on this page come from bathroom and bedroom jobs: walls patched and skimmed before paint, rooms taken down to subfloor before new flooring, and large-format tile set around recessed shower niches.</p>

        <h3>How a remodel moves along</h3>
        <ol class="process-steps">
          <li><b>Repair what's behind the finish</b><span>Damaged drywall is cut out, patched and skimmed so the new surface starts flat.</span></li>
          <li><b>Prep the room</b><span>Old flooring comes up to the subfloor, and windows and trim are masked before paint.</span></li>
          <li><b>Install</b><span>Tile walls, recessed niches, mosaic floors, fixtures and new flooring go in.</span></li>
          <li><b>Finish</b><span>Walls and trim are painted and baseboard goes back so the room is ready to use.</span></li>
        </ol>
      </div>

      <div class="about-right about-image reveal-right">
        <div class="about-image-primary img-clipped">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002210-480.avif 480w, /assets/images/1000002210-960.avif 960w, /assets/images/1000002210-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002210-960.webp" srcset="/assets/images/1000002210-480.webp 480w, /assets/images/1000002210-960.webp 960w, /assets/images/1000002210-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Shower corner tiled in marble-look porcelain with a long recessed niche and pebble floor" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="about-stat-card"><b class="tabular"><?php echo h($yearsLabel); ?> years</b><span>in business</span></div>
      </div>

    </div>
  </div>
</section>

<!-- ============ MID-PAGE BAND ============ -->
<section class="cta-banner texture-grain edge-parallelogram-top home-cta" aria-label="Small repairs before they grow">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate" aria-hidden="true"></span>
  <div class="container">
    <div class="reveal-up">
      <span class="eyebrow">Small leaks, big repairs</span>
      <h2>Can failed caulk and loose tile let water into the wall?</h2>
      <p>A gap around a tub or a cracked grout line looks minor, but water that gets behind it soaks drywall and subfloor. Re-caulking or re-setting a few tiles now costs far less than tearing out a soft wall or floor later.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>

<!-- ============ GOOGLE REVIEWS (Page One feed; '' until the profile has written reviews) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$homeReviews = p1_google_reviews($slug, ['heading' => 'What Elkhart customers say on Google']);
if ($homeReviews !== ''): ?>
<section class="section home-reviews" aria-label="Google reviews"><div class="container-narrow"><?php echo $homeReviews; ?></div></section>
<?php endif; ?>

<!-- ============ FAQ ============ -->
<section class="section home-faq" aria-label="Frequently asked questions">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2>What do Elkhart homeowners ask <span class="text-accent">before they call</span>?</h2>
      <p>Elkhart homeowners usually call AP Remodeling Handyman List with the same handful of questions: whether the estimate costs anything, which jobs are on the list, which towns are covered, how a job is priced and when someone answers the phone.</p>
    </div>
    <div class="faq-grid">
<?php foreach (array_chunk($faqs, (int) ceil(count($faqs) / 2)) as $faqColIdx => $faqCol): ?>
      <div class="faq-col <?php echo $faqColIdx === 0 ? 'reveal-left' : 'reveal-right'; ?>">
<?php foreach ($faqCol as $faqIdx => $faq): ?>
        <details class="faq"<?php echo $faqIdx === 0 ? ' open' : ''; ?>>
          <summary><?php echo h($faq['q']); ?></summary>
          <p><?php echo linkContact(h($faq['a'])); ?></p>
        </details>
<?php endforeach; ?>
      </div>
<?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ ESTIMATE SECTION ============ -->
<section class="section home-estimate" id="estimate" aria-label="Request an estimate">
  <div class="container-wide">
    <div class="estimate">

      <div class="card reveal-left">
        <span class="eyebrow">Estimate Request</span>
        <h2>What should I tell AP Remodeling about the job?</h2>
        <p class="answer-block">Tell AP Remodeling Handyman List what needs fixing or remodeling, the town the house is in, and how to reach you. A phone number and email let the company follow up, and the project details help the estimate visit start with the right questions.</p>
        <form action="<?php echo h($formAction); ?>" method="POST" class="estimate-form">
          <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
          <input type="hidden" name="_next" value="<?php echo h($siteUrl); ?>/thank-you">
          <input type="hidden" name="form_location" value="estimate-section">
          <input type="hidden" name="consent_version" value="v2.1">
          <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
          <?php echo p1_attribution_fields('estimate-section'); ?>

          <div class="form-grid">
            <div class="field">
              <label for="est-name">Your Name</label>
              <input id="est-name" type="text" name="name" autocomplete="name" required>
            </div>
            <div class="field">
              <label for="est-phone">Phone</label>
              <input id="est-phone" type="tel" name="phone" autocomplete="tel" required>
            </div>
            <div class="field">
              <label for="est-email">Email</label>
              <input id="est-email" type="email" name="email" autocomplete="email" required>
            </div>
            <div class="field">
              <label for="est-service">Service Needed</label>
              <select id="est-service" name="service">
                <option value="">Select a service</option>
<?php foreach ($services as $estOpt): ?>
                <option value="<?php echo h($estOpt['name']); ?>"><?php echo h($estOpt['name']); ?></option>
<?php endforeach; ?>
              </select>
            </div>
            <div class="field full">
              <label for="est-message">Project Details</label>
              <textarea id="est-message" name="message" rows="4" placeholder="What needs fixing or remodeling, and which town is the house in?"></textarea>
            </div>
          </div>

          <fieldset class="form-consent-fieldset">
            <legend class="form-consent-legend">Communication Consent</legend>
            <label class="form-consent-item">
              <input type="checkbox" name="email_opt_in" value="yes" class="consent-checkbox">
              <span class="consent-label"><strong>Email updates (optional):</strong> I agree to receive emails from <?php echo h($siteName); ?> about my inquiry, services, promotions, and news. I understand I can unsubscribe anytime via the link in any email or by emailing <?php echo emailLink(); ?>. Message frequency varies.</span>
            </label>
            <label class="form-consent-item">
              <input type="checkbox" name="sms_opt_in" value="yes" class="consent-checkbox">
              <span class="consent-label"><strong>SMS/Text messages (optional):</strong> I agree to receive text messages from <?php echo h($siteName); ?> at the phone number I provided. Message types may include appointment reminders, service updates, and promotional offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe, HELP for help. <strong>Consent is not a condition of purchase.</strong></span>
            </label>
            <label class="form-consent-item form-consent-required">
              <input type="checkbox" name="terms_accepted" value="yes" class="consent-checkbox" required>
              <span class="consent-label">I have read and agree to the <a href="/privacy-policy/">Privacy Policy</a> and <a href="/terms/">Terms of Service</a>. <span class="required-star">*</span></span>
            </label>
          </fieldset>

          <button type="submit" class="btn btn-primary btn-lg">Send my estimate request</button>
        </form>
      </div>

      <div class="estimate-aside reveal-right">
        <h3>What happens next</h3>
        <ol class="next-steps">
          <li><strong>Send the form or call</strong>Tell us what needs fixing or remodeling and which town the house is in.</li>
          <li><strong>Pick an estimate window</strong>Estimate visits run Monday through Friday in two-hour arrival windows, from 8 AM to 6 PM.</li>
          <li><strong>Walk through the job</strong>We look at the job in person and go over the scope and the price before any work is scheduled.</li>
        </ol>
        <div class="nap">
          <div><?php echo icon('phone', 18); ?><a href="tel:<?php echo h($phoneRaw); ?>"><?php echo h($phone); ?></a></div>
          <div><?php echo icon('mail', 18); ?><a href="mailto:<?php echo h($email); ?>"><?php echo h($email); ?></a></div>
          <div><?php echo icon('map-pin', 18); ?><span><?php echo h($siteName); ?>, <?php echo h($address['city'] . ', ' . $address['state']); ?></span></div>
          <div><?php echo icon('clock', 18); ?><span><?php echo h($businessHours); ?></span></div>
        </div>
        <p class="area-line">Serving Elkhart and <?php echo count($serviceAreas) - 1; ?> nearby towns in Northern Indiana and Southwest Michigan.</p>
      </div>

    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
