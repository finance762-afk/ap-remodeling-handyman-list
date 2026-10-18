<?php
/**
 * config.php — site-wide variables for AP Remodeling Handyman List.
 * Source of truth: build-plan.json (Phase 1 scaffold, 2026-10-18).
 * Every page includes this before head.php and sets its own $canonicalUrl,
 * $pageType (+ $serviceSlug / $citySlug) — never $cssVersion.
 */

// ── Identity ────────────────────────────────────────────────
$slug           = 'ap-remodeling-handyman-list';
$siteName       = 'AP Remodeling Handyman List';
$tagline        = '';                       // build-plan tagline is empty
$ownerName      = 'Charles Poe';
$industry       = 'Handyman/Remodeling';
$tier           = 'basic';

// ── Contact ─────────────────────────────────────────────────
$phone          = '(219) 296-5827';
$phoneRaw       = '+12192965827';
$phoneSecondary = '';
$email          = 'andypoe1963@gmail.com';
$businessHours  = 'Mon–Sun 9:00 AM–6:00 PM';

// build-plan address holds "Elkhart" in the street field with city/zip blank —
// Elkhart is the city (primary keyword + first service area); no street was supplied.
$address = [
    'street' => '',
    'city'   => 'Elkhart',
    'state'  => 'IN',
    'zip'    => '',
];
$addressPublic  = true;
$geo            = ['lat' => 41.730991, 'lng' => -85.83901105];

// ── Domain / URLs ───────────────────────────────────────────
// No production_domain in build-plan.json → preview domain.
$domain         = 'ap-remodeling-handyman-list.pageone.cloud';
$siteUrl        = 'https://' . $domain;

// ── SEO ─────────────────────────────────────────────────────
$primaryKeyword    = 'handyman elkhart in';
$secondaryKeywords = [
    'bathroom remodeling elkhart',
    'kitchen remodeling elkhart',
    'handyman near me elkhart',
    'home remodeling elkhart',
];

// ── Services (one entry per service page, from build-plan service_grouping) ──
$services = [
    [
        'name'        => 'Flooring Installation',
        'slug'        => 'flooring-installation',
        'description' => 'Flooring installation for kitchens, baths, living areas and whole homes in Elkhart and the surrounding area.',
        'keywords'    => ['flooring installation elkhart', 'flooring installers near me', 'new floors elkhart in'],
        'includes'    => ['Flooring Installation'],
    ],
    [
        'name'        => 'Siding & Window Replacement',
        'slug'        => 'siding-window-replacement',
        'description' => 'Siding and window replacement for homes in Elkhart and across Northern Indiana and Southwest Michigan.',
        'keywords'    => ['siding replacement elkhart', 'window replacement elkhart', 'siding contractor elkhart in'],
        'includes'    => ['Siding & Window Replacement'],
    ],
    [
        'name'        => 'Remodeling Services',
        'slug'        => 'remodeling-services',
        'description' => 'Bathroom and kitchen remodeling, from layout and fixtures to finished surfaces, for Elkhart-area homeowners.',
        'keywords'    => ['bathroom remodeling elkhart', 'kitchen remodeling elkhart', 'home remodeling elkhart'],
        'includes'    => ['Bathroom Remodeling', 'Kitchen Remodeling'],
    ],
    [
        'name'        => 'Additional Services',
        'slug'        => 'additional-services',
        'description' => 'Roof repair and replacement plus handyman work: drywall, painting, doors, TV mounting, shelving, fixtures, caulking, deck and fence repair.',
        'keywords'    => ['handyman elkhart in', 'handyman near me elkhart', 'roof repair elkhart'],
        'includes'    => [
            'Roofing (roof repair & replacement)',
            'Handyman Services (drywall repair, interior & exterior painting, door installation & repair, TV mounting, shelving installation, furniture assembly, fixture replacement, caulking & weatherproofing, deck repair, fence repair, small home repairs)',
        ],
    ],
];

// ── Service areas ───────────────────────────────────────────
$serviceAreas = [
    'Elkhart, IN',
    'Mishawaka, IN',
    'South Bend, IN',
    'Osceola, IN',
    'Bristol, IN',
    'Plymouth, IN',
    'Warsaw, IN',
    'Kendallville, IN',
    'Ligonier, IN',
    'Niles, MI',
    'Edwardsburg, MI',
];
$targetRadius = 25; // miles

// ── Social / profiles ───────────────────────────────────────
$socialLinks = [];  // no social profiles in build-plan.json
$gbpUrl          = 'https://share.google/rE66BvwmFRxXlJzmy';
$gbpPlaceId      = 'ChIJfRx5xSR5SA8RdQF8daG00xM';
$gbpMapEmbedSrc  = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d762243.7496723352!2d-85.83901105!3d41.730991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xf487924c5791c7d%3A0x13d3b4a1757c0175!2sAP%20Remodeling%20Handyman%20List!5e0!3m2!1sen!2sus!4v1792341617899!5m2!1sen!2sus';
$directionsUrl   = 'https://www.google.com/maps/dir/?api=1&destination=place_id:ChIJfRx5xSR5SA8RdQF8daG00xM';
$reviewRequestUrl = 'https://search.google.com/local/writereview?placeid=ChIJfRx5xSR5SA8RdQF8daG00xM';

// ── Analytics ───────────────────────────────────────────────
$googleAnalyticsId = 'G-XXXXXXXXXX'; // placeholder — replace post-launch

// ── Brand colors ────────────────────────────────────────────
// build-plan design.colors carries no values (no logo supplied); these mirror
// the framework.css :root tokens so PHP and CSS stay in sync.
$colors = [
    'primary'   => '#1f2428',
    'secondary' => '#5a6570',
    'accent'    => '#c8461a',
];

// ── Business facts ──────────────────────────────────────────
$yearsInBusiness = 32;                                     // content.years
$yearEstablished = (int) date('Y') - $yearsInBusiness;     // 1994 as of 2026

// ── Build / forms ───────────────────────────────────────────
$cssVersion      = '1';  // SINGLE framework.css cache-bust — bump here only
$formAction      = 'https://db.pageone.cloud/functions/v1/leads/ap-remodeling-handyman-list';
$leadsFormSecret = '';   // none issued — spam shield skipped by p1-form-helpers.php

// ── v8 components (from build-plan.json integrations) ───────
// estimate_tool.authorized === true (Charles Poe, 2026-10-11T21:00:25Z, onboarding).
// Range is the client's own figure, verbatim. Plan row has no slug; it maps to the
// page that hosts handyman services.
$estimateTool = [
    'authorized' => true,
    'pricing'    => [
        [
            'service' => 'Handyman/Handywoman/Handyperson',
            'slug'    => 'additional-services',
            'low'     => 1500,
            'high'    => 225000,
            'unit'    => 'per job',
            'note'    => '',
        ],
    ],
];

// booking.authorized === true (Charles Poe, 2026-10-11T21:00:25Z, onboarding). No lead_days in plan → 1.
$bookingWindows = [
    'authorized' => true,
    'days'       => ['mon', 'tue', 'wed', 'thu', 'fri'],
    'windows'    => ['8-10 am', '10 am-12 pm', '12-2 pm', '2-4 pm', '4-6 pm'],
    'lead_days'  => 1,
];

// integrations.text_us_number (owner's own phone), normalized to E.164.
$textUsNumber = '+12192965827';

// financing: provider is empty and url is "Yeah" (not a URL) → no financing block.
$financing = [];

// integrations.service_zips not supplied.
$serviceZips = [];

// ── Lead attribution (v6.3) — must stay last ────────────────
require_once __DIR__ . '/attribution.php';
