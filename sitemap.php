<?php
/**
 * sitemap.php — dynamic XML sitemap. .htaccess rewrites /sitemap.xml to this file; never ship a static sitemap.xml.
 * Pages come from config.php ($services, $serviceAreas) plus the static page list below. Nothing is hand-listed
 * per service: a new $services entry appears here automatically once its /services/<slug>/index.php exists.
 * Every URL is the trailing-slash directory form and must match the page's canonical exactly.
 * Variables are $sm-prefixed (shared-variable rule). Thank-you and 404 are noindex and never listed.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

header_remove('Set-Cookie'); // config.php drops the lead-attribution cookie; crawlers don't need it
header('Content-Type: application/xml; charset=utf-8');

$smRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$smBase = rtrim($siteUrl, '/');

/** lastmod = the page file's modified date (falls back to today for a path with no file). */
$smLastmod = function (string $path) use ($smRoot): string {
    $trimmed = trim($path, '/');
    $candidates = $trimmed === '' ? [$smRoot . '/index.php'] : [$smRoot . '/' . $trimmed . '/index.php', $smRoot . '/' . $trimmed . '.php'];
    foreach ($candidates as $file) {
        if (is_file($file)) return date('Y-m-d', filemtime($file));
    }
    return date('Y-m-d');
};

// [path, changefreq, priority] — only pages that exist on disk are emitted.
$smPages = [
    ['/', 'weekly', '1.0'],
    ['/services/', 'monthly', '0.8'],
];
foreach ($services as $smService) {
    $smPages[] = ['/services/' . $smService['slug'] . '/', 'monthly', '0.8'];
}
$smPages[] = ['/about/', 'monthly', '0.6'];
$smPages[] = ['/contact/', 'monthly', '0.6'];
$smPages[] = ['/service-area/', 'monthly', '0.6'];
$smPages[] = ['/faq/', 'monthly', '0.6'];
$smPages[] = ['/blog/', 'weekly', '0.6'];
foreach ($serviceAreas as $smArea) {
    $smPages[] = ['/areas/' . getAreaSlug($smArea) . '/', 'monthly', '0.6']; // individual area pages, once built
}
// Compliance pages: indexable, low priority, yearly.
foreach (['/privacy-policy/', '/terms/', '/cookie-policy/', '/accessibility/'] as $smLegal) {
    $smPages[] = [$smLegal, 'yearly', '0.3'];
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($smPages as [$smPath, $smFreq, $smPriority]): if (!pageBuilt($smPath)) continue; ?>
  <url>
    <loc><?php echo htmlspecialchars($smBase . $smPath, ENT_XML1); ?></loc>
    <lastmod><?php echo $smLastmod($smPath); ?></lastmod>
    <changefreq><?php echo $smFreq; ?></changefreq>
    <priority><?php echo $smPriority; ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
