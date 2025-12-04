@extends('admin.template.app')

@push('style')
    <style>
        /* Content Area */
        .content {
            padding: 30px;
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
        }

        .page-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-recyle {
            background: var(--accent);
            color: white;
        }

        .btn-recyle:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--border);
            color: var(--text);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Table Container */
        .table-container {
            background: var(--surface);
            border-radius: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .table-header {
            padding: 25px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .search-box {
            position: relative;
        }

        .search-input {
            padding: 10px 15px 10px 40px;
            border: 2px solid var(--border);
            border-radius: 8px;
            width: 300px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: var(--surface-light);
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--text);
            border-bottom: 2px solid var(--border);
        }

        .table td {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: var(--surface-light);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: rgba(6, 214, 160, 0.1);
            color: var(--success);
        }

        .status-inactive {
            background: rgba(239, 71, 111, 0.1);
            color: var(--error);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-search {
            background: rgba(255, 107, 53, 0.1);
            color: var(--primary);
        }

        .btn-search:hover {
            background: var(--secondary);
            color: white;
        }

        .btn-edit {
            background: rgba(255, 107, 53, 0.1);
            color: var(--primary);
        }

        .btn-edit:hover {
            background: var(--primary);
            color: white;
        }

        .btn-delete {
            background: rgba(239, 71, 111, 0.1);
            color: var(--error);
        }

        .btn-delete:hover {
            background: var(--error);
            color: white;
        }

        /* Form Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: var(--surface);
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow);
        }

        .modal-header {
            padding: 25px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-light);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-btn:hover {
            color: var(--error);
        }

        .modal-body {
            padding: 25px;
        }

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

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-top: 1px solid var(--border);
        }

        .pagination-info {
            color: var(--text-light);
            font-size: 14px;
        }

        .pagination-controls {
            display: flex;
            gap: 10px;
        }

        .page-btn {
            padding: 8px 12px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .page-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .page-btn:hover:not(.active) {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .search-input {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .table-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .search-input {
                width: 100%;
            }

            .table-container {
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h2 class="page-title">Data Lapangan</h2>
        <div class="page-actions">
            <a href="{{ route('admin.fields.export') }}" class="btn btn-outline">
                <i class="fas fa-download"></i>
                Export
            </a>
            <a href="{{ route('admin.fields.trash') }}" class="btn btn-recyle">
                <i class="fas fa-trash"></i>
                Recylebin
            </a>
            <button class="btn btn-primary" onclick="openModal()">
                <i class="fas fa-plus"></i>
                Tambah Lapangan
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">Daftar Lapangan</h3>
            <div class="table-actions">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Cari lapangan...">
                </div>
                <select class="form-select" style="width: auto;">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                </select>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Foto Lapangan</th>
                    <th>Nama Lapangan</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fields as $index => $field)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $field->picture) }}" alt="Logo {{ $field->name }}"
                                class="rounded" style="width: auto; height: 80px; object-fit: contain;">
                        </td>
                        <td>{{ $field->name }}</td>
                        <td><span class="status-badge status-active">{{ $field->type }}</span></td>
                        <td><span class="status-badge status-active">{{ $field->status }}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-search" onclick="showModal({{ $field }})">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                                <a class="btn-action btn-edit" href="{{ Route('admin.fields.edit', $field->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-delete" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <td colspan="10" class="text-center py-5 text-secondary">
                        <h1>Data Tidak Ada</h1>
                        <i class="fa-solid fa-trash" style="font-size: 100px"></i>
                    </td>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <div class="pagination-info">
                Menampilkan 1-4 dari 12 data
            </div>
            <div class="pagination-controls">
                <button class="page-btn">Previous</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">Next</button>
            </div>
        </div>
    </div>
    </div>
    </main>
    </div>

    <!-- Modal Form -->
    <div class="modal" id="formModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Tambah Lapangan Baru</h3>
                <button class="close-btn" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ Route('admin.fields.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="courtName">Nama Lapangan</label>
                            <input type="text" class="form-control" placeholder="Isi nama Lengkap di sini" required
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label" for="courtName">Foto Lapangan</label>
                                <input type="file" class="form-control" placeholder="Isi nama Lengkap di sini" required
                                    name="picture" value="{{ old('picture') }}">
                                @error('picture')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="sportType">Type</label>
                        <select class="form-control" name="type"required>
                            <option disabled hidden selected>Pilih Jenis Olahraga</option>
                            <option value="indoor">Indoor</option>
                            <option value="outdoor">Outdoor</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="capacity">description</label>
                        <textarea id="description" class="form-control" placeholder="description" required name="description">{{ old('description') }} </textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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

    <!-- Modal Detail -->
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Detail Sekolah</h5>
                </div>
                <div id="modalDetailBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Modal Functions
        function openModal() {
            document.getElementById('formModal').classList.add('show');
            document.getElementById('modalTitle').textContent = 'Tambah Lapangan Baru';
            document.getElementById('courtForm').reset();
        }

        function closeModal() {
            document.getElementById('formModal').classList.remove('show');
        }

        function showModal(field) {
            // mengambil image dengan fungsi php
            let image = "{{ asset('storage/') }}" + "/" + field.picture;
            // cosole.log(it)
            // backtip (``) : menyimpan string yg berbaris -baris, ada enternya
            let content = `
                        <img src="${image}" width="120" class="d-block mx-auto my-2 img-thumbnail img-thumbnail">
                        <ul>
                            <li>Name : ${field.name}</li>
                            <li>Vision : ${field.type}</li>
                            <li>Mision : ${field.status}</li>
                            <li>Description  : ${field.description}</li>
                        </ul>
                        `;
            console.log(content)
            // panggil element HTML yang akan diisi konten diatas : document.querySelector()
            let modalDetailBody = document.querySelector('#modalDetailBody');
            // isi konten HTML : innerHTML
            modalDetailBody.innerHTML = content;
            // panggil element HTML bagian modal
            let modalDetail = document.querySelector("#modalDetail");
            // munculkan modal boostrap
            new mdb.Modal(modalDetail).show();

        }

        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                console.log('Editor siap dipakai!', editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
