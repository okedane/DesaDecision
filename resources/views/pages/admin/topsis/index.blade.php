{{-- resources/views/pages/admin/topsis/index.blade.php --}}
<x-app>
    <x-slot name="title">Perhitungan TOPSIS</x-slot>

    <div class="container-fluid py-4">


        {{-- Alert --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(isset($error))
        <div class="alert alert-warning d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ $error }}</span>
        </div>
        @else

        {{-- LANGKAH 1 — Matriks Keputusan Awal --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white fw-semibold">
                <span class="badge bg-white text-primary me-2">Langkah 1</span>
                Matriks Keputusan Awal
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center mb-0 align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th class="text-start ps-3">Pelamar</th>
                                @foreach($kriterias as $k)
                                <th>{{ $k->kode }}<br><small class="fw-normal text-muted">{{ $k->nama }}</small></th>
                                @endforeach
                            </tr>
                            <tr class="table-light small">
                                <th class="text-start ps-3">Sifat</th>
                                @foreach($kriterias as $k)
                                <th>
                                    <span class="badge {{ $k->sifat === 'benefit' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($k->sifat) }}
                                    </span>
                                </th>
                                @endforeach
                            </tr>
                            <tr class="table-light small">
                                <th class="text-start ps-3">Bobot (%)</th>
                                @foreach($kriterias as $k)
                                <th>{{ $k->bobot }}%</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelamars as $pelamar)
                            <tr>
                                <td class="text-start ps-3 fw-semibold">{{ $pelamar->nama_lengkap }}</td>
                                @foreach($kriterias as $k)
                                <td>{{ $matrix[$pelamar->id][$k->id] }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            <tr class="table-secondary fw-semibold small">
                                <td class="text-start ps-3">√(ΣX²)</td>
                                @foreach($kriterias as $k)
                                <td>{{ round($divider[$k->id], 4) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- LANGKAH 2 — Matriks Normalisasi --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white fw-semibold">
                <span class="badge bg-white text-info me-2">Langkah 2</span>
                Matriks Normalisasi
                <small class="fw-normal ms-2">r<sub>ij</sub> = x<sub>ij</sub> / √(Σx<sub>kj</sub>²)</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center mb-0 align-middle">
                        <thead class="table-info">
                            <tr>
                                <th class="text-start ps-3">Pelamar</th>
                                @foreach($kriterias as $k)
                                <th>{{ $k->kode }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelamars as $pelamar)
                            <tr>
                                <td class="text-start ps-3 fw-semibold">{{ $pelamar->nama_lengkap }}</td>
                                @foreach($kriterias as $k)
                                <td>{{ number_format($normalized[$pelamar->id][$k->id], 6) }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- LANGKAH 3 — Matriks Terbobot --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark fw-semibold">
                <span class="badge bg-dark text-warning me-2">Langkah 3</span>
                Matriks Terbobot
                <small class="fw-normal ms-2">v<sub>ij</sub> = w<sub>j</sub> × r<sub>ij</sub></small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center mb-0 align-middle">
                        <thead class="table-warning">
                            <tr>
                                <th class="text-start ps-3">Pelamar</th>
                                @foreach($kriterias as $k)
                                <th>{{ $k->kode }}<br><small class="fw-normal">(w={{ $k->bobot/100 }})</small></th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelamars as $pelamar)
                            <tr>
                                <td class="text-start ps-3 fw-semibold">{{ $pelamar->nama_lengkap }}</td>
                                @foreach($kriterias as $k)
                                <td>{{ number_format($weighted[$pelamar->id][$k->id], 6) }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- LANGKAH 4 — Solusi Ideal --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white fw-semibold">
                <span class="badge bg-white text-success me-2">Langkah 4</span>
                Solusi Ideal Positif (A⁺) dan Negatif (A⁻)
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0 align-middle">
                        <thead class="table-success">
                            <tr>
                                <th class="text-start ps-3">Solusi</th>
                                @foreach($kriterias as $k)
                                <th>{{ $k->kode }}<br>
                                    <small class="fw-normal">{{ $k->sifat === 'benefit' ? 'max' : 'min' }}</small>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start ps-3 fw-semibold text-success">A⁺ (Ideal Positif)</td>
                                @foreach($kriterias as $k)
                                <td class="text-success fw-semibold">{{ number_format($idealPositif[$k->id], 6) }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="text-start ps-3 fw-semibold text-danger">A⁻ (Ideal Negatif)</td>
                                @foreach($kriterias as $k)
                                <td class="text-danger fw-semibold">{{ number_format($idealNegatif[$k->id], 6) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">
                <strong>Benefit:</strong> A⁺ = maks, A⁻ = min &nbsp;|&nbsp;
                <strong>Cost:</strong> A⁺ = min, A⁻ = maks
            </div>
        </div>

        {{-- LANGKAH 5 — Jarak --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white fw-semibold">
                <span class="badge bg-white text-secondary me-2">Langkah 5</span>
                Jarak ke Solusi Ideal (D⁺ dan D⁻)
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0 align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-start ps-3">Pelamar</th>
                                <th>D⁺ (Jarak ke A⁺)</th>
                                <th>D⁻ (Jarak ke A⁻)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelamars as $pelamar)
                            <tr>
                                <td class="text-start ps-3 fw-semibold">{{ $pelamar->nama_lengkap }}</td>
                                <td class="text-success">{{ number_format($dPlus[$pelamar->id], 6) }}</td>
                                <td class="text-danger">{{ number_format($dMinus[$pelamar->id], 6) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">
                D⁺ = √Σ(v<sub>ij</sub> − A⁺<sub>j</sub>)² &nbsp;|&nbsp;
                D⁻ = √Σ(v<sub>ij</sub> − A⁻<sub>j</sub>)²
            </div>
        </div>

        {{-- LANGKAH 6 — Ranking Akhir --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white fw-semibold">
                <span class="badge bg-white text-dark me-2">Langkah 6</span>
                Nilai Preferensi &amp; Ranking Akhir
                <small class="fw-normal ms-2">V<sub>i</sub> = D⁻ / (D⁺ + D⁻)</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Rank</th>
                                <th class="text-start ps-3">Nama Pelamar</th>
                                <th>NIK</th>
                                <th>D⁺</th>
                                <th>D⁻</th>
                                <th>Skor (V<sub>i</sub>)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ranking as $item)
                            <tr class="{{ $item['rank'] === 1 ? 'table-success fw-bold' : '' }}">
                                <td>
                                    @if($item['rank'] === 1)
                                    <span class="badge bg-warning text-dark">🥇 {{ $item['rank'] }}</span>
                                    @elseif($item['rank'] === 2)
                                    <span class="badge bg-secondary">🥈 {{ $item['rank'] }}</span>
                                    @elseif($item['rank'] === 3)
                                    <span class="badge bg-danger">🥉 {{ $item['rank'] }}</span>
                                    @else
                                    <span class="badge bg-light text-dark">{{ $item['rank'] }}</span>
                                    @endif
                                </td>
                                <td class="text-start ps-3">{{ $item['pelamar']->nama_lengkap }}</td>
                                <td>{{ $item['pelamar']->nik }}</td>
                                <td>{{ number_format($item['dPlus'], 6) }}</td>
                                <td>{{ number_format($item['dMinus'], 6) }}</td>
                                <td class="fw-bold">{{ number_format($item['score'], 6) }}</td>
                                <td>
                                    <span class="badge {{ $item['status'] === 'lolos' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item['status'] === 'lolos' ? '✓ Lolos' : '✗ Tidak Lolos' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">Skor ≥ 0.5 → <strong>Lolos</strong>, di bawah 0.5 → <strong>Tidak Lolos</strong></small>
                @if(!$sudahDisimpan)
                <button class="btn btn-success btn-sm"
                    data-bs-toggle="modal" data-bs-target="#modalSimpan">
                    <i class="bi bi-check-circle me-1"></i> Setujui &amp; Simpan Hasil
                </button>
                @else
                <span class="text-success small fw-semibold">
                    <i class="bi bi-check-circle-fill me-1"></i> Hasil sudah tersimpan
                </span>
                @endif
            </div>
        </div>

        @endif {{-- end isset($error) --}}

    </div>

    {{-- Modal Konfirmasi Simpan --}}
    <div class="modal fade" id="modalSimpan" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('topsis.simpan') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-check-circle me-1"></i> Setujui &amp; Simpan Hasil
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted small mb-3">
                            Hasil ranking TOPSIS di atas akan disimpan sebagai <strong>hasil seleksi final</strong>.
                            Jika data sudah ada sebelumnya, akan <strong>diperbarui</strong>.
                        </p>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Tanggal Pengumuman <span class="text-danger">*</span>
                            </label>
                            <input type="datetime-local" name="tanggal_pengumuman"
                                class="form-control @error('tanggal_pengumuman') is-invalid @enderror"
                                value="{{ old('tanggal_pengumuman') }}" required>
                            @error('tanggal_pengumuman')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="alert alert-warning small mb-0">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Pastikan semua data penilaian sudah benar sebelum menyimpan.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i> Simpan Hasil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app>