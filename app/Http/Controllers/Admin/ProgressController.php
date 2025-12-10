<?php

namespace App\Http\Controllers\Admin;

use App\Models\Intervention;
use App\Models\ProgressUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreProgressRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProgressController extends Controller
{
    public function store(StoreProgressRequest $request, $interventionId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $intervention = Intervention::findOrFail($interventionId);

        if ($intervention->teacher_id !== $user->uuid) {
            return response()->json(['message' => 'Forbidden: not your intervention'], 403);
        }

        $data = $request->validated();
        $data['uuid'] = Str::uuid();
        $data['intervention_id'] = $intervention->id;

        $progress = ProgressUpdate::create($data);

        return response()->json([
            'message' => 'Progress saved',
            'data' => $progress
        ], 201);
    }
}
