<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ------------------------------------------------------------------ *
 * Flooring Installation — AP Remodeling Handyman List (Phase 4, 2026-10-18)
 * Archetype: warm-human · Tier: basic. Every fact traces to build-plan.json / config.php
 * or to what the client's own job photos show. Facts the page wanted but intake did not
 * supply are listed in /content-confirmations.json, not invented.
 * ------------------------------------------------------------------ */

$currentPage = 'services';
$pageType    = 'service';
$serviceSlug = 'flooring-installation';

$pageTitle       = 'Flooring Installation in Elkhart, IN | AP Remodeling';
$pageDescription = 'Flooring installation in Elkhart, IN from AP Remodeling Handyman List: tile and new floors for baths, bedrooms and living areas. Call for a free estimate today.';
$canonicalUrl    = $siteUrl . '/services/' . $serviceSlug . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';

/* Hero photo (manifest): preloaded as AVIF */
$heroPreload = [
    'srcset' => '/assets/images/1000002207-480.avif 480w, /assets/images/1000002207-960.avif 960w, /assets/images/1000002207-1600.avif 1600w',
    'sizes'  => '100vw',
];

/* FAQs — questions from the research brief and intake only (0–4 per page; none invented). */
$faqs = [
    [
        'q' => 'Is a flooring estimate free?',
        'a' => 'Yes. AP Remodeling Handyman List does not charge to look at a flooring job and price it. Estimate visits run Monday through Friday in two-hour windows between 8 AM and 6 PM, and you decide afterward whether to go ahead.',
    ],
    [
        'q' => 'How is a flooring job priced?',
        'a' => 'Flooring is priced after the estimate visit, once the room size, the type of floor and the prep work are known. The estimate itself costs nothing.',
    ],
    [
        'q' => 'Does AP Remodeling install floors in my town?',
        'a' => 'AP Remodeling Handyman List works in Elkhart, Mishawaka, South Bend, Osceola, Bristol, Plymouth, Warsaw, Kendallville and Ligonier in Indiana, and in Niles and Edwardsburg in Michigan. If your town is not listed, call ' . $phone . ' and ask.',
    ],
];

$svcEntry = [];
foreach ($services as $svcRow) { if ($svcRow['slug'] === $serviceSlug) { $svcEntry = $svcRow; break; } }
$schemaMarkup = [
    array_merge(generateServiceSchema($svcEntry), [
        '@id'         => $canonicalUrl . '#service-' . $serviceSlug,
        'serviceType' => array_map('shortServiceName', (array) $svcEntry['includes']),
    ]),
    generateBreadcrumbSchema([
        ['name' => 'Home',     'url' => '/'],
        ['name' => 'Services', 'url' => '/services/'],
        ['name' => 'Flooring Installation', 'url' => '/services/' . $serviceSlug . '/'],
    ]),
    generateFAQSchema($faqs),
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<style>
/* ===== Service page composition (tokens only — framework.css carries the components) ===== */
.svc-hero h1, .svc-detail h2, .svc-why h2, .svc-process h2, .svc-faq h2, .svc-related h2, .svc-cta h2 { text-wrap: balance; }
.svc-hero .breadcrumb { color: color-mix(in srgb, var(--color-white) 72%, transparent); }
.svc-hero .breadcrumb a:hover { color: var(--color-white); }
.svc-hero .breadcrumb { align-items: center; }
.svc-hero .link-call { color: color-mix(in srgb, var(--color-white) 90%, transparent); }
.svc-hero .link-call:hover { color: var(--color-white); }
.svc-hero .link-call svg { color: var(--color-white); }
.svc-hero .btn-primary { background: var(--color-accent); border-color: var(--color-accent); color: var(--color-white); }
.svc-hero .btn-primary:hover { background: var(--color-accent-dark); border-color: var(--color-accent-dark); }
.svc-hero .hero-form-card h3 { font-size: 1.25rem; color: var(--color-ink); }
.svc-hero .hero-form-card .consent a { color: var(--color-primary); }
.svc-hero .hero-book {
  font-weight: 600; color: var(--color-white);
  text-decoration: underline; text-decoration-color: var(--color-accent-bright); text-underline-offset: var(--space-1);
}
.svc-hero .hero-copy { max-width: 38rem; }
.svc-hero .floating-ring { top: -12%; right: -6%; opacity: .1; }

/* Detail: copy beside a tall photo */
.svc-detail { background: var(--color-paper); }
.svc-detail .split, .svc-detail .split-reverse { align-items: start; }
.svc-detail .detail-copy { display: grid; gap: var(--space-md); }
.svc-detail .detail-copy p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.svc-detail .detail-copy p.answer-block { color: var(--color-ink); }
.svc-detail .detail-copy a, .svc-faq a, .svc-process a { color: var(--color-primary); font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: var(--space-1); }
.svc-figure { margin: 0; position: relative; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-lg); aspect-ratio: 4 / 5; }
.svc-figure img { width: 100%; height: 100%; object-fit: cover; }
.svc-figure figcaption { position: absolute; inset: auto 0 0 0; padding: var(--space-xl) var(--space-md) var(--space-sm); background: linear-gradient(to top, color-mix(in srgb, var(--color-dark) 88%, transparent), transparent); color: var(--color-white); font-size: var(--fs-small); }

/* Why band: dark, grain, two-column */
.svc-why .svc-why__grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: clamp(2rem, 6vw, 5rem); align-items: center; }
.svc-why .section-head { margin-bottom: 0; }
.svc-why .why-list { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-sm); }
.svc-why .why-list li { display: grid; grid-template-columns: auto 1fr; gap: var(--space-sm); align-items: start; padding: var(--space-md); border: 1px solid color-mix(in srgb, var(--color-white) 16%, transparent); border-radius: var(--radius); background: color-mix(in srgb, var(--color-white) 5%, transparent); color: var(--color-white); }
.svc-why .why-list svg { color: var(--color-accent-bright); margin-top: 2px; }
.svc-why .answer-block { background: transparent; color: color-mix(in srgb, var(--color-white) 88%, transparent); }

/* Process */
.svc-process { background: var(--color-surface); }
.svc-process .process-steps, .svc-process .timeline, .svc-process .next-steps { margin-top: var(--space-lg); }
.svc-timeline > li { padding-bottom: var(--space-xs); }
.svc-timeline b { font-family: var(--font-heading); font-size: var(--fs-h3); display: block; margin-bottom: var(--space-1); }
.svc-timeline p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }

/* FAQ */
.svc-faq { background: var(--color-paper-2); }
.svc-faq .faq-grid { align-items: start; }

/* Related services: three cards */
.svc-related { background: var(--color-surface); }
@media (min-width: 1000px) { .svc-related .services-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }

/* Closing band */
.svc-cta { color: var(--color-white); }
.svc-cta .answer-block { background: transparent; color: color-mix(in srgb, var(--color-white) 88%, transparent); max-width: 52ch; }
.svc-cta .actions .btn-primary { background: var(--color-accent); border-color: var(--color-accent); color: var(--color-white); }
.svc-cta .actions .btn-primary:hover { background: var(--color-accent-dark); }
.svc-cta .floating-ring { top: -20%; right: -6%; opacity: .09; }

@media (max-width: 900px) {
  .svc-why .svc-why__grid { grid-template-columns: 1fr; }
  .svc-figure { aspect-ratio: 4 / 3; }
}
@media (max-width: 560px) { .svc-hero .hero-book { display: none; } }

.svc-hero .hero-bg img { object-position: 50% 62%; }
.svc-detail .svc-figure { clip-path: polygon(0 0, 100% 0, 100% 90%, 88% 100%, 0 100%); }
.svc-process .svc-figure { aspect-ratio: 3 / 4; border-radius: var(--radius); }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior svc-hero" aria-label="Flooring Installation introduction">
  <div class="hero-bg">
    <picture>
            <source type="image/avif" srcset="/assets/images/1000002207-480.avif 480w, /assets/images/1000002207-960.avif 960w, /assets/images/1000002207-1600.avif 1600w" sizes="100vw">
            <img src="/assets/images/1000002207-960.webp" srcset="/assets/images/1000002207-480.webp 480w, /assets/images/1000002207-960.webp 960w, /assets/images/1000002207-1600.webp 1600w" sizes="100vw" alt="White hexagon mosaic tile floor in a bathroom installed by AP Remodeling Handyman List, leading to a tiled shower" width="960" height="1280" loading="eager" fetchpriority="high">
          </picture>
  </div>
  <div class="hero-overlay" aria-hidden="true"></div>
  <span class="grain" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid hero-grid--form">

      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="breadcrumb-sep" aria-hidden="true">›</li>
          <li><a href="/services/">Services</a></li>
          <li class="breadcrumb-sep" aria-hidden="true">›</li>
          <li aria-current="page">Flooring Installation</li>
        </ol>
      </nav>
        <span class="eyebrow">Services · Flooring</span>
        <h1 class="hero-title">Flooring installation in Elkhart, Indiana</h1>
        <p class="hero-answer">AP Remodeling Handyman List installs new floors in baths, bedrooms and living areas around Elkhart, from tile to subfloor prep and baseboard. The Elkhart company is owned by Charles Poe, has 32 years in business, and prices every floor after a weekday estimate visit.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free estimate</button>
          <a class="link-call" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>or call <?php echo h($phone); ?></a>
<?php if (!empty($bookingWindows['authorized']) && pageBuilt('/contact/')): ?>
          <a class="hero-book" href="/contact/#book-visit">Request an estimate visit</a>
<?php endif; ?>
        </div>
        <ul class="hero-chips">
          <li><?php echo icon('check-circle', 16); ?>Free estimates</li>
          <li><?php echo icon('clock', 16); ?>Open 7 days, 9–6</li>
          <li><?php echo icon('hammer', 16); ?>32 years in business</li>
        </ul>
      </div>

      <aside class="hero-form-card" id="estimate-form">
          <h3>Ready for a free estimate?</h3>
          <p class="hero-form-tagline">No obligation. Tell us what needs doing.</p>
          <form action="<?php echo h($formAction); ?>" method="POST" class="hero-form">
            <input type="hidden" name="_next" value="<?php echo h($siteUrl); ?>/thank-you">
            <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
            <input type="hidden" name="form_location" value="hero">
            <input type="hidden" name="consent_version" value="v2.1">
            <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
            <?php echo p1_attribution_fields('hero'); ?>
            <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
            <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" required></div>
            <div class="form-row"><label class="sr-only" for="hero-email">Email</label><input id="hero-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
            <div class="form-row"><label class="sr-only" for="hero-service">Service</label>
              <select id="hero-service" name="service">
                <option value="">What do you need?</option>
<?php foreach ($services as $heroOpt): ?>
                <option value="<?php echo h($heroOpt['name']); ?>"<?php echo $heroOpt['slug'] === $serviceSlug ? ' selected' : ''; ?>><?php echo h($heroOpt['name']); ?></option>
<?php endforeach; ?>
              </select>
            </div>
            <label class="consent"><input type="checkbox" name="terms_accepted" value="yes" required><span>I agree to the <a href="/terms/" target="_blank" rel="noopener">Terms</a> and <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and consent to be contacted. *</span></label>
            <button type="submit" class="btn btn-primary btn-block">Request my estimate</button>
          </form>
        </aside>

    </div>
  </div>
</section>

<section class="section svc-detail" id="what-is-included" aria-label="What flooring installation includes">
  <div class="container">
    <article class="split">
      <div class="detail-copy reveal-left">
        <span class="eyebrow">Flooring Installation</span>
        <h2>What does flooring installation with <span class="text-accent">AP Remodeling</span> include?</h2>
        <p class="answer-block">Flooring installation with AP Remodeling Handyman List covers taking the room down to the subfloor, laying the new floor, and finishing the edges with baseboard and paint. The company works in bathrooms, bedrooms, kitchens and living areas in Elkhart, Mishawaka, South Bend and the towns around them.</p>
        <p>AP Remodeling Handyman List is a handyman and remodeling company in Elkhart, Indiana, owned by Charles Poe and in business for 32 years.</p>
        <p>The photo beside this section shows the first half of most floor jobs: a room taken down to bare subfloor, with new white baseboard on the walls and tools set out before the floor goes in. A new floor is only as flat as what is under it, so the subfloor gets cleared and checked before anything is laid on top.</p>
        <p>Tile is the other floor in the photos. A white hexagon mosaic runs across one bathroom and into a tiled walk-in shower, set against walls that were patched and prepped for paint. Small mosaic tile needs a tight layout and even grout lines, because every irregular line shows on a floor that small.</p>
        <p>Because the same company also does drywall, painting and trim, the floor is not where the job stops. Walls get patched and painted and baseboard goes back, all under one estimate. If the floor is part of a bigger project, see <a href="/services/remodeling-services/">bathroom and kitchen remodeling</a>, or <a href="/services/additional-services/">the handyman list</a> for the smaller fixes that turn up along the way.</p>
      </div>
      <figure class="svc-figure reveal-right">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002321-480.avif 480w, /assets/images/1000002321-960.avif 960w, /assets/images/1000002321-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002321-960.webp" srcset="/assets/images/1000002321-480.webp 480w, /assets/images/1000002321-960.webp 960w, /assets/images/1000002321-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Room with double doors, new baseboard and exposed subfloor, tools set out for the flooring install" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
          <figcaption>Room taken down to subfloor with tools set out for the new floor</figcaption>
        </figure>
    </article>
  </div>
</section>

<section class="section texture-grain slant-top svc-why " aria-label="Why choose AP Remodeling">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-why__grid">
      <div class="section-head reveal-left">
        <span class="eyebrow">Why AP Remodeling</span>
        <h2>Why hire AP Remodeling Handyman List to install your floor?</h2>
        <p class="answer-block">AP Remodeling Handyman List has been in business in Elkhart for 32 years and handles the walls, trim and paint around a new floor. That means one estimate and one phone number instead of separate tile, drywall and paint contractors, which keeps a floor job from stalling between trades.</p>
      </div>
      <ul class="why-list reveal-right">
        <li><?php echo icon("check-circle", 22); ?><span>Rooms taken down to bare subfloor before new flooring goes in</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Tile floors, including small hexagon mosaic</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Walls patched, painted and trimmed around the floor</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>An in-person estimate visit, Monday through Friday, before any work is scheduled</span></li>
      </ul>
    </div>
  </div>
</section>
<section class="section svc-process" id="process" aria-label="How the job works">
  <div class="container">
    <div class="split-reverse">
      <div class="reveal-left">
        <span class="eyebrow">How It Works</span>
        <h2>How does a flooring job go from estimate to finished room?</h2>
        <p class="answer-block">A flooring job runs in four steps: estimate visit, clearing the room, installing the floor, and finishing the edges. The estimate visit settles the schedule, because timing depends on the size of the room and the floor you choose, and the price is set once the room has been seen.</p>
      <ol class="process-steps">
        <li><b>Estimate visit</b><span>Request a weekday window, two hours long, between 8 AM and 6 PM. The room, the floor and the price are talked through before any work is scheduled.</span></li>
        <li><b>Clear to the subfloor</b><span>Old flooring comes up, and the subfloor is cleaned and checked so the new floor starts flat.</span></li>
        <li><b>Install the floor</b><span>Tile or new flooring is laid out and set, with the layout planned around doors and fixtures.</span></li>
        <li><b>Finish the edges</b><span>Baseboard goes back, walls are touched up and painted, and the room is ready to use.</span></li>
      </ol>
      </div>
      <figure class="svc-figure reveal-right">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002319-480.avif 480w, /assets/images/1000002319-960.avif 960w, /assets/images/1000002319-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002319-960.webp" srcset="/assets/images/1000002319-480.webp 480w, /assets/images/1000002319-960.webp 960w, /assets/images/1000002319-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Bedroom under a sloped ceiling with fresh paint, new white baseboard and bare subfloor ready for new flooring" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
          <figcaption>Sloped-ceiling bedroom painted, new baseboard in, subfloor ready for flooring</figcaption>
        </figure>
    </div>
  </div>
</section>

<section class="section svc-faq" aria-label="Frequently asked questions">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2>What do homeowners ask before a <span class="text-accent">flooring</span> job?</h2>
      <p class="answer-block">Homeowners ask three things before a flooring job: whether the estimate is free, how the job is priced, and whether AP Remodeling works in their town. The answers below describe how the company handles estimates in Elkhart and the towns around it.</p>
    </div>
    <div class="faq-grid">
<?php foreach (array_chunk($faqs, (int) ceil(count($faqs) / 2)) as $faqColIdx => $faqCol): ?>
      <div class="faq-col <?php echo $faqColIdx === 0 ? 'reveal-left' : 'reveal-right'; ?>">
<?php foreach ($faqCol as $faqIdx => $faq): ?>
        <details class="faq"<?php echo ($faqColIdx === 0 && $faqIdx === 0) ? ' open' : ''; ?>>
          <summary><?php echo h($faq['q']); ?></summary>
          <p><?php echo linkContact(h($faq['a'])); ?></p>
        </details>
<?php endforeach; ?>
      </div>
<?php endforeach; ?>
    </div>
  </div>
</section>
<section class="section edge-curve-top svc-related" aria-label="Related services">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">Other Services You May Need</span>
      <h2>Which other AP Remodeling services go with new flooring?</h2>
      <p class="answer-block">New flooring often goes in alongside bathroom or kitchen remodeling, drywall and paint work, or new windows and trim. AP Remodeling Handyman List handles each of these, so a floor job can grow into a room refresh without changing contractors.</p>
    </div>
    <div class="services-grid">
      <article class="service-card-with-image card-tint-1 reveal-up reveal-delay-1">
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
      <article class="service-card-with-image card-tint-2 reveal-up reveal-delay-2">
        <div class="service-card__image">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002213-480.avif 480w, /assets/images/1000002213-960.avif 960w, /assets/images/1000002213-1600.avif 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px">
            <img src="/assets/images/1000002213-960.webp" srcset="/assets/images/1000002213-480.webp 480w, /assets/images/1000002213-960.webp 960w, /assets/images/1000002213-1600.webp 1600w" sizes="(max-width: 440px) 100vw, (max-width: 1000px) 33vw, 290px" alt="Bathroom wall with fresh drywall patching beside new tile, ready for primer and paint" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        </div>
        <div class="service-card__body">
          <div class="service-card__icon"><?php echo icon('wrench', 22); ?></div>
          <h3>Handyman &amp; Roofing</h3>
          <p class="service-card__desc">Drywall, paint, doors, fixtures, deck and fence fixes, plus roof repair and replacement.</p>
          <ul>
            <li>Drywall patched, taped and painted</li>
            <li>TV mounts, shelving, furniture assembly</li>
            <li>Roof repair and full replacement</li>
          </ul>
          <a href="/services/additional-services/" class="service-card__cta">See Handyman &amp; Roofing</a>
        </div>
      </article>
      <article class="service-card-with-image card-tint-3 reveal-up reveal-delay-3">
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
<section class="cta-banner texture-grain edge-parallelogram-top svc-cta" aria-label="Request a free estimate">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate" aria-hidden="true"></span>
  <div class="container">
    <div class="reveal-up">
      <span class="eyebrow">Next step</span>
      <h2>Ready to get a price on your new floor?</h2>
      <p class="answer-block">AP Remodeling Handyman List gives free flooring estimates in Elkhart and nearby towns. Call <?php echo phoneLink(); ?> or send the form, and ask for a weekday estimate visit in a two-hour window that suits you. There is no charge for the estimate, and nothing is scheduled until you have seen the scope and the price.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
