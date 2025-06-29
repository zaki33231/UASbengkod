<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Asahi Medical Clinic</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box" style="width: 600px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1">
                    <i class="fas fa-hospital-alt text-primary mr-2"></i>
                    <b>Asahi</b> Medical Clinic
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar akun pasien baru
                </p>

                <!-- Debug Information -->
                @if(session('debug'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Debug Info:</strong> {{ session('debug') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong>Errors ditemukan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Form tanpa JavaScript validation -->
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap *</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukkan password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password *</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Ulangi password">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_ktp">Nomor KTP *</label>
                                <input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
                                    id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
                                    placeholder="Masukkan nomor KTP (16 digit)" maxlength="16">
                                @error('no_ktp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_hp">Nomor HP *</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                    name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukkan nomor HP">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat *</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="4"
                                    placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror"
                                id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="terms">
                                Saya setuju dengan syarat & ketentuan *
                            </label>
                            @error('terms')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <a href="{{ route('login') }}" class="btn btn-secondary btn-block">
                                Kembali ke Login
                            </a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                                <i class="fas fa-user-plus mr-1"></i>
                                Daftar Sekarang
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="mb-0">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-primary font-weight-bold">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Health Theme Decorations -->
    <div class="position-absolute" style="bottom: 20px; left: 50%; transform: translateX(-50%);">
        <div class="text-center text-primary">
            <i class="fas fa-heartbeat fa-2x mb-2"></i>
            <p class="mb-0 font-weight-light">Register Page - Asahi Medical Clinic</p>
        </div>
    </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            console.log('Simple form loaded');

            // Simple number-only validation untuk KTP
            $('#no_ktp').on('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 16) {
                    this.value = this.value.slice(0, 16);
                }
            });

            // Log form data before submit
            $('form').on('submit', function (e) {
                console.log('Form being submitted...');

                // Disable submit button dan ubah text
                $('#submitBtn').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin mr-1"></i>Sedang memproses...');

                var formData = new FormData(this);
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                // Tambahkan loading overlay
                $('body').append('<div id="loading-overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;justify-content:center;align-items:center;"><div style="background:white;padding:20px;border-radius:10px;text-align:center;"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><br><br>Sedang memproses registrasi...</div></div>');
            });
        });
    </script>

</body>

</html>