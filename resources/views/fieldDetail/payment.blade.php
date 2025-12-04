@extends('templates.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('userstyle/stylePayment.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1 class="page-title">Halaman Pembayaran</h1>

        <div class="timer">
            <i class="fas fa-clock"></i> Selesaikan pembayaran dalam: <span id="countdown">14:59</span>
        </div>

        <div class="payment-container">
            <!-- Bagian detail pesanan -->
            <div class="payment-details">
                <h2 class="section-title">Detail Pesanan</h2>

                <div class="detail-item">
                    <span class="detail-label">Nama Lapangan</span>
                    <span class="detail-value lapangan-name" id="fieldName">{{ $booking->schedule->field->name }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">ID Order</span>
                    <span class="detail-value order-id" id="orderId">...</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Tanggal & Waktu</span>
                    <span class="detail-value" id="bookingTime">{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, d M Y') }}- {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i') }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Durasi</span>
                    <span class="detail-value" id="duration">{{ $booking->duration }} Jam</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Harga per Jam</span>
                    <span class="detail-value" id="pricePerHour">Rp 150.000</span>
                </div>

                <div class="summary">
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span>Rp {{{ number_format($booking->schedule->hourly_price,0,',','.') }}} x {{ $booking->duration }}</span>
                    </div>
                    <div class="summary-item" style="font-weight: 700; font-size: 1.1rem; margin-top: 10px;">
                        <span>Total Pembayaran</span>
                        <span class="amount" id="totalAmount">Rp {{ number_format($booking->price,0,',','.') }}</span>
                    </div>
                </div>

                <div class="note" style="margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 8px;">
                    <h4 style="color: var(--accent-color) ; margin-bottom: 8px;"><i class="fas fa-info-circle"></i> Catatan
                        Penting:</h4>
                    <p style="font-size: 0.9rem;">Pembayaran harus diselesaikan dalam waktu 15 menit. Setelah pembayaran
                        berhasil, Anda akan menerima email konfirmasi dan tiket elektronik.</p>
                </div>
            </div>

            <!-- Bagian formulir pembayaran -->
            <div class="payment-form">
                <h2 class="section-title">Metode Pembayaran</h2>

                <div class="form-group">
                    <label for="paymentMethod">Pilih Metode Pembayaran</label>
                    <div class="method-select-container">
                        <select id="paymentMethod" name="paymentMethod" onchange="payBtn()">
                            <option selected disabled hidden>-- Pilih metode Pembayaran --</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="e-wallet">E-Wallet (Dana, OVO, Gopay)</option>
                            <option value="qris">QRIS</option>
                            <option value="cash">Bayar di Tempat</option>
                        </select>
                    </div>
                </div>

                <!-- Detail metode pembayaran yang akan ditampilkan berdasarkan pilihan -->
                <div id="methodDetails" class="hidden">
                    <div class="form-group">
                        <h3 id="methodTitle" style="color: var(--accent-color); margin-bottom: 15px;"></h3>
                        <div id="methodInstructions"></div>
                    </div>
                </div>

                <!-- Tampilkan metode pembayaran sebagai pilihan visual -->
                <div class="payment-methods">
                    <div class="payment-method" data-method="transfer">
                        <i class="fas fa-university"></i>
                        <span>Transfer Bank</span>
                    </div>
                    <div class="payment-method" data-method="e_wallet">
                        <i class="fas fa-wallet"></i>
                        <span>E-Wallet</span>
                    </div>
                    <div class="payment-method" data-method="qris">
                        <i class="fas fa-qrcode" style="color: #8B5CF6;"></i>
                        <span>QRIS</span>
                    </div>
                    <div class="payment-method" data-method="cash">
                        <i class="fas fa-store" style="color:  var(--accent-color); "></i>
                        <span>cash</span>
                    </div>
                </div>

                <div class="total-payment">
                    <div class="total-label">Total Pembayaran</div>
                    <div class="total-amount" id="displayAmount">Rp {{ number_format($booking->price,0,',','.') }}</div>
                </div>

                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="booking_id" id="booking_id" value="{{ $booking->id }}">
                <input type="hidden" name="amount" id="amount" value="{{ $booking->price }}">
                <div class="btn-pay text-center" style="cursor: not-allowed;" id="payButton">
                    <i class="fas fa-lock"></i> Bayar Sekarang
                </div>

                <div class="note" style="margin-top: 20px; text-align: center; font-size: 0.9rem; color: #666;">
                    <p><i class="fas fa-shield-alt"></i> Pembayaran Anda aman dan terenkripsi</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let sekarang = new Date()

            let Oder_id = "ORD-" + sekarang.getFullYear() + '-' +
            Math.floor(
                1000 + Math.random() * 9000);

        let order_id = document.getElementById('orderId').textContent = Oder_id;

;

        function payBtn() {
            let paymentButton = document.querySelector('#payButton');
            let paymentMethod = $('#paymentMethod').val();
            if (paymentMethod != null) {
                paymentButton.style.background = '#8B5CF6';
                paymentButton.style.cursor = 'pointer';
                paymentButton.style.color = 'white';
                document.getElementById('payButton')
    .addEventListener('click', createPaymentData);
            } else {
                paymentButton.style.background = '';
                paymentButton.style.cursor = '';
                paymentButton.style.color = '';
                paymentButton.onClick = null;
            }
        };


        function createPaymentData() {
            $.ajax({
                url: "{{ route('user.store.payment') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    booking_id: $('#booking_id').val(),
                    user_id: $('#user_id').val(),
                    Oder_id: Oder_id,
                    metode: $('#paymentMethod').val(),
                    amount: $('#amount').val()
                },

                success: function(response){
                    let paymentId= response.data.id
                    window.location.href = `/user/struk/payment/${paymentId}`
                },

                                error: function(message) {
                    console.log(message);
                    alert('Terjadi kesalahan saat membuat data ticket!');
                },
            })
        }

    </script>

    <script>
             // Data untuk setiap metode pembayaran
        const paymentMethods = {
            transfer: {
                title: "Transfer Bank",
                instructions: `
                    <p>Silakan transfer ke rekening berikut:</p>
                    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 10px;">
                        <p><strong>Bank:</strong> BCA (Bank Central Asia)</p>
                        <p><strong>Nomor Rekening:</strong> 123 456 7890</p>
                        <p><strong>Atas Nama:</strong> ArenaTime</p>
                        <p><strong>Jumlah:</strong> <span style="color: #e74c3c; font-weight: 700;">Rp {{ number_format($booking->price,0,',','.') }}</span></p>
                    </div>
                    <p style="margin-top: 15px; font-size: 0.9rem;">Harap transfer tepat sesuai nominal di atas. Pembayaran akan diverifikasi otomatis dalam 1x24 jam.</p>
                `
            },
            e_wallet: {
                title: "E-Wallet",
                instructions: `
                    <p>Pilih salah satu e-wallet berikut:</p>
                    <div style="display: flex; gap: 15px; margin-top: 15px;">
                        <div style="flex: 1; text-align: center; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                            <i class="fas fa-mobile-alt" style="font-size: 2rem; color: var(--accent-color);"></i>
                            <p style="margin-top: 10px; font-weight: 600;">Dana</p>
                        </div>
                        <div style="flex: 1; text-align: center; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                            <i class="fas fa-bolt" style="font-size: 2rem; color: var(--accent-color);"></i>
                            <p style="margin-top: 10px; font-weight: 600;">OVO</p>
                        </div>
                        <div style="flex: 1; text-align: center; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                            <i class="fas fa-qrcode" style="font-size: 2rem; color:  var(--accent-color);"></i>
                            <p style="margin-top: 10px; font-weight: 600;">Gopay</p>
                        </div>
                    </div>
                    <p style="margin-top: 15px; font-size: 0.9rem;">Setelah memilih e-wallet, Anda akan diarahkan ke halaman pembayaran yang sesuai.</p>
                `
            },
            credit_card: {
                title: "Kartu Kredit",
                instructions: `
                    <div class="form-group">
                        <label for="cardNumber">Nomor Kartu</label>
                        <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456">
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div class="form-group" style="flex: 1;">
                            <label for="cardExpiry">Masa Berlaku (MM/YY)</label>
                            <input type="text" id="cardExpiry" placeholder="12/25">
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label for="cardCVC">CVC</label>
                            <input type="text" id="cardCVC" placeholder="123">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardName">Nama di Kartu</label>
                        <input type="text" id="cardName" placeholder="John Doe">
                    </div>
                    <p style="margin-top: 15px; font-size: 0.9rem; color: #666;">Pembayaran dengan kartu kredit diproses dengan enkripsi tingkat tinggi untuk keamanan maksimal.</p>
                `
            },
            virtual_account: {
                title: "Virtual Account",
                instructions: `
                    <p>Virtual Account akan dibuat khusus untuk transaksi ini:</p>
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 10px; text-align: center;">
                        <p style="font-size: 0.9rem; color: #666;">Nomor Virtual Account</p>
                        <p style="font-size: 1.8rem; font-weight: 700; letter-spacing: 2px; color: #2c3e50;">8888 1234 5678 9012</p>
                        <p style="margin-top: 10px; font-size: 0.9rem;">Bank: BCA, Mandiri, BRI, BNI, dan lainnya</p>
                    </div>
                    <p style="margin-top: 15px; font-size: 0.9rem;">Gunakan nomor Virtual Account di atas untuk melakukan pembayaran melalui ATM, mobile banking, atau internet banking.</p>
                `
            },
            qris: {
                title: "QRIS",
                instructions: `
                    <div style="text-align: center;">
                        <div style="width: 200px; height: 200px; background-color: #f1f1f1; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; margin-bottom: 15px;">
                        <img width=240 src="{{ asset('qrcode/R.png') }}" />
                        </div>
                        <p>Scan QR code di atas menggunakan aplikasi e-wallet atau mobile banking yang mendukung QRIS.</p>
                    </div>
                `
            },
            cash: {
                title: "Bayar di Tempat",
                instructions: `
                    <div style="background-color: #f0faf4; padding: 20px; border-radius: 8px; text-align: center;">
                        <i class="fas fa-store" style="font-size: 3rem; color:  var(--accent-color); margin-bottom: 15px;"></i>
                        <p>Anda dapat membayar langsung di lokasi lapangan sebelum pertandingan dimulai.</p>
                        <p style="margin-top: 10px; font-weight: 600;">Pastikan untuk menunjukkan ID Order: <span class="order-id">${Oder_id}</span></p>
                    </div>
                    <p style="margin-top: 15px; font-size: 0.9rem;">Booking Anda sudah terjamin. Silakan datang 30 menit sebelum waktu yang dipesan untuk proses pembayaran.</p>
                `
            }
        };

        // Elemen DOM
        const paymentMethodSelect = document.getElementById('paymentMethod');
        const methodDetails = document.getElementById('methodDetails');
        const methodTitle = document.getElementById('methodTitle');
        const methodInstructions = document.getElementById('methodInstructions');
        const paymentButtons = document.querySelectorAll('.payment-method');
        const payButton = document.getElementById('payButton');
        const countdownElement = document.getElementById('countdown');

        // Fungsi untuk menampilkan detail metode pembayaran
        function showPaymentMethodDetails(method) {
            if (method && paymentMethods[method]) {
                methodDetails.classList.remove('hidden');
                methodTitle.textContent = paymentMethods[method].title;
                methodInstructions.innerHTML = paymentMethods[method].instructions;

                // Update pilihan di select
                paymentMethodSelect.value = method;

                // Update tampilan visual metode pembayaran
                paymentButtons.forEach(btn => {
                    if (btn.dataset.method === method) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            } else {
                methodDetails.classList.add('hidden');
                paymentButtons.forEach(btn => btn.classList.remove('active'));
            }
        }

        // Event listener untuk select metode pembayaran
        paymentMethodSelect.addEventListener('change', function() {
            showPaymentMethodDetails(this.value);
        });

        // Event listener untuk tombol metode pembayaran visual
        paymentButtons.forEach(button => {
            button.addEventListener('click', function() {
                const method = this.dataset.method;
                showPaymentMethodDetails(method);
            });
        });

        // Fungsi untuk countdown timer
        function startCountdown(minutes) {
            let totalSeconds = minutes * 60;

            const countdownInterval = setInterval(() => {
                const minutesLeft = Math.floor(totalSeconds / 60);
                const secondsLeft = totalSeconds % 60;

                countdownElement.textContent =
                    `${minutesLeft.toString().padStart(2, '0')}:${secondsLeft.toString().padStart(2, '0')}`;

                // Ganti warna saat waktu hampir habis
                if (totalSeconds <= 300) { // 5 menit terakhir
                    countdownElement.style.color = '#e74c3c';
                }

                if (totalSeconds <= 0) {
                    clearInterval(countdownInterval);
                    countdownElement.textContent = "Waktu habis!";
                    payButton.disabled = true;
                    payButton.textContent = "Waktu Pembayaran Habis";
                    payButton.style.backgroundColor = "#95a5a6";
                } else {
                    totalSeconds--;
                }
            }, 1000);
        }

        // Event listener untuk tombol bayar
        payButton.addEventListener('click', function() {
            const selectedMethod = paymentMethodSelect.value;

            if (!selectedMethod) {
                alert("Silakan pilih metode pembayaran terlebih dahulu!");
                return;
            }

            // // Simulasi proses pembayaran
            // this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses Pembayaran...';
            // this.disabled = true;

            // // Simulasi delay proses
            // setTimeout(() => {
            //     alert(
            //         `Pembayaran dengan ${paymentMethods[selectedMethod].title} berhasil diproses! Anda akan menerima email konfirmasi dalam beberapa menit.`
            //     );
            //     this.innerHTML = '<i class="fas fa-check"></i> Pembayaran Berhasil';
            //     this.style.backgroundColor = "#27ae60";

            //     // Redirect ke halaman konfirmasi (simulasi)
            //     setTimeout(() => {
            //         window.location.href = "#"; // Ganti dengan URL konfirmasi sebenarnya
            //     }, 2000);
            // }, 3000);
        });

        // Inisialisasi halaman
        document.addEventListener('DOMContentLoaded', function() {
            // Set data contoh
            // document.getElementById('fieldName').textContent = "Lapangan Futsal Merdeka";

            // document.getElementById('displayAmount').textContent = "Rp 305.000";

            // Tampilkan metode pembayaran pertama sebagai default
            showPaymentMethodDetails('bank_transfer');

            // Mulai countdown 15 menit
            startCountdown(15);
        });
    </script>
@endpush
