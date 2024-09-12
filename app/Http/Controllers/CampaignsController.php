<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignCreateRequest;
use App\Http\Requests\CampaignStoreRequest;
use App\Http\Requests\CampaignUpdateRequest;
use App\Http\Requests\CampaignUploadRequest;
use App\Models\Campaign;
use App\Models\Platform;
use App\Models\User;
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
            ->paginate();

        return Inertia::render('Campaigns/List', [
            'campaigns' => $campaigns,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Campaigns/Create');
    }

    public function store(CampaignStoreRequest $request): RedirectResponse
    {
        auth()->user()->campaigns()->create($request->all());

        return redirect()->route('campaigns.list');
    }

    public function view(Request $request, Campaign $campaign): Response
    {
        $search = $request->input('search');

        $campaign->load([
                            'links',
                            'links.platform',
                        ]);

        $campaign->loadCount(['links']);

        $leads = $campaign->leads()
                          ->with(['platform'])
                          ->when($request->input('from'), function ($query, $from) {
                              $query->where('created_at', '>=', $from);
                          })
                          ->when($request->input('to'), function ($query, $to) {
                              $query->where('created_at', '<=', $to);
                          })
                          ->when($search, function ($query, $search) {
                              $query->where('ip', $search);
                              $query->orWhere('user_agent', 'like', '%' . $search . '%');
                              $query->orWhere('referer', 'like', '%' . $search . '%');
                          })
                          ->orderBy('id', 'desc')
                          ->paginate();

        return Inertia::render('Campaigns/View', [
            'campaign' => $campaign,
            'leads'    => $leads,
            'search'   => $search,
        ]);
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

        return redirect()->route('campaigns.edit', ['campaign' => $campaign->id]);
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

        return redirect()->route('campaigns.edit', ['campaign' => $campaign->id]);
    }

    public function destroy(Request $request, Campaign $campaign): RedirectResponse
    {
        $campaign->delete();

        return redirect()->route('campaigns.list');
    }
}
