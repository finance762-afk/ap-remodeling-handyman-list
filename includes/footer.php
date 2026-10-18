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
          <p><?php echo h($siteName); ?> is a handyman and home remodeling company in <?php echo h($footPlace); ?> with <?php echo (int) $yearsInBusiness; ?> years in business. Call for a free estimate.</p>
          <div class="footer-badges">
            <span><?php echo (int) $yearsInBusiness; ?> years in business</span>
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

      <!-- AEO entity block: NAP + offering in plain text, mirrors the LocalBusiness schema in head.php -->
      <div class="footer-entity" itemscope itemtype="https://schema.org/HomeAndConstructionBusiness" itemid="<?php echo h(rtrim($siteUrl, '/') . '/#organization'); ?>">
        <meta itemprop="name" content="<?php echo h($siteName); ?>">
        <meta itemprop="url" content="<?php echo h(rtrim($siteUrl, '/') . '/'); ?>">
        <meta itemprop="telephone" content="<?php echo h($phoneRaw); ?>">
        <p><?php echo h($siteName); ?> is a handyman and home remodeling company based in
          <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress"><span itemprop="addressLocality"><?php echo h($address['city']); ?></span>, <span itemprop="addressRegion"><?php echo h($address['state']); ?></span></span>,
          with <?php echo (int) $yearsInBusiness; ?> years in business. The company handles <?php echo h($footNameList); ?>
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

<div class="cookie-banner" id="cookie-banner" role="region" aria-label="Cookie notice">
  <p class="cookie-banner__text">We use cookies to improve your experience and analyze site usage. By continuing, you agree to our use of cookies. <a href="/cookie-policy/">Learn more</a>.</p>
  <button type="button" class="cookie-banner__dismiss" id="cookie-banner-dismiss" aria-label="Dismiss cookie notice">Got it</button>
</div>

<script src="/assets/js/main.js?v=<?php echo h($cssVersion); ?>" defer></script>
<script src="/assets/js/animations.js?v=<?php echo h($cssVersion); ?>" defer></script>
<script src="/assets/js/effects.js?v=<?php echo h($cssVersion); ?>" defer></script>
</body>
</html>
