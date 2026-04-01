<x-app>
    @php
        $user = auth()->user();
    @endphp

    <div class="page-heading">
        <h3>Dashboard Pelamar</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row g-3">
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-body px-3 py-4-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold mb-1">Data Pelamar</h6>
                                        <h6 class="font-extrabold mb-0">Lengkap</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-body px-3 py-4-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldDocument"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold mb-1">Berkas</h6>
                                        <h6 class="font-extrabold mb-0">Terkirim</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="card-body px-3 py-4-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldCheckmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold mb-1">Hasil</h6>
                                        <h6 class="font-extrabold mb-0">Menunggu</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-4 col-md-6">
                        @if(!empty($jadwalInterview))
                            <div class="card border-success h-100">
                                <div class="card-header pb-1">
                                    <h5 class="mb-0">Jadwal Interview</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-1">
                                        <strong>Status:</strong>
                                        <span class="text-success">Dijadwalkan</span>
                                    </p>
                                    <p class="mb-1">
                                        <strong>Tanggal:</strong>
                                        {{ \Carbon\Carbon::parse($jadwalInterview->tanggal)->translatedFormat('d F Y') }}
                                    </p>
                                    <p class="mb-1">
                                        <strong>Jam:</strong> {{ $jadwalInterview->jam }}
                                    </p>
                                    <p class="mb-0">
                                        <strong>Tempat / Link:</strong> {{ $jadwalInterview->lokasi ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="card h-100">
                                <div class="card-header pb-1">
                                    <h5 class="mb-0">Jadwal Interview</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-0">Belum ada jadwal interview dari admin.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Foto User">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold mb-0">{{ $user->name ?? 'Pelamar' }}</h5>
                                <h6 class="text-muted mb-0">{{ '@' . ($user->username ?? 'user') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app>