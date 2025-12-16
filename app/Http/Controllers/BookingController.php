<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\payment;
use App\Models\schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

        $jam = \Carbon\Carbon::parse($request->hours)->format('H');
        $menit =\Carbon\Carbon::parse($request->hours)->format('i');
        $hasilJam = $jam + $request->duration;
        $result = sprintf('%02d:%02d', $hasilJam, $menit);
        $hour_end = \Carbon\Carbon::parse($result)->format('H:i');

        $order_id = 'ORD-'.random_int(1,999999999);

        $createData = Booking::create([
            'user_id' => Auth::user()->id,
            'schedule_id' => $schedule->id,
            'booking_date' => $request->date,
            'price' => $pricetotal,
            'start_time' => $request->hours,
            'hour_end' => $hour_end,
            'duration' => $request->duration,
            'Order_id'=> $order_id,
            'status' => 'pending',
        ]);

        $bookingId = booking::orderBy('id', 'desc')->first();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($createData)
            ->log("Berhasil Booking #" . $schedule->field->name);

        if ($createData) {
            return redirect()->back()->with('success', 'Berhasil Booking, Tunggu dari pihak kami menerima!');
        } else {
            return redirect()->back()->with('failed', 'Gagal Booking!!');
        }

        // dd($schedule)
    }

    public function approve($id) {

        $approve = booking::where('id',$id)->update([
            'status' => 'confirmed'
        ]);

        if ($approve) {
            return redirect()->back()->with('success','Berhasil menerima');
        }else{
            return redirect()->back()->with('error','Gagal memuat data');
        }
    }

    public function bookingUser(payment $payment){
        $bookings = booking::where('user_id', Auth::user()->id)->whereIn('status', ['confirmed','pending'])->with(['user','schedule'])->get();

        return view('profile.booking', compact('bookings','product','payment'));
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
