@extends('templates.app')

@push('style')
    <style>
        /* Hero Carousel */
        .hero-carousel {
            margin-top: 76px;
        }

        .carousel-item {
            height: 85vh;
            min-height: 600px;
        }

        .carousel-item img {
            object-fit: cover;
            height: 100%;
            width: 100%;
            filter: brightness(0.7);
        }

        .carousel-caption {
            bottom: 35%;
            text-align: left;
            max-width: 600px;
            margin-left: 10%;
        }

        .carousel-caption h2 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #fff, #e3f2fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .carousel-caption p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: #f8f9fa;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Search Section */
        .search-section {
            margin-top: -80px;
            position: relative;
            z-index: 100;
        }

        .search-card {
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: none;
            overflow: hidden;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
        }

        .search-input {
            border: none;
            border-radius: 12px;
            padding: 18px 20px;
            font-size: 16px;
            background: #fff;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 113, 202, 0.1);
            border-color: var(--primary-color);
        }

        .input-group-text {
            background: white;
            border: none;
            color: var(--primary-color);
            border-radius: 12px 0 0 12px;
            padding: 18px 20px;
        }

        .btn-search {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border-radius: 0 12px 12px 0;
            padding: 0 30px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 113, 202, 0.3);
        }

        /* Categories Section */
        .categories-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .section-title {
            position: relative;
            margin-bottom: 50px;
            font-weight: 700;
            font-size: 2.5rem;
            text-align: center;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }

        .category-card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            height: 100%;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: white;
            position: relative;
        }

        .category-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .category-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.3s ease;
        }

        .category-card:hover .category-icon {
            transform: scale(1.1);
        }

        .category-card h5 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .category-card p {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        /* Lapangan Section */
        .lapangan-section {
            padding: 100px 0;
            background: white;
        }

        .card-lapangan {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .card-lapangan:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .card-lapangan:hover .card-img-top {
            transform: scale(1.1);
        }

        .price-tag {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 700;
            position: absolute;
            top: 20px;
            right: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .rating {
            color: #FFD700;
        }

        .chip {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 25px;
            background-color: #e9ecef;
            margin-right: 8px;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .chip:hover {
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
            transform: translateY(-2px);
        }

        .chip.selected {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-dark);
        }

        .btn-booking {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-booking:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 113, 202, 0.3);
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .feature-card {
            text-align: center;
            padding: 40px 20px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #FFD700;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Carousel -->
    <div id="heroCarousel" class="carousel slide hero-carousel" data-mdb-ride="carousel" data-mdb-carousel-init>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('banner/banner1.png') }}" class="d-block w-100" alt="Basketball Court">
                <div class="carousel-caption animate-fadeInUp">
                    <h2>Temukan Lapangan Olahraga Terbaik</h2>
                    <p>Booking lapangan favoritmu dengan mudah dan cepat. Pengalaman berolahraga yang tak terlupakan
                        menantimu!</p>
                    <a href="#lapangan" class="btn btn-primary btn-lg btn-booking">
                        <i class="fas fa-search me-2"></i>Jelajahi Lapangan
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('banner/banner2.png') }}" class="d-block w-100" alt="Badminton Court">
                <div class="carousel-caption animate-fadeInUp">
                    <h2>Berbagai Jenis Olahraga</h2>
                    <p>Dari badminton, futsal, basket, hingga tenis. Semua tersedia di satu platform!</p>
                    <a href="#categories" class="btn btn-primary btn-lg btn-booking">
                        <i class="fas fa-list me-2"></i>Lihat Kategori
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('banner/banner3.png') }}" class="d-block w-100" alt="Soccer Field">
                <div class="carousel-caption animate-fadeInUp">
                    <h2>Booking Online Mudah</h2>
                    <p>Pesan kapan saja, di mana saja. Sistem booking yang simpel dan terpercaya.</p>
                    <a href="#booking" class="btn btn-primary btn-lg btn-booking">
                        <i class="fas fa-calendar-check me-2"></i>Booking Sekarang
                    </a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#heroCarousel" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#heroCarousel" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="card search-card shadow">
                <div class="card-body p-5">
                    @if (Session::get('error'))
                        <div class="alert alert-success">
                            <i class="fas fa-trophy"></i>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::get('error'))
                        <div class="alert alert-dangger">
                            <i class="fas fa-trophy"></i>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="categories-section">
        <div class="container">
            <h2 class="section-title animate-fadeInUp">Kategori Olahraga</h2>
            <div class="row g-4">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card category-card text-center p-5 animate-fadeInUp">
                        <div class="category-icon">
                            <i class="fas fa-table-tennis"></i>
                        </div>
                        <h5 class="fw-bold">Badminton</h5>
                        <p class="text-muted">32 lapangan tersedia</p>
                        <span class="badge bg-primary rounded-pill">Populer</span>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card category-card text-center p-5 animate-fadeInUp">
                        <div class="category-icon">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h5 class="fw-bold">Futsal</h5>
                        <p class="text-muted">18 lapangan tersedia</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card category-card text-center p-5 animate-fadeInUp">
                        <div class="category-icon">
                            <i class="fas fa-basketball-ball"></i>
                        </div>
                        <h5 class="fw-bold">Basket</h5>
                        <p class="text-muted">15 lapangan tersedia</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card category-card text-center p-5 animate-fadeInUp">
                        <div class="category-icon">
                            <i class="fas fa-baseball-ball"></i>
                        </div>
                        <h5 class="fw-bold">Tenis</h5>
                        <p class="text-muted">12 lapangan tersedia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lapangan Section -->
    <section id="lapangan" class="lapangan-section">
        <div class="container">
            <h2 class="section-title animate-fadeInUp">Lapangan Terpopuler</h2>
            <p class="text-center text-muted mb-5 animate-fadeInUp">Temukan lapangan favoritmu dengan fasilitas terbaik dan
                harga terjangkau</p>

            <div class="row g-4">
                <!-- Lapangan 1 -->
                @foreach ($schedules as $index => $schedule)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-lapangan shadow-sm animate-fadeInUp">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $schedule->field->picture) }}" class="card-img-top"
                                    alt="Lapangan Badminton Pro">
                                <div class="price-tag">Rp {{ $schedule->hourly_price }}/jam</div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold">{{ $schedule->field->name }}</h5>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rating me-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="text-muted">4.5 (413 reviews)</span>
                                </div>
                                <p class="mb-3"><i
                                        class="fas fa-map-marker-alt text-primary me-2"></i>{{ $schedule->field->type }}
                                </p>
                                <p class="card-text text-muted mb-4">
                                    {!! Str::limit($schedule->field->description, 45, '...') !!}
                                </p>
                                <hr class="my-4" />
                                <p class="fw-bold mb-3">Ketersediaan Hari Ini</p>
                                <div class="d-flex flex-wrap mb-4">
                                    @foreach ($schedule->hour as $hour)
                                        <span class="chip">{{ $hour }}</span>
                                    @endforeach
                                </div>
                                <div class="d-grid">
                                    <a href="{{ route('field.detail', $schedule->id) }}" class="btn btn-booking">
                                        <i class="fas fa-calendar-plus me-2"></i>Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5 animate-fadeInUp">
                <a href="#" class="btn btn-outline-primary btn-lg px-5 py-3">
                    <i class="fas fa-list me-2"></i>Lihat Semua Lapangan
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-fadeInUp">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Booking Instan</h4>
                        <p>Proses booking yang cepat dan mudah hanya dalam beberapa klik</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-fadeInUp">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Terjamin & Aman</h4>
                        <p>Pembayaran aman dengan sistem yang terpercaya</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card animate-fadeInUp">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Support 24/7</h4>
                        <p>Tim support siap membantu kapan pun Anda butuhkan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
