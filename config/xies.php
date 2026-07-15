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

];
