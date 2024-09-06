<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class Controller extends BaseController
{
    public function index(): Response
    {
        return Inertia::render('Welcome');
    }

    public function pricings(): Response
    {
        return Inertia::render('Pricings');
    }
}
