<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanCreateCampaign
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->onTrial() && $request->user()?->campaigns()->count()) {
            return redirect()->route('subscriptions.subscribe');
        }

        if ($request->user()?->subscription(User::STRIPE_SUBSCRIPTION_NAME)?->quantity <= $request->user()?->campaigns()->count()) {
            return redirect()->route('subscriptions.edit');
        }

        return $next($request);
    }
}
