<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET PASSWORD</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title mb-1">Reset Password</h1>
                    <p class="text-muted mb-4">Masukkan password baru Anda</p>
                    
                    <form action="{{ route('reset-password-proses') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="new_password" class="form-label fw-6 mb-2">Password Baru</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white"><i class="bi bi-shield-lock"></i></span>
                                <input type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password baru"
                                    name="password"
                                    id="new_password"
                                    required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" aria-label="Toggle password">
                                    <i class="bi bi-eye-slash fs-5 text-muted"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="form-label fw-6 mb-2">Konfirmasi Password</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white"><i class="bi bi-shield-lock"></i></span>
                                <input type="password"
                                    class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Konfirmasi password baru"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" aria-label="Toggle password confirmation">
                                    <i class="bi bi-eye-slash fs-5 text-muted"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary btn-lg w-100 mt-3" type="submit">Reset Password</button>
                    </form>
                    
                    <div class="text-center mt-5">
                        <p class='text-gray-600'>Sudah punya akun? <a href="{{ route('login') }}" class='font-bold text-decoration-none'>Masuk sekarang</a></p>
                    </div>
                </div>
            </div>
            
             <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <div class="auth-cover">
                        <div class="d-flex justify-content-center align-items-center h-100 pt-5">
                            <img src="assets/images/logo/logo.png" alt="Login Cover" class="img-fluid" style="margin-top: 50px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('click', function (e) {
            const toggle = e.target.closest('.toggle-password');
            if (toggle) {
                const parent = toggle.parentElement;
                const input = parent.querySelector('input');
                if (input) {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    
                    const icon = toggle.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('bi-eye');
                        icon.classList.toggle('bi-eye-slash');
                    }
                }
            }
        });
    </script>
</body>
</html>