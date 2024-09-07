<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class Controller extends BaseController
{
    public function home(): Response
    {
        return Inertia::render('Welcome');
    }

    public function dashboard(): Response
    {
        return Inertia::render('Dashboard');
    }

    public function pricing(): Response
    {
        return Inertia::render('Pricing');
    }

}
