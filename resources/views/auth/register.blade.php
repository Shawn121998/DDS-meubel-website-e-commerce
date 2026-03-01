<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - DDS Meubel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .left-section {
            background: url('{{ asset('images/register.jpg') }}') center/cover no-repeat;
        }

        .register-card {
            width: 100%;
            max-width: 420px;
        }

        .btn-orange {
            background-color: #d2691e;
            color: white;
            border: none;
        }

        .btn-orange:hover {
            background-color: #b85c18;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row vh-100">

        <!-- LEFT IMAGE -->
        <div class="col-lg-6 d-none d-lg-block left-section">
            <div class="text-white position-absolute bottom-0 p-5">
                <h2 class="fw-bold">Bergabung dengan DDS Meubel</h2>
                <p>Dapatkan akses ke koleksi furniture kayu terbaik dan penawaran eksklusif</p>
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="register-card">

                <h2 class="fw-bold mb-2">Buat Akun Baru</h2>
                <p class="text-muted mb-4">Daftar untuk mulai berbelanja furniture impian Anda</p>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-orange w-100">
                        Daftar Sekarang →
                    </button>

                </form>

                <div class="text-center mt-3">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                        Login di sini
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>