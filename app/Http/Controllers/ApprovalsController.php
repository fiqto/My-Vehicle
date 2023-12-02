<?php

namespace App\Http\Controllers;

use App\Models\Approvals;
use App\Http\Requests\StoreApprovalsRequest;
use App\Http\Requests\UpdateApprovalsRequest;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\Vehicle;

class ApprovalsController extends Controller
{
    protected $approval;

    public function __construct(Approvals $approval)
    {
        $this->approval = $approval;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookings = Booking::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('approval.index', compact('bookings', 'vehicles', 'drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('approval.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApprovalsRequest $request)
    {
        //
        $this->approval->create($request->validated());

        return redirect()->route('approvals.index')
            ->with('success', 'Berhasil DiTambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Approvals $approvals)
    {
        //
        return view('approval.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approvals $approvals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApprovalsRequest $request, Approvals $approvals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approvals $approvals)
    {
        //
    }
}
