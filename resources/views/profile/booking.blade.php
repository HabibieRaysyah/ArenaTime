@extends('profile.profile')

@push('style')
    <style>
        .compact-card {
            width: 350px;
            /* Ukuran lebih kecil sesuai contoh */
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: none;
            margin: 0 auto;
        }

        .card-header-compact {
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            font-weight: 600;
            text-align: center;
            border-bottom: 3px solid #3498db;
        }

        .booking-id {
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 5px;
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .card-body-compact {
            padding: 1.2rem;
            background-color: white;
        }

        .info-row {
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #eee;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-size: 0.8rem;
            color: #7f8c8d;
            font-weight: 600;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 0.95rem;
            color: #2c3e50;
            font-weight: 500;
        }

        .date-range {
            color: #2980b9;
            font-weight: 600;
        }

        .guest-name {
            color: #2c3e50;
            font-weight: 600;
            font-size: 1rem;
        }

        .guest-icon {
            color: #e74c3c;
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .card-footer-compact {
            padding: 1rem;
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn-compact {
            flex: 1;
            padding: 8px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-pay-compact {
            background-color: #27ae60;
            color: white;
        }

        .btn-pay-compact:hover {
            background-color: #219653;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(39, 174, 96, 0.2);
        }

        .btn-cancel-compact {
            background-color: #e74c3c;
            color: white;
        }

        .btn-cancel-compact:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(231, 76, 60, 0.2);
        }

        .icon-small {
            font-size: 0.9rem;
        }

        .text-center {
            text-align: center;
        }

        .mb-1 {
            margin-bottom: 0.5rem;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }

        .page-title {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-weight: 700;
            border-bottom: 3px solid #4a6491;
            padding-bottom: 10px;
            display: inline-block;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h2 class="page-title">Detail Booking</h2>
        <div class="d-flex flex-wrap">
            @foreach ($bookings as $booking)
                <div class="compact-card mt-2">
                    <!-- Header Card -->
                    <div class="card-header-compact">
                        <div class="booking-id">{{ $booking->Order_id ?? '-' }}</div>
                        @if ($booking->status == 'pending')
                            <div class="status-badge">{{ $booking->status }}</div>
                        @endif
                        @if ($booking->status == 'confirmed')
                            <div class="status-badge bg-success text-white">{{ $booking->status }}</div>
                        @endif
                    </div>

                    <!-- Body Card -->
                    <div class="card-body-compact">
                        <!-- Tanggal -->
                        <div class="info-row">
                            <div class="info-label">Tanggal & Waktu</div>
                            <div class="info-value date-range">
                                {{ \Carbon\Carbon::parse($booking->created_at, 'Asia/Jakarta')->locale('id')->format('d F Y') }}
                                / {{ \Carbon\Carbon::parse($booking->hour_start)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($booking->hour_end)->format('H:i') }}</div>
                        </div>

                        <!-- Nama Tamu -->
                        <div class="info-row">
                            <div class="info-label">Name</div>
                            <div class="info-value">
                                <i class="fas fa-user guest-icon"></i>
                                <span class="guest-name">{{ $booking->user->name }}</span>
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="info-row">
                            <div class="info-label">Lapangan</div>
                            <div class="info-value">{{ $booking->schedule->field->name }}</div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="info-row">
                            <div class="info-label">Status Pemabayaran</div>
                            <div class="info-value">{{ $payment->status }}</div>
                        </div>


                        <div class="info-row">
                            <div class="info-label">Total</div>
                            <div class="info-value" style="color: #e74c3c; font-weight: 700;">Rp.
                                {{ number_format($booking->price, 0, ',', '.') }}</div>
                        </div>

                        <!-- Catatan kecil -->
                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle icon-small me-1"></i>
                                Batas pembayaran: 1 Jam setelah pesanan ini di buat
                            </small>
                        </div>
                    </div>

                    <!-- Footer dengan Tombol -->
                    @if ($booking->status == 'confirmed')
                        <div class="card-footer-compact">
                            <button class="btn-compact btn-cancel-compact" id="cancelBtn">
                                <i class="fas fa-times icon-small"></i> Cancel
                            </button>
                            <form action="{{ route('user.booking-user.store.payment', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-compact btn-pay-compact" id="payBtn">
                                    <i class="fas fa-credit-card icon-small"></i> Bayar Sekarang
                                </button>
                            </form>
                        </div>
                </div>
            @endif
            @if ($booking->status == 'pending')
                <div class="card-footer-compact">
                    <a href="{{ route('user.booking-user.cancel', $booking->id) }}" class="btn-compact btn-cancel-compact"
                        id="cancelBtn">
                        <i class="fas fa-times icon-small"></i> Cancel
                    </a>
                </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
@endsection
