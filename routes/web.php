<?php

use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Middleware\HasActiveSubscription;
use App\Http\Middleware\HasSubscription;
use Illuminate\Support\Facades\Route;

Route::prefix('backend')->group(function () {

    Route::middleware('auth')->group(function () {

        Route::get('/subscriptions/subscribe', [SubscriptionsController::class, 'subscribe'])->name('subscriptions.subscribe');
        Route::post('/subscriptions/subscribe', [SubscriptionsController::class, 'store'])->name('subscriptions.store');

        Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], static function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });

        Route::middleware(HasSubscription::class)->group(function () {

            Route::group(['prefix' => 'subscriptions', 'as' => 'subscriptions.'], static function () {
                Route::get('/edit', [SubscriptionsController::class, 'edit'])->name('edit');
                Route::get('/view', [SubscriptionsController::class, 'view'])->name('view');
                Route::post('/resume', [SubscriptionsController::class, 'resume'])->name('resume');
            });

            Route::middleware(HasActiveSubscription::class)->group(function () {

                Route::group(['prefix' => 'subscriptions', 'as' => 'subscriptions.'], static function () {
                    Route::put('/', [SubscriptionsController::class, 'update'])->name('update');
                    Route::post('/cancel', [SubscriptionsController::class, 'cancel'])->name('cancel');
                });

                Route::group(['prefix' => 'platforms', 'as' => 'platforms.'], static function () {
                    Route::get('/{platform:slug}/search', [PlatformController::class, 'search'])->name('search');
                });

                Route::group(['prefix' => 'campaigns', 'as' => 'campaigns.'], static function () {
                    Route::get('/', [CampaignsController::class, 'list'])->name('list');
                    Route::get('/create', [CampaignsController::class, 'create'])->name('create');
                    Route::post('/create', [CampaignsController::class, 'store'])->name('store');
                    Route::get('/{campaign}', [CampaignsController::class, 'view'])->name('view');
                    Route::post('/{campaign}/upload', [CampaignsController::class, 'upload'])->name('upload');
                    Route::get('/{campaign}/edit', [CampaignsController::class, 'edit'])->name('edit');
                    Route::put('/{campaign}', [CampaignsController::class, 'update'])->name('update');
                    Route::delete('/{campaign}', [CampaignsController::class, 'destroy'])->name('destroy');

                    Route::group(['prefix' => '{campaign}/links', 'as' => 'links.'], static function () {
                        Route::post('/create', [LinksController::class, 'store'])->name('store');
                        Route::get('/{link}/edit', [LinksController::class, 'edit'])->name('edit');
                        Route::delete('/{link}', [LinksController::class, 'destroy'])->name('destroy');
                    });
                });
            });
        });

    });

    require __DIR__ . '/auth.php';
});

Route::get('/', [Controller::class, 'home'])->name('home');
Route::get('/pricing', [Controller::class, 'pricing'])->name('pricing');


Route::get('/{campaign:slug}', [LandingController::class, 'index'])->name('landing');
Route::get('/{campaign:slug}/{link:platform_id}', [LandingController::class, 'open'])->name('landing.open');
