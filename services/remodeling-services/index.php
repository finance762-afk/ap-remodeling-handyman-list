<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ------------------------------------------------------------------ *
 * Bathroom & Kitchen Remodeling — AP Remodeling Handyman List (Phase 4, 2026-10-18)
 * Archetype: warm-human · Tier: basic. Every fact traces to build-plan.json / config.php
 * or to what the client's own job photos show. Facts the page wanted but intake did not
 * supply are listed in /content-confirmations.json, not invented.
 * ------------------------------------------------------------------ */

$currentPage = 'services';
$pageType    = 'service';
$serviceSlug = 'remodeling-services';

$pageTitle       = 'Bathroom & Kitchen Remodeling Elkhart, IN | AP Remodeling';
$pageDescription = 'Bathroom and kitchen remodeling in Elkhart, IN from AP Remodeling Handyman List: tile, drywall, paint and fixtures from one company. Call for a free estimate.';
$canonicalUrl    = $siteUrl . '/services/' . $serviceSlug . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';

/* Hero photo (manifest): preloaded as AVIF */
$heroPreload = [
    'srcset' => '/assets/images/1000002210-480.avif 480w, /assets/images/1000002210-960.avif 960w, /assets/images/1000002210-1600.avif 1600w',
    'sizes'  => '100vw',
];

/* FAQs — questions from the research brief and intake only (0–4 per page; none invented). */
$faqs = [
    [
        'q' => 'Is a bathroom or kitchen remodel estimate free?',
        'a' => 'Yes. AP Remodeling Handyman List does not charge to look at a remodel and price it. Estimate visits run Monday through Friday in two-hour windows between 8 AM and 6 PM, and you decide afterward whether to go ahead.',
    ],
    [
        'q' => 'How is a bathroom or kitchen remodel priced?',
        'a' => 'A remodel is priced after the estimate visit, once the scope, the materials and the time involved are known. The estimate costs nothing, and the price is not set until the work has been walked through.',
    ],
    [
        'q' => 'Do you remodel bathrooms and kitchens in my town?',
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
        ['name' => 'Bathroom & Kitchen Remodeling', 'url' => '/services/' . $serviceSlug . '/'],
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

.svc-hero .hero-bg img { object-position: 50% 45%; }
.svc-detail .svc-figure { box-shadow: 14px 14px 0 var(--color-accent); border-radius: var(--radius); }
.svc-kitchen { color: var(--color-white); }
.svc-kitchen .container-narrow { display: grid; gap: var(--space-md); }
.svc-kitchen p { margin: 0; color: color-mix(in srgb, var(--color-white) 86%, transparent); max-width: var(--measure); }
.svc-kitchen .answer-block { background: transparent; color: var(--color-white); }
.svc-kitchen a { color: var(--color-white); font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent-bright); text-underline-offset: var(--space-1); }
.svc-gallery { background: var(--color-paper); }
.svc-gallery .sp-gallery-grid { margin-top: var(--space-lg); }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior svc-hero" aria-label="Bathroom &amp; Kitchen Remodeling introduction">
  <div class="hero-bg">
    <picture>
            <source type="image/avif" srcset="/assets/images/1000002210-480.avif 480w, /assets/images/1000002210-960.avif 960w, /assets/images/1000002210-1600.avif 1600w" sizes="100vw">
            <img src="/assets/images/1000002210-960.webp" srcset="/assets/images/1000002210-480.webp 480w, /assets/images/1000002210-960.webp 960w, /assets/images/1000002210-1600.webp 1600w" sizes="100vw" alt="Shower corner tiled in marble-look porcelain with a long recessed niche, a bathroom remodel by AP Remodeling Handyman List" width="960" height="1280" loading="eager" fetchpriority="high">
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
          <li aria-current="page">Bathroom &amp; Kitchen Remodeling</li>
        </ol>
      </nav>
        <span class="eyebrow">Services · Remodeling</span>
        <h1 class="hero-title">Bathroom and kitchen remodeling in Elkhart, Indiana</h1>
        <p class="hero-answer">AP Remodeling Handyman List remodels bathrooms and kitchens in Elkhart and nearby towns, with tile, drywall, paint and fixtures handled by one company. The company is owned by Charles Poe and prices each remodel after an in-person estimate visit.</p>
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
          <li><?php echo icon('droplets', 16); ?>Tile, drywall and paint in one job</li>
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

<section class="section svc-detail" id="bathroom" aria-label="Bathroom remodeling">
  <div class="container">
    <article class="split">
      <div class="detail-copy reveal-left">
        <span class="eyebrow">Bathroom Remodeling</span>
        <h2>What does a bathroom remodel with <span class="text-accent">AP Remodeling</span> include?</h2>
        <p class="answer-block">A bathroom remodel with AP Remodeling Handyman List covers tile for the shower walls and floor, drywall repair and paint around the tile, and fixture replacement. The jobs pictured on this page include large-format marble-look porcelain, recessed niches, a pebble shower floor and a hexagon mosaic floor.</p>
        <p>AP Remodeling Handyman List is a handyman and remodeling company in Elkhart, Indiana, owned by Charles Poe and in business for 30+ years.</p>
        <p>The shower walls in these photos are large-format porcelain tile with a marble look, which means fewer grout lines than small tile. Recessed niches are set into the wall so shampoo and soap sit inside the shower instead of on a ledge, and one corner carries a long niche running most of the width of the tile.</p>
        <p>Tile is only the middle of a bathroom job. The wall beside the new tile has to be patched and skimmed before primer and paint, the stage the drywall photo below captures, and a shower can look finished while raw wallboard still sits next to it.</p>
        <p>The floor is part of the same job. See <a href="/services/flooring-installation/">flooring installation</a> for the hexagon mosaic floor, and the <a href="/services/additional-services/">handyman list</a> for fixture replacement and caulking once the tile is done.</p>
      </div>
      <figure class="svc-figure reveal-right">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002211-480.avif 480w, /assets/images/1000002211-960.avif 960w, /assets/images/1000002211-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002211-960.webp" srcset="/assets/images/1000002211-480.webp 480w, /assets/images/1000002211-960.webp 960w, /assets/images/1000002211-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Tiled shower wall in marble-look porcelain with a small built-in niche above a pebble floor" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
          <figcaption>Shower back wall with a small soap niche set into the tile</figcaption>
        </figure>
    </article>
  </div>
</section>

<!-- ============ KITCHEN ============ -->
<section class="section texture-grain slant-top svc-kitchen" id="kitchen" aria-label="Kitchen remodeling">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container-narrow">
    <article class="reveal-up">
      <span class="eyebrow">Kitchen Remodeling</span>
      <h2>What does a kitchen remodel with <span class="text-accent">AP Remodeling</span> include?</h2>
      <p class="answer-block">A kitchen remodel with AP Remodeling Handyman List is scoped at a free estimate visit, then priced for the work you agree on. Kitchen jobs vary the most of any remodel, so the visit sets the list: fixtures, drywall repair, flooring, paint and trim are all work the company does.</p>
      <p>Because one company does the floor, the drywall and the paint, a kitchen update does not have to be split across several contractors. Ask about the kitchen when you request an estimate visit, and say which parts of the room you want changed.</p>
      <p>Start with the <a href="/services/">full services list</a> if the project touches more than one room, or send the estimate form with the rooms and the town listed.</p>
    </article>
  </div>
</section>

<!-- ============ RECENT BATHROOM WORK ============ -->
<section class="section svc-gallery" aria-label="Recent bathroom work">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Recent Work</span>
      <h2>What do recent <span class="text-accent">AP Remodeling</span> bathroom jobs look like?</h2>
      <p class="answer-block">Recent AP Remodeling Handyman List bathroom jobs include a walk-in shower in large marble-look tile, a hexagon mosaic floor and drywall patched beside new tile. The three photos below were taken on the job and show each stage as it stood when photographed.</p>
    </div>
    <div class="sp-gallery-grid" data-p1-dynamic>
      <figure class="sp-gallery-item reveal-left">
        <picture>
            <source type="image/avif" srcset="/assets/images/1000002111-480.avif 480w, /assets/images/1000002111-960.avif 960w, /assets/images/1000002111-1600.avif 1600w" sizes="(max-width: 700px) 100vw, 55vw">
            <img src="/assets/images/1000002111-960.webp" srcset="/assets/images/1000002111-480.webp 480w, /assets/images/1000002111-960.webp 960w, /assets/images/1000002111-1600.webp 1600w" sizes="(max-width: 700px) 100vw, 55vw" alt="Walk-in shower walls finished in large marble-look porcelain tile with a recessed shelf niche" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        <figcaption>Walk-in shower in large-format marble-look tile with a recessed niche</figcaption>
      </figure>
      <figure class="sp-gallery-item reveal-up">
        <picture>
            <source type="image/avif" srcset="/assets/images/1000002207-480.avif 480w, /assets/images/1000002207-960.avif 960w, /assets/images/1000002207-1600.avif 1600w" sizes="(max-width: 700px) 100vw, 40vw">
            <img src="/assets/images/1000002207-960.webp" srcset="/assets/images/1000002207-480.webp 480w, /assets/images/1000002207-960.webp 960w, /assets/images/1000002207-1600.webp 1600w" sizes="(max-width: 700px) 100vw, 40vw" alt="Bathroom with a white hexagon mosaic tile floor leading to a tiled shower, walls patched for paint" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        <figcaption>Hex mosaic tile floor leading into the new shower</figcaption>
      </figure>
      <figure class="sp-gallery-item reveal-right">
        <picture>
            <source type="image/avif" srcset="/assets/images/1000002213-480.avif 480w, /assets/images/1000002213-960.avif 960w, /assets/images/1000002213-1600.avif 1600w" sizes="(max-width: 700px) 100vw, 40vw">
            <img src="/assets/images/1000002213-960.webp" srcset="/assets/images/1000002213-480.webp 480w, /assets/images/1000002213-960.webp 960w, /assets/images/1000002213-1600.webp 1600w" sizes="(max-width: 700px) 100vw, 40vw" alt="Bathroom wall with fresh drywall patching beside new tile, ready for primer and paint" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
        <figcaption>Drywall patched and skimmed beside new tile, ready for paint</figcaption>
      </figure>
    </div>
  </div>
</section>

<section class="section texture-grain edge-wave-top svc-why " aria-label="Why choose AP Remodeling">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-why__grid">
      <div class="section-head reveal-left">
        <span class="eyebrow">Why AP Remodeling</span>
        <h2>Why remodel with AP Remodeling instead of hiring separate trades?</h2>
        <p class="answer-block">AP Remodeling Handyman List does the tile, the drywall repair and the paint on a bathroom remodel itself, so one company answers for the whole room. Hiring trades separately means three schedules and three handoffs, while one company means one schedule and one phone number to call.</p>
      </div>
      <ul class="why-list reveal-right">
        <li><?php echo icon("check-circle", 22); ?><span>Tile, drywall and paint under one estimate</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Recessed niches, pebble shower floors and hex mosaic tile</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Fixtures, flooring and trim handled in the same job</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>An in-person estimate visit before any work is scheduled</span></li>
      </ul>
    </div>
  </div>
</section>
<section class="section svc-process" id="process" aria-label="How the job works">
  <div class="container-narrow">
    <div class="section-head reveal-up">
      <span class="eyebrow">How It Works</span>
      <h2>How does a bathroom or kitchen remodel move along?</h2>
      <p class="answer-block">A remodel runs in five steps: estimate visit, repairs behind the finish, room prep, installation, and finishing. The estimate visit sets the scope and the price before any work is scheduled, and the later steps follow the order the job photos show.</p>
    </div>
      <ol class="timeline svc-timeline">
        <li><b>Estimate visit</b><p>Request a weekday window. The room is looked at in person, and the scope and price are talked through first.</p></li>
        <li><b>Repair what is behind the finish</b><p>Damaged drywall is cut out, patched and skimmed so the new surface starts flat.</p></li>
        <li><b>Prep the room</b><p>Old flooring comes up to the subfloor, and trim and openings are masked before paint.</p></li>
        <li><b>Install</b><p>Tile walls, recessed niches, mosaic floors and fixtures go in.</p></li>
        <li><b>Finish</b><p>Walls and trim are painted and baseboard goes back, so the room is ready to use.</p></li>
      </ol>
  </div>
</section>

<section class="section svc-faq" aria-label="Frequently asked questions">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2>What do homeowners ask before a <span class="text-accent">bathroom or kitchen remodel</span>?</h2>
      <p class="answer-block">Homeowners ask three things before a remodel: whether the estimate is free, how the job is priced, and whether AP Remodeling works in their town. The answers below describe how the company handles estimates in Elkhart and the towns around it.</p>
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
      <h2>Which other AP Remodeling services go with a remodel?</h2>
      <p class="answer-block">A bathroom or kitchen remodel usually touches the floor, the windows and the small repairs around the room. AP Remodeling Handyman List handles all three, so the remodel and the follow-up work can sit under one estimate and one visit.</p>
    </div>
    <div class="services-grid">
      <article class="service-card-with-image card-tint-1 reveal-up reveal-delay-1">
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
      <article class="service-card-with-image card-tint-2 reveal-up reveal-delay-2">
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
      <h2>Ready to price your bathroom or kitchen remodel?</h2>
      <p class="answer-block">AP Remodeling Handyman List gives free remodeling estimates in Elkhart and nearby towns. Call <?php echo phoneLink(); ?> or send the form, and ask for a weekday estimate visit in a two-hour window that suits you. There is no charge for the estimate, and nothing is scheduled until you have seen the scope and the price.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
