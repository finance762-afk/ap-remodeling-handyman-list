<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
$currentPage = 'contact';
$pageType    = 'contact';

$pageTitle       = 'Contact AP Remodeling Handyman List | Elkhart, Indiana';
$pageDescription = 'Call (219) 296-5827, send the form or request a weekday estimate visit with AP Remodeling Handyman List in Elkhart, IN. Open seven days, 9 AM to 6 PM.';
$canonicalUrl    = $siteUrl . '/contact/';
$ogImage         = '/assets/images/og-default-v1.jpg';

$schemaMarkup = [
    [
        '@context'   => 'https://schema.org',
        '@type'      => 'ContactPage',
        '@id'        => $canonicalUrl . '#webpage',
        'url'        => $canonicalUrl,
        'name'       => $pageTitle,
        'about'      => ['@id' => rtrim($siteUrl, '/') . '/#organization'],
    ],
    generateBreadcrumbSchema([
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Contact', 'url' => '/contact/'],
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
.contact-main { background: var(--color-paper); }
.contact-main .estimate { max-width: calc(var(--max-width) + var(--space-4xl)); margin-inline: auto; }
.contact-main .card { display: grid; gap: var(--space-sm); }
.contact-main .card > .answer-block { margin: 0; }
.contact-main .estimate-form .btn { margin-top: var(--space-xs); }
.contact-main .contact-aside { display: grid; gap: var(--space-sm); padding-top: var(--space-md); align-content: start; }
.contact-main .contact-aside h2 { font-size: var(--fs-h3); }
.contact-main .contact-aside .answer-block { margin: 0; }
.contact-main .nap a:hover { color: var(--color-primary); text-decoration: underline; }
.contact-map { background: var(--color-surface); }
.contact-map .map-links { margin: var(--space-md) 0 0; font-size: var(--fs-small); }
.contact-map .map-links a { color: var(--color-primary); font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: var(--space-1); }
</style>

<!-- ============ HERO ============ -->
<section class="hero hero--interior texture-grain svc-hero" aria-label="Contact introduction">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-copy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li>
          <li class="breadcrumb-sep" aria-hidden="true">›</li>
          <li aria-current="page">Contact</li>
        </ol>
      </nav>
      <span class="eyebrow">Contact · Elkhart, IN</span>
      <h1 class="hero-title">Contact AP Remodeling Handyman List in Elkhart, IN</h1>
      <p class="hero-answer">Call <?php echo phoneLink(); ?>, send the form or request a weekday estimate visit. AP Remodeling answers seven days a week, 9 AM to 6 PM, and works in eleven towns across Northern Indiana and Southwest Michigan from its base in Elkhart.</p>
      
    </div>
  </div>
</section>

<?php
/* Booking window: authorized in build-plan.json integrations.booking. It is a request; the owner confirms. */
if (!empty($bookingWindows['authorized'])):
    require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/booking-window.php';
    echo p1_booking_window(['heading' => 'When can I request an estimate visit?']);
endif;
?>

<!-- ============ CONTACT FORM + DETAILS ============ -->
<section class="section sec-body contact-main" id="contact-form" aria-label="Contact form and details">
  <div class="container-wide">
    <div class="estimate">

      <div class="card reveal-left">
        <span class="eyebrow">Send a Message</span>
        <h2>How do I send AP Remodeling Handyman List my project details?</h2>
        <p class="answer-block">Fill in the form with your name, phone, email and the work you need, and AP Remodeling Handyman List follows up by phone or email. The service and message fields help the estimate visit start with the right questions, and the town the house is in helps most.</p>
        <form action="<?php echo h($formAction); ?>" method="POST" class="estimate-form">
          <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
          <input type="hidden" name="_next" value="<?php echo h($siteUrl); ?>/thank-you">
          <input type="hidden" name="form_location" value="contact">
          <input type="hidden" name="consent_version" value="v2.1">
          <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
          <?php echo p1_attribution_fields('contact'); ?>

          <div class="form-grid">
            <div class="field">
              <label for="contact-name">Your Name</label>
              <input id="contact-name" type="text" name="name" autocomplete="name" required>
            </div>
            <div class="field">
              <label for="contact-phone">Phone</label>
              <input id="contact-phone" type="tel" name="phone" autocomplete="tel" required>
            </div>
            <div class="field">
              <label for="contact-email">Email</label>
              <input id="contact-email" type="email" name="email" autocomplete="email" required>
            </div>
            <div class="field">
              <label for="contact-service">Service Needed</label>
              <select id="contact-service" name="service">
                <option value="">Select a service</option>
<?php foreach ($services as $contactOpt): ?>
                <option value="<?php echo h($contactOpt['name']); ?>"><?php echo h($contactOpt['name']); ?></option>
<?php endforeach; ?>
              </select>
            </div>
            <div class="field full">
              <label for="contact-message">Project Details</label>
              <textarea id="contact-message" name="message" rows="5" placeholder="What needs fixing or remodeling, and which town is the house in?"></textarea>
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

      <div class="contact-aside reveal-right">
        <h2>How else can I reach AP Remodeling Handyman List?</h2>
        <p class="answer-block">AP Remodeling Handyman List is easiest to reach by phone at <?php echo phoneLink(); ?>, seven days a week from 9 AM to 6 PM. Email works too, and the form on this page goes to the same place. Estimate visits are scheduled Monday through Friday in two-hour windows.</p>
        <div class="nap">
          <div><?php echo icon('phone', 18); ?><a href="tel:<?php echo h($phoneRaw); ?>"><?php echo h($phone); ?></a></div>
          <div><?php echo icon('mail', 18); ?><a href="mailto:<?php echo h($email); ?>"><?php echo h($email); ?></a></div>
          <div><?php echo icon('map-pin', 18); ?><span><?php echo h($siteName); ?><br><?php echo h($address['city'] . ', ' . $address['state']); ?></span></div>
          <div><?php echo icon('clock', 18); ?><span><?php echo h($businessHours); ?></span></div>
        </div>
        <ol class="next-steps">
          <li><strong>Send the form or call</strong>Tell us what needs doing and which town the house is in.</li>
          <li><strong>Pick an estimate window</strong>Visits run Monday through Friday in two-hour windows, 8 AM to 6 PM.</li>
          <li><strong>See the scope and the price</strong>The job is walked through in person before any work is scheduled.</li>
        </ol>
      </div>

    </div>
  </div>
</section>

<!-- ============ MAP ============ -->
<section class="section edge-curve-top sec-body contact-map" aria-label="Where we work">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Where We Work</span>
      <h2>Where does AP Remodeling Handyman List work around Elkhart?</h2>
      <p class="answer-block">AP Remodeling Handyman List is based in Elkhart, Indiana, and works in eleven towns across Northern Indiana and Southwest Michigan. The map shows the Elkhart area, and the service area page lists every town and what sits near each one.</p>
    </div>
    <div class="map-embed reveal-scale">
      <iframe src="<?php echo h($gbpMapEmbedSrc); ?>" title="Map of the Elkhart, Indiana area where AP Remodeling Handyman List works" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <p class="map-links"><a href="/service-area/">See all eleven towns we serve</a> · <a href="<?php echo h($gbpUrl); ?>" target="_blank" rel="noopener">View us on Google</a></p>
  </div>
</section>

<section class="cta-banner texture-grain edge-parallelogram-top cta-close" aria-label="Request a free estimate">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring float-animate" aria-hidden="true"></span>
  <div class="container">
    <div class="reveal-up">
      <span class="eyebrow">Next step</span>
      <h2>Prefer to talk it through first?</h2>
      <p class="answer-block">AP Remodeling Handyman List picks up the phone seven days a week from 9 AM to 6 PM. Call <?php echo phoneLink(); ?> to describe the job, ask whether your town is covered, and set up a free estimate visit on a weekday in a two-hour window that suits you.</p>
    </div>
    <div class="actions reveal-scale">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request an estimate</button>
      <a class="btn btn-outline-white btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call <?php echo h($phone); ?></a>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
