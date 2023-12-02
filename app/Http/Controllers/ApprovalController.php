<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Http\Requests\StoreApprovalRequest;
use App\Http\Requests\UpdateApprovalRequest;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    protected $approval;

    public function __construct(Approval $approval)
    {
        $this->approval = $approval;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userId = Auth::id();
        $approvals = Approval::where('user_id', $userId)
                         ->whereHas('booking', function ($query) {
                             $query->where('status', '!=', 'Batal');
                         })
                         ->get();

        return view('approval.index', compact('approvals'));
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
    public function store(StoreApprovalRequest $request)
    {
        //
        $this->approval->create($request->validated());

        return redirect()->route('approvals.index')
            ->with('success', 'Berhasil DiTambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Approval $approval)
    {
        //
        return view('approval.show', compact('approval'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approval $approval)
    {
        //
        return view('approval.edit', compact('approval'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApprovalRequest $request, Approval $approval)
    {
        //
        $approval->update($request->validated());

        $bookingId = $approval->booking_id;
        $approvalsForBooking = Approval::where('booking_id', $bookingId)->where('status', '!=', 'Setuju')->exists();

        if (!$approvalsForBooking) {
            $booking = Booking::findOrFail($bookingId);
            $booking->status = "Setujui";
            $booking->save();
        }

        return redirect()->route('approvals.index')
            ->with('success', 'Berhasil DiSimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approval $approval)
    {
        //
        $approval->delete();

        return redirect()->route('approvals.index')
            ->with('success', 'Berhasil DiHapus!');
    }
}
