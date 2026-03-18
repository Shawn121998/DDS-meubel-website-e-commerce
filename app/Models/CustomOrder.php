<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    // Nama tabel (opsional kalau nama tabel sesuai konvensi)
    protected $table = 'custom_orders';

    // Field yang boleh diisi (WAJIB supaya bisa insert ke database)
    protected $fillable = [
        'user_id',
        'nama_produk',
        'deskripsi',
        'ukuran',
        'warna',
        'jumlah',
        'harga_estimasi',
        'status'
    ];

    // Relasi ke User (opsional tapi penting untuk skripsi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}