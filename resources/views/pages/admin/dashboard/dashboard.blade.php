<x-app>
    <style>
        .transition-hover {
            transition: all 0.3s ease;
        }
        .transition-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important;
        }
        .bg-light-hover {
            transition: all 0.2s ease-in-out;
        }
        .bg-light-hover:hover {
            background-color: rgba(67, 94, 190, 0.04) !important;
            border-color: #435ebe !important;
        }
    </style>

    <div class="page-heading d-flex justify-content-between align-items-center">
        <div>
            <h3>Dashboard Admin</h3>
            <p class="text-subtitle text-muted">Akses cepat dan ringkasan data pemilihan perangkat desa.</p>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <!-- Welcome Banner -->
                <div class="row">
                    <div class="col-12">
                        <div class="card text-white mb-4 shadow-sm" style="background: linear-gradient(135deg, #435ebe 0%, #6f42c1 100%); border: none; border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h4 class="text-white mb-2">Selamat Datang Kembali, <span class="text-capitalize font-bold">{{ $user->name }}</span>! 👋</h4>
                                        <p class="mb-0 opacity-75">Sistem Pendukung Keputusan Pemilihan Perangkat Desa menggunakan Metode TOPSIS siap digunakan.</p>
                                    </div>
                                    <div class="d-none d-md-block ms-3">
                                        <i class="bi bi-award-fill" style="font-size: 3rem; opacity: 0.85;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Widgets -->
                <div class="row">
                    <div class="col-6 col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 transition-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="stats-icon purple">
                                            <i class='iconly-boldShow'></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pelamar</h6>
                                        <h6 class='font-extrabold mb-0'>{{ $countPelamar }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 transition-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="stats-icon blue">
                                            <i class='iconly-boldProfile'></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Kandidat</h6>
                                        <h6 class='font-extrabold mb-0'>{{ $countKandidat }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 transition-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="stats-icon green">
                                            <i class='iconly-boldAdd-User'></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Kriteria</h6>
                                        <h6 class='font-extrabold mb-0'>{{ $countKriteria }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3 col-md-6">
                        <div class="card shadow-sm border-0 transition-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="stats-icon red">
                                            <i class='iconly-boldBookmark'></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Sub Kriteria</h6>
                                        <h6 class='font-extrabold mb-0'>{{ $countSubKriteria }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interactive Workflow Guide -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 mt-2">
                            <div class="card-header bg-transparent border-0 pb-0">
                                <h5 class="font-bold mb-1"><i class="bi bi-arrow-right-circle-fill text-primary me-2"></i>Alur Proses Seleksi TOPSIS</h5>
                                <p class="text-muted text-sm">Ikuti langkah-langkah di bawah ini untuk memproses pemilihan perangkat desa secara teratur.</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-light-hover">
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-primary me-2">Langkah 1</span>
                                                    <h6 class="mb-0 font-semibold">Validasi Pendaftaran</h6>
                                                </div>
                                                <p class="text-muted text-sm mb-3">Verifikasi berkas fisik/administrasi pelamar dan ubah status menjadi "Lolos" agar dapat masuk ke tahap penilaian kriteria.</p>
                                            </div>
                                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline-primary btn-sm w-100 mt-2">
                                                <i class="bi bi-file-earmark-check me-1"></i> Buka Verifikasi
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-light-hover">
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-success me-2">Langkah 2</span>
                                                    <h6 class="mb-0 font-semibold">Input Penilaian</h6>
                                                </div>
                                                <p class="text-muted text-sm mb-3">Berikan bobot nilai kriteria (praktek, wawancara, tulis, dll) untuk masing-masing kandidat yang lolos seleksi.</p>
                                            </div>
                                            <a href="{{ route('penilaian.index') }}" class="btn btn-outline-success btn-sm w-100 mt-2">
                                                <i class="bi bi-clipboard-data me-1"></i> Masukkan Nilai
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-light-hover">
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-warning text-dark me-2">Langkah 3</span>
                                                    <h6 class="mb-0 font-semibold">Proses & Hasil</h6>
                                                </div>
                                                <p class="text-muted text-sm mb-3">Jalankan kalkulasi matriks keputusan, matriks ternormalisasi terbobot, hingga perankingan akhir dengan TOPSIS.</p>
                                            </div>
                                            <a href="{{ route('topsis.index') }}" class="btn btn-outline-warning btn-sm w-100 mt-2">
                                                <i class="bi bi-calculator me-1"></i> Hitung TOPSIS
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Sidebar -->
            <div class="col-12 col-lg-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body py-4 px-4 text-center">
                        <div class="d-flex flex-column align-items-center">
                            <!-- <div class="avatar avatar-2xl mb-3 shadow-sm" style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%; border: 3px solid #435ebe;">
                                <img src="assets/images/faces/1.jpg" alt="Face 1" style="width: 100%; height: 100%; object-fit: cover;">
                            </div> -->
                            <div class="name w-100">
                                <h5 class='font-bold mb-1 text-capitalize text-truncate' title="{{ $user->name }}">{{ $user->name }}</h5>
                                <span class="badge bg-light-primary text-primary font-semibold mb-3 px-3 py-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-shield-fill-check me-1"></i> {{ ucfirst($user->role) }}
                                </span>
                                <hr class="w-100 my-3 opacity-25">
                                <div class="text-start">
                                    <small class="text-muted d-block">Email</small>
                                    <span class="text-sm font-semibold d-block text-truncate mb-2" title="{{ $user->email }}">{{ $user->email }}</span>
                                    
                                    <small class="text-muted d-block">Tanggal Terdaftar</small>
                                    <span class="text-sm font-semibold d-block">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app>
