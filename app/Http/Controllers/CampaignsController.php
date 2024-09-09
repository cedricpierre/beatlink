<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignStoreRequest;
use App\Http\Requests\CampaignUpdateRequest;
use App\Http\Requests\CampaignUploadRequest;
use App\Models\Campaign;
use App\Models\Platform;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CampaignsController extends Controller
{
    public function list(Request $request): Response
    {

        $campaigns = auth()->user()
                           ->campaigns()
                           ->withCount(['links'])
                           ->paginate(10);

        return Inertia::render('Campaigns/List', [
            'campaigns' => $campaigns,
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Campaigns/Create');
    }

    public function store(CampaignStoreRequest $request): RedirectResponse
    {
        auth()->user()->campaigns()->create($request->all());

        return Redirect::route('campaigns.list');
    }

    public function view(Request $request, Campaign $campaign): Response
    {
        $campaign->load([
                            'links',
                            'links.platform',
                        ]);

        $campaign->loadCount(['links']);

        return Inertia::render('Campaigns/View', ['campaign' => $campaign]);
    }

    public function edit(Request $request, Campaign $campaign): Response
    {
        $campaign->load([
                            'links',
                            'links.platform',
                        ]);

        $campaign->loadCount(['links']);

        $platformIds = $campaign->links()->pluck('links.platform_id')->toArray();

        $platforms = Platform::query()->whereNotIn('id', $platformIds)->get();

        return Inertia::render('Campaigns/Edit', ['campaign' => $campaign, 'platforms' => $platforms]);
    }

    public function update(CampaignUpdateRequest $request, Campaign $campaign): RedirectResponse
    {
        $campaign->update($request->all());

        return Redirect::route('campaigns.edit', ['campaign' => $campaign->id]);
    }

    public function upload(CampaignUploadRequest $request, Campaign $campaign): RedirectResponse
    {
        if ($request->hasFile('background')) {
            $campaign->background_url = $request->file('background')?->store('backgrounds', 'public');
            $campaign->save();

        }

        if ($request->hasFile('image')) {
            $campaign->image_url = $request->file('image')?->store('backgrounds', 'public');
            $campaign->save();
        }

        return Redirect::route('campaigns.edit', ['campaign' => $campaign->id]);
    }

    public function destroy(Request $request, Campaign $campaign): RedirectResponse
    {
        $campaign->delete();

        return Redirect::route('campaigns.list');
    }
}
