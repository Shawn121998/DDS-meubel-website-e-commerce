@extends('layouts.app')

@section('content')

<style>
.login-wrapper{
    min-height:100vh;
    display:flex;
}

.login-left{
    flex:1;
    background:url('https://images.unsplash.com/photo-1615874959474-d609969a20ed') center center/cover no-repeat;
    position:relative;
    color:white;
    display:flex;
    align-items:flex-end;
    padding:40px;
}

.login-left::after{
    content:'';
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.4);
}

.login-left-content{
    position:relative;
    z-index:2;
}

.login-right{
    flex:1;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:60px;
    background:#f8f9fa;
}

.login-card{
    width:100%;
    max-width:420px;
}

.btn-orange{
    background:linear-gradient(135deg,#ff8c00,#e66a00);
    color:white;
    border:none;
    padding:12px;
    border-radius:10px;
    font-weight:600;
}

.btn-orange:hover{
    opacity:.9;
    color:white;
}

@media(max-width:992px){
.login-left{
display:none;
}
}
</style>

<div class="login-wrapper">

{{-- LEFT --}}

<div class="login-left">
<div class="login-left-content">
<h2 class="fw-bold">DDS Meubel</h2>
<p>Furniture Kayu Berkualitas Tinggi untuk Rumah Impian Anda</p>
</div>
</div>

{{-- RIGHT --}}

<div class="login-right">
<div class="login-card">

<h3 class="fw-bold mb-2">Selamat Datang Kembali</h3>
<p class="text-muted mb-4">Masuk ke akun Anda untuk melanjutkan</p>

{{-- ERROR MESSAGE --}}
@if($errors->any())

<div class="alert alert-danger">
{{ $errors->first() }}
</div>
@endif

{{-- CUSTOMER LOGIN --}}

<form action="{{ route('login.process') }}" method="POST">
@csrf

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email"
       name="email"
       class="form-control"
       placeholder="nama@email.com"
       required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password"
       name="password"
       class="form-control"
       placeholder="Masukkan password"
       required>
</div>

<button type="submit" class="btn btn-orange w-100 mb-3">
Customer Login →
</button>

</form>

<div class="text-center small mb-3">
Belum punya akun?
<a href="{{ route('register') }}">Register Now</a>
</div>

{{-- ADMIN LOGIN --}}

<div class="border rounded-3 p-3 bg-light">

<div class="small fw-bold mb-2">Admin Login Cepat</div>

<div class="small">Email: admin@ddsmeubel.com</div>
<div class="small mb-2">Password: admin123</div>

<form action="{{ route('login.process') }}" method="POST">
@csrf

<input type="hidden" name="email" value="admin@ddsmeubel.com">
<input type="hidden" name="password" value="admin123">

<button type="submit" class="btn btn-orange w-100">
Admin Login →
</button>

</form>

</div>

</div>
</div>

</div>

@endsection
