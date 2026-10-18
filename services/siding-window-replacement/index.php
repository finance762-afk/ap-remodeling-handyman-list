<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ------------------------------------------------------------------ *
 * Siding & Window Replacement — AP Remodeling Handyman List (Phase 4, 2026-10-18)
 * Archetype: warm-human · Tier: basic. Every fact traces to build-plan.json / config.php
 * or to what the client's own job photos show. Facts the page wanted but intake did not
 * supply are listed in /content-confirmations.json, not invented.
 * ------------------------------------------------------------------ */

$currentPage = 'services';
$pageType    = 'service';
$serviceSlug = 'siding-window-replacement';

$pageTitle       = 'Siding & Window Replacement Elkhart, IN | AP Remodeling Handyman List';
$pageDescription = 'Siding and window replacement in Elkhart, IN from AP Remodeling Handyman List, with trim, caulking and drywall returns finished. Free estimates.';
$canonicalUrl    = $siteUrl . '/services/' . $serviceSlug . '/';
$ogImage         = '/assets/images/og-default-v1.jpg';

/* FAQs — questions from the research brief and intake only (0–4 per page; none invented). */
$faqs = [
    [
        'q' => 'Is a siding or window estimate free?',
        'a' => 'Yes. AP Remodeling Handyman List does not charge to look at siding or windows and price the job. Estimate visits run Monday through Friday in two-hour windows between 8 AM and 6 PM, and you decide afterward whether to go ahead.',
    ],
    [
        'q' => 'How is siding or window replacement priced?',
        'a' => 'Each job is priced after the estimate visit, once the number of windows or the amount of siding, and the work around them, are known. The estimate costs nothing.',
    ],
    [
        'q' => 'Do you replace siding and windows in my town?',
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
        ['name' => 'Siding & Window Replacement', 'url' => '/services/' . $serviceSlug . '/'],
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

.svc-detail .svc-figure { clip-path: polygon(12% 0, 100% 0, 100% 100%, 0 100%, 0 8%); }
.svc-process { background: var(--color-paper); }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--interior texture-grain svc-hero" aria-label="Siding &amp; Window Replacement introduction">
  <span class="grain-layer" aria-hidden="true"></span>
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
          <li aria-current="page">Siding &amp; Window Replacement</li>
        </ol>
      </nav>
        <span class="eyebrow">Services · Siding &amp; Windows</span>
        <h1 class="hero-title">Siding and window replacement in Elkhart, Indiana</h1>
        <p class="hero-answer">AP Remodeling Handyman List replaces siding and windows on Elkhart-area homes, then finishes the openings with trim, caulk and paint. The Elkhart company has 32 years in business and prices each job after an in-person estimate visit on a weekday.</p>
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
          <li><?php echo icon('shield-check', 16); ?>Caulking and weatherproofing included</li>
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

<section class="section svc-detail" id="what-is-included" aria-label="What siding and window replacement covers">
  <div class="container">
    <article class="split-reverse">
      <div class="detail-copy reveal-right">
        <span class="eyebrow">Siding &amp; Windows</span>
        <h2>What does siding and window replacement with <span class="text-accent">AP Remodeling</span> cover?</h2>
        <p class="answer-block">Siding and window replacement with AP Remodeling Handyman List covers removing the old siding or window, setting the new one, and sealing and finishing the opening inside and out. The same company handles the trim, caulking and drywall around each window.</p>
        <p>AP Remodeling Handyman List is a handyman and remodeling company in Elkhart, Indiana, owned by Charles Poe and in business for 32 years.</p>
        <p>The photo shows the inside half of a window job: an arched window with plantation shutters, its drywall return finished smooth and masked off for paint. A window can be set correctly and still look unfinished from indoors if the return, trim and paint are left for someone else.</p>
        <p>Northern Indiana houses take lake-effect snow, freezing rain and repeated freeze-and-thaw swings, and each of those finds gaps in aging siding and window seals. Caulking and weatherproofing are already on the AP Remodeling handyman list, so sealing a new opening is part of the job, not an extra call.</p>
        <p>Siding replacement starts with a question the estimate visit answers: what is behind the old siding. What is found there sets the scope, which is why the price is set after the visit. Roofing meets siding at the eaves, so see <a href="/services/additional-services/#roofing">roof repair and replacement</a> if the two belong in one estimate.</p>
      </div>
      <figure class="svc-figure reveal-left">
          <picture>
            <source type="image/avif" srcset="/assets/images/1000002330-480.avif 480w, /assets/images/1000002330-960.avif 960w, /assets/images/1000002330-1600.avif 1600w" sizes="(max-width: 900px) 100vw, 480px">
            <img src="/assets/images/1000002330-960.webp" srcset="/assets/images/1000002330-480.webp 480w, /assets/images/1000002330-960.webp 960w, /assets/images/1000002330-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 480px" alt="Arched window with plantation shutters and a newly finished drywall return, masked for paint" width="960" height="1280" loading="lazy" decoding="async">
          </picture>
          <figcaption>Arched window return finished in drywall and masked for paint</figcaption>
        </figure>
    </article>
  </div>
</section>

<section class="section svc-process" id="process" aria-label="How the job works">
  <div class="container-narrow">
    <div class="section-head reveal-up">
      <span class="eyebrow">How It Works</span>
      <h2>How does a siding or window replacement job work?</h2>
      <p class="answer-block">A siding or window job runs in four steps: estimate visit, removal and inspection of the opening, installation, and sealing and finish work. The estimate visit sets the scope, since what is behind the old siding or window decides how much work the job takes.</p>
    </div>
      <ol class="timeline svc-timeline">
        <li><b>Estimate visit</b><p>The windows and siding walls are looked at in person, and the scope and price are talked through before any work is scheduled.</p></li>
        <li><b>Remove the old siding or window</b><p>The old unit comes out, and the opening is looked at before the new one goes in.</p></li>
        <li><b>Install the new unit</b><p>The window or siding is set and fastened to the house.</p></li>
        <li><b>Seal and finish</b><p>Gaps are caulked and weatherproofed, trim goes on, and inside returns are finished in drywall and painted.</p></li>
      </ol>
  </div>
</section>

<section class="section texture-grain edge-curve-top svc-why " aria-label="Why choose AP Remodeling">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-why__grid">
      <div class="section-head reveal-left">
        <span class="eyebrow">Why AP Remodeling</span>
        <h2>Why use one company for siding, windows and the finish work?</h2>
        <p class="answer-block">AP Remodeling Handyman List replaces the siding or window and also finishes the drywall, trim, caulk and paint around it. One company covering the outside and inside of an opening leaves no gap between trades, which is where leaks and unfinished edges tend to show up.</p>
      </div>
      <ul class="why-list reveal-right">
        <li><?php echo icon("check-circle", 22); ?><span>Windows set and the inside drywall return finished smooth</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Trim, caulking and weatherproofing handled by the same company</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>Paint-ready openings, masked off before the paint goes on</span></li>
        <li><?php echo icon("check-circle", 22); ?><span>An in-person estimate visit, Monday through Friday, before any work is scheduled</span></li>
      </ul>
    </div>
  </div>
</section>
<section class="section svc-faq" aria-label="Frequently asked questions">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2>What do homeowners ask before replacing <span class="text-accent">siding or windows</span>?</h2>
      <p class="answer-block">Homeowners ask three things before replacing siding or windows: whether the estimate is free, how the job is priced, and whether AP Remodeling works in their town. The answers below describe how the company handles estimates in Elkhart and the towns around it.</p>
    </div>
    <div class="faq-grid">
<?php foreach (array_chunk($faqs, (int) ceil(count($faqs) / 2)) as $faqColIdx => $faqCol): ?>
      <div class="faq-col <?php echo $faqColIdx === 0 ? 'reveal-left' : 'reveal-right'; ?>">
<?php foreach ($faqCol as $faqIdx => $faq): ?>
        <details class="faq"<?php echo ($faqColIdx === 0 && $faqIdx === 0) ? ' open' : ''; ?>>
          <summary><?php echo h($faq['q']); ?></summary>
          <p><?php echo h($faq['a']); ?></p>
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
      <h2>Which other AP Remodeling services go with siding and windows?</h2>
      <p class="answer-block">Siding and window work often sits next to roofing at the eaves, flooring inside, and drywall and paint on the walls. AP Remodeling Handyman List handles each of these, so one estimate visit can cover several parts of the same house.</p>
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
          <h3>Handyman &amp; Roofing</h3>
          <p class="service-card__desc">Drywall, paint, doors, fixtures, deck and fence fixes, plus roof repair and replacement.</p>
          <ul>
            <li>Drywall patched, taped and painted</li>
            <li>TV mounts, shelving, furniture assembly</li>
            <li>Roof repair and full replacement</li>
          </ul>
          <a href="/services/additional-services/" class="service-card__cta">Learn more</a>
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
          <a href="/services/flooring-installation/" class="service-card__cta">Learn more</a>
        </div>
      </article>
      <article class="service-card-with-image card-tint-3 reveal-up reveal-delay-3">
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
          <a href="/services/remodeling-services/" class="service-card__cta">Learn more</a>
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
      <h2>Ready to price your siding or window project?</h2>
      <p class="answer-block">AP Remodeling Handyman List gives free siding and window estimates in Elkhart and nearby towns. Call <?php echo h($phone); ?> or send the form, and ask for a weekday estimate visit in a two-hour window that suits you. There is no charge for the estimate, and nothing is scheduled until you have seen the scope and the price.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
