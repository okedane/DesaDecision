<x-app>
    <h3>Status Pendaftaran</h3>

    @if ($pendaftaran)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Status Pendaftaran</h5>
                <div class="alert alert-info">
                    <strong>Status:</strong> 
                    <span class="badge bg-{{ $pendaftaran->status == 'lolos' ? 'success' : 'warning' }}">
                        {{ ucfirst($pendaftaran->status) }}
                    </span>
                </div>

                @if ($pendaftaran->status == 'lolos')
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle"></i> Selamat! Silakan cek jadwal interview di menu berikutnya.
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-4">
            <i class="fas fa-exclamation-triangle"></i> Anda belum mendaftar. Silakan lengkapi pendaftaran terlebih dahulu.
        </div>
    @endif
</x-app>
