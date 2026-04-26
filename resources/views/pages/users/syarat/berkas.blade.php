<x-app>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Berkas</h3>
                    <p class="text-subtitle text-muted">Kelola dokumen dan berkas Anda</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Berkas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                            <div>
                                <h6 class="mb-1">Pendaftaran Test Administrasi</h6>
                                @if ($pendaftaran)
                                    @if ($pendaftaran->status === 'lolos')
                                        <span class="badge bg-success">Status: Lolos</span>
                                    @elseif ($pendaftaran->status === 'tidak_lolos')
                                        <span class="badge bg-danger">Status: Tidak Lolos</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Status: Menunggu</span>
                                    @endif
                                @elseif (!$isBerkasLengkap)
                                    <span class="text-muted">Lengkapi 5 berkas wajib untuk mengaktifkan tombol daftar.</span>
                                @else
                                    <span class="text-muted">Semua berkas lengkap. Anda bisa lanjut daftar.</span>
                                @endif
                            </div>

                            @if (!$pendaftaran)
                                <form action="{{ route('pendaftaran.store') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" {{ $isBerkasLengkap ? '' : 'disabled' }}>
                                        <i class="bi bi-send-check me-1"></i> Daftar Test Administrasi
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @if (session('success'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
                @endif

                @if (session('error'))
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
                @endif

                <!-- Form untuk setiap jenis berkas -->
                @foreach(['ktp' => 'KTP', 'ijazah' => 'Ijazah', 'pas_foto' => 'Pas Foto', 'cv' => 'CV', 'surat_sehat' => 'Surat Sehat'] as $key => $label)
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 16px;">
                            <h6 style="color: white; margin: 0; font-weight: 600;">{{ $label }}</h6>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            @php
                                $berkasItem = $berkas->where('jenis', $key)->first();
                            @endphp

                            @if($berkasItem)
                                <!-- Jika berkas sudah ada -->
                                <div class="text-center mb-3">
                                    <i class="bi bi-check-circle" style="font-size: 40px; color: #10b981;"></i>
                                    <p class="text-muted small mt-2">Berkas sudah diunggah</p>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block mb-2"><strong>File:</strong> {{ $berkasItem->file }}</small>
                                    <small class="text-muted d-block mb-2"><strong>Diupload:</strong> {{ \Carbon\Carbon::parse($berkasItem->created_at)->format('d M Y H:i') }}</small>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ asset('storage/berkas/' . $berkasItem->file) }}" target="_blank" class="btn btn-sm btn-outline-primary flex-grow-1" style="border-radius: 8px;">
                                        <i class="bi bi-download me-1"></i> Lihat
                                    </a>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $berkasItem->id }}" style="border-radius: 8px;">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('berkas.destroy', $berkasItem->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="border-radius: 8px;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="edit{{ $berkasItem->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: linear-gradient(to right, #eff6ff, #eef2ff); border-bottom: 1px solid #e2e8f0;">
                                                <h5 class="modal-title" style="color: #1e293b; font-weight: 700;">Edit {{ $label }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body" style="background: #f8fafc; padding: 24px;">
                                                <form id="form-edit-{{ $berkasItem->id }}" action="{{ route('berkas.update', $berkasItem->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="jenis" value="{{ $key }}">

                                                    <div class="mb-3">
                                                        <label class="form-label">File Saat Ini <span style="color: #ef4444;">*</span></label>
                                                        <div class="alert alert-info" role="alert">
                                                            <small><strong>{{ $berkasItem->file }}</strong></small>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="file_edit_{{ $berkasItem->id }}" class="form-label">Upload File Baru <span style="color: #ef4444;">*</span></label>
                                                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file_edit_{{ $berkasItem->id }}" name="file" accept=".pdf,.jpg,.jpeg,.png" style="border-radius: 10px;">
                                                        <small class="text-muted d-block mt-2">Format: PDF, JPG, PNG (Max: 2MB)</small>
                                                        @error('file')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0;">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" form="form-edit-{{ $berkasItem->id }}" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Jika berkas belum ada -->
                                <div class="text-center mb-3">
                                    <i class="bi bi-file-earmark-text" style="font-size: 40px; color: #cbd5e1;"></i>
                                    <p class="text-muted small mt-2">Belum diunggah</p>
                                </div>

                                <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="jenis" value="{{ $key }}">

                                    <div class="mb-3">
                                        <label for="file_{{ $key }}" class="form-label">Pilih File <span style="color: #ef4444;">*</span></label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file_{{ $key }}" name="file" accept=".pdf,.jpg,.jpeg,.png" required style="border-radius: 10px;">
                                        <small class="text-muted d-block mt-2">Format: PDF, JPG, PNG (Max: 2MB)</small>
                                        @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100" style="border-radius: 10px;">
                                        <i class="bi bi-upload me-2"></i>Upload
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                
                @endforeach
            </div>
        </section>
    </div>
</x-app>