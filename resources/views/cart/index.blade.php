{{-- resources/views/cart/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Keranjang Belanja</h2>
            <p class="text-muted mb-0">Cek kembali produk kamu sebelum checkout.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-3">
                ← Lanjut Belanja
            </a>

            @php $cartCount = count(session('cart', [])); @endphp

            @if($cartCount > 0)
                <a href="{{ route('checkout.index') }}" class="btn btn-dark rounded-pill px-3">
                    Checkout
                </a>
            @else
                <button class="btn btn-secondary rounded-pill px-3" disabled>
                    Checkout
                </button>
            @endif
        </div>
    </div>

    @php
        $cart = session('cart', []);
        $items = is_array($cart) ? $cart : [];
        $subtotal = 0;

        foreach ($items as $it) {
            $qty = (int)($it['quantity'] ?? 1);
            $price = (int)($it['price'] ?? 0);
            $subtotal += ($qty * $price);
        }

        $shipping = 0;
        $discount = 0;
        $total = $subtotal + $shipping - $discount;
    @endphp

    @if(empty($items))

        {{-- Empty State --}}
        <div class="text-center py-5">
            <h4>Keranjang kamu masih kosong</h4>
            <a href="{{ url('/products') }}" class="btn btn-dark mt-3">
                Lihat Produk
            </a>
        </div>

    @else

        <div class="row g-4">

            {{-- LIST PRODUK --}}
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">

                        @foreach($items as $id => $item)

                            @php
                                $name = $item['name'] ?? 'Produk';
                                $price = (int)($item['price'] ?? 0);
                                $qty = (int)($item['quantity'] ?? 1);
                                $lineTotal = $price * $qty;
                                $image = $item['image'] ?? null;
                            @endphp

                            <div class="d-flex gap-3 align-items-start py-3 border-bottom">

                                {{-- Image --}}
                                <div style="width:90px;height:90px;">
                                    @if($image)
                                        <img src="{{ asset('storage/'.$image) }}" 
                                             style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                                    @else
                                        <div style="width:100%;height:100%;background:#f1f1f1;
                                                    display:flex;align-items:center;justify-content:center;
                                                    border-radius:12px;">
                                            🪑
                                        </div>
                                    @endif
                                </div>

                                {{-- Info --}}
                                <div class="flex-grow-1">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="fw-bold">{{ $name }}</div>
                                            <div class="text-muted small">
                                                Rp {{ number_format($price,0,',','.') }}
                                            </div>
                                        </div>
                                        <div class="fw-bold">
                                            Rp {{ number_format($lineTotal,0,',','.') }}
                                        </div>
                                    </div>

                                    {{-- Qty --}}
                                    <div class="mt-3 d-flex align-items-center gap-2">

                                        <form action="{{ route('cart.decrease',$id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-outline-secondary btn-sm">-</button>
                                        </form>

                                        <span>{{ $qty }}</span>

                                        <form action="{{ route('cart.increase',$id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-outline-secondary btn-sm">+</button>
                                        </form>

                                        {{-- Remove --}}
                                        <form action="{{ route('cart.remove',$id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Hapus item ini?')"
                                              class="ms-3">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>

                                </div>
                            </div>

                        @endforeach

                        {{-- Clear Cart --}}
                        <div class="mt-4">
                            <form action="{{ route('cart.clear') }}" 
                                  method="POST"
                                  onsubmit="return confirm('Kosongkan keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-dark">
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            {{-- SUMMARY --}}
            <div class="col-lg-4">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">Ringkasan</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Ongkir</span>
                            <span>Gratis</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total</span>
                            <span>Rp {{ number_format($total,0,',','.') }}</span>
                        </div>

                        {{-- Checkout Button --}}
                        @if($total > 0)
                            <a href="{{ route('checkout.index') }}" 
                               class="btn btn-dark w-100">
                                Checkout Sekarang
                            </a>
                        @else
                            <button class="btn btn-secondary w-100" disabled>
                                Keranjang Kosong
                            </button>
                        @endif

                    </div>
                </div>
            </div>

        </div>

    @endif

</div>
@endsection