<x-app>

    <style>
        #statusTable th,
        #statusTable td,
        .dataTable-table th,
        .dataTable-table td {
            vertical-align: middle;
        }

        .dataTable-table th,
        .dataTable-table td {
            padding: .5rem .75rem !important;
            line-height: 1.2;
        }

        #statusTable th:last-child,
        #statusTable td:last-child {
            width: 1%;
            white-space: nowrap;
        }
    </style>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Seleksi Administrasi</h3>
                    <p class="text-subtitle text-muted">For admin to check their list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header float-start float-lg-end'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Seleksi Administrasi</li>
                        </ol>
                    </nav>  
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Seleksi Administrasi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="statusTable" data-datatable="true" data-no-sort-last="true" class='table table-striped w-100'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->pelamar->nik ?? '-' }}</td>
                                        <td>{{ $item->pelamar->nama_lengkap ?? '-' }}</td>
                                        <td>
                                            @if ($item->status === 'lolos')
                                                <span class="badge bg-success">Lolos</span>
                                            @elseif ($item->status === 'tidak_lolos')
                                                <span class="badge bg-danger">Tidak Lolos</span>
                                            @else
                                                <span class="badge bg-warning">Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-flex">
                                                <form action="{{ route('pendaftaran.update', $item->id) }}" method="POST" class="me-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="lolos">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="bi bi-check-circle"></i> Lolos
                                                    </button>
                                                </form>
                                                <form action="{{ route('pendaftaran.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="tidak_lolos">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-x-circle"></i> Tidak Lolos
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data pendaftaran belum tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>

</x-app>
