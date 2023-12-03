<?php

namespace App\Http\Controllers;

use App\Exports\BookingsExport;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Approval;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function export() 
    {
        return Excel::download(new BookingsExport, 'myvehicle.xlsx');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookings = Booking::latest()->paginate(10);
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approvals = Approval::all();
        $users = User::where('role', 1)->get();
        return view('booking.index', compact('bookings', 'vehicles', 'drivers', 'approvals', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        //
        $dataBooking = new Booking;
        $dataBooking->user_id = $request->user_id;
        $dataBooking->vehicle_id = $request->vehicle_id;
        $dataBooking->driver_id = $request->driver_id;
        $dataBooking->reason = $request->reason;
        $dataBooking->start_date = $request->start_date;
        $dataBooking->end_date = $request->end_date;

        $dataBooking->save();

        $bookingId = $dataBooking->id;

        $dataApproval1 = new Approval;
        $dataApproval1->booking_id = $bookingId;
        $dataApproval1->user_id = $request->approval_1;

        $dataApproval1->save();

        $dataApproval2 = new Approval;
        $dataApproval2->booking_id = $bookingId;
        $dataApproval2->user_id = $request->approval_2;

        $dataApproval2->save();


        return redirect()->route('bookings.index')
            ->with('success', 'Berhasil DiTambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
        return view('booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
        $booking->update($request->validated());

        return redirect()->route('bookings.index')
            ->with('success', 'Berhasil DiSimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
        $booking->status = "Batal";
        $booking->save();

        return redirect()->route('bookings.index')
            ->with('success', 'Berhasil DiBatalkan!');
    }
}
