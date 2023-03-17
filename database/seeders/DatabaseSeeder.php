<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Customer::factory(10)->create();
        Supplier::factory(10)->create();

        Product::insert([
            [
                'nama_produk' => 'indomie',
                'jenis_produk' => 'makanan',
                'harga' => 7500,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'aqua',
                'jenis_produk' => 'minuman',
                'harga' => 2500,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'coca-cola',
                'jenis_produk' => 'minuman',
                'harga' => 10000,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'chiki',
                'jenis_produk' => 'makanan',
                'harga' => 5000,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'lifebuoy',
                'jenis_produk' => 'sabun',
                'harga' => 4500,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'clear',
                'jenis_produk' => 'sampo',
                'harga' => 3000,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'taro',
                'jenis_produk' => 'makanan',
                'harga' => 5500,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'tango',
                'jenis_produk' => 'makanan',
                'harga' => 8000,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'kratindaeng',
                'jenis_produk' => 'minuman',
                'harga' => 7500,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ], [
                'nama_produk' => 'nuvo',
                'jenis_produk' => 'sabun',
                'harga' => 10000,
                'stok' => rand(10,20),
                'id_admin' => rand(1,10)
            ]
        ]);
    }
}
