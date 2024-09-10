<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlatformSearchRequest;
use App\Models\Platform;
use Illuminate\Http\JsonResponse;

class PlatformController extends Controller
{
    public function search(PlatformSearchRequest $request, Platform $platform): JsonResponse
    {
        $result = $platform->service->search($request->input('search'));

        return response()->json($result->toArray());
    }
}
