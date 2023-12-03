<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        //
        $currentMonth = Carbon::now()->month;

        $bookingThisMonth  = Booking::whereMonth('created_at', $currentMonth)->count();
        $vehicleThisMonth  = Vehicle::whereMonth('created_at', $currentMonth)->count();
        $driverThisMonth  = Driver::whereMonth('created_at', $currentMonth)->count();

        // Chart Data
        $bookingCounts = [];
        for ($i = 0; $i < 6; $i++) {
            $bookingMonth = Carbon::now()->subMonths($i);
            $bookingCount = Booking::whereYear('created_at', $bookingMonth->year)
                ->whereMonth('created_at', $bookingMonth->month)
                ->count();
            $bookingCounts[] = $bookingCount;
        }
        $bookingCounts = array_reverse($bookingCounts);
        
        $months = [];
        for ($i = 0; $i < 6; $i++) {
            $months[] = Carbon::now()->subMonths($i)->format('Y-m');
        }
        $months = array_reverse($months);

        return view('dashboard', compact('bookingThisMonth', 'vehicleThisMonth', 'driverThisMonth', 'bookingCounts', 'months'));
    }
}
