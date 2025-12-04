<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\Booking as ModelsBooking;
use App\Models\payment;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\VarDumper\Caster\PdoCaster;

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
        $booking = Booking::find($id)->with(['schedule','schedule.field'])->latest()->first();
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
    public function store(Request $request)
    {

        $createData = payment::create([
            'booking_id' => $request->booking_id,
            'user_id' => $request->user_id,
            'Oder_id' => $request->Oder_id,
            'metode' => $request->metode,
            'amount' => $request->amount,
            'payment_date' => now(),
            'status' => 'belum',
        ]);

        return response()->json(['message' => 'Berhasil membuat barcode pembayaran', 'data' => $createData]);
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
