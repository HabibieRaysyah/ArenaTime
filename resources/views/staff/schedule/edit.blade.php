@extends('staff.template.app')

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
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h1>Edit Jadwal Lapangan</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ Route('staff.schedules.update', $schedule->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="courtName">Pilih Lapangan</label>
                            <select type="text" class="form-control" placeholder="Isi nama Lengkap di sini"
                                name="field_id" value="{{ old('field_id') }}">
                                <option disabled selected hidden>{{ $schedule->field->name }}</option>
                            </select>
                            @error('field_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label" for="courtName">Jadwal Lapangan</label>
                                @foreach ($schedule->hour as $hour)
                                    <input type="time" class="form-control mt-2" placeholder="Isi nama Lengkap di sini"
                                        name="hour[]" value="{{ $hour }}">
                                    @error('hours.*')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="form-label" for="courtName">Harga Perjam</label>
                            <input type="number" class="form-control" placeholder="Harga"
                                name="price_hourly" value="{{ $schedule->hourly_price }}">
                            @error('price_hourly')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

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
