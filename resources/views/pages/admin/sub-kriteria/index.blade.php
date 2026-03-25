<x-app>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Sub Kriteria</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header float-start float-lg-end'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kriteria</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">{{ $kriteria->nama }}</h5>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        Create
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class='table table-striped w-100'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Min Value</th>
                                    <th>Max Value</th>
                                    <th>Bobot</th>
                                    <th class="no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subKriteria as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->min_value }}</td>
                                        <td>{{ $item->max_value }}</td>
                                        <td>{{ $item->bobot }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateModal{{ $item->id }}">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus sub kriteria
                                                    <strong>{{ $item->nama }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('subKriteria.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Update Modal --}}
                                    <div class="modal fade text-left" id="updateModal{{ $item->id }}"
                                        tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Sub Kriteria</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('subKriteria.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group mb-3">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" name="nama"
                                                                value="{{ $item->nama }}" required>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label>Min Value</label>
                                                            <input type="text" class="form-control" name="min_value"
                                                                value="{{ $item->min_value }}" required>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label>Max Value</label>
                                                            <input type="text" class="form-control" name="max_value"
                                                                value="{{ $item->max_value }}" required>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label>Bobot</label>
                                                            <input type="number" class="form-control" name="bobot"
                                                                step="0.01" min="0.01" max="100"
                                                                value="{{ $item->bobot }}" required>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Accept</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Create Modal --}}
    <div class="modal fade text-left" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sub Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subKriteria.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Min Value</label>
                            <input type="text" class="form-control" name="min_value" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Max Value</label>
                            <input type="text" class="form-control" name="max_value" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Bobot</label>
                            <input type="number" class="form-control" name="bobot" step="0.01" min="0.01"
                                max="100" required>
                        </div>
                        <input type="text" class="form-control" name="kriteria_id" required
                            value="{{ $kriteria->id }}" hidden />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Accept</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
