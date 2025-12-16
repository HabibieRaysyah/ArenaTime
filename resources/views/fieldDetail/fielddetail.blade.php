@extends('templates.app')
@push('style')
    <style>
        :root {
            --primary: #FF6B35;
            --primary-light: #FF8E53;
            --secondary: #00A8E8;
            --accent: #FFD166;
            --success: #06D6A0;
            --error: #EF476F;
            --background: #F8FAFC;
            --surface: #FFFFFF;
            --surface-light: #F1F5F9;
            --text: #1E293B;
            --text-light: #64748B;
            --border: #E2E8F0;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.6;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }

        /* Hero Section */
        .court-hero {
            margin-top: 76px;
            position: relative;
        }

        .court-gallery {
            position: relative;
            height: 500px;
            overflow: hidden;
            border-radius: 0 0 20px 20px;
        }

        .main-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-thumbnails {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .thumbnail {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--primary);
            transform: scale(1.1);
        }

        .court-badge {
            position: absolute;
            top: 30px;
            left: 30px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Court Details */
        .court-details {
            padding: 50px 0;
        }

        .court-header {
            margin-bottom: 30px;
        }

        .court-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: var(--text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .court-location {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .court-rating {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
        }

        .rating-stars {
            color: #FFD700;
            font-size: 1.2rem;
        }

        .rating-text {
            font-weight: 600;
            color: var(--text);
        }

        .review-count {
            color: var(--text-light);
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .feature-card {
            background: var(--surface);
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.5rem;
        }

        .feature-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--text);
        }

        .feature-desc {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Booking Section */
        .booking-section {
            background: var(--surface);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow);
            margin-top: 30px;
            position: sticky;
            top: 100px;
        }

        .price-display {
            text-align: center;
            margin-bottom: 30px;
        }

        .price-amount {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }

        .price-period {
            color: var(--text-light);
            font-size: 1rem;
        }

        .time-slots {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
            margin: 20px 0;
        }

        .time-slot {
            padding: 12px;
            border: 2px solid var(--border);
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .time-slot:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .time-slot.selected {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        .time-slot.booked {
            background: var(--surface-light);
            color: var(--text-light);
            cursor: not-allowed;
            text-decoration: line-through;
        }

        /* Reviews Section */
        .reviews-section {
            margin-top: 50px;
        }

        .review-card {
            background: var(--surface);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .review-header {
            display: flex;
            justify-content: between;
            align-items: start;
            margin-bottom: 15px;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .reviewer-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .reviewer-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .review-date {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .review-content {
            color: var(--text);
            line-height: 1.6;
        }

        /* Add Review Section */
        .add-review-section {
            background: var(--surface);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            margin-top: 30px;
            border: 1px solid var(--border);
        }

        .add-review-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text);
        }

        .star-rating {
            display: flex;
            gap: 5px;
            margin-bottom: 20px;
        }

        .star {
            font-size: 1.8rem;
            color: var(--border);
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .star:hover,
        .star.active {
            color: #FFD700;
        }

        .review-form textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Similar Courts */
        .similar-courts {
            margin-top: 50px;
        }

        .court-card {
            background: var(--surface);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }

        .court-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .court-card-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .court-card-body {
            padding: 20px;
        }

        .court-card-title {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .court-card-price {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .court-hero {
                margin-top: 66px;
            }

            .court-gallery {
                height: 300px;
            }

            .court-title {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .time-slots {
                grid-template-columns: repeat(3, 1fr);
            }

            .booking-section {
                position: static;
                margin-top: 30px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="court-hero">
        <div class="court-gallery">
            <img src="{{ asset('storage/' . $schedule->field->picture) }}" class="main-image" alt="Lapangan Badminton Pro"
                id="mainImage">
        </div>
    </section>

    <!-- Court Details -->
    <section class="court-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Court Header -->
                    <div class="court-header animate-fadeInUp">
                        <h1 class="court-title">{{ $schedule->field->name }}</h1>
                        <div class="court-location">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <span>{{ $schedule->field->type }}</span>
                        </div>
                        <div class="court-rating">
                            <div class="rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="rating-text">4.5</span>
                            <span class="review-count">(413 reviews)</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="court-description animate-fadeInUp">
                        <h3 class="mb-3">Deskripsi Lapangan</h3>
                        {!! $schedule->field->description !!}
                    </div>

                    <!-- Features -->
                    <div class="features-section animate-fadeInUp">
                        <h3 class="mb-4">Fasilitas & Fitur</h3>
                        <div class="features-grid">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-wind"></i>
                                </div>
                                <div class="feature-name">AC & Ventilasi</div>
                                <div class="feature-desc">Suhu terkontrol</div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div class="feature-name">Pencahayaan LED</div>
                                <div class="feature-desc">Cahaya optimal</div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-shower"></i>
                                </div>
                                <div class="feature-name">Kamar Mandi</div>
                                <div class="feature-desc">Air panas & dingin</div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="feature-name">Loker Pribadi</div>
                                <div class="feature-desc">Aman & nyaman</div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <div class="feature-name">Parkir Luas</div>
                                <div class="feature-desc">Gratis & aman</div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div class="feature-name">Kantin</div>
                                <div class="feature-desc">Makanan & minuman</div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Review Section -->
                    <div class="add-review-section animate-fadeInUp">
                        <h3 class="add-review-title">Tambah Ulasan Anda</h3>
                        <form id="reviewForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Rating</label>
                                <div class="star-rating">
                                    <span class="star" data-rating="1">★</span>
                                    <span class="star" data-rating="2">★</span>
                                    <span class="star" data-rating="3">★</span>
                                    <span class="star" data-rating="4">★</span>
                                    <span class="star" data-rating="5">★</span>
                                </div>
                                <input type="hidden" id="ratingValue" name="rating" value="0">
                            </div>

                            <div class="mb-3">
                                <label for="reviewerName" class="form-label fw-bold">Nama</label>
                                <input type="text" class="form-control" id="reviewerName"
                                    placeholder="Masukkan nama Anda" required>
                            </div>

                            <div class="mb-3">
                                <label for="reviewContent" class="form-label fw-bold">Ulasan</label>
                                <textarea class="form-control" id="reviewContent" rows="4"
                                    placeholder="Bagikan pengalaman Anda menggunakan lapangan ini..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Ulasan
                            </button>
                        </form>
                    </div>

                    <!-- Reviews -->
                    <div class="reviews-section animate-fadeInUp">
                        <h3 class="mb-4">Ulasan Pelanggan</h3>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">BS</div>
                                    <div>
                                        <div class="reviewer-name">Budi Santoso</div>
                                        <div class="review-date">2 minggu yang lalu</div>
                                    </div>
                                </div>
                                <div class="rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="review-content">
                                Lapangan sangat bagus dan bersih. Pencahayaan sangat optimal untuk bermain malam hari.
                                Pelayanan staff juga ramah dan profesional. Highly recommended!
                            </div>
                        </div>

                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">SI</div>
                                    <div>
                                        <div class="reviewer-name">Sari Indah</div>
                                        <div class="review-date">1 bulan yang lalu</div>
                                    </div>
                                </div>
                                <div class="rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="review-content">
                                Fasilitas lengkap dan nyaman. Lokasinya strategis dan parkir luas.
                                Hanya saja kadang agak sulit dapat slot di weekend, harus booking jauh-jauh hari.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Section -->
                <div class="col-lg-4">
                    <div class="booking-section animate-fadeInUp">
                        <div class="price-display">
                            <div class="price-amount">Rp {{ number_format($schedule->hourly_price, 0, ',', '.') }}</div>
                            <div class="price-period">per jam</div>
                        </div>

                        <form id="bookingForm" action="{{ route('user.booking.store', $schedule->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-bold">Pilih Tanggal</label>
                                <input type="date" class="form-control" name="date" id="bookingDate" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Pilih Waktu</label>
                                <div class="time-slots">
                                    <select name="hours" class="form-select" id="">
                                        <option selected disabled hidden>--Pilih main jam berapa--</option>
                                        @foreach ($schedule->hour as $hour)
                                            <option value="{{ $hour }}">{{ $hour }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Durasi</label>
                                <select class="form-select" name="duration" id="duration">
                                    <option disabled hidden selected>-- Berapa Jam? --</option>
                                    <option value="1">1 Jam</option>
                                    <option value="2">2 Jam</option>
                                    <option value="3">3 Jam</option>
                                    <option value="4">4 Jam</option>
                                </select>
                            </div>

                            <div class="booking-summary mb-4 p-3 bg-light rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal (...):</span>
                                    <span>Rp ...</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total:</span>
                                    <span>Rp ...</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                                <i class="fas fa-calendar-check me-2"></i>Booking Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Similar Courts -->
    <section class="similar-courts">
        <div class="container">
            <h3 class="mb-4">Lapangan Serupa</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="court-card">
                        <img src="https://images.unsplash.com/photo-1595436106560086-2d4d594e437c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="court-card-img" alt="Lapangan Badminton Elite">
                        <div class="court-card-body">
                            <h5 class="court-card-title">Lapangan Badminton Elite</h5>
                            <p class="text-muted mb-2">Gedung B, Jakarta Selatan</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="court-card-price">Rp 75.000/jam</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="court-card">
                        <img src="https://images.unsplash.com/photo-1518604666860-9ed391f76460?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="court-card-img" alt="Lapangan Futsal Pro">
                        <div class="court-card-body">
                            <h5 class="court-card-title">Lapangan Futsal Pro</h5>
                            <p class="text-muted mb-2">Outdoor, Jakarta Pusat</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <div class="court-card-price">Rp 150.000/jam</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="court-card">
                        <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="court-card-img" alt="Lapangan Basket Supreme">
                        <div class="court-card-body">
                            <h5 class="court-card-title">Lapangan Basket Supreme</h5>
                            <p class="text-muted mb-2">Indoor, Jakarta Timur</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="court-card-price">Rp 120.000/jam</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        // Time slot selection
        function selectTimeSlot(slot) {
            if (!slot.classList.contains('booked')) {
                document.querySelectorAll('.time-slot').forEach(s => {
                    s.classList.remove('selected');
                });
                slot.classList.add('selected');
            }
        }



        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('bookingDate').min = today;

        // Update booking summary
        function updateBookingSummary() {
            const duration = document.getElementById('duration').value;
            const pricePerHour = {{ $schedule->hourly_price }};
            const total = pricePerHour * duration;

            document.querySelector('.booking-summary').innerHTML = `
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal (${duration} jam):</span>
                    <span>Rp ${(pricePerHour * duration).toLocaleString()}</span>
                </div>
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total:</span>
                    <span>Rp ${total.toLocaleString()}</span>
                </div>
            `;
        }

        document.getElementById('duration').addEventListener('change', updateBookingSummary);

        // Star rating functionality
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('ratingValue');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingValue.value = rating;

                // Update star display
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });

        // Review form submission
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('reviewerName').value;
            const content = document.getElementById('reviewContent').value;
            const rating = ratingValue.value;

            if (rating === '0') {
                alert('Silakan berikan rating terlebih dahulu!');
                return;
            }

            // Create new review element
            const reviewsSection = document.querySelector('.reviews-section');
            const newReview = document.createElement('div');
            newReview.className = 'review-card animate-fadeInUp';

            // Generate initials for avatar
            const initials = name.split(' ').map(n => n[0]).join('').toUpperCase();

            // Create star rating HTML
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    starsHtml += '<i class="fas fa-star"></i>';
                } else {
                    starsHtml += '<i class="far fa-star"></i>';
                }
            }

            newReview.innerHTML = `
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="reviewer-avatar">${initials}</div>
                        <div>
                            <div class="reviewer-name">${name}</div>
                            <div class="review-date">Baru saja</div>
                        </div>
                    </div>
                    <div class="rating-stars">
                        ${starsHtml}
                    </div>
                </div>
                <div class="review-content">
                    ${content}
                </div>
            `;

            // Insert new review at the top of reviews section
            reviewsSection.insertBefore(newReview, reviewsSection.children[1]);

            // Reset form
            document.getElementById('reviewForm').reset();
            ratingValue.value = '0';
            stars.forEach(star => star.classList.remove('active'));

            // Show success message
            alert('Ulasan berhasil ditambahkan! Terima kasih atas ulasan Anda.');
        });
    </script>
    @if (Session::get('success'))
        <script>
            Swal.fire({
                title: "{{ session('success') }}",
                icon: "success",
                draggable: true
            });
        </script>
    @endif

@endpush
