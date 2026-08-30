<?php

/**
 * Regions shown in the site header's region bar.
 *
 * PLACEHOLDER DATA — the region grouping mirrors the coverage claimed on the
 * Why Choose Us page (North America, the UK, Europe, Australia & New Zealand,
 * the Middle East and Asia-Pacific), but the individual country lists are
 * awaiting confirmation from the client. Edit the lists here; the header and
 * the mobile menu both read from this file.
 *
 * @var array<string, array{label: string, countries: list<string>}>
 */
return [
    'americas' => [
        'label' => 'Americas',
        'countries' => ['United States', 'Canada', 'Mexico', 'Brazil'],
    ],
    'europe' => [
        'label' => 'Europe',
        'countries' => ['United Kingdom', 'Ireland', 'Netherlands', 'Germany', 'France'],
    ],
    'asia' => [
        'label' => 'Asia',
        'countries' => ['India', 'Singapore', 'Malaysia', 'Philippines', 'Japan'],
    ],
    'middle-east' => [
        'label' => 'Middle East',
        'countries' => ['United Arab Emirates', 'Saudi Arabia', 'Qatar', 'Oman', 'Bahrain'],
    ],
    'oceania' => [
        'label' => 'Oceania',
        'countries' => ['Australia', 'New Zealand'],
    ],
];
