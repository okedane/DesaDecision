<!-- Modal Detail Pelamar -->
<div class="modal fade text-left" id="detailModal{{ $pelamar->id }}" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel{{ $pelamar->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $pelamar->id }}">Detail Pelamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <!-- Informasi Pribadi -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3"><strong>Informasi Pribadi</strong></h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>NIK</strong></label>
                                <p class="text-muted">{{ $pelamar->nik }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Nama Lengkap</strong></label>
                                <p class="text-muted">{{ $pelamar->nama_lengkap }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Email</strong></label>
                                <p class="text-muted">{{ $pelamar->user->email }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Jenis Kelamin</strong></label>
                                <p class="text-muted">{{ ucfirst($pelamar->jenis_kelamin) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Tanggal Lahir</strong></label>
                                <p class="text-muted">{{ \Carbon\Carbon::parse($pelamar->tanggal_lahir)->format('d-m-Y') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>No. HP</strong></label>
                                <p class="text-muted">{{ $pelamar->no_hp }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label"><strong>Alamat</strong></label>
                                <p class="text-muted">{{ $pelamar->alamat }}</p>
                            </div>
                        </div>
                        @if ($pelamar->foto)
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label"><strong>Foto</strong></label>
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $pelamar->foto) }}" alt="Foto {{ $pelamar->nama_lengkap }}"
                                            class="img-fluid rounded" style="max-height: 200px; max-width: 200px;">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Dokumen/Berkas -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3"><strong>Dokumen/Berkas</strong></h6>
                        @if ($pelamar->berkasPerlamar->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Jenis Dokumen</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelamar->berkasPerlamar as $berkas)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ ucfirst(str_replace('_', ' ', $berkas->jenis)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($berkas->file)
                                                        <small class="text-muted">{{ basename($berkas->file) }}</small>
                                                    @else
                                                        <small class="text-danger">Tidak ada file</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($berkas->file)
                                                        <a href="{{ asset('storage/' . $berkas->file) }}" 
                                                            class="btn btn-sm btn-outline-primary" 
                                                            target="_blank"
                                                            download>
                                                            <i class="bi bi-download"></i> Download
                                                        </a>
                                                    @else
                                                        <small class="text-muted">-</small>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info" role="alert">
                                <i class="bi bi-info-circle"></i> Belum ada dokumen/berkas yang diunggah.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
