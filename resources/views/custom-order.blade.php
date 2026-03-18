@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">
        <div class="mb-3">
            <i class="fa fa-hammer fa-2x text-warning p-3 rounded bg-light"></i>
        </div>
        <h2 class="fw-bold">Pesan Custom</h2>
        <p class="text-muted">
            Wujudkan furniture impian Anda dengan desain sesuai keinginan.
        </p>
    </div>

    <div class="card shadow-sm border-0 p-4">

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('custom.store') }}" method="POST">
            @csrf

            {{-- JENIS PRODUK --}}
            <div class="mb-4">
                <label class="form-label">Jenis Produk</label>
                <select name="name" class="form-control" required>
                    <option value="">Pilih jenis produk</option>
                    <option value="Meja">Meja</option>
                    <option value="Kursi">Kursi</option>
                    <option value="Lemari">Lemari</option>
                </select>
            </div>

            {{-- UKURAN --}}
            <div class="mb-4">
                <label class="form-label">Ukuran (cm)</label>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="size_panjang" class="form-control" placeholder="Panjang" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="size_lebar" class="form-control" placeholder="Lebar" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="size_tinggi" class="form-control" placeholder="Tinggi" required>
                    </div>
                </div>
            </div>

            {{-- JENIS KAYU --}}
            <div class="mb-4">
                <label class="form-label">Jenis Kayu</label>
                <select name="material" class="form-control" required>
                    <option value="">Pilih jenis kayu</option>
                    <option value="Kayu Jati">Kayu Jati</option>
                    <option value="Kayu Mahoni">Kayu Mahoni</option>
                    <option value="Kayu Cempaka">Kayu Cempaka</option>
                    <option value="Kayu Nantu">Kayu Nantu</option>
                </select>
            </div>

            {{-- FINISHING --}}
            <div class="mb-4">
                <label class="form-label">Warna / Finishing</label>
                <input type="text" name="finishing" class="form-control" placeholder="Contoh: Natural Wood, Walnut">
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-4">
                <label class="form-label">Detail Tambahan</label>
                <textarea name="description" class="form-control" rows="4"
                    placeholder="Detail desain, jumlah pintu, dll" required></textarea>
            </div>

            {{-- PHONE --}}
            <div class="mb-4">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            {{-- ADDRESS --}}
            <div class="mb-4">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-control" rows="3" required></textarea>
            </div>

            {{-- NOTE --}}
            <div class="alert alert-warning small">
                <b>Catatan:</b><br>
                • Admin akan menghubungi dalam 1-2 hari<br>
                • Estimasi harga setelah konsultasi<br>
                • Pembayaran DP setelah desain disetujui
            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-between">
                <a href="/" class="btn btn-light">Batal</a>
                <button type="submit" class="btn btn-warning px-4">
                    Kirim Pesanan Custom
                </button>
            </div>

        </form>

    </div>

</div>

@endsection