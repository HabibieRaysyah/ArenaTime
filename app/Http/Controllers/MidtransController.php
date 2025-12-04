<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct(){
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitize');
        Config::$is3ds = config('midtrans.server_key');
    }

    public function pay(Request $request){
        $transaction= Payment::create([
            'Order_id' => 'ORDER-'. time(),
            'booking_id' => $request->booking_id,
            'metode' => $request->metode,
            'amount' => $request->amount,
            'status' => $request->status,
            'payment_date' => $request->date,
        ]);

    

    }
}
