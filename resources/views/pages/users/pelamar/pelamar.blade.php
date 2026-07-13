<x-app>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pelamar</h3>
                    <p class="text-subtitle text-muted">Manage your pelamar information</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pelamar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Isi Data Pelamar</h5>
                        </div>
                        <div class="card-body">
                            @if ($pelamars->count() > 0)
                            <!-- Jika data sudah ada, tampilkan view mode -->
                            @foreach ($pelamars as $pelamar)
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <div class="form-control bg-light">{{ $pelamar->nama_lengkap }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">NIK</label>
                                        <div class="form-control bg-light">{{ $pelamar->nik }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="form-control bg-light">{{ $pelamar->jenis_kelamin ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="form-control bg-light">{{ $pelamar->tanggal_lahir ? \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d M Y') : '-' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor HP</label>
                                        <div class="form-control bg-light">{{ $pelamar->no_hp ?? '-' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <div class="form-control bg-light">{{ $pelamar->alamat ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-warning me-2"
                                    data-bs-toggle="modal" data-bs-target="#update{{ $pelamar->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit Data
                                </button>
                                <form action="{{ route('pelamar.destroy', $pelamar->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash me-2"></i>Hapus Data
                                    </button>
                                </form>
                            </div>


                            <div class="modal fade" id="update{{ $pelamar->id }}" tabindex="-1" aria-labelledby="updateLabel{{ $pelamar->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: linear-gradient(to right, #eff6ff, #eef2ff); border-bottom: 1px solid #e2e8f0;">
                                            <h5 class="modal-title" id="updateLabel{{ $pelamar->id }}" style="color: #1e293b; font-weight: 700;">Edit Data Pelamar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="background: #f8fafc; padding: 24px;">
                                            <form id="form-update-{{ $pelamar->id }}" action="{{ route('pelamar.update', $pelamar->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 18px;">
                                                    <h6 style="margin: 0 0 14px 0; color: #1e293b; font-size: 16px; font-weight: 600;">Identitas Diri</h6>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="edit_nama_{{ $pelamar->id }}" class="form-label">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                                                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="edit_nama_{{ $pelamar->id }}" name="nama_lengkap" value="{{ old('nama_lengkap', $pelamar->nama_lengkap) }}" required style="border-radius: 10px;">
                                                                @error('nama_lengkap')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="edit_nik_{{ $pelamar->id }}" class="form-label">NIK <span style="color: #ef4444;">*</span></label>
                                                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="edit_nik_{{ $pelamar->id }}" name="nik" value="{{ old('nik', $pelamar->nik) }}" required style="border-radius: 10px;">
                                                                @error('nik')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="edit_jk_{{ $pelamar->id }}" class="form-label">Jenis Kelamin <span style="color: #ef4444;">*</span></label>
                                                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="edit_jk_{{ $pelamar->id }}" name="jenis_kelamin" required style="border-radius: 10px;">
                                                                    <option value="">Pilih</option>
                                                                    <option value="Laki-laki" {{ old('jenis_kelamin', $pelamar->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                    <option value="Perempuan" {{ old('jenis_kelamin', $pelamar->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                                </select>
                                                                @error('jenis_kelamin')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="edit_tl_{{ $pelamar->id }}" class="form-label">Tanggal Lahir <span style="color: #ef4444;">*</span></label>
                                                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="edit_tl_{{ $pelamar->id }}" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pelamar->tanggal_lahir) }}" required style="border-radius: 10px;">
                                                                @error('tanggal_lahir')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="edit_hp_{{ $pelamar->id }}" class="form-label">Nomor HP <span style="color: #ef4444;">*</span></label>
                                                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="edit_hp_{{ $pelamar->id }}" name="no_hp" value="{{ old('no_hp', $pelamar->no_hp) }}" placeholder="08xxxxxxxxxx" required style="border-radius: 10px;">
                                                                @error('no_hp')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 18px;">
                                                    <h6 style="margin: 0 0 14px 0; color: #1e293b; font-size: 16px; font-weight: 600;">Alamat</h6>
                                                    <div class="mb-3">
                                                        <label for="edit_alamat_{{ $pelamar->id }}" class="form-label">Alamat Lengkap <span style="color: #ef4444;">*</span></label>
                                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="edit_alamat_{{ $pelamar->id }}" name="alamat" rows="3" required style="border-radius: 10px;">{{ old('alamat', $pelamar->alamat) }}</textarea>
                                                        @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px;">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" form="{{ 'form-update-' . $pelamar->id }}" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @endforeach
                            @else
                            <!-- Form input jika belum ada data -->
                            <p class="text-muted mb-4">Silahkan isi data diri Anda dengan lengkap dan benar</p>
                            <form action="{{ route('pelamar.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                            @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" required>
                                            @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                            @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label">Nomor HP</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                                            @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4" required>{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>Simpan Data
                                    </button>
                                   
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app>