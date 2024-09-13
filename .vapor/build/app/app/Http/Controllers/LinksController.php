<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignStoreRequest;
use App\Http\Requests\CampaignUpdateRequest;
use App\Http\Requests\LinkStoreRequest;
use App\Http\Requests\LinkUpdateRequest;
use App\Models\Campaign;
use App\Models\Link;
use App\Models\Platform;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class LinksController extends Controller
{
    public function store(LinkStoreRequest $request, Campaign $campaign): RedirectResponse
    {
        $campaign->links()->create($request->all());

        return redirect()->route('campaigns.edit', ['campaign' => $campaign]);
    }

    public function update(LinkUpdateRequest $request, Campaign $campaign, Link $link): RedirectResponse
    {
        $link->update($request->all());

        return redirect()->route('campaigns.edit', ['campaign' => $campaign]);
    }

    public function destroy(Request $request, Campaign $campaign, Link $link): RedirectResponse
    {
        $link->delete();

        return redirect()->route('campaigns.edit', ['campaign' => $campaign]);
    }
}
