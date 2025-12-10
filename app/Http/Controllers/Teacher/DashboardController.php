<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Activity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            "message" => "Dashboard loaded",
            "data" => Activity::with('user')->latest()->limit(5)->get()
        ]);
    }
}
