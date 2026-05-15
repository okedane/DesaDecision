<x-app>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hasil Seleksi</h3>
                    <p class="text-subtitle text-muted">Cek status pengumuman hasil seleksi Anda</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hasil Seleksi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        
        <section class="section">
            <div class="row">
                @if ($hasil)
                    @if ($hasil->status === 'lolos')
                    <!-- Card Lolos -->
                    <div class="col-12">
                        <div class="card" style="border-left: 5px solid #10b981; border-radius: 12px; overflow: hidden;">
                            <div class="card-body" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%); padding: 40px;">
                                <div class="text-center">
                                    <div style="margin-bottom: 30px;">
                                        <i class="bi bi-check-circle" style="font-size: 80px; color: #10b981;"></i>
                                    </div>
                                    
                                    <h2 style="color: #10b981; font-weight: 700; margin-bottom: 10px;">Selamat! Anda Lolos</h2>
                                    <p class="text-muted" style="font-size: 16px; margin-bottom: 30px;">Terima kasih telah mengikuti proses seleksi kami</p>

                                    <div style="background: white; border: 2px solid #10b981; border-radius: 12px; padding: 30px; max-width: 500px; margin: 0 auto; margin-bottom: 30px;">
                                        <div class="mb-4">
                                            <small style="color: #667eea; font-weight: 600;">DATA PELAMAR</small>
                                            <h5 style="color: #1e293b; margin: 10px 0 0 0;">{{ $hasil->pelamar->nama_lengkap ?? 'N/A' }}</h5>
                                        </div>

                                        <hr style="border-top: 1px solid #e2e8f0;">

                                        <div class="mb-4">
                                            <small style="color: #667eea; font-weight: 600;">NO. IDENTITAS</small>
                                            <p style="color: #1e293b; margin: 8px 0; font-size: 16px;">{{ $hasil->pelamar->no_identitas ?? 'N/A' }}</p>
                                        </div>

                                        <div class="mb-4">
                                            <small style="color: #667eea; font-weight: 600;">TANGGAL PENGUMUMAN</small>
                                            <p style="color: #1e293b; margin: 8px 0; font-size: 16px;">
                                                @if ($hasil->tanggal_pengumuman)
                                                    {{ \Carbon\Carbon::parse($hasil->tanggal_pengumuman)->locale('id')->format('d F Y H:i') }} WIB
                                                @else
                                                    Menunggu pengumuman
                                                @endif
                                            </p>
                                        </div>

                                        @if ($hasil->keterangan)
                                        <hr style="border-top: 1px solid #e2e8f0;">
                                        <div>
                                            <small style="color: #667eea; font-weight: 600;">KETERANGAN</small>
                                            <p style="color: #1e293b; margin: 8px 0; font-size: 14px;">{{ $hasil->keterangan }}</p>
                                        </div>
                                        @endif
                                    </div>

                                    <div style="background: #eff6ff; border-left: 4px solid #667eea; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                                        <p style="color: #1e293b; margin: 0; font-size: 14px;">
                                            <strong>Informasi Penting:</strong><br>
                                            Silahkan periksa email Anda untuk detail lebih lanjut mengenai tahap berikutnya. Jika Anda tidak menerima email, silahkan hubungi pihak penyelenggara.
                                        </p>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="" class="btn btn-primary" style="border-radius: 10px; padding: 10px 30px;">
                                            <i class="bi bi-house me-2"></i>Kembali ke Dashboard
                                        </a>
                                        <a href="{{ route('berkas.index') }}" class="btn btn-outline-primary" style="border-radius: 10px; padding: 10px 30px;">
                                            <i class="bi bi-file-earmark me-2"></i>Lihat Berkas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else
                    <!-- Card Tidak Lolos -->
                    <div class="col-12">
                        <div class="card" style="border-left: 5px solid #ef4444; border-radius: 12px; overflow: hidden;">
                            <div class="card-body" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%); padding: 40px;">
                                <div class="text-center">
                                    <div style="margin-bottom: 30px;">
                                        <i class="bi bi-x-circle" style="font-size: 80px; color: #ef4444;"></i>
                                    </div>
                                    
                                    <h2 style="color: #ef4444; font-weight: 700; margin-bottom: 10px;">Tidak Lolos</h2>
                                    <p class="text-muted" style="font-size: 16px; margin-bottom: 30px;">Terima kasih telah mengikuti proses seleksi kami</p>

                                    <div style="background: white; border: 2px solid #ef4444; border-radius: 12px; padding: 30px; max-width: 500px; margin: 0 auto; margin-bottom: 30px;">
                                        <div class="mb-4">
                                            <small style="color: #667eea; font-weight: 600;">DATA PELAMAR</small>
                                            <h5 style="color: #1e293b; margin: 10px 0 0 0;">{{ $hasil->pelamar->nama_lengkap ?? 'N/A' }}</h5>
                                        </div>

                                        <hr style="border-top: 1px solid #e2e8f0;">

                                        <div class="mb-4">
                                            <small style="color: #667eea; font-weight: 600;">NO. NIK</small>
                                            <p style="color: #1e293b; margin: 8px 0; font-size: 16px;">{{ $hasil->pelamar->nik ?? 'N/A' }}</p>
                                        </div>

                                        <div class="mb-4">
                                            <small style="color: #667eea; font-weight: 600;">TANGGAL PENGUMUMAN</small>
                                            <p style="color: #1e293b; margin: 8px 0; font-size: 16px;">
                                                @if ($hasil->tanggal_pengumuman)
                                                    {{ \Carbon\Carbon::parse($hasil->tanggal_pengumuman)->locale('id')->format('d F Y H:i') }} WIB
                                                @else
                                                    Menunggu pengumuman
                                                @endif
                                            </p>
                                        </div>

                                        @if ($hasil->keterangan)
                                        <hr style="border-top: 1px solid #e2e8f0;">
                                        <div>
                                            <small style="color: #667eea; font-weight: 600;">KETERANGAN</small>
                                            <p style="color: #1e293b; margin: 8px 0; font-size: 14px;">{{ $hasil->keterangan }}</p>
                                        </div>
                                        @endif
                                    </div>

                                    <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                                        <p style="color: #1e293b; margin: 0; font-size: 14px;">
                                            <strong>Informasi:</strong><br>
                                            Kami menghargai partisipasi Anda. Silahkan coba lagi di kesempatan berikutnya dan tingkatkan kualifikasi Anda.
                                        </p>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="" class="btn btn-primary" style="border-radius: 10px; padding: 10px 30px;">
                                            <i class="bi bi-house me-2"></i>Kembali ke Dashboard
                                        </a>
                                        <a href="{{ route('berkas.index') }}" class="btn btn-outline-primary" style="border-radius: 10px; padding: 10px 30px;">
                                            <i class="bi bi-file-earmark me-2"></i>Lihat Berkas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                @else
                <!-- Belum Ada Pengumuman -->
                <div class="col-12">
                    <div class="card" style="border-left: 5px solid #f59e0b; border-radius: 12px; overflow: hidden;">
                        <div class="card-body" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%); padding: 40px;">
                            <div class="text-center">
                                <div style="margin-bottom: 30px;">
                                    <i class="bi bi-hourglass-split" style="font-size: 80px; color: #f59e0b;"></i>
                                </div>
                                
                                <h2 style="color: #f59e0b; font-weight: 700; margin-bottom: 10px;">Menunggu Pengumuman</h2>
                                <p class="text-muted" style="font-size: 16px; margin-bottom: 30px;">Hasil seleksi Anda sedang diproses</p>

                                <div style="background: white; border: 2px solid #f59e0b; border-radius: 12px; padding: 30px; max-width: 500px; margin: 0 auto; margin-bottom: 30px;">
                                    <div class="mb-4">
                                        <small style="color: #667eea; font-weight: 600;">STATUS</small>
                                        <p style="color: #1e293b; margin: 8px 0; font-size: 16px;">Sedang diverifikasi</p>
                                    </div>

                                    <hr style="border-top: 1px solid #e2e8f0;">

                                    <div>
                                        <small style="color: #667eea; font-weight: 600;">DATA PELAMAR</small>
                                        <p style="color: #1e293b; margin: 8px 0; font-size: 16px;">{{ auth()->user()->name }}</p>
                                    </div>
                                </div>

                                <div style="background: #fffbeb; border-left: 4px solid #f59e0b; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                                    <p style="color: #1e293b; margin: 0; font-size: 14px;">
                                        <strong>Catatan:</strong><br>
                                        Tim kami sedang memproses seluruh berkas pelamar. Pengumuman hasil seleksi akan diumumkan sesuai jadwal yang telah ditentukan. Terima kasih atas kesabaran Anda.
                                    </p>
                                </div>

                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('hasil-seleksi.index') }}" class="btn btn-primary" style="border-radius: 10px; padding: 10px 30px;">
                                        <i class="bi bi-arrow-repeat me-2"></i>Refresh Halaman
                                    </a>
                                    <a href="{{ route('berkas.index') }}" class="btn btn-outline-primary" style="border-radius: 10px; padding: 10px 30px;">
                                        <i class="bi bi-file-earmark me-2"></i>Lihat Berkas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>
</x-app>