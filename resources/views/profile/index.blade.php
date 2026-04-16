@extends('layouts.app')

@section('content')

@php
use Carbon\Carbon;
@endphp

<style>
/* HEADER PROFILE */
.profile-header{
    background: linear-gradient(90deg,#ff7a00,#ff8c00);
    height:120px;
    border-radius:20px 20px 0 0;
}

.profile-card{
    background:white;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
    overflow:hidden;
}

.profile-top{
    position:relative;
    padding:20px;
}

.avatar{
    width:80px;
    height:80px;
    background:#ff7a00;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:30px;
    font-weight:bold;
    border:5px solid white;
    position:absolute;
    top:-40px;
}

.profile-name{
    margin-left:100px;
    margin-top:10px;
}

.edit-btn{
    position:absolute;
    right:20px;
    top:20px;
    background:#ff7a00;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:10px;
}

/* CARD */
.box{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 4px 15px rgba(0,0,0,0.05);
}

/* INPUT STYLE */
.form-control{
    background:#f5f5f5;
    border:none;
}

/* STAT */
.stat-box{
    background:#f5f5f5;
    padding:15px;
    border-radius:12px;
    margin-bottom:12px;
}

/* ICON STAT */
.stat-icon{
    width:45px;
    height:45px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:18px;
}

.bg-blue{ background:#3b82f6; }
.bg-orange{ background:#ff7a00; }
.bg-purple{ background:#a855f7; }

/* BUTTON */
.quick-btn{
    display:block;
    padding:15px;
    border-radius:12px;
    text-align:center;
    margin-bottom:10px;
    text-decoration:none;
}

.btn-blue{
    background:#e8f0ff;
}

.btn-orange{
    background:#fff3e6;
}
</style>

<div class="container mt-4">

<div class="profile-card">

    <!-- HEADER -->
    <div class="profile-header"></div>

    <div class="profile-top">

        <div class="avatar">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>

        <div class="profile-name">
            <h5>{{ Auth::user()->name }}</h5>
            <small>{{ Auth::user()->email }}</small>
        </div>

        <button class="edit-btn">Edit Profil</button>

    </div>

</div>

<div class="row mt-4">

    <!-- LEFT -->
    <div class="col-md-4">

        <div class="box mb-3">
            <h6 class="mb-3">Statistik</h6>

            <div class="stat-box d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Pesanan</small>
                    <h5 class="mb-0" id="totalPesanan">0</h5>
                </div>
                <div class="stat-icon bg-blue">
                    <i class="bi bi-bag"></i>
                </div>
            </div>

            <div class="stat-box d-flex justify-content-between align-items-center">
                <div>
                    <small>Pesanan Reguler</small>
                    <h5 class="mb-0" id="pesananReguler">0</h5>
                </div>
                <div class="stat-icon bg-orange">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>

            <div class="stat-box d-flex justify-content-between align-items-center">
                <div>
                    <small>Pesanan Custom</small>
                    <h5 class="mb-0" id="pesananCustom">0</h5>
                </div>
                <div class="stat-icon bg-purple">
                    <i class="bi bi-box"></i>
                </div>
            </div>

        </div>

        <div class="box">
            <h6>Member Sejak</h6>
            <p>
                {{ Carbon::parse(Auth::user()->created_at)->translatedFormat('d F Y') }}
            </p>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="col-md-8">

        <div class="box">

            <h5>Informasi Pribadi</h5>

            <label>Nama Lengkap</label>
            <input type="text" class="form-control mb-3"
                   value="{{ Auth::user()->name }}" readonly>

            <label>Email</label>
            <input type="text" class="form-control mb-3"
                   value="{{ Auth::user()->email }}" readonly>

            <label>Nomor Telepon</label>
            <input type="text" class="form-control mb-3"
                   value="0896xxxxxxx">

            <label>Tipe Akun</label>
            <input type="text" class="form-control mb-3"
                   value="Customer" readonly>

            <h6 class="mt-4">Akses Cepat</h6>

            <a href="{{ route('orders.index') }}" class="quick-btn btn-blue">
                Pesanan Saya
            </a>

            <a href="{{ route('custom.index') }}" class="quick-btn btn-orange">
                Pesan Custom
            </a>

        </div>

    </div>

</div>

</div>

<!-- ✅ TAMBAHAN SCRIPT REAL-TIME -->
<script>
function loadStatistik() {
    fetch("{{ route('user.statistik') }}")
        .then(res => res.json())
        .then(data => {
            document.getElementById('totalPesanan').innerText = data.total;
            document.getElementById('pesananReguler').innerText = data.reguler;
            document.getElementById('pesananCustom').innerText = data.custom;
        });
}

loadStatistik();
setInterval(loadStatistik, 3000);
</script>

@endsection