{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
@php
  // FIX: Biar tidak error Undefined variable $products
  $products = $products ?? \App\Models\Product::latest()->take(8)->get();
@endphp

{{-- HERO --}}
<section class="text-white py-5" style="
  background: radial-gradient(1200px circle at 10% 10%, rgba(255,193,7,.25), transparent 55%),
              radial-gradient(900px circle at 90% 30%, rgba(13,110,253,.18), transparent 50%),
              linear-gradient(180deg, #111827 0%, #0b1220 100%);
">
  <div class="container py-4">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <span class="badge rounded-pill mb-3" style="background:#f8f9fa;border:1px solid #e9ecef;color:#111827;">
          DDS Meubel • Furniture Berkualitas
        </span>

        <h1 class="display-5 fw-bold lh-sm mb-3">
          Buat rumah makin nyaman dengan <span class="text-warning">mebel terbaik</span>.
        </h1>

        <p class="lead text-white-50 mb-4">
          Pilihan lemari, meja, kursi, hingga kitchen set. Harga bersahabat, kualitas juara.
        </p>

        {{-- SEARCH --}}
        <form action="{{ url('/products') }}" method="GET"
              class="rounded-4 p-3"
              style="background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); backdrop-filter: blur(10px);">
          <div class="row g-2 align-items-center">
            <div class="col-md-7">
              <input type="text" name="q"
                     class="form-control form-control-lg border-0"
                     placeholder="Cari produk… contoh: lemari, meja, kursi"
                     style="background:transparent;color:white;">
            </div>
            <div class="col-md-3">
              <select name="category" class="form-select form-select-lg border-0"
                      style="background:rgba(255,255,255,.08);color:white;">
                <option value="">Semua Kategori</option>
                <option value="lemari">Lemari</option>
                <option value="meja">Meja</option>
                <option value="kursi">Kursi</option>
                <option value="tempat-tidur">Tempat Tidur</option>
              </select>
            </div>
            <div class="col-md-2 d-grid">
              <button class="btn btn-warning btn-lg fw-semibold rounded-3">Cari</button>
            </div>
          </div>

          <div class="mt-2 small text-white-50">
            Populer:
            <a class="text-white text-decoration-none" href="{{ url('/products') }}?q=lemari">Lemari</a>,
            <a class="text-white text-decoration-none" href="{{ url('/products') }}?q=meja">Meja</a>,
            <a class="text-white text-decoration-none" href="{{ url('/products') }}?q=kitchen">Kitchen Set</a>
          </div>
        </form>

        <div class="d-flex gap-2 mt-4 flex-wrap">
          <a href="{{ url('/products') }}" class="btn btn-light btn-lg rounded-pill px-4">Lihat Produk</a>
          <a href="#unggulan" class="btn btn-outline-light btn-lg rounded-pill px-4">Produk Unggulan</a>
        </div>

        <div class="mt-4 d-flex gap-2 flex-wrap">
          <span class="badge rounded-pill" style="background:#f8f9fa;border:1px solid #e9ecef;color:#111827;">✅ Garansi</span>
          <span class="badge rounded-pill" style="background:#f8f9fa;border:1px solid #e9ecef;color:#111827;">🚚 Pengiriman aman</span>
          <span class="badge rounded-pill" style="background:#f8f9fa;border:1px solid #e9ecef;color:#111827;">🪵 Material berkualitas</span>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="rounded-4 p-4"
             style="background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); backdrop-filter: blur(10px);">
          <div class="rounded-4 overflow-hidden"
               style="height:320px;background:rgba(255,255,255,.06);display:flex;align-items:center;justify-content:center;">
            <div class="text-center">
              <div style="font-size:48px;">🪑</div>
              <div class="fw-semibold">Furniture Modern Minimalis</div>
              <div class="text-white-50 small">Nanti bisa diganti foto banner asli.</div>
            </div>
          </div>

          <div class="row g-3 mt-3">
            <div class="col-6">
              <div class="p-3 rounded-4" style="background:rgba(255,255,255,.06);">
                <div class="fw-bold">Produk</div>
                <div class="small text-white-50">{{ $products->count() }} ditampilkan</div>
              </div>
            </div>
            <div class="col-6">
              <div class="p-3 rounded-4" style="background:rgba(255,255,255,.06);">
                <div class="fw-bold">Rating</div>
                <div class="small text-white-50">4.9/5 (contoh)</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- KATEGORI --}}
<section class="py-5">
  <div class="container">
    <div class="d-flex align-items-end justify-content-between mb-3">
      <div>
        <h3 class="fw-bold mb-1">Kategori Populer</h3>
        <p class="text-muted mb-0">Temukan produk berdasarkan kebutuhan rumahmu.</p>
      </div>
      <a href="{{ url('/products') }}" class="text-decoration-none fw-semibold">Lihat semua →</a>
    </div>

    @php
      $cats = [
        ['name'=>'Lemari', 'icon'=>'🧥', 'q'=>'lemari'],
        ['name'=>'Meja', 'icon'=>'🪵', 'q'=>'meja'],
        ['name'=>'Kursi', 'icon'=>'🪑', 'q'=>'kursi'],
        ['name'=>'Tempat Tidur', 'icon'=>'🛏️', 'q'=>'tempat tidur'],
        ['name'=>'Rak / Shelf', 'icon'=>'📚', 'q'=>'rak'],
        ['name'=>'Kitchen Set', 'icon'=>'🍳', 'q'=>'kitchen'],
      ];
    @endphp

    <div class="row g-3">
      @foreach($cats as $c)
        <div class="col-6 col-md-4 col-lg-2">
          <a href="{{ url('/products') }}?q={{ urlencode($c['q']) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm rounded-4" style="transition:.2s ease;">
              <div class="card-body text-center py-4">
                <div style="font-size:34px;">{{ $c['icon'] }}</div>
                <div class="fw-semibold mt-2 text-dark">{{ $c['name'] }}</div>
                <div class="text-muted small">Lihat koleksi</div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- PRODUK UNGGULAN --}}
<section id="unggulan" class="py-5" style="background:#f8f9fa;">
  <div class="container">
    <div class="d-flex align-items-end justify-content-between mb-3">
      <div>
        <h3 class="fw-bold mb-1">Produk Unggulan</h3>
        <p class="text-muted mb-0">Pilihan terbaik yang paling banyak diminati.</p>
      </div>
      <a href="{{ url('/products') }}" class="btn btn-outline-dark rounded-pill px-3">Semua Produk</a>
    </div>

    <div class="row g-3">
      @forelse($products as $p)
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="transition:.2s ease;">
            <div style="height:180px;background:#eef2f7;display:flex;align-items:center;justify-content:center;">
              {{-- kalau nanti sudah ada image di product, buka ini --}}
              {{-- <img src="{{ asset('storage/'.$p->image) }}" style="width:100%;height:100%;object-fit:cover;"> --}}
              <div class="text-center text-muted">
                <div style="font-size:40px;">🪑</div>
                <div class="small">Preview foto</div>
              </div>
            </div>

            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start gap-2">
                <div>
                  <div class="fw-bold text-truncate" title="{{ $p->name ?? 'Produk' }}">
                    {{ $p->name ?? 'Produk' }}
                  </div>
                  <div class="text-success fw-semibold mt-1">
                    Rp {{ number_format($p->price ?? 0, 0, ',', '.') }}
                  </div>
                </div>
                <span class="badge bg-warning text-dark rounded-pill">Best</span>
              </div>

              <div class="d-grid mt-3">
                <a href="{{ url('/products/'.$p->id) }}" class="btn btn-dark rounded-pill">Detail</a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-warning rounded-4">
            Produk belum ada. Tambahkan produk dulu ya.
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- KEUNGGULAN --}}
<section class="py-5">
  <div class="container">
    <div class="text-center mb-4">
      <h3 class="fw-bold mb-1">Kenapa DDS Meubel?</h3>
      <p class="text-muted mb-0">Kualitas terjaga, layanan ramah, pengiriman aman.</p>
    </div>

    @php
      $benefits = [
        ['icon'=>'🪵', 'title'=>'Material Berkualitas', 'desc'=>'Kayu & finishing pilihan, kokoh dan awet.'],
        ['icon'=>'🎨', 'title'=>'Desain Minimalis', 'desc'=>'Cocok untuk rumah modern dan elegan.'],
        ['icon'=>'🚚', 'title'=>'Pengiriman Aman', 'desc'=>'Packing rapi & aman sampai tujuan.'],
        ['icon'=>'🛠️', 'title'=>'Bisa Custom', 'desc'=>'Ukuran & model bisa menyesuaikan kebutuhan.'],
      ];
    @endphp

    <div class="row g-3">
      @foreach($benefits as $b)
        <div class="col-md-6 col-lg-3">
          <div class="card border-0 shadow-sm rounded-4 h-100" style="transition:.2s ease;">
            <div class="card-body p-4">
              <div class="d-flex align-items-center gap-3">
                <div class="rounded-4 d-flex align-items-center justify-content-center"
                     style="width:54px;height:54px;background:#fff3cd;">
                  <span style="font-size:26px;">{{ $b['icon'] }}</span>
                </div>
                <div class="fw-bold">{{ $b['title'] }}</div>
              </div>
              <p class="text-muted mt-3 mb-0">{{ $b['desc'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- FOOTER MINI --}}
<section class="py-5" style="background:#0b1220;color:#fff;">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-6">
        <h4 class="fw-bold mb-2">DDS Meubel</h4>
        <p class="text-white-50 mb-0">
          Toko furniture berkualitas dengan harga terbaik. Cocok untuk rumah minimalis dan modern.
        </p>
      </div>
      <div class="col-lg-6">
        <div class="d-flex gap-2 justify-content-lg-end flex-wrap">
          <a href="{{ url('/products') }}" class="btn btn-warning rounded-pill px-4 fw-semibold">Belanja</a>
          <a href="#" class="btn btn-outline-light rounded-pill px-4">Hubungi</a>
        </div>
      </div>
    </div>

    <hr class="border-secondary my-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <div class="text-white-50 small">© {{ date('Y') }} DDS Meubel. All rights reserved.</div>
      <div class="d-flex gap-3 small">
        <a class="text-white-50 text-decoration-none" href="#">Syarat</a>
        <a class="text-white-50 text-decoration-none" href="#">Privasi</a>
        <a class="text-white-50 text-decoration-none" href="#">Bantuan</a>
      </div>
    </div>
  </div>
</section>

{{-- ================= ADMIN SECTION ================= --}}
<style>
    .admin-section {
        background: linear-gradient(135deg, #0f1b2e, #1c2b45);
        padding: 80px 0;
        margin-top: 80px;
    }

    .admin-card {
        background: linear-gradient(135deg, #2c2f36, #3a2f2f);
        border-radius: 25px;
        padding: 50px;
        color: white;
        box-shadow: 0 0 40px rgba(255,140,0,0.15);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .admin-icon {
        background: #ff9800;
        width: 90px;
        height: 90px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        box-shadow: 0 0 30px rgba(255,152,0,0.5);
        margin-right: 25px;
    }

    .admin-btn {
        background: linear-gradient(135deg, #ff9800, #ff6f00);
        color: white;
        padding: 18px 35px;
        border-radius: 15px;
        font-weight: bold;
        text-decoration: none;
        box-shadow: 0 0 25px rgba(255,140,0,0.6);
        transition: 0.3s ease;
    }

    .admin-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 0 35px rgba(255,140,0,0.9);
        color: white;
    }
</style>

<section class="admin-section">
    <div class="container">
        <div class="admin-card">

            <div class="d-flex align-items-center">
                <div class="admin-icon">
                    ⬛
                </div>

                <div>
                    <h1 class="fw-bold">Admin Panel</h1>
                    <p class="text-light">
                        Kelola produk, pesanan, pelanggan & laporan penjualan
                    </p>
                    <p style="color:#ffc107;">
                        Login dengan: admin@ddsmeubel.com
                    </p>
                </div>
            </div>

            <div>
                <a href="{{ route('admin.dashboard') }}" class="admin-btn">
                    Akses Admin →
                </a>
            </div>

        </div>
    </div>
</section>
{{-- ================= END ADMIN SECTION ================= --}}
@endsection