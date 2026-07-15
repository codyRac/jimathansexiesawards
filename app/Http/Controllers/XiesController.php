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
     * Show the merchandise concept shop.
     */
    public function shop(): Response
    {
        return Inertia::render('xies/Shop', Xies::siteProps());
    }
}
