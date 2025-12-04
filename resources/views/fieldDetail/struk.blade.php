<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - Sewa Lapangan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', monospace, 'Segoe UI', sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            max-width: 800px;
            width: 100%;
            margin: 20px auto;
        }

        header {
            background-color: #2ecc71;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .logo i {
            margin-right: 10px;
            font-size: 2rem;
        }

        .success-message {
            text-align: center;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #c3e6cb;
        }

        .success-message i {
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: block;
        }

        .receipt-container {
            background-color: white;
            border-radius: 10px;
            padding: 0;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .receipt-header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .receipt-title {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .receipt-subtitle {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .receipt-body {
            padding: 25px;
        }

        .receipt-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 2px dashed #ddd;
        }

        .info-group {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.1rem;
            color: #333;
        }

        .field-name {
            color: #2ecc71;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .order-id {
            background-color: #f8f9fa;
            padding: 8px 12px;
            border-radius: 6px;
            font-family: monospace;
            font-weight: 600;
            display: inline-block;
        }

        .payment-method-badge {
            display: inline-block;
            background-color: #e8f5e9;
            color: #2ecc71;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .amount {
            color: #e74c3c;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .booking-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .details-title {
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 1.2rem;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
        }

        .detail-value {
            font-weight: 500;
            color: #333;
        }

        .receipt-summary {
            background-color: #f9fdfb;
            border: 2px solid #2ecc71;
            border-radius: 8px;
            padding: 20px;
            margin-top: 25px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.5rem;
            font-weight: 800;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #ddd;
            color: #e74c3c;
        }

        .receipt-footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            border-top: 2px dashed #ddd;
        }

        .footer-note {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 15px;
        }

        .barcode {
            text-align: center;
            margin: 20px 0;
        }

        .barcode-placeholder {
            display: inline-block;
            width: 200px;
            height: 80px;
            background-color: #f1f1f1;
            margin-bottom: 10px;
            position: relative;
        }

        .barcode-placeholder:before {
            content: "";
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #333;
        }

        .barcode-placeholder:after {
            content: "";
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #333;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: #2ecc71;
            color: white;
        }

        .btn-primary:hover {
            background-color: #27ae60;
        }

        .btn-secondary {
            background-color: #3498db;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #2980b9;
        }

        .btn-outline {
            background-color: white;
            color: #2c3e50;
            border: 2px solid #ddd;
        }

        .btn-outline:hover {
            background-color: #f8f9fa;
            border-color: #2c3e50;
        }

        footer {
            text-align: center;
            color: #666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            width: 100%;
            font-size: 0.9rem;
        }

        .print-only {
            display: none;
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .action-buttons,
            header,
            footer,
            .success-message {
                display: none;
            }

            .receipt-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .print-only {
                display: block;
                text-align: center;
                margin-bottom: 20px;
                font-size: 0.9rem;
                color: #666;
            }
        }

        @media (max-width: 768px) {
            .receipt-info {
                grid-template-columns: 1fr;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 8rem;
            color: rgba(46, 204, 113, 0.1);
            z-index: -1;
            pointer-events: none;
            font-weight: 800;
            white-space: nowrap;
        }

        .payment-status {
            display: inline-block;
            background-color: #d4edda;
            color: #155724;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            margin-left: 10px;
            font-size: 0.9rem;
        }

        .payment-details {
            background-color: #f0faf4;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .timestamp {
            color: #666;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="watermark">ArenaTime</div>

    <div class="container">
        <header>
            <div class="logo">
                <i class="fas fa-futbol"></i>
                <span>ArenaTime</span>
            </div>
            <p>Struk Pembayaran Sewa Lapangan</p>
        </header>

        <div class="success-message">
            <i class="fas fa-check-circle"></i>
            <h2>Pembayaran Berhasil!</h2>
            <p>Pembayaran Anda telah berhasil diproses. Berikut adalah struk resmi untuk penyewaan lapangan.</p>
        </div>

        <div class="receipt-container">
            <div class="receipt-header">
                <h2 class="receipt-title">STRUK PEMBAYARAN</h2>
                <p class="receipt-subtitle">Sewa Lapangan Olahraga</p>
            </div>

            <div class="receipt-body">
                <div class="print-only">
                    <p>Dicetak pada: <span id="printDate"></span></p>
                </div>

                <div class="receipt-info">
                    <div class="info-group">
                        <div class="info-label">Nama Lapangan</div>
                        <div class="info-value field-name" id="receiptFieldName">
                            {{ $payment['booking']['schedule']['field']['name'] }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">ID Order</div>
                        <div class="info-value order-id" id="receiptOrderId">{{ $payment['Oder_id'] }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Status Pembayaran</div>
                        <div class="info-value">
                            <span>{{ $payment['status'] }}</span>
                            <span class="payment-status">pendding</span>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Metode Pembayaran</div>
                        <div class="info-value">
                            <span class="payment-method-badge" id="receiptPaymentMethod">{{ $payment['metode'] }}</span>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Total Pembayaran</div>
                        <div class="info-value amount" id="receiptAmount">Rp
                            {{ number_format($payment['amount'], 0, ',', '.') }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Tanggal Pembayaran</div>
                        <div class="info-value" id="receiptPaymentDate">{{ \Carbon\Carbon::parse($payment['payment_date'])->format('h M Y') }}</div>
                    </div>
                </div>

                <div class="booking-details">
                    <h3 class="details-title">Detail Booking</h3>
                    <div class="details-grid">
                        <div class="detail-item">
                            <span class="detail-label">Tanggal Main</span>
                            <span class="detail-value"
                                id="bookingDate">{{ \Carbon\Carbon::parse($payment['payment_date'])->format('h M Y') }}
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Waktu</span>
                            <span class="detail-value" id="bookingTime">{{ \Carbon\Carbon::parse($payment['booking']['start_time'])->format('h:i') }} WIB</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Durasi</span>
                            <span class="detail-value" id="bookingDuration">{{ $payment['booking']['duration'] }} Jam</span>
                        </div>
                    </div>
                </div>



                <div class="receipt-summary">
                    <h3 class="details-title">Rincian Biaya</h3>
                    <div class="summary-item">
                        <span>Sewa Lapangan (2 Jam)</span>
                        <span>Rp {{ number_format($payment['amount'], 0, ',', '.') }}</span>
                    </div>
                    </div>
                    <div class="summary-total">
                        <span>TOTAL</span>
                        <span id="receiptTotalAmount">Rp {{ number_format($payment['amount'], 0, ',', '.') }}</span>
                    </div>
                </div>


            </div>

            <div class="receipt-footer">
                <p class="footer-note">
                    <i class="fas fa-info-circle"></i> Struk ini merupakan bukti pembayaran yang sah.
                    Harap bawa struk ini (cetak atau digital) saat tiba di lokasi.
                </p>
                <p class="footer-note">
                    Untuk pertanyaan atau bantuan, hubungi: <strong>support@ArenaTime.id</strong> atau
                    <strong>0812-3456-7890</strong>
                </p>
                <p class="timestamp">Dicetak secara otomatis pada: <span id="receiptTimestamp"></span></p>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn btn-primary" id="printBtn" onclick="printReceipt()">
                <i class="fas fa-print"></i> Cetak Struk
            </button>
            <a href="{{ route('user.pdf', $payment['id']) }}" class="btn btn-secondary" id="downloadBtn">
                <i class="fas fa-download"></i> Unduh PDF
            </a>
            <button class="btn btn-outline" id="shareBtn">
                <i class="fas fa-share-alt"></i> Bagikan
            </button>
            <button class="btn btn-outline" id="backBtn">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </button>
        </div>
    </div>

    <footer>
        <p>© 2023 ArenaTime - Platform Sewa Lapangan Olahraga</p>
        <p style="margin-top: 10px;">Struk ini valid hingga: <strong id="validUntil">15 Agustus 2023</strong></p>
    </footer>

    <script>
        // Data struk
        // const receiptData = {
        //     fieldName: "Lapangan Futsal Merdeka",
        //     orderId: "ORD-" + new Date().getFullYear() + "-" + Math.floor(1000 + Math.random() * 9000),
        //     paymentMethod: "Transfer Bank (BCA)",
        //     amount: "Rp 305.000",
        //     paymentDate: new Date().toLocaleDateString('id-ID', {
        //         weekday: 'long',
        //         year: 'numeric',
        //         month: 'long',
        //         day: 'numeric',
        //         hour: '2-digit',
        //         minute: '2-digit',
        //         timeZoneName: 'short'
        //     }),
        //     bookingDate: new Date(Date.now() + 2 * 24 * 60 * 60 * 1000).toLocaleDateString('id-ID', {
        //         weekday: 'long',
        //         year: 'numeric',
        //         month: 'long',
        //         day: 'numeric'
        //     }),
        //     bookingTime: "16:00 - 18:00 WIB",
        //     bookingDuration: "2 Jam",
        //     bookingLocation: "Komplek Olahraga Merdeka, Jakarta",
        //     transactionCode: "TRX-" + Math.floor(1000000000 + Math.random() * 9000000000),
        //     paymentMethodDetail: "Transfer Bank - BCA",
        //     paymentReference: "BCA" + Math.floor(1000000000000 + Math.random() * 9000000000000),
        //     transactionTime: new Date().toLocaleString('id-ID', {
        //         day: 'numeric',
        //         month: 'short',
        //         year: 'numeric',
        //         hour: '2-digit',
        //         minute: '2-digit',
        //         second: '2-digit'
        //     }),
        //     totalAmount: "Rp 305.000",
        //     barcodeNumber: (Math.floor(1000000000000000 + Math.random() * 9000000000000000)).toString().replace(/(\d{4})/g, '$1 ').trim(),
        //     receiptTimestamp: new Date().toLocaleString('id-ID'),
        //     validUntil: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toLocaleDateString('id-ID', {
        //         year: 'numeric',
        //         month: 'long',
        //         day: 'numeric'
        //     })
        // };

        // Fungsi untuk mengisi data struk
        // function populateReceiptData() {
        //     document.getElementById('receiptFieldName').textContent = receiptData.fieldName;
        //     document.getElementById('receiptOrderId').textContent = receiptData.orderId;
        //     document.getElementById('receiptPaymentMethod').textContent = receiptData.paymentMethod;
        //     document.getElementById('receiptAmount').textContent = receiptData.amount;
        //     document.getElementById('receiptPaymentDate').textContent = receiptData.paymentDate;
        //     document.getElementById('bookingDate').textContent = receiptData.bookingDate;
        //     document.getElementById('bookingTime').textContent = receiptData.bookingTime;
        //     document.getElementById('bookingDuration').textContent = receiptData.bookingDuration;
        //     document.getElementById('bookingLocation').textContent = receiptData.bookingLocation;
        //     document.getElementById('transactionCode').textContent = receiptData.transactionCode;
        //     document.getElementById('paymentMethodDetail').textContent = receiptData.paymentMethodDetail;
        //     document.getElementById('paymentReference').textContent = receiptData.paymentReference;
        //     document.getElementById('transactionTime').textContent = receiptData.transactionTime;
        //     document.getElementById('receiptTotalAmount').textContent = receiptData.totalAmount;
        //     document.getElementById('barcodeNumber').textContent = receiptData.barcodeNumber;
        //     document.getElementById('receiptTimestamp').textContent = receiptData.receiptTimestamp;
        //     document.getElementById('validUntil').textContent = receiptData.validUntil;
        //     document.getElementById('printDate').textContent = receiptData.receiptTimestamp;
        // }

        // Fungsi untuk mencetak struk
        function printReceipt() {
            window.print();
        }

        // // Fungsi untuk mengunduh struk sebagai PDF (simulasi)
        // function downloadReceipt() {
        //     const btn = document.getElementById('downloadBtn');
        //     const originalText = btn.innerHTML;

        //     btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat PDF...';
        //     btn.disabled = true;

        //     // Simulasi proses pembuatan PDF
        //     setTimeout(() => {
        //         alert("Struk berhasil diunduh sebagai PDF!");
        //         btn.innerHTML = originalText;
        //         btn.disabled = false;
        //     }, 2000);
        // }

        // // Fungsi untuk berbagi struk
        // function shareReceipt() {
        //     if (navigator.share) {
        //         navigator.share({
        //             title: 'Struk Pembayaran ArenaTime',
        //             text: `Struk pembayaran sewa lapangan ${receiptData.fieldName}. ID Order: ${receiptData.orderId}`,
        //             url: window.location.href
        //         })
        //         .then(() => console.log('Berhasil dibagikan'))
        //         .catch((error) => console.log('Error sharing:', error));
        //     } else {
        //         // Fallback untuk browser yang tidak mendukung Web Share API
        //         const shareText = `Struk pembayaran sewa lapangan ${receiptData.fieldName}.\nID Order: ${receiptData.orderId}\nTotal: ${receiptData.amount}\n\nLihat detail: ${window.location.href}`;
        //         navigator.clipboard.writeText(shareText)
        //             .then(() => alert("Tautan struk telah disalin ke clipboard!"))
        //             .catch(err => console.error('Gagal menyalin:', err));
        //     }
        // }

        // Fungsi untuk kembali ke beranda
        function goToHomepage() {
            window.location.href = "index.html"; // Ganti dengan URL beranda sebenarnya
        }

        // // Inisialisasi halaman
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Isi data struk
        //     populateReceiptData();

        //     // Event listeners untuk tombol
        //     document.getElementById('printBtn').addEventListener('click', printReceipt);
        //     document.getElementById('downloadBtn').addEventListener('click', downloadReceipt);
        //     document.getElementById('shareBtn').addEventListener('click', shareReceipt);
        //     document.getElementById('backBtn').addEventListener('click', goToHomepage);

        //     // Simulasi notifikasi sukses
        //     const successMessage = document.querySelector('.success-message');
        //     successMessage.style.animation = "none";
        //     setTimeout(() => {
        //         successMessage.style.animation = "fadeIn 1s";
        //     }, 10);
        // });

        // // Tambahkan animasi fadeIn
        // const style = document.createElement('style');
        // style.textContent = `
    //     @keyframes fadeIn {
    //         from { opacity: 0; transform: translateY(-20px); }
    //         to { opacity: 1; transform: translateY(0); }
    //     }

    //     .success-message {
    //         animation: fadeIn 1s ease-out;
    //     }
    // `;
        // document.head.appendChild(style);
    </script>
</body>

</html>
