@extends('profile.profile')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if ($payment->status == 'belum')
                    <h3>Silahkan Klik Button</h3>
                    <p>di bawah ini untuk melakukan pembayaran</p>

                    @if ($payment && $payment->snap_token)
                        <button type="button" id="payBtn" class="btn btn-success">Bayar Sekarang</button>
                    @else
                        <div class="alert alert-danger">
                            Token pembayaran tidak valid. Silakan coba lagi.
                        </div>
                    @endif
                @endif

            </div>
        </div>
        <div id="snap-container" class="mt-3" style="width: 100%!important"></div>
    </div>
@endsection

@push('script')
    @if ($payment && $payment->snap_token)
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script type="text/javascript">
            var payButton = document.getElementById('payBtn');
            payButton.addEventListener('click', function() {
                window.snap.embed('{{ $payment->snap_token }}', {
                    embedId: 'snap-container',
                    onSuccess: function(result) {
                        alert("Pembayaran berhasil!");
                        // $.ajax({
                        //     url : '{{ route('user.booking-user.success', $payment->id) }}',
                        //     method : 'PATCH'
                        // })
                        window.location.href = "{{ route('user.booking-user.success', $payment->id) }}";

                    },
                    onPending: function(result) {
                        alert("Menunggu pembayaran!");
                        console.log(result);
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal!");
                        console.log(result);
                    },
                    onClose: function() {
                        alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                        window.location.href = "{{ route('user.booking-user.index') }}";
                    }
                });
            });
        </script>
    @endif
@endpush
