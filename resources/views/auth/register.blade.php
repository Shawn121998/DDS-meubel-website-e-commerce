@extends('layouts.app')

@section('content')
<style>
    body{ background:#F5EFE6; }

    .auth-wrap{
        min-height: calc(100vh - 120px);
        display:flex;
        align-items:flex-start;
        justify-content:center;
        padding:40px 12px;
    }

    .auth-card{
        width: 520px;
        max-width: 100%;
        background:#fff;
        border-radius:18px;
        padding:28px 28px 22px;
        border:1px solid #E8DFD0;
        box-shadow: 0 14px 40px rgba(0,0,0,.06);
    }

    .auth-title{
        font-weight:800;
        font-size:28px;
        color:#2F2A25;
        margin-bottom:6px;
    }
    .auth-subtitle{
        color:#6b5f55;
        margin-bottom:18px;
        font-size:14px;
    }

    .form-label{
        font-weight:600;
        color:#2F2A25;
        margin-top:10px;
        margin-bottom:6px;
    }

    .input-group{
        border:1px solid #E8DFD0;
        border-radius:12px;
        overflow:hidden;
        background:#fff;
    }
    .input-group-text{
        background:#fff;
        border:0;
        color:#7A5C3E;
        padding-left:14px;
        padding-right:12px;
    }
    .form-control{
        border:0 !important;
        box-shadow:none !important;
        padding:12px 14px;
        font-size:14px;
    }
    .form-control::placeholder{
        color:#a79a8f;
    }

    .btn-earth{
        width:100%;
        margin-top:16px;
        background:#7A5C3E;
        border:0;
        color:#fff;
        padding:12px 16px;
        border-radius:12px;
        font-weight:700;
        transition:.2s;
        box-shadow: 0 10px 24px rgba(122,92,62,.28);
    }
    .btn-earth:hover{
        background:#5E4630;
        color:#fff;
        transform: translateY(-1px);
    }

    .auth-footer{
        text-align:center;
        margin-top:14px;
        color:#6b5f55;
        font-size:14px;
    }
    .auth-footer a{
        color:#D97706;
        font-weight:700;
        text-decoration:none;
    }
</style>

<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-title">Buat Akun Baru</div>
        <div class="auth-subtitle">Daftar untuk mulai berbelanja furniture impian Anda</div>

        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <label class="form-label">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap"
                       value="{{ old('name') }}" required>
            </div>

            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com"
                       value="{{ old('email') }}" required>
            </div>

            <label class="form-label">Nomor Telepon</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="text" name="phone" class="form-control" placeholder="08123456789"
                       value="{{ old('phone') }}" required>
            </div>

            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>

            <label class="form-label">Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn btn-earth">
                Daftar Sekarang <i class="bi bi-arrow-right ms-1"></i>
            </button>

            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection