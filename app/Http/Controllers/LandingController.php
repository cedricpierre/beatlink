<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Link;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LandingController extends BaseController
{
    public function index(Request $request, Campaign $campaign): Response
    {
        $campaign->increment('views_count');

        $campaign->load(['links', 'links.platform']);

        return Inertia::render('Landing', [
            'campaign' => $campaign,
            'referer'  => $request->header('Referer'),
            'token'    => csrf_token(),
        ])->withViewData(['dark' => $campaign->is_dark]);
    }

    public function open(Request $request, Campaign $campaign, Link $link): JsonResponse
    {
        $campaign->increment('leads_count');

        $link->increment('leads_count');

        $link->leads()->create([
                                   'platform_id' => $link->platform_id,
                                   'campaign_id' => $campaign->id,
                                   'ip'          => $request->getClientIp(),
                                   'user_agent'  => $request->header('User-Agent'),
                                   'referer' => $request->input('referer'),
                                   'email'       => $request->input('email'),
                                   'name'        => $request->input('name'),
                                   'phone'       => $request->input('phone'),
                               ]);

        return response()->json(['url' => $link->url]);
    }
}
