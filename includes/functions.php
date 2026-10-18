<?php
/**
 * functions.php — shared helpers for head.php / header.php / footer.php and pages.
 * Phase 2, 2026-10-18. Every function is guarded so the file can be required from any include.
 * Shared-include variable rule: locals inside these functions never reuse page names ($svc, $area, $c, $card).
 */

if (!function_exists('h')) {
    /** Escape for HTML text and attribute values. */
    function h($value): string {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

// ── Request / navigation state ──────────────────────────────

if (!function_exists('requestPath')) {
    /** Request path with no query string and no trailing index.php, always starting with "/". */
    function requestPath(): string {
        $fnPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $fnPath = preg_replace('#/index\.php$#', '/', $fnPath);
        $fnPath = preg_replace('#\.php$#', '', $fnPath);
        return '/' . ltrim($fnPath, '/');
    }
}

if (!function_exists('isActivePage')) {
    /** True when $page is the current page: matches $currentPage, or the first URL segment. 'home' = "/". */
    function isActivePage(string $page): bool {
        global $currentPage;
        if (isset($currentPage) && $currentPage === $page) return true;
        $fnPath = requestPath();
        if ($page === 'home') return $fnPath === '/';
        return $fnPath === '/' . $page . '/' || $fnPath === '/' . $page || strpos($fnPath, '/' . $page . '/') === 0;
    }
}

if (!function_exists('pageBuilt')) {
    /** Link-integrity gate: true only when $path ("/about/") exists on disk as a directory index or a flat .php. */
    function pageBuilt(string $path): bool {
        $fnRoot = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/');
        $fnPath = trim($path, '/');
        if ($fnPath === '') return is_file($fnRoot . '/index.php');
        return is_file($fnRoot . '/' . $fnPath . '/index.php') || is_file($fnRoot . '/' . $fnPath . '.php');
    }
}

// ── Formatting / slugs ──────────────────────────────────────

if (!function_exists('formatPhone')) {
    /** "+12192965827" or "219.296.5827" → "(219) 296-5827". Returns the input unchanged if it is not 10/11 digits. */
    function formatPhone(string $phone): string {
        $fnDigits = preg_replace('/\D+/', '', $phone);
        if (strlen($fnDigits) === 11 && $fnDigits[0] === '1') $fnDigits = substr($fnDigits, 1);
        if (strlen($fnDigits) !== 10) return $phone;
        return '(' . substr($fnDigits, 0, 3) . ') ' . substr($fnDigits, 3, 3) . '-' . substr($fnDigits, 6);
    }
}

if (!function_exists('slugify')) {
    function slugify(string $text): string {
        $fnSlug = strtolower(str_replace('&', ' and ', $text));
        $fnSlug = preg_replace('/[^a-z0-9]+/', '-', $fnSlug);
        return trim($fnSlug, '-');
    }
}

if (!function_exists('getServiceSlug')) {
    /** Slug for a service name. Uses the config.php slug when the name matches a $services entry. */
    function getServiceSlug(string $name): string {
        global $services;
        foreach ((array) ($services ?? []) as $fnEntry) {
            if (is_array($fnEntry) && strcasecmp($fnEntry['name'] ?? '', $name) === 0 && !empty($fnEntry['slug'])) {
                return $fnEntry['slug'];
            }
        }
        return slugify($name);
    }
}

if (!function_exists('getAreaSlug')) {
    /** "South Bend, IN" → "south-bend". State suffix is dropped. */
    function getAreaSlug(string $city): string {
        return slugify(preg_replace('/,\s*[A-Za-z]{2}$/', '', $city));
    }
}

if (!function_exists('shortServiceName')) {
    /** "Handyman Services (drywall repair, …)" → "Handyman Services"; "Roofing (roof repair & replacement)" → "Roofing". */
    function shortServiceName(string $name): string {
        return trim(preg_replace('/\s*\(.*$/', '', $name));
    }
}

if (!function_exists('keywordCore')) {
    /** Primary keyword without its trailing city/state: "handyman elkhart in" → "Handyman". */
    function keywordCore(): string {
        global $primaryKeyword, $address;
        $fnKw = trim((string) ($primaryKeyword ?? ''));
        $fnCity = preg_quote((string) ($address['city'] ?? ''), '/');
        $fnState = preg_quote((string) ($address['state'] ?? ''), '/');
        if ($fnCity !== '') $fnKw = preg_replace('/\s+' . $fnCity . '(\s+' . $fnState . ')?$/i', '', $fnKw);
        return ucwords($fnKw);
    }
}

if (!function_exists('cityFromArea')) {
    /** Split "Niles, MI" → ['Niles', 'MI']. */
    function cityFromArea(string $area): array {
        $fnParts = array_map('trim', explode(',', $area, 2));
        return [$fnParts[0], $fnParts[1] ?? ''];
    }
}

// ── Icons (inline SVG at build time — never runtime injection) ──

if (!function_exists('icon')) {
    /**
     * Echo-ready inline SVG from references/lucide-icons/<name>.svg with aria-hidden, width/height and an optional class.
     * Returns '' when the file is missing so a bad name never breaks the page.
     */
    function icon(string $name, int $size = 20, string $class = ''): string {
        static $fnCache = [];
        if (!preg_match('/^[a-z0-9-]+$/', $name)) return '';
        if (!isset($fnCache[$name])) {
            $fnFile = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/') . '/references/lucide-icons/' . $name . '.svg';
            $fnRaw = is_file($fnFile) ? (string) file_get_contents($fnFile) : '';
            $fnStart = strpos($fnRaw, '<svg');            // files open with a license comment — drop it
            $fnCache[$name] = $fnStart === false ? '' : trim(substr($fnRaw, $fnStart));
        }
        if ($fnCache[$name] === '') return '';
        // Rewrite only the opening tag: strip width/height/class/aria-hidden, then set ours.
        $fnAttrs = ' aria-hidden="true" focusable="false" class="icon' . ($class !== '' ? ' ' . h($class) : '') . '" width="' . $size . '" height="' . $size . '"';
        return preg_replace_callback('/^<svg\b([^>]*)>/s', function ($fnTag) use ($fnAttrs) {
            $fnRest = preg_replace('/\s(width|height|class|aria-hidden|focusable)="[^"]*"/', '', $fnTag[1]);
            return '<svg' . $fnAttrs . ' ' . trim(preg_replace('/\s+/', ' ', $fnRest)) . '>';
        }, $fnCache[$name], 1);
    }
}

// ── Logo (image-first; text lockup only when no logo file exists) ──

if (!function_exists('siteLogo')) {
    /**
     * Finds the logo in /assets/images/ (newest versioned knock-out first). Returns
     * ['src','width','height','class'] sized to the LARGE-LOGO STANDARD by aspect ratio, or null → text logo.
     */
    function siteLogo(int $mobile = 0): ?array {
        static $fnLogo = false;
        if ($fnLogo === false) {
            $fnLogo = null;
            $fnRoot = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/');
            $fnCandidates = array_merge(
                array_reverse(glob($fnRoot . '/assets/images/logo-mark-v*.png') ?: []),
                array_map(fn($f) => $fnRoot . '/assets/images/' . $f, ['logo-mark.png', 'logo.svg', 'logo.png', 'logo.webp'])
            );
            foreach ($fnCandidates as $fnFile) {
                if (!is_file($fnFile)) continue;
                $fnW = $fnH = 0;
                if (substr($fnFile, -4) === '.svg') {
                    $fnXml = @simplexml_load_file($fnFile);
                    if ($fnXml && !empty($fnXml['viewBox'])) {
                        $fnBox = preg_split('/[\s,]+/', trim((string) $fnXml['viewBox']));
                        if (count($fnBox) === 4) { $fnW = (float) $fnBox[2]; $fnH = (float) $fnBox[3]; }
                    }
                } else {
                    $fnSize = @getimagesize($fnFile);
                    if ($fnSize) { $fnW = $fnSize[0]; $fnH = $fnSize[1]; }
                }
                if ($fnW <= 0 || $fnH <= 0) continue;
                $fnRatio = $fnW / $fnH;
                // wordmark >3:1 → 120px, combination 1.5–3:1 → 96px, square → 88px (CSS: .logo--wordmark / .logo--square)
                $fnHeight = $fnRatio > 3 ? 120 : ($fnRatio >= 1.5 ? 96 : 88);
                $fnLogo = [
                    'src'    => str_replace($fnRoot, '', $fnFile),
                    'width'  => (int) round($fnHeight * $fnRatio),
                    'height' => $fnHeight,
                    'class'  => $fnRatio > 3 ? 'logo--wordmark' : ($fnRatio >= 1.5 ? '' : 'logo--square'),
                ];
                break;
            }
        }
        return $fnLogo;
    }
}

// ── Hours / schema ──────────────────────────────────────────

if (!function_exists('parseHours')) {
    /** "Mon–Sun 9:00 AM–6:00 PM" → [['days'=>[...], 'opens'=>'09:00', 'closes'=>'18:00']]; [] if the format is not recognised. */
    function parseHours(string $hours): array {
        $fnWeek = ['mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thu' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday'];
        $fnPattern = '/^(\w{3})\w*\s*[–\-]\s*(\w{3})\w*\s+(\d{1,2})(?::(\d{2}))?\s*([AP]M)\s*[–\-]\s*(\d{1,2})(?::(\d{2}))?\s*([AP]M)$/iu';
        if (!preg_match($fnPattern, trim($hours), $fnM)) return [];
        $fnFrom = strtolower($fnM[1]); $fnTo = strtolower($fnM[2]);
        if (!isset($fnWeek[$fnFrom], $fnWeek[$fnTo])) return [];
        $fnKeys = array_keys($fnWeek);
        $fnStart = array_search($fnFrom, $fnKeys); $fnEnd = array_search($fnTo, $fnKeys);
        $fnDays = [];
        for ($fnI = $fnStart; ; $fnI = ($fnI + 1) % 7) { $fnDays[] = $fnWeek[$fnKeys[$fnI]]; if ($fnI === $fnEnd) break; }
        $fnClock = function ($hr, $min, $ap) {
            $hr = (int) $hr % 12; if (strtoupper($ap) === 'PM') $hr += 12;
            return sprintf('%02d:%02d', $hr, (int) $min);
        };
        return [['days' => $fnDays, 'opens' => $fnClock($fnM[3], $fnM[4] ?: 0, $fnM[5]), 'closes' => $fnClock($fnM[6], $fnM[7] ?: 0, $fnM[8])]];
    }
}

if (!function_exists('absoluteUrl')) {
    function absoluteUrl(string $path): string {
        global $siteUrl;
        if (preg_match('#^https?://#i', $path)) return $path;
        return rtrim((string) $siteUrl, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('defaultOgImage')) {
    /** Site OG image path (local), or '' when none exists on disk. */
    function defaultOgImage(): string {
        $fnRoot = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/');
        foreach (['/assets/images/og-default-v1.jpg', '/assets/images/og-default.jpg'] as $fnPath) {
            if (is_file($fnRoot . $fnPath)) return $fnPath;
        }
        return '';
    }
}

if (!function_exists('buildLocalBusinessSchema')) {
    /** The site-wide @graph: HomeAndConstructionBusiness (#organization) + WebSite. No self-serving rating markup, ever. */
    function buildLocalBusinessSchema(string $ogImage = ''): array {
        global $siteName, $siteUrl, $phoneRaw, $email, $address, $addressPublic, $geo, $businessHours, $services,
               $serviceAreas, $gbpUrl, $socialLinks, $yearsInBusiness;

        $fnAddress = ['@type' => 'PostalAddress', 'addressLocality' => $address['city'], 'addressRegion' => $address['state'], 'addressCountry' => 'US'];
        if (!empty($addressPublic) && !empty($address['street'])) $fnAddress['streetAddress'] = $address['street']; // address_public:false → never the street
        if (!empty($address['zip'])) $fnAddress['postalCode'] = $address['zip'];

        $fnStates = ['IN' => 'Indiana', 'MI' => 'Michigan', 'OH' => 'Ohio', 'IL' => 'Illinois'];
        $fnAreas = [];
        foreach ((array) $serviceAreas as $fnArea) {
            [$fnCity, $fnSt] = cityFromArea($fnArea);
            $fnNode = ['@type' => 'City', 'name' => $fnCity];
            if ($fnSt !== '') $fnNode['containedInPlace'] = ['@type' => 'State', 'name' => $fnStates[strtoupper($fnSt)] ?? strtoupper($fnSt)];
            $fnAreas[] = $fnNode;
        }

        $fnOffers = [];
        foreach ((array) $services as $fnEntry) {
            foreach ((array) ($fnEntry['includes'] ?? [$fnEntry['name'] ?? '']) as $fnInc) {
                if ($fnInc === '') continue;
                $fnOffers[] = ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => shortServiceName($fnInc)]];
            }
        }

        $fnHours = [];
        foreach (parseHours((string) $businessHours) as $fnSpec) {
            $fnHours[] = ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => $fnSpec['days'], 'opens' => $fnSpec['opens'], 'closes' => $fnSpec['closes']];
        }

        $fnSameAs = array_values(array_filter(array_merge([(string) $gbpUrl], array_values((array) $socialLinks))));

        $fnBiz = [
            '@type'       => 'HomeAndConstructionBusiness',
            '@id'         => rtrim($siteUrl, '/') . '/#organization',
            'name'        => $siteName,
            'url'         => rtrim($siteUrl, '/') . '/',
            'telephone'   => $phoneRaw,
            'email'       => $email,
            'description' => $siteName . ' is a handyman and home remodeling company in ' . $address['city'] . ', Indiana, serving homeowners across Northern Indiana and Southwest Michigan. ' . $yearsInBusiness . ' years in business. Free estimates.',
            'address'     => $fnAddress,
            'geo'         => ['@type' => 'GeoCoordinates', 'latitude' => $geo['lat'], 'longitude' => $geo['lng']],
            'hasMap'      => $gbpUrl,
            'areaServed'  => $fnAreas,
        ];
        if ($ogImage !== '') $fnBiz['image'] = absoluteUrl($ogImage);
        if ($fnHours)  $fnBiz['openingHoursSpecification'] = $fnHours;
        if ($fnOffers) $fnBiz['hasOfferCatalog'] = ['@type' => 'OfferCatalog', 'name' => $siteName . ' services', 'itemListElement' => $fnOffers];
        if ($fnSameAs) $fnBiz['sameAs'] = $fnSameAs;

        return [
            '@context' => 'https://schema.org',
            '@graph'   => [
                $fnBiz,
                ['@type' => 'WebSite', '@id' => rtrim($siteUrl, '/') . '/#website', 'url' => rtrim($siteUrl, '/') . '/', 'name' => $siteName, 'publisher' => ['@id' => rtrim($siteUrl, '/') . '/#organization']],
            ],
        ];
    }
}

if (!function_exists('generateServiceSchema')) {
    /** Service node for a $services entry (config.php shape). Provider points at the homepage @id — no duplicate business block. */
    function generateServiceSchema(array $service): array {
        global $siteUrl, $address, $targetRadius;
        $fnSlug = $service['slug'] ?? getServiceSlug($service['name'] ?? '');
        return [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            'name'        => $service['name'] ?? '',
            'description' => $service['description'] ?? '',
            'url'         => rtrim($siteUrl, '/') . '/services/' . $fnSlug . '/',
            'serviceType' => $service['name'] ?? '',
            'provider'    => ['@id' => rtrim($siteUrl, '/') . '/#organization'],
            'areaServed'  => ['@type' => 'City', 'name' => $address['city']],
        ];
    }
}

if (!function_exists('generateFAQSchema')) {
    /** FAQPage from [['q'=>…, 'a'=>…], …]. AI-comprehension aid only (FAQ rich results are deprecated). */
    function generateFAQSchema(array $faqs): array {
        $fnItems = [];
        foreach ($faqs as $fnFaq) {
            $fnQ = $fnFaq['q'] ?? ($fnFaq['question'] ?? '');
            $fnA = $fnFaq['a'] ?? ($fnFaq['answer'] ?? '');
            if ($fnQ === '' || $fnA === '') continue;
            $fnItems[] = ['@type' => 'Question', 'name' => $fnQ, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $fnA]];
        }
        return ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $fnItems];
    }
}

if (!function_exists('generateBreadcrumbSchema')) {
    /** BreadcrumbList from [['name'=>'Home','url'=>'/'], …]; urls may be relative. */
    function generateBreadcrumbSchema(array $crumbs): array {
        $fnItems = [];
        foreach (array_values($crumbs) as $fnIdx => $fnCrumb) {
            $fnItems[] = ['@type' => 'ListItem', 'position' => $fnIdx + 1, 'name' => $fnCrumb['name'], 'item' => absoluteUrl($fnCrumb['url'])];
        }
        return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $fnItems];
    }
}

if (!function_exists('jsonLd')) {
    /** <script type="application/ld+json"> for an array or a ready JSON string. */
    function jsonLd($data): string {
        $fnJson = is_string($data) ? $data : json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
        return '<script type="application/ld+json">' . $fnJson . '</script>';
    }
}

// ── SEO ─────────────────────────────────────────────────────

if (!function_exists('defaultMetaDescription')) {
    /** Fallback description (pages should set $pageDescription). Uses only facts that are in build-plan.json / config.php. */
    function defaultMetaDescription(): string {
        global $siteName, $address, $phone, $yearsInBusiness;
        $fnText = $siteName . ': ' . strtolower(keywordCore()) . ' and remodeling in ' . $address['city'] . ', ' . $address['state']
                . '. Kitchens, baths, floors, siding, roofing. ' . $yearsInBusiness . ' years in business. Call ' . $phone . '.';
        if (mb_strlen($fnText) > 160) $fnText = rtrim(mb_substr($fnText, 0, 157), " ,.:;") . '...';
        return $fnText;
    }
}

if (!function_exists('canonicalFromRequest')) {
    /** Self-referencing canonical: site URL + request path, trailing slash for directory pages, no query string. */
    function canonicalFromRequest(): string {
        global $siteUrl;
        $fnPath = requestPath();
        if ($fnPath !== '/' && !preg_match('#\.[a-z0-9]{2,5}$#i', $fnPath)) $fnPath = rtrim($fnPath, '/') . '/';
        return rtrim((string) $siteUrl, '/') . $fnPath;
    }
}

if (!function_exists('generateMetaTags')) {
    /** <title>, meta description and canonical for the given values (all escaped). */
    function generateMetaTags(string $title, string $description, string $canonical): string {
        return '<title>' . h($title) . '</title>' . "\n"
             . '<meta name="description" content="' . h($description) . '">' . "\n"
             . '<link rel="canonical" href="' . h($canonical) . '">';
    }
}
