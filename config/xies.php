<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nomination Fee
    |--------------------------------------------------------------------------
    |
    | The fee, in whole US dollars, charged per nomination entry. One fee
    | covers one entry; nominating in multiple categories creates one
    | entry per category.
    |
    */

    'fee' => 10,

    /*
    |--------------------------------------------------------------------------
    | Payment Links
    |--------------------------------------------------------------------------
    |
    | Hosted checkout links shown on the nomination page. Replace these with
    | a real PayPal Business payment link and a Stripe Payment Link, each
    | configured for the nomination fee. When left empty the buttons on
    | the nomination page render in a disabled "coming soon" state.
    |
    */

    'paypal_url' => env('XIES_PAYPAL_URL'),
    'stripe_url' => env('XIES_STRIPE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Admin Notifications
    |--------------------------------------------------------------------------
    */

    'admin_email' => env('XIES_ADMIN_EMAIL'),

    /*
    |--------------------------------------------------------------------------
    | Contact & Key Dates
    |--------------------------------------------------------------------------
    */

    'phones' => ['877-243-9279', '816-907-8628'],

    'website' => 'www.jimathansxiesawards.com',

    'dates' => [
        'eligibility_start' => 'January 1, 2026',
        'eligibility_end' => 'December 31, 2026',
        'nominations_open' => 'June 3, 2026',
        'nominations_close' => 'December 31, 2026',
        'show' => 'December 31, 2026',
    ],

    /*
    |--------------------------------------------------------------------------
    | Award Categories
    |--------------------------------------------------------------------------
    */

    'categories' => [
        'News & Journalism',
        'Politics & Public Affairs',
        'Interviews',
        'Comedy & Entertainment',
        'Sports',
        'Business & Finance',
        'Education',
        'Music',
        'Technology & Innovation',
        'Gaming',
        'Arts & Culture',
        'Health & Wellness',
        'Community Building',
        'International',
        'Live Events',
        'Debates & Discussions',
        'Newcomers & Rising Stars',
        'Personalities & Influencers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Additional Category Groups
    |--------------------------------------------------------------------------
    |
    | The complete list of additional categories shown on the nomination
    | page, organized into groups. The featured categories above stay on
    | the home page; these appear only on the nomination page.
    |
    */

    'category_groups' => [
        'Podcast, Show & Program Categories' => [
            'Best Independent Podcast',
            'Best Conservative Podcast',
            'Best Liberal Podcast',
            'Best Nonpartisan Political Podcast',
            'Best Political X Space',
            'Best Current Events Program',
            'Best News Commentary Program',
            'Best Breaking News Coverage',
            'Best Investigative Journalism',
            'Best Documentary-Style Program',
            'Best Educational Series',
            'Best Business and Finance Podcast',
            'Best Technology Podcast',
            'Best Health and Wellness Podcast',
            'Best Sports Podcast',
            'Best Music Podcast',
            'Best Arts and Culture Podcast',
            'Best Entertainment Podcast',
            'Best Faith and Spirituality Podcast',
            'Best International Podcast',
            'Best International X Show',
            'Best International X Space',
            'Best Community Service Program',
            'Best Advocacy Program',
            'Best Live Broadcast',
            'Best Panel Show',
            'Best Debate',
            'Best Special Episode',
            'Best Original Program Format',
        ],
        'Host, Guest & Personality Categories' => [
            'Best Solo Host',
            'Best Hosting Team',
            'Best Moderator',
            'Best Guest Appearance',
            'Best Celebrity Personality',
            'Best Comedy Personality',
            'Best Political Personality',
            'Best Inspirational Voice',
            'Best Rising Voice',
            'Best Newcomer',
            'Best Youth Voice',
            'Best Senior Voice',
            'Best International Host',
            'Best Community Builder',
            'Best Audience Interaction',
        ],
        'Production & Behind-the-Scenes Categories' => [
            'Best Producer',
            'Best Executive Producer',
            'Best Audio Production',
            'Best Video Production',
            'Best Researcher or Research Team',
            'Best Guest Booker',
            'Best Behind-the-Scenes Contributor',
            'Best Promotional Campaign',
            'Best Show Branding',
            'Best Show Introduction',
            'Best Use of Social Media',
            'Best Audience Engagement',
        ],
        'Special Recognition Categories' => [
            "People's Choice Award",
            'Lifetime Achievement Award',
            'XIES Excellence Award',
            'XIES Humanitarian Award',
            'XIES Impact Award',
        ],
    ],

];
