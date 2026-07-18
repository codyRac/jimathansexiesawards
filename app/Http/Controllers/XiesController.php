<?php

namespace App\Http\Controllers;

use App\Support\Xies;
use Inertia\Inertia;
use Inertia\Response;

class XiesController extends Controller
{
    /**
     * Show the public landing page.
     */
    public function home(): Response
    {
        return Inertia::render('xies/Home', [
            ...Xies::siteProps(),
            'categories' => Xies::categories(),
        ]);
    }

    /**
     * Show the merchandise page.
     */
    public function shop(): Response
    {
        return Inertia::render('xies/Shop', Xies::siteProps());
    }

    /**
     * Show the trophy collection page.
     */
    public function trophies(): Response
    {
        return Inertia::render('xies/Trophies', Xies::siteProps());
    }
}
