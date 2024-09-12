<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionCancelRequest;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Stripe\StripeClient;

class SubscriptionsController extends BaseController
{
    public function subscribe(Campaign $campaign): Response|RedirectResponse
    {
        $user = auth()->user();

        if ($user->subscribed(User::STRIPE_SUBSCRIPTION_NAME)) {
            return redirect()->route('subscriptions.edit');
        }

        return Inertia::render('Subscriptions/Subscribe', [
            'stripe_intent' => $user->createSetupIntent(),
            'stripe_key'    => env('STRIPE_KEY'),
        ]);
    }

    public function store(SubscriptionStoreRequest $request): RedirectResponse
    {
        $user = auth()->user();

        $user->createOrGetStripeCustomer();

        $quantity = 1;

        if ($user->subscription(User::STRIPE_SUBSCRIPTION_NAME)) {
            $quantity = $user->subscription(User::STRIPE_SUBSCRIPTION_NAME)->quantity;
        }

        $user->newSubscription(User::STRIPE_SUBSCRIPTION_NAME, 'price_1PxxcE08YIxHX5obOKN4rBeH')
             ->quantity($quantity)
             ->create($request->input('payment_method'));


        return redirect()->route('subscriptions.view');
    }

    public function view(): Response
    {
        return Inertia::render('Subscriptions/View');
    }

    public function edit(): Response
    {
        $subscription = auth()->user()->subscription(User::STRIPE_SUBSCRIPTION_NAME);

        return Inertia::render('Subscriptions/Edit', [
            'subscription' => $subscription,
        ]);
    }

    public function update(SubscriptionUpdateRequest $request): RedirectResponse
    {
        $subscription = auth()->user()->subscription(User::STRIPE_SUBSCRIPTION_NAME);

        if ($subscription) {
            $subscription->updateQuantity($request->integer('quantity'));
        }

        return redirect()->route('subscriptions.edit');
    }

    public function cancel(SubscriptionCancelRequest $request): RedirectResponse
    {
        $user = auth()->user();

        $user->subscription(User::STRIPE_SUBSCRIPTION_NAME)?->cancelNow();

        return redirect()->route('subscriptions.view');
    }

    public function resume(): RedirectResponse
    {
        $user = auth()->user();

        $user->subscription(User::STRIPE_SUBSCRIPTION_NAME)?->resume();

        return redirect()->route('subscriptions.view');
    }
}
