<x-app>
    @php
        $user = auth()->user();
    @endphp

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
            background-color: rgba(29, 151, 108, 0.04) !important;
            border-color: #1d976c !important;
        }
    </style>

    <div class="page-heading">
        <h3>Dashboard Pelamar</h3>
        <p class="text-subtitle text-muted">Pantau status pendaftaran dan lengkapi berkas persyaratan Anda.</p>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <!-- Welcome Banner -->
                <div class="row">
                    <div class="col-12">
                        <div class="card text-white mb-4 shadow-sm" style="background: linear-gradient(135deg, #1d976c 0%, #11998e 100%); border: none; border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h4 class="text-white mb-2">Halo, <span class="text-capitalize font-bold">{{ $user->name }}</span>! 👋</h4>
                                        <p class="mb-0 opacity-90">Selamat datang di portal seleksi Perangkat Desa. Silakan lengkapi profil dan berkas administrasi Anda untuk melanjutkan proses seleksi.</p>
                                    </div>
                                    <div class="d-none d-md-block ms-3">
                                        <i class="bi bi-person-check-fill" style="font-size: 3rem; opacity: 0.85;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics / Status Cards -->
                <div class="row g-3 mb-4">
                    <!-- Data Profil Status -->
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 transition-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="stats-icon blue mb-2 mb-md-0">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold mb-1 text-sm">Profil Diri</h6>
                                        @if($pelamar)
                                            <span class="badge bg-success font-semibold px-2 py-1 text-xs">Lengkap</span>
                                        @else
                                            <span class="badge bg-danger font-semibold px-2 py-1 text-xs">Belum Lengkap</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Berkas Kelengkapan Status -->
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 transition-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="stats-icon green mb-2 mb-md-0">
                                            <i class="iconly-boldDocument"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold mb-1 text-sm">Kelengkapan Berkas</h6>
                                        @if($countBerkas == 5)
                                            <span class="badge bg-success font-semibold px-2 py-1 text-xs">Terkirim (5/5)</span>
                                        @elseif($countBerkas > 0)
                                            <span class="badge bg-warning text-dark font-semibold px-2 py-1 text-xs">Belum Lengkap ({{ $countBerkas }}/5)</span>
                                        @else
                                            <span class="badge bg-danger font-semibold px-2 py-1 text-xs">Belum Ada Berkas</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Pendaftaran Administrasi -->
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 transition-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="stats-icon red mb-2 mb-md-0">
                                            <i class="iconly-boldCheckmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold mb-1 text-sm">Seleksi Administrasi</h6>
                                        @if(!$pendaftaran)
                                            <span class="badge bg-secondary font-semibold px-2 py-1 text-xs">Belum Mendaftar</span>
                                        @elseif($pendaftaran->status === 'menunggu')
                                            <span class="badge bg-warning text-dark font-semibold px-2 py-1 text-xs">Menunggu Verifikasi</span>
                                        @elseif($pendaftaran->status === 'lolos')
                                            <span class="badge bg-success font-semibold px-2 py-1 text-xs">Lolos Administrasi</span>
                                        @else
                                            <span class="badge bg-danger font-semibold px-2 py-1 text-xs">Tidak Lolos</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step-by-Step Task Checklist -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 mt-2">
                            <div class="card-header bg-transparent border-0 pb-0">
                                <h5 class="font-bold mb-1"><i class="bi bi-list-task text-primary me-2"></i>Panduan Pendaftaran Seleksi</h5>
                                <p class="text-muted text-sm">Lengkapi tahapan pendaftaran di bawah ini secara berurutan.</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Step 1 -->
                                    <div class="col-md-4 mb-3">
                                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-light-hover">
                                            <div>
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="badge bg-primary">Langkah 1</span>
                                                    @if($pelamar)
                                                        <span class="text-success text-sm font-semibold"><i class="bi bi-check-circle-fill me-1"></i> Selesai</span>
                                                    @else
                                                        <span class="text-danger text-sm font-semibold"><i class="bi bi-exclamation-circle-fill me-1"></i> Belum</span>
                                                    @endif
                                                </div>
                                                <h6 class="font-semibold">Lengkapi Profil Diri</h6>
                                                <p class="text-muted text-xs mb-3">Isi data profil Anda termasuk NIK, Alamat, No. HP, Jenis Kelamin, dan Tanggal Lahir.</p>
                                            </div>
                                            <a href="/pelamar" class="btn btn-outline-primary btn-sm w-100 mt-2">
                                                <i class="bi bi-person-fill me-1"></i> {{ $pelamar ? 'Ubah Profil' : 'Lengkapi Profil' }}
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Step 2 -->
                                    <div class="col-md-4 mb-3">
                                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-light-hover">
                                            <div>
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="badge bg-primary">Langkah 2</span>
                                                    @if($countBerkas == 5)
                                                        <span class="text-success text-sm font-semibold"><i class="bi bi-check-circle-fill me-1"></i> Lengkap</span>
                                                    @else
                                                        <span class="text-warning text-sm font-semibold"><i class="bi bi-exclamation-circle-fill me-1"></i> {{ $countBerkas }}/5 Berkas</span>
                                                    @endif
                                                </div>
                                                <h6 class="font-semibold">Unggah Berkas Syarat</h6>
                                                <p class="text-muted text-xs mb-3">Unggah 5 berkas wajib: KTP, Ijazah, Pas Foto, CV, dan Surat Keterangan Sehat.</p>
                                            </div>
                                            <a href="/berkas" class="btn btn-outline-primary btn-sm w-100 mt-2">
                                                <i class="bi bi-file-earmark-arrow-up me-1"></i> Unggah Berkas
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Step 3 -->
                                    <div class="col-md-4 mb-3">
                                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-light-hover">
                                            <div>
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="badge bg-primary">Langkah 3</span>
                                                    @if($pendaftaran)
                                                        <span class="text-success text-sm font-semibold"><i class="bi bi-check-circle-fill me-1"></i> Dikirim</span>
                                                    @else
                                                        <span class="text-danger text-sm font-semibold"><i class="bi bi-exclamation-circle-fill me-1"></i> Belum</span>
                                                    @endif
                                                </div>
                                                <h6 class="font-semibold">Kirim Pendaftaran</h6>
                                                <p class="text-muted text-xs mb-3">Ajukan berkas pendaftaran Anda agar divalidasi oleh panitia pemilihan perangkat desa.</p>
                                            </div>
                                            
                                            @if($pendaftaran)
                                                <button class="btn btn-success btn-sm w-100 mt-2" disabled>
                                                    <i class="bi bi-check2-all me-1"></i> Sudah Terdaftar
                                                </button>
                                            @elseif($pelamar && $countBerkas == 5)
                                                <form action="{{ route('pendaftaran.store') }}" method="POST" class="mt-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                                        <i class="bi bi-send-fill me-1"></i> Ajukan Sekarang
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-outline-secondary btn-sm w-100 mt-2" disabled title="Lengkapi Profil & Berkas terlebih dahulu">
                                                    <i class="bi bi-lock-fill me-1"></i> Ajukan Sekarang
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interview Schedule Card -->
              
            </div>

            <!-- Profile Sidebar -->
            <div class="col-12 col-lg-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body py-4 px-4 text-center">
                        <div class="d-flex flex-column align-items-center">
                            <!-- Initials Avatar -->
                            <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm mb-3 font-bold" 
                                 style="width: 75px; height: 75px; font-size: 1.8rem; background: linear-gradient(135deg, #435ebe 0%, #6f42c1 100%) !important;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="name w-100">
                                <h5 class='font-bold mb-1 text-capitalize text-truncate' title="{{ $user->name }}">{{ $user->name }}</h5>
                                <span class="badge bg-light-primary text-primary font-semibold mb-3 px-3 py-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-person-fill me-1"></i> Pelamar
                                </span>
                                <hr class="w-100 my-3 opacity-25">
                                <div class="text-start">
                                    <small class="text-muted d-block text-xs">Email</small>
                                    <span class="text-sm font-semibold d-block text-truncate mb-2" title="{{ $user->email }}">{{ $user->email }}</span>
                                    
                                    <small class="text-muted d-block text-xs">Terdaftar Sejak</small>
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