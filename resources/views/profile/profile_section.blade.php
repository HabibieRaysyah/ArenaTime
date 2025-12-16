@extends('profile.profile')

@section('content')
    <!-- Content -->
    <div class="content">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-info">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                    <div class="avatar-edit">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <div class="profile-details">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p>Member sejak Januari 2023 • {{ Auth::user()->role }}</p>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-value">24</span>
                            <span class="stat-label">Total Booking</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">18</span>
                            <span class="stat-label">Berhasil</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">4.8</span>
                            <span class="stat-label">Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <!-- Informasi Pribadi -->
            <div class="profile-card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pribadi</h3>
                    <button class="btn-edit ms-3" onclick="toggleEdit('personalInfo')">
                        <i class="fas fa-edit me-2"></i>Edit
                    </button>
                </div>
                <form id="personalInfoForm" method="POST" action="{{ route('user.update.profile', Auth::user()->id) }}">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input name="name" class="form-control" value="{{ Auth::user()->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Umur</label>
                            <input name="age" class="form-control" value="{{ Auth::user()->age ?? '-' }}" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" name="number" class="form-control"
                                value="{{ Auth::user()->number_phone ?? '-' }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="address" rows="3" disabled>{{ Auth::user()->address ?? '-' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" disabled>Submit</button>
                </form>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="profile-card">
                <div class="card-header">
                    <h3 class="card-title">Aktivitas Terbaru</h3>
                </div>
                <ul class="activity-list">
                    @foreach ($activityLogs as $activity)
                        <li class="activity-item">
                            <div class="activity-icon booking">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-text">{{ $activity->description }}</div>
                                <div class="activity-time">{{ $activity->created_at->diffForHumans() }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
