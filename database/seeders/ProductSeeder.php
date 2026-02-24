<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Lemari Pakaian 2 Pintu Minimalis',
                'price' => 1850000,
                'stock' => 8,
                'size' => '180x80x45 cm',
                'material' => 'Kayu Mahoni + Finishing Melamin',
                'description' => 'Lemari pakaian minimalis 2 pintu, cocok untuk kamar modern. Finishing halus dan awet.',
                'is_featured' => true,
            ],
            [
                'name' => 'Tempat Tidur Minimalis Queen',
                'price' => 2400000,
                'stock' => 5,
                'size' => '200x160 cm',
                'material' => 'Kayu Jati/ Mahoni (sesuai stok)',
                'description' => 'Rangka tempat tidur minimalis kuat, desain sederhana, cocok untuk rumah modern.',
                'is_featured' => true,
            ],
            [
                'name' => 'Meja Makan 4 Kursi',
                'price' => 2750000,
                'stock' => 3,
                'size' => 'Meja 120x70 cm',
                'material' => 'Kayu Jati + Jok Fabric',
                'description' => 'Set meja makan 4 kursi. Nyaman untuk keluarga kecil, material kokoh.',
                'is_featured' => false,
            ],
            [
                'name' => 'Kursi Tamu Sudut Minimalis',
                'price' => 3200000,
                'stock' => 2,
                'size' => 'Sesuai konfigurasi ruang',
                'material' => 'Rangka Kayu + Busa + Kain/Jok',
                'description' => 'Kursi tamu sudut minimalis, bisa custom warna kain dan ukuran.',
                'is_featured' => false,
            ],
            [
                'name' => 'Meja TV Minimalis',
                'price' => 950000,
                'stock' => 10,
                'size' => '120x40x45 cm',
                'material' => 'Kayu Mahoni + HPL',
                'description' => 'Meja TV minimalis dengan ruang penyimpanan. Tampilan rapi dan elegan.',
                'is_featured' => false,
            ],
            [
                'name' => 'Rak Buku 5 Susun',
                'price' => 650000,
                'stock' => 12,
                'size' => '150x60x30 cm',
                'material' => 'Kayu Mahoni + Finishing Melamin',
                'description' => 'Rak buku 5 susun, cocok untuk rumah, kantor, atau kamar.',
                'is_featured' => false,
            ],
        ];

        foreach ($items as $item) {
            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                array_merge($item, ['slug' => Str::slug($item['name']), 'image' => null])
            );
        }
    }
}