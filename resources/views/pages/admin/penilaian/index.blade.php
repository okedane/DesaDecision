<x-app>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Penilaian</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header float-start float-lg-end'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Kriteria</h5>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#default">
                        Create
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class='table table-striped w-100'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Bobot</th>
                                    <th>Sifat</th>
                                    <th class="no-export">Action</th>
                                </tr>
                            </thead>K</h3 <tbody>
                            @foreach ($kriteria as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->bobot }}</td>
                                    <td>{{ $item->sifat }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-sm btn-warning me-2"
                                                data-bs-toggle="modal" data-bs-target="#update{{ $item->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>

                                            <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST"
                                                id="deleteForm{{ $item->id }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>

                                            
                                            <a href="{{ route('subKriteria.index', $item->id) }}" class="btn btn-sm btn-outline-info me-2">
                                                <i class="bi bi-diagram-3"></i> Sub Kriteria
                                            </a>

                                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">
                                                                Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus kriteria
                                                            <strong>{{ $item->nama }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="document.getElementById('deleteForm{{ $item->id }}').submit();">Hapus</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <div class="modal fade text-left" id="update{{ $item->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel1">Update kriteria</h5>
                                                <button type="button" class="close rounded-pill"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <form class="form form-vertical"
                                                        action="{{ route('kriteria.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="validationCustom01">Name</label>
                                                                        <input type="text" id="validationCustom01"
                                                                            class="form-control" name="nama"
                                                                            placeholder="Name"
                                                                            value="{{ $item->nama }}">
                                                                        <div class="invalid-feedback">Please enter a
                                                                            name.</div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="validationCustom01">Bobot</label>
                                                                        <input type="number" id="validationCustom01"
                                                                            class="form-control" name="bobot"
                                                                            placeholder="Bobot" step="0.01"
                                                                            min="0.01" max="100"
                                                                            value="{{ $item->bobot }}">
                                                                        <div class="invalid-feedback">Please enter a
                                                                            bobot.</div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Sifat</label>
                                                                        <select class="form-select" name="sifat"
                                                                            required>
                                                                            <option value="cost"
                                                                                {{ $item->sifat == 'cost' ? 'selected' : '' }}>
                                                                                Cost</option>
                                                                            <option value="benefit"
                                                                                {{ $item->sifat == 'benefit' ? 'selected' : '' }}>
                                                                                Benefit</option>
                                                                        </select>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary ml-1">Accept</button>
                                                        </div>
                                                    </form>
                                                </div>
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


    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Kriteria</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('kriteria.store') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="validationCustom01">Name</label>
                                            <input type="text" id="validationCustom01" class="form-control"
                                                name="nama" placeholder="nama">
                                            <div class="invalid-feedback">Please enter a name.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom01">Bobot</label>
                                            <input type="number" id="validationCustom01" class="form-control"
                                                name="bobot" placeholder="Bobot" step="0.01" min="0.01"
                                                max="100">
                                            <div class="invalid-feedback">Please enter a bobot.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label>Sifat</label>
                                            <select class="form-select" name="sifat" required>
                                                <option value="cost">
                                                    Cost</option>
                                                <option value="benefit">
                                                    Benefit</option>
                                            </select>
                                        </div>



                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary ml-1">Accept</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app>
