{{-- resources/views/pages/admin/hasil/index.blade.php --}}
<x-app>
    <x-slot name="title">Hasil Seleksi</x-slot>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hasil Seleksi</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header float-start float-lg-end'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hasil Seleksi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            @if($hasil->isEmpty())
            {{-- Belum ada data --}}
            <div class="card shadow-sm">
                <div class="card-body text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    <p class="mb-1">Belum ada data hasil seleksi.</p>
                    <small>Proses dan simpan hasil di halaman <a href="{{ route('topsis.index') }}">Perhitungan TOPSIS</a>.</small>
                </div>
            </div>
            @else

            {{-- Ringkasan --}}
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                        style="border-left: 4px solid #10b981 !important; border-radius: 12px;">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div style="background: rgba(16,185,129,0.1); border-radius: 50%; width:52px; height:52px;"
                                class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-people-fill fs-4 text-success"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Total Pelamar</div>
                                <div class="fw-bold fs-4">{{ $hasil->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                        style="border-left: 4px solid #10b981 !important; border-radius: 12px;">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div style="background: rgba(16,185,129,0.1); border-radius: 50%; width:52px; height:52px;"
                                class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Lolos</div>
                                <div class="fw-bold fs-4 text-success">{{ $totalLolos }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm h-100"
                        style="border-left: 4px solid #ef4444 !important; border-radius: 12px;">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div style="background: rgba(239,68,68,0.1); border-radius: 50%; width:52px; height:52px;"
                                class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-x-circle-fill fs-4 text-danger"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Tidak Lolos</div>
                                <div class="fw-bold fs-4 text-danger">{{ $totalTidakLolos }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th class="text-start ps-3">Nama Pelamar</th>
                                    <th>NIK</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Keterangan (Skor TOPSIS)</th>
                                    <th>Tanggal Pengumuman</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil as $i => $item)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td class="ps-3">
                                        <span class="fw-semibold">{{ $item->pelamar->nama_lengkap ?? '-' }}</span>
                                    </td>
                                    <td class="text-center">{{ $item->pelamar->nik ?? '-' }}</td>
                                    <td class="text-center">
                                        <small>{{ $item->pelamar->user->email ?? '-' }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if($item->status === 'lolos')
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="bi bi-check-circle me-1"></i> Lolos
                                        </span>
                                        @else
                                        <span class="badge bg-danger px-3 py-2">
                                            <i class="bi bi-x-circle me-1"></i> Tidak Lolos
                                        </span>
                                        @endif
                                    </td>
                                    <td><small class="text-muted">{{ $item->keterangan ?? '-' }}</small></td>
                                    <td class="text-center">
                                        <small>
                                            {{ $item->tanggal_pengumuman
                                            ? $item->tanggal_pengumuman->format('d M Y, H:i')
                                            : '-' }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('hasil.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @endif
         </div>
    </div>
</x-app>