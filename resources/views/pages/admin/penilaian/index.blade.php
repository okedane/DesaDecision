{{-- resources/views/penilaian/index.blade.php --}}
<x-app>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Penilaian Pelamar</h3>
                    <p class="text-subtitle text-muted">Input nilai kriteria untuk setiap pelamar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Penilaian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                @php
                    $pelamarBelumDinilai = $pelamar->first(function ($p) {
                        return $p->penilaians->count() === 0;
                    });
                @endphp
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Daftar Pelamar</h5>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    @foreach($kriterias as $kriteria)
                                        <th>{{ $kriteria->nama }}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pelamar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        @foreach($kriterias as $kriteria)
                                            @php
                                                $nilaiExisting = optional($item->penilaians->firstWhere('kriteria_id', $kriteria->id))->nilai;
                                                $subTerpilih = $kriteria->subkriteria->firstWhere('bobot', (int) $nilaiExisting);
                                            @endphp
                                            <td>{{ $subTerpilih ? $subTerpilih->nama : '-' }}</td>
                                        @endforeach
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalPenilaian{{ $item->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                    Edit
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modalPenilaian{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Penilaian - {{ $item->user->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('penilaian.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="pelamar_id" value="{{ $item->id }}">

                                                    <div class="modal-body">
                                                        @foreach($kriterias as $kriteria)
                                                            @php
                                                                $nilaiExisting = optional($item->penilaians->firstWhere('kriteria_id', $kriteria->id))->nilai;
                                                            @endphp
                                                            <div class="mb-3">
                                                                <label class="form-label mb-1">
                                                                    {{ $kriteria->nama }}
                                                                </label>
                                                                <select
                                                                    class="form-select"
                                                                    name="nilai[{{ $kriteria->id }}]"
                                                                    required>
                                                                    <option value="" selected disabled>Pilih subkriteria</option>
                                                                    @foreach($kriteria->subkriteria as $sub)
                                                                        <option
                                                                            value="{{ $sub->id }}"
                                                                            {{ (int) $nilaiExisting === (int) $sub->bobot ? 'selected' : '' }}>
                                                                            {{ $sub->nama }} (Bobot: {{ $sub->bobot }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="{{ 4 + $kriterias->count() }}" class="text-center text-muted">
                                            Tidak ada pelamar yang siap dinilai.
                                        </td>
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