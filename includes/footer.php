<?php
/**
 * footer.php — closes <main>; footer grid, AEO entity block, legal row, credit, partner badge,
 * back-to-top, mobile CTA bar, cookie bar, deferred scripts; closes </body></html>.
 * Phase 2, 2026-10-18. Loop variables are $foot-prefixed (shared-include variable rule).
 * ADDRESS: build-plan has no street (city + state only), so only city/state are printed anywhere.
 * SMS: integrations.accepts_sms is false → no "Text Us" button and no text-us component.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$footLogo   = siteLogo();
$footWords  = preg_split('/\s+/', trim($siteName));
$footMark   = preg_match('/^[A-Z]{2,3}$/', $footWords[0]) ? $footWords[0] : strtoupper(substr($footWords[0], 0, 1) . substr($footWords[1] ?? '', 0, 1));
$footTop    = implode(' ', array_slice($footWords, 0, 2));
$footSub    = implode(' ', array_slice($footWords, 2)) ?: ($address['city'] . ', ' . $address['state']);
$footPlace  = $address['city'] . ', ' . $address['state'];
$footAreaHub = pageBuilt('/service-area/') ? '/service-area/' : (pageBuilt('/service-areas/') ? '/service-areas/' : '');

// Individual services, for the entity paragraph (names only — "Roofing (roof repair & replacement)" → "Roofing").
$footNames = [];
foreach ($services as $footSvc) {
    foreach ((array) ($footSvc['includes'] ?? [$footSvc['name']]) as $footInc) $footNames[] = strtolower(shortServiceName($footInc));
}
$footNameList = count($footNames) > 1 ? implode(', ', array_slice($footNames, 0, -1)) . ' and ' . end($footNames) : implode('', $footNames);
$footCities   = array_map(fn($footA) => cityFromArea($footA)[0], array_slice($serviceAreas, 0, 3));
$footBook     = !empty($bookingWindows['authorized']) && pageBuilt('/book/');
?>
</main>

<footer class="site-footer">
  <div class="footer-top">
    <div class="container">
      <div class="footer-grid">

        <div class="footer-brand footer-col">
          <a class="site-logo" href="/" aria-label="<?php echo h($siteName); ?> — home">
<?php if ($footLogo): ?>
            <img class="footer-logo-img" src="<?php echo h($footLogo['src']); ?>" width="<?php echo (int) $footLogo['width']; ?>" height="<?php echo (int) $footLogo['height']; ?>" alt="<?php echo h($siteName); ?>" loading="lazy" decoding="async">
<?php else: ?>
            <span class="logo-mark" aria-hidden="true"><?php echo h($footMark); ?></span>
            <span class="logo-text"><span class="brand-name"><?php echo h($footTop); ?></span><span class="brand-sub"><?php echo h($footSub); ?></span></span>
<?php endif; ?>
          </a>
          <p><?php echo h($siteName); ?> is a handyman and home remodeling company in <?php echo h($footPlace); ?> with <?php echo h($yearsLabel); ?> years in business. Call for a free estimate.</p>
          <div class="footer-badges">
            <span><?php echo h($yearsLabel); ?> years in business</span>
            <span>Free estimates</span>
            <span><?php echo h($footPlace); ?></span>
          </div>
<?php if (!empty($socialLinks)): ?>
          <ul class="footer-social" aria-label="Social profiles">
<?php foreach ($socialLinks as $footNet => $footUrl): ?>
            <li><a href="<?php echo h($footUrl); ?>" target="_blank" rel="noopener"><?php echo h(ucfirst((string) $footNet)); ?></a></li>
<?php endforeach; ?>
          </ul>
<?php endif; ?>
        </div>

        <div class="footer-col">
          <p class="footer-heading">Services</p>
          <ul>
<?php foreach ($services as $footSvc): ?>
            <li><a href="/services/<?php echo h($footSvc['slug']); ?>/"><?php echo h($footSvc['name']); ?></a></li>
<?php endforeach; ?>
<?php if (pageBuilt('/services/')): ?>
            <li><a href="/services/">All Services</a></li>
<?php endif; ?>
<?php if (pageBuilt('/faq/')): ?>
            <li><a href="/faq/">FAQ</a></li>
<?php endif; ?>
<?php if (pageBuilt('/blog/')): ?>
            <li><a href="/blog/">Blog</a></li>
<?php endif; ?>
          </ul>
        </div>

        <div class="footer-col">
          <p class="footer-heading">Service Areas</p>
          <ul class="footer-areas">
<?php foreach ($serviceAreas as $footArea): $footAreaSlug = getAreaSlug($footArea); ?>
<?php if (is_dir($_SERVER['DOCUMENT_ROOT'] . '/areas/' . $footAreaSlug)): ?>
            <li><a href="/areas/<?php echo h($footAreaSlug); ?>/"><?php echo h($footArea); ?></a></li>
<?php elseif ($footAreaHub !== ''): ?>
            <li><a href="<?php echo h($footAreaHub); ?>#<?php echo h($footAreaSlug); ?>"><?php echo h($footArea); ?></a></li>
<?php else: ?>
            <li><?php echo h($footArea); ?></li>
<?php endif; ?>
<?php endforeach; ?>
          </ul>
          <p class="footer-radius">Serving homes within about <?php echo (int) $targetRadius; ?> miles of <?php echo h($address['city']); ?>.</p>
<?php if ($footAreaHub !== ''): ?>
          <a class="footer-more" href="<?php echo h($footAreaHub); ?>">View All Areas →</a>
<?php endif; ?>
        </div>

        <div class="footer-col">
          <p class="footer-heading">Contact</p>
          <div class="footer-nap">
            <div><?php echo icon('phone', 18); ?><a href="tel:<?php echo h($phoneRaw); ?>"><?php echo h($phone); ?></a></div>
            <div><?php echo icon('mail', 18); ?><a href="mailto:<?php echo h($email); ?>"><?php echo h($email); ?></a></div>
            <div><?php echo icon('map-pin', 18); ?><span><?php echo h($siteName); ?><br><?php echo h($footPlace); ?></span></div>
            <div><?php echo icon('clock', 18); ?><span><?php echo h($businessHours); ?></span></div>
          </div>
          <a class="footer-gbp" href="<?php echo h($gbpUrl); ?>" target="_blank" rel="noopener">View us on Google ↗</a><br>
          <a class="btn btn-primary" href="/contact/" data-open-estimate>Get a Free Estimate</a>
        </div>

      </div>

      <!-- Location: same GBP place embed as /contact/ and /service-area/. Lazy, fixed aspect-ratio box (no layout shift). -->
      <section class="footer-map" aria-label="<?php echo h($siteName); ?> location">
        <div class="footer-map__text">
          <p class="footer-heading">Find Us</p>
          <p><?php echo h($siteName); ?> is based in <?php echo h($footPlace); ?> and works in towns across Northern Indiana and Southwest Michigan.</p>
          <a class="footer-gbp" href="<?php echo h($directionsUrl); ?>" target="_blank" rel="noopener">Get directions ↗</a>
        </div>
        <div class="footer-map__frame">
          <iframe src="<?php echo h($gbpMapEmbedSrc); ?>" title="Google map showing <?php echo h($siteName); ?> in <?php echo h($footPlace); ?>" width="800" height="300" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </section>

      <!-- AEO entity block: NAP + offering in plain text, mirrors the LocalBusiness schema in head.php -->
      <div class="footer-entity" itemscope itemtype="https://schema.org/HomeAndConstructionBusiness" itemid="<?php echo h(rtrim($siteUrl, '/') . '/#organization'); ?>">
        <meta itemprop="name" content="<?php echo h($siteName); ?>">
        <meta itemprop="url" content="<?php echo h(rtrim($siteUrl, '/') . '/'); ?>">
        <meta itemprop="telephone" content="<?php echo h($phoneRaw); ?>">
        <p><?php echo h($siteName); ?> is a handyman and home remodeling company based in
          <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress"><span itemprop="addressLocality"><?php echo h($address['city']); ?></span>, <span itemprop="addressRegion"><?php echo h($address['state']); ?></span></span>,
          with <?php echo h($yearsLabel); ?> years in business. The company handles <?php echo h($footNameList); ?>
          for homeowners in <?php echo h(implode(', ', array_slice($footCities, 0, -1)) . ' and ' . end($footCities)); ?> and nearby communities in Northern Indiana and Southwest Michigan.
          Free estimates: <a href="tel:<?php echo h($phoneRaw); ?>"><?php echo h($phone); ?></a>.</p>
      </div>

      <div class="footer-legal-row">
        <nav class="footer-legal-links" aria-label="Legal">
          <a href="/privacy-policy/">Privacy Policy</a>
          <span class="divider footer-legal-divider" aria-hidden="true">|</span>
          <a href="/terms/">Terms of Service</a>
          <span class="divider footer-legal-divider" aria-hidden="true">|</span>
          <a href="/cookie-policy/">Cookie Policy</a>
          <span class="divider footer-legal-divider" aria-hidden="true">|</span>
          <a href="/accessibility/">Accessibility</a>
          <span class="divider footer-legal-divider" aria-hidden="true">|</span>
          <a href="/privacy-policy/#ccpa-rights">Do Not Sell or Share My Personal Information</a>
          <span class="divider footer-legal-divider" aria-hidden="true">|</span>
          <a href="/sitemap.xml">Sitemap</a>
        </nav>
      </div>
    </div>
  </div>

  <div class="footer-bottom footer-bottom-bar">
    <div class="container footer-bottom-inner">
      <span class="footer-copy">© <?php echo date('Y'); ?> <?php echo h($siteName); ?>. All rights reserved.</span>
      <p class="footer-credit"><a href="https://pageoneinsights.com" rel="dofollow" target="_blank">Web Design & Hosting by Page One Insights, LLC</a></p>
    </div>
  </div>

  <?php include __DIR__ . '/partner-badge.php'; ?>
</footer>

<button type="button" class="back-to-top" aria-label="Back to top"><?php echo icon('chevron-down', 22, 'icon-flip'); ?></button>

<!-- Sticky mobile bar: appears once the hero scrolls away (main.js). Two buttons — SMS is not accepted for this client. -->
<div class="mobile-cta-bar<?php echo $footBook ? ' mobile-cta-bar--3' : ''; ?>" aria-label="Quick contact">
  <a class="mobile-cta-bar__call" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 18); ?>Call Now</a>
  <a class="mobile-cta-bar__estimate" href="/contact/" data-open-estimate>Free Estimate</a>
<?php if ($footBook): ?>
  <a class="mobile-cta-bar__text" href="/book/">Book a Time</a>
<?php endif; ?>
</div>

<!-- Estimate dialog: every [data-open-estimate] opens it (main.js). Full contact form, ids prefixed dlg-. -->
<dialog class="estimate-dialog" id="estimate-dialog" aria-labelledby="estimate-dialog-title">
  <div class="dialog-head">
    <div>
      <h3 id="estimate-dialog-title">Get a free estimate</h3>
      <p class="footnote">No obligation. Tell us about the job and we'll be in touch.</p>
    </div>
    <button type="button" class="dialog-close" aria-label="Close" data-close-estimate><?php echo icon('x', 20); ?></button>
  </div>
  <div class="dialog-body">
    <form action="<?php echo h($formAction); ?>" method="POST" class="estimate-form">
      <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="hidden" name="_next" value="<?php echo h($siteUrl); ?>/thank-you">
      <input type="hidden" name="form_location" value="dialog">
      <input type="hidden" name="consent_version" value="v2.1">
      <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
      <?php echo p1_attribution_fields('dialog'); ?>

      <div class="form-grid">
        <div class="field">
          <label for="dlg-name">Your Name</label>
          <input id="dlg-name" type="text" name="name" autocomplete="name" required>
        </div>
        <div class="field">
          <label for="dlg-phone">Phone</label>
          <input id="dlg-phone" type="tel" name="phone" autocomplete="tel" required>
        </div>
        <div class="field">
          <label for="dlg-email">Email</label>
          <input id="dlg-email" type="email" name="email" autocomplete="email" required>
        </div>
        <div class="field">
          <label for="dlg-service">Service Needed</label>
          <select id="dlg-service" name="service">
            <option value="">Select a service</option>
<?php foreach ($services as $footOpt): ?>
            <option value="<?php echo h($footOpt['name']); ?>"><?php echo h($footOpt['name']); ?></option>
<?php endforeach; ?>
          </select>
        </div>
        <div class="field full">
          <label for="dlg-message">Project Details</label>
          <textarea id="dlg-message" name="message" rows="3" placeholder="What needs fixing or remodeling, and which town is the house in?"></textarea>
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

      <button type="submit" class="btn btn-primary btn-block btn-lg">Send my estimate request</button>
    </form>
  </div>
</dialog>

<div class="cookie-banner" id="cookie-banner" role="region" aria-label="Cookie notice">
  <p class="cookie-banner__text">We use cookies to improve your experience and analyze site usage. By continuing, you agree to our use of cookies. <a href="/cookie-policy/">Read the cookie policy</a>.</p>
  <button type="button" class="cookie-banner__dismiss" id="cookie-banner-dismiss" aria-label="Dismiss cookie notice">Got it</button>
</div>

<script src="/assets/js/main.js?v=<?php echo h($cssVersion); ?>" defer></script>
<script src="/assets/js/animations.js?v=<?php echo h($cssVersion); ?>" defer></script>
<script src="/assets/js/effects.js?v=<?php echo h($cssVersion); ?>" defer></script>
</body>
</html>
