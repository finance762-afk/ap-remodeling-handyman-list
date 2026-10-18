<?php
/**
 * header.php — skip link, fixed glass navbar, mobile overlay menu; opens <main id="main-content">.
 * Phase 2, 2026-10-18. Include after head.php. Footer.php closes <main>.
 * Loop variables are $nav-prefixed (shared-include variable rule — pages own $svc, $area, $c, $card).
 * Link integrity: Services is a link only when /services/ exists; FAQ, Blog and Service Areas appear only when built.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$navLogo = siteLogo();
// Text lockup (used until a logo file lands in /assets/images/): "AP" mark + name split into two lines.
$navWords    = preg_split('/\s+/', trim($siteName));
$navMarkText = preg_match('/^[A-Z]{2,3}$/', $navWords[0]) ? $navWords[0] : strtoupper(substr($navWords[0], 0, 1) . substr($navWords[1] ?? '', 0, 1));
$navNameTop  = implode(' ', array_slice($navWords, 0, 2));
$navNameSub  = implode(' ', array_slice($navWords, 2)) ?: ($address['city'] . ', ' . $address['state']);

$navServicesBuilt = pageBuilt('/services/');
$navAreaPath      = pageBuilt('/service-area/') ? '/service-area/' : (pageBuilt('/service-areas/') ? '/service-areas/' : '');
$navExtras = [];   // optional pages, shown only once they exist on disk
if ($navAreaPath !== '')    $navExtras[] = ['service-area', $navAreaPath, 'Service Areas'];
if (pageBuilt('/faq/'))     $navExtras[] = ['faq', '/faq/', 'FAQ'];
if (pageBuilt('/blog/'))    $navExtras[] = ['blog', '/blog/', 'Blog'];

/** One service-group's secondary line for the dropdown: "Bathroom Remodeling · Kitchen Remodeling". */
$navSub = function (array $navEntry): string {
    $navInc = array_map('shortServiceName', (array) ($navEntry['includes'] ?? []));
    return count($navInc) > 1 ? implode(' · ', $navInc) : '';
};
?>
<a href="#main-content" class="skip-link">Skip to main content</a>

<header class="site-header" data-header>
  <nav class="navbar" aria-label="Main navigation">
    <div class="navbar-inner container">

      <a class="site-logo navbar-logo" href="/" aria-label="<?php echo h($siteName); ?> — home">
<?php if ($navLogo): ?>
        <img src="<?php echo h($navLogo['src']); ?>" width="<?php echo (int) $navLogo['width']; ?>" height="<?php echo (int) $navLogo['height']; ?>" alt="<?php echo h($siteName); ?>"<?php echo $navLogo['class'] ? ' class="' . h($navLogo['class']) . '"' : ''; ?>>
<?php else: ?>
        <span class="logo-mark" aria-hidden="true"><?php echo h($navMarkText); ?></span>
        <span class="logo-text"><span class="brand-name"><?php echo h($navNameTop); ?></span><span class="brand-sub"><?php echo h($navNameSub); ?></span></span>
<?php endif; ?>
      </a>

      <ul class="navbar-links">
        <li><a href="/"<?php echo isActivePage('home') ? ' aria-current="page"' : ''; ?>>Home</a></li>
        <li class="has-dropdown">
<?php if ($navServicesBuilt): ?>
          <a href="/services/" aria-haspopup="true"<?php echo isActivePage('services') ? ' aria-current="page"' : ''; ?>>Services <?php echo icon('chevron-down', 16); ?></a>
<?php else: ?>
          <button type="button" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">Services <?php echo icon('chevron-down', 16); ?></button>
<?php endif; ?>
          <ul class="dropdown" role="menu" style="display:none">
<?php foreach ($services as $navSvc): ?>
            <li role="none"><a role="menuitem" href="/services/<?php echo h($navSvc['slug']); ?>/"><?php echo h($navSvc['name']); ?><?php if ($navSub($navSvc) !== ''): ?><small><?php echo h($navSub($navSvc)); ?></small><?php endif; ?></a></li>
<?php endforeach; ?>
          </ul>
        </li>
        <li><a href="/about/"<?php echo isActivePage('about') ? ' aria-current="page"' : ''; ?>>About</a></li>
<?php foreach ($navExtras as $navExtra): ?>
        <li><a href="<?php echo h($navExtra[1]); ?>"<?php echo isActivePage($navExtra[0]) ? ' aria-current="page"' : ''; ?>><?php echo h($navExtra[2]); ?></a></li>
<?php endforeach; ?>
        <li><a href="/contact/"<?php echo isActivePage('contact') ? ' aria-current="page"' : ''; ?>>Contact</a></li>
      </ul>

      <div class="navbar-cta">
        <a class="btn btn-secondary navbar-phone" href="tel:<?php echo h($phoneRaw); ?>" aria-label="Call <?php echo h($siteName); ?> at <?php echo h($phone); ?>"><?php echo icon('phone', 18); ?><?php echo h($phone); ?></a>
        <a class="btn btn-nav-cta" href="/contact/" data-open-estimate>Free Estimate</a>
      </div>

      <button class="hamburger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </button>

    </div>
  </nav>
</header>

<!-- Mobile overlay lives OUTSIDE <header>: the header's backdrop-filter would otherwise shrink position:fixed to bar height. main.js toggles .active + aria-hidden. -->
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
  <div class="mobile-menu-inner">
    <nav aria-label="Mobile navigation">
      <ul class="mobile-menu-links">
        <li><a href="/"<?php echo isActivePage('home') ? ' aria-current="page"' : ''; ?>>Home</a></li>
        <li>
<?php if ($navServicesBuilt): ?>
          <a href="/services/"<?php echo isActivePage('services') ? ' aria-current="page"' : ''; ?>>Services</a>
<?php else: ?>
          <span class="mm-label">Services</span>
<?php endif; ?>
          <ul class="mobile-submenu">
<?php foreach ($services as $navSvc): ?>
            <li><a href="/services/<?php echo h($navSvc['slug']); ?>/"><?php echo h($navSvc['name']); ?></a></li>
<?php endforeach; ?>
          </ul>
        </li>
        <li><a href="/about/"<?php echo isActivePage('about') ? ' aria-current="page"' : ''; ?>>About</a></li>
<?php foreach ($navExtras as $navExtra): ?>
        <li><a href="<?php echo h($navExtra[1]); ?>"<?php echo isActivePage($navExtra[0]) ? ' aria-current="page"' : ''; ?>><?php echo h($navExtra[2]); ?></a></li>
<?php endforeach; ?>
        <li><a href="/contact/"<?php echo isActivePage('contact') ? ' aria-current="page"' : ''; ?>>Contact</a></li>
      </ul>
    </nav>
    <div class="mobile-menu-cta">
      <a class="btn btn-primary btn-lg" href="tel:<?php echo h($phoneRaw); ?>"><?php echo icon('phone', 20); ?>Call <?php echo h($phone); ?></a>
      <a class="btn btn-outline-white btn-lg" href="/contact/" data-open-estimate>Free Estimate</a>
    </div>
    <p class="mobile-menu-meta"><?php echo h($businessHours); ?> · <?php echo h($address['city'] . ', ' . $address['state']); ?></p>
  </div>
</div>

<main id="main-content">
