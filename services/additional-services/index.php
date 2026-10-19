<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ------------------------------------------------------------------ *
 * Handyman & Roofing — AP Remodeling Handyman List (Phase 4, 2026-10-18)
 * Archetype: warm-human · Tier: basic. Every fact traces to build-plan.json / config.php
 * or to what the client's own job photos show. Facts the page wanted but intake did not
 * supply are listed in /content-confirmations.json, not invented.
 * ------------------------------------------------------------------ */

$currentPage = 'services';
$pageType    = 'service';
$serviceSlug = 'additional-services';

$pageTitle       = 'Handyman & Roofing Services Elkhart, IN | AP Remodeling';
$pageDescription = 'Handyman services and roof repair in Elkhart, IN from AP Remodeling Handyman List: drywall, paint, doors, TV mounting, decks, fences. Call for a free estimate.';
$canonicalUrl    = $siteUrl . '/services/' . $serviceSlug . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';

/* Hero photo (manifest): preloaded as AVIF */
$heroPreload = [
    'srcset' => '/assets/images/1000002213-480.avif 480w, /assets/images/1000002213-960.avif 960w, /assets/images/1000002213-1600.avif 1600w',
    'sizes'  => '100vw',
];

/* FAQs — questions from the research brief and intake only (0–4 per page; none invented). */
$faqs = [
    [
        'q' => 'What does a handyman or roofing estimate cost?',
        'a' => 'No. AP Remodeling Handyman List does not charge to look at a handyman list or a roof and price the work. Estimate visits run Monday through Friday in two-hour windows between 8 AM and 6 PM, and you decide afterward whether to go ahead.',
    ],
    [
        'q' => 'How is handyman work priced?',
        'a' => 'Each job is priced after the estimate visit, once the scope, the materials and the time involved are known. Whether small jobs are charged by the hour or by the job is settled in that visit.',
    ],
    [
        'q' => 'Do you do handyman jobs and roofs in my town?',
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
        ['name' => 'Handyman & Roofing', 'url' => '/services/' . $serviceSlug . '/'],
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

.svc-hero .hero-bg img { object-position: 50% 55%; }
.svc-groups { background: var(--color-paper); }
.svc-groups .group-cards { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-md); margin: var(--space-lg) 0; }
.svc-groups .group-cards .card { display: grid; gap: var(--space-xs); align-content: start; box-shadow: none; }
.svc-groups .group-cards .card svg { color: var(--color-accent-dark); }
.svc-groups .group-cards h3 { font-size: var(--fs-h3); }
.svc-groups .group-cards ul { margin: 0; padding-left: var(--space-lg); color: var(--color-ink-2); font-size: var(--fs-small); }
.svc-groups .group-cards p { margin: 0; color: var(--color-ink-2); font-size: var(--fs-small); }
.svc-groups .split-reverse, .svc-groups .split { margin-top: var(--space-2xl); align-items: start; }
.svc-groups .svc-figure { aspect-ratio: 4 / 3; }
.svc-groups .svc-figure img { object-position: 50% 55%; }
.svc-roof { background: var(--color-surface); }
.svc-roof .detail-copy { display: grid; gap: var(--space-md); }
.svc-roof .detail-copy p { margin: 0; max-width: var(--measure); color: var(--color-ink-2); }
.svc-roof .detail-copy p.answer-block { color: var(--color-ink); }
.svc-roof .roof-table { width: 100%; border-collapse: collapse; font-size: var(--fs-small); background: var(--color-paper); border-radius: var(--radius); overflow: hidden; }
.svc-roof .roof-table caption { text-align: left; font-family: var(--font-heading); font-weight: 800; padding-bottom: var(--space-xs); }
.svc-roof .roof-table th, .svc-roof .roof-table td { text-align: left; padding: var(--space-sm) var(--space-md); border-bottom: 1px solid var(--color-line); vertical-align: top; }
.svc-roof .roof-table thead th { background: var(--color-card-tint-1); font-family: var(--font-accent); letter-spacing: .08em; text-transform: uppercase; }
.svc-roof .roof-note { font-size: var(--fs-small); color: var(--color-muted); margin: var(--space-xs) 0 0; }
@media (max-width: 900px) { .svc-groups .group-cards { grid-template-columns: 1fr; } }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--photo hero--interior svc-hero" aria-label="Handyman &amp; Roofing introduction">
  <div class="hero-bg">
    <picture>
            <source type="image/avif" srcset="/assets/images/1000002213-480.avif 480w, /assets/images/1000002213-960.avif 960w, /assets/images/1000002213-1600.avif 1600w" sizes="100vw">
            <img src="/assets/images/1000002213-960.webp" srcset="/assets/images/1000002213-480.webp 480w, /assets/images/1000002213-960.webp 960w, /assets/images/1000002213-1600.webp 1600w" sizes="100vw" alt="Bathroom wall with fresh drywall patching beside new tile, ready for primer, a handyman repair by AP Remodeling Handyman List" width="960" height="1280" loading="eager" fetchpriority="high">
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
          <li aria-current="page">Handyman &amp; Roofing</li>
        </ol>
      </nav>
        <span class="eyebrow">Services · Handyman &amp; Roofing</span>
        <h1 class="hero-title">Handyman services and roofing in Elkhart, Indiana</h1>
        <p class="hero-answer">AP Remodeling Handyman List fixes small things and big ones around Elkhart: drywall, paint, doors, mounts, fixtures, decks, fences and roofs. The company has 30+ years in business and prices each job after an in-person estimate visit on a weekday.</p>
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
          <li><?php echo icon('wrench', 16); ?>Handyman list to roofing</li>
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

<section class="section svc-groups" id="handyman" aria-label="Handyman services">
  <div class="container">
    <article>
      <div class="section-head reveal-up">
        <span class="eyebrow">Handyman Services</span>
        <h2>Which handyman jobs does <span class="text-accent">AP Remodeling</span> take on in Elkhart?</h2>
        <p class="answer-block">AP Remodeling takes on drywall, painting, doors, TV mounts, shelving, fixtures, caulking, and deck and fence repair around Elkhart. The full handyman list is grouped below by the kind of job, so one call can list several jobs at once.</p>
        <p>AP Remodeling Handyman List is a handyman and remodeling company in Elkhart, Indiana, owned by Charles Poe and in business for 30+ years.</p>
      </div>
      <div class="group-cards">
        <div class="card card-tint-1 reveal-up reveal-delay-1">
          <?php echo icon('paint-bucket', 28); ?>
          <h3>Walls, paint and trim</h3>
          <p>Drywall repair, interior painting and exterior painting. Patching, skimming and priming come before the paint goes on.</p>
          <ul><li>Drywall repair</li><li>Interior painting</li><li>Exterior painting</li></ul>
        </div>
        <div class="card card-tint-2 reveal-up reveal-delay-2">
          <?php echo icon('wrench', 28); ?>
          <h3>Doors, fixtures and mounting</h3>
          <p>Hanging, installing and swapping the things that wear out or never got put up.</p>
          <ul><li>Door installation and repair</li><li>TV mounting and shelving installation</li><li>Furniture assembly and fixture replacement</li></ul>
        </div>
        <div class="card card-tint-3 reveal-up reveal-delay-3">
          <?php echo icon('fence', 28); ?>
          <h3>Outdoors and weatherproofing</h3>
          <p>Sealing gaps and mending what the weather works on.</p>
          <ul><li>Caulking and weatherproofing</li><li>Deck repair</li><li>Fence repair and small home repairs</li></ul>
        </div>
      </div>
      <div class="split-reverse">
        <div class="detail-copy reveal-left" style="display:grid;gap:var(--space-md)">
          <p>The painted bedroom in the photo shows how the list works together: a sloped ceiling and walls with fresh paint, new white baseboard along the wall, and bare subfloor still waiting for its floor. Painting, trim and floor prep happened in one room under one estimate.</p>
          <p>The window in the second photo is the same idea indoors: an arched opening whose drywall return has been finished and masked, ready for paint. When a window is replaced, that return is part of the work; see <a href="/services/siding-window-replacement/">siding and window replacement</a> for the outside half.</p>
          <p>For the larger jobs that grow out of a small repair, <a href="/services/remodeling-services/">bathroom and kitchen remodeling</a> and <a href="/services/flooring-installation/">flooring installation</a> are handled by the same company.</p>
        </div>
        <div class="reveal-right" style="display:grid;gap:var(--space-md)">
          <figure class="svc-figure ">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002319-480.avif 480w, /assets/images/1000002319-960.avif 960w, /assets/images/1000002319-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002319-960.webp" srcset="/assets/images/1000002319-480.webp 480w, /assets/images/1000002319-960.webp 960w, /assets/images/1000002319-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Bedroom under a sloped ceiling with fresh paint, new white baseboard and bare subfloor ready for new flooring" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
          <figcaption>Bedroom painted under a sloped ceiling, baseboard in, subfloor ready</figcaption>
        </figure>
          <figure class="svc-figure ">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002330-480.avif 480w, /assets/images/1000002330-960.avif 960w, /assets/images/1000002330-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002330-960.webp" srcset="/assets/images/1000002330-480.webp 480w, /assets/images/1000002330-960.webp 960w, /assets/images/1000002330-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Arched window with plantation shutters and a newly finished drywall return, masked for paint" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
          <figcaption>Arched window return finished in drywall and masked for paint</figcaption>
        </figure>
        </div>
      </div>
    </article>
  </div>
</section>

<!-- ============ ROOFING ============ -->
<section class="section edge-curve-top svc-roof" id="roofing" aria-label="Roof repair and replacement">
  <div class="container">
    <article class="split">
      <div class="detail-copy reveal-left">
        <span class="eyebrow">Roofing</span>
        <h2>Does <span class="text-accent">AP Remodeling</span> repair and replace roofs?</h2>
        <p class="answer-block">Yes. AP Remodeling Handyman List repairs and replaces roofs on homes in Elkhart and nearby towns. Roofing is priced after an estimate visit, because the size, pitch and condition of the roof set the scope of the job and whether a repair or a full replacement makes sense.</p>
        <p>Snow load, ice at the eaves and freeze-and-thaw cycles are what tend to expose weak spots on Northern Indiana roofs, so a roof that looks fine in summer can leak after the first heavy thaw. Roof problems also reach the inside: a stain on a ceiling is drywall and paint work as well as roofing, and AP Remodeling does both.</p>
        <p>Roofing meets the walls at the eaves, so <a href="/services/siding-window-replacement/">siding and window replacement</a> is often worth pricing in the same visit.</p>
      </div>
      <div class="reveal-right">
        <table class="roof-table">
          <caption>Repair or replace: what usually decides it</caption>
          <thead><tr><th scope="col">What you see</th><th scope="col">Usually points toward</th></tr></thead>
          <tbody>
            <tr><th scope="row">One leak or a few damaged spots</th><td>Repair</td></tr>
            <tr><th scope="row">Damage spread across much of the roof</th><td>Replacement</td></tr>
            <tr><th scope="row">The same area failing again after repairs</th><td>Replacement is worth pricing</td></tr>
          </tbody>
        </table>
        <p class="roof-note">The estimate visit makes the call for your roof; this table is only a starting point.</p>
      </div>
    </article>
  </div>
</section>

<?php
/* Estimate tool: authorized in build-plan.json integrations.estimate_tool; renders for the service whose pricing row maps to this page. */
$svcPrice = null;
foreach ((array) ($estimateTool['pricing'] ?? []) as $svcP) { if (($svcP['slug'] ?? '') === $serviceSlug) { $svcPrice = $svcP; break; } }
if (!empty($estimateTool['authorized']) && $svcPrice):
    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/estimate-tool.php';
    echo p1_estimate_tool(['service' => $svcPrice['service'], 'heading' => 'Want an instant estimate range for your job?']);
endif;
?>

<section class="section texture-grain slant-top svc-why " aria-label="Why choose AP Remodeling">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-why__grid">
      <div class="section-head reveal-left">
        <span class="eyebrow">Why AP Remodeling</span>
        <h2>Why call AP Remodeling for small jobs and roofs?</h2>
        <p class="answer-block">AP Remodeling Handyman List covers the small fixes and the roof from one phone number in Elkhart, and has been in business for 30+ years. A homeowner with a sagging door, a loose rail and a ceiling stain can make one call instead of three.</p>
      </div>
      <ul class="why-list reveal-right">
        <li><?php echo icon("check-circle", 22); ?><span>Drywall, paint and caulking done by the same company</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Deck and fence repair alongside interior fixes</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Roof repair and replacement priced after an estimate visit</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Open seven days a week, 9 AM to 6 PM, at <?php echo phoneLink(); ?></span></li>
      </ul>
    </div>
  </div>
</section>
<section class="section svc-process" id="process" aria-label="How the job works">
  <div class="container-narrow">
    <div class="section-head reveal-up">
      <span class="eyebrow">How It Works</span>
      <h2>How does a handyman or roofing job get scheduled?</h2>
      <p class="answer-block">A job is scheduled in four steps: tell us what needs doing, pick a weekday estimate window, walk the job with us, then set a start date. Listing every small job up front lets the visit cover them in one trip.</p>
    </div>
      <ol class="next-steps">
          <li><strong>List the jobs</strong>Call or send the form with everything on your list, small and large, and the town the house is in.</li>
          <li><strong>Request an estimate window</strong>Pick a weekday, Monday through Friday, in a two-hour window between 8 AM and 6 PM. <a href="/contact/#book-visit">Request an estimate visit</a> online or by phone.</li>
          <li><strong>Walk the job</strong>The work is looked at in person, and the scope and price are talked through before any work is scheduled.</li>
          <li><strong>Do the work</strong>Walls are patched, primed and painted, openings are caulked, and fixtures and roof work are finished.</li>
      </ol>
  </div>
</section>

<section class="section svc-faq" aria-label="Frequently asked questions">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2>What do homeowners ask before a <span class="text-accent">handyman or roofing</span> job?</h2>
      <p class="answer-block">Homeowners ask three things before a handyman or roofing job: whether the estimate is free, how the work is priced, and whether AP Remodeling works in their town. The answers below describe how the company handles estimates in Elkhart and the towns around it.</p>
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
      <h2>Which other AP Remodeling services go with handyman work?</h2>
      <p class="answer-block">A handyman list often leads into larger work: a patched wall into a bathroom remodel, a worn floor into new flooring, an old window into a replacement. AP Remodeling Handyman List handles each, so a small job never sends you looking for a new contractor.</p>
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
      <h2>Ready to get your list of jobs priced?</h2>
      <p class="answer-block">AP Remodeling Handyman List gives estimates at no charge on handyman work and roofing in Elkhart and nearby towns. Call <?php echo phoneLink(); ?> or send the form, and ask for a weekday estimate visit in a two-hour window that suits you. There is no charge for the estimate, and nothing is scheduled until you have seen the scope and the price.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
