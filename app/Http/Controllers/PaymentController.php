<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\payment;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function Symfony\Component\Clock\now;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function payment($id)
    {
        $booking = Booking::find($id)->with(['schedule', 'schedule.field'])->latest()->first();
        // dd($booking);
        return view("fieldDetail.payment", compact('booking'));
    }

    public function struk($id)
    {
        //
        $payment = payment::find($id)->with(['booking', 'user'])->first();
        return view('fieldDetail.struk', compact('payment'));
    }

    public function exportPdf($id)
    {
        $payment = payment::find($id)->with(['booking', 'user', 'booking.schedule', 'booking.schedule.field'])->first()->toArray();
        view()->share('payment', $payment);
        $pdf = Pdf::loadview('fieldDetail.pdf', $payment);
        $fileName = $payment['Oder_id'] . '.pdf';

        return $pdf->download($fileName);
    }

    // app/Http/Controllers/DashboardController.php atau Controller lainnya
    public function chartData()
    {

        $month = now()->format('m');
        $year = now()->format('Y');

        // Jika payment_date ada di tabel payments
        $payments = Payment::whereMonth('payment_date', $month)
            ->whereYear('payment_date', $year)
            ->where('status', 'belum') // hanya ambil yang sudah dibayar
            ->get()
            ->groupBy(function ($payment) {
                return \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d');
            })
            ->toArray();

        // Ambil data key/index (tanggal) untuk data label chartjs
        $labels = array_keys($payments);
        // Membuat array untuk menyimpan data jumlah pembayaran tiap tanggal
        $data = [];
        foreach ($payments as $payment) {
            // Simpan hasil perhitungan count() dari $payment
            array_push($data, count($payment));
        }
        // dd($data);

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
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
        $booking = Booking::with(['user', 'schedule'])->findOrFail($id);

        // Buat order_id yang unik
        $orderId = 'ORDER-' . $booking->id . '-' . time();

        $payment = Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'user_id' => Auth::user()->id,
                'Order_id' => $orderId,
                'amount' => (int) $booking->price,
                'payment_date' => now(),
            ]
        );

        // Midtrans config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $payment->Order_id,
                'gross_amount' => (int) $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $payment->snap_token = $snapToken;
            $payment->save();

            return redirect()->route('user.booking-user.checkout', $payment->id);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    // ✅ PERBAIKAN: Hapus parameter ganda & logic yang tidak perlu
    public function checkout($id)
    {
        $payment = Payment::findOrFail($id);

        // Pastikan snap_token ada
        if (!$payment->snap_token) {
            return redirect()->route('user.booking-user.index')
                ->with('error', 'Token pembayaran tidak ditemukan');
        }

        return view('profile.checkout', compact('payment'));
    }

    public function success($id)
    {
        $data = payment::where('id', $id)->update([
            'status' => 'lunas',
        ]);

        return redirect()->route('user.booking-user.index');
    }

    public function cancel($id)
    {
        $data = booking::where('id', $id)->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('user.booking-user.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(payment $payment)
    {
        //
    }
}
