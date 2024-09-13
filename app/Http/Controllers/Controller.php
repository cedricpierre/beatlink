<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
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
        $user = auth()->user();

        $campaigns = $user->campaigns()
                          ->orderBy('id', 'desc')
                          ->withCount(['leads'])
                          ->take(5)
                          ->get();

        $subscription = $user->subscription(User::STRIPE_SUBSCRIPTION_NAME);

        return Inertia::render('Dashboard', [
            'campaigns'    => $campaigns,
            'subscription' => $subscription,
        ]);
    }

    public function pricing(): Response
    {
        return Inertia::render('Pricing');
    }

}
