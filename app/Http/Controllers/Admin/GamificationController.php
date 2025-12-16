<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GamificationPoint;
use Illuminate\Http\Request;

class GamificationController extends Controller
{
    public function profile(Request $req)
    {
        $ownerType = 'students';
        $ownerId = $req->user()->student->id ?? null; // adapt
        $gp = GamificationPoint::where('owner_type', $ownerType)->where('owner_id', $ownerId)->first();

        return response()->json($gp);
    }

    public function checkin(Request $req)
    {
        $ownerType = 'students';
        $ownerId = $req->user()->student->id ?? null;
        $gp = GamificationPoint::firstOrCreate(['owner_type' => $ownerType, 'owner_id' => $ownerId], ['points' => 0, 'badges' => null, 'streak_days' => 0]);
        // sample checkin logic
        $gp->points += 10;
        $gp->streak_days = $gp->last_checkin_at && $gp->last_checkin_at->diffInDays(now()) == 1 ? $gp->streak_days + 1 : 1;
        $gp->last_checkin_at = now();
        $gp->save();

        return response()->json($gp);
    }
}
