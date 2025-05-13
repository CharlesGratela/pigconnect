<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoginHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBuyers = User::where('role', 'buyer')->count();
        $totalFarmers = User::where('role', 'farmer')->count();

        $newRegistrations = User::where('created_at', '>=', Carbon::now()->subWeek())->count();
        $averageSessionDuration = LoginHistory::select(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_duration'))->first()->avg_duration;

        $loginTrends = LoginHistory::select(
            DB::raw('count(*) as logins'),
            DB::raw('MONTH(created_at) as month')
        )
        ->groupBy('month')
        ->get();

        $registrationTrends = User::select(
            DB::raw('count(*) as registrations'),
            DB::raw('MONTH(created_at) as month')
        )
        ->groupBy('month')
        ->get();

        return Inertia::render('AdminDashboard', [
            'totalUsers' => $totalUsers,
            'totalBuyers' => $totalBuyers,
            'totalFarmers' => $totalFarmers,
            'newRegistrations' => $newRegistrations,
            'averageSessionDuration' => $averageSessionDuration,
            'loginTrends' => $loginTrends,
            'registrationTrends' => $registrationTrends
        ]);
    }
}