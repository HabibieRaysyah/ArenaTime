<?php

namespace App\Http\Controllers;

use App\Models\booking;

use App\Models\schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'schedule'])->get();
        return view('staff.booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $schedule = Schedule::where('id', $id)->with('field')->first();
        $pricetotal = $schedule->hourly_price * $request->duration;
        $createData = Booking::create([
            'user_id' => Auth::user()->id,
            'schedule_id' => $schedule->id,
            'booking_date' => $request->date,
            'price' => $pricetotal,
            'start_time' => $request->hours,
            'duration' => $request->duration,
            'status' => 'pending',
        ]);

        $bookingId = booking::orderBy('id', 'desc')->first();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($createData)
            ->log("Berhasil Booking #" . $schedule->field->name);

        if ($createData) {
            return redirect()->route('user.payment', $bookingId)->with('success', 'Berhasil Booking!!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Booking!!');
        }

        // dd($schedule)
    }

    /**
     * Display the specified resource.
     */
    public function show(booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(booking $booking)
    {
        //
    }
}
