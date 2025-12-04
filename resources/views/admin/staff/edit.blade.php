@extends('admin.template.app')

@push('style')
    <style>
        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            background: var(--surface);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .btn-cancel {
            background: var(--surface-light);
            color: var(--text);
            border: 2px solid var(--border);
        }

        .btn-cancel:hover {
            background: var(--border);
        }
    </style>
@endpush

@section('content')
    <div class="container py-3">

        @if (Session::get('success'))
            <div class="alert alert-success">
                <i class="fas fa-trophy"></i>
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::get('failed'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                {{ Session::get('failed') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <i class="fas fa-users" style="font-size: 45px;margin-right: 20px"></i>
                    <h1>Edit Staff</h1>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ Route('admin.staffs.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="courtName">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Isi nama Lengkap di sini" name="name"
                                value="{{ $user->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sportType">Role</label>
                            <select class="form-control" name="role">
                                <option disabled hidden selected>Pilih Jenis Olahraga</option>
                                <option value="staff" @if ($user->role == 'staff') selected @endif>Staff</option>
                                <option value="user"@if ($user->role == 'user') selected @endif>User</option>
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="courtName">Email</label>
                        <input type="text" class="form-control" placeholder="Isi nama Lengkap di sini" name="email"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="capacity">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-actions">
                            <button type="button" class="btn btn-cancel" onclick="closeModal()">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Simpan Data
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@pus
