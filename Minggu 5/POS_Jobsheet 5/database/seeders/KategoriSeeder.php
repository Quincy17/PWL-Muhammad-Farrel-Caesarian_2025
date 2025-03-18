<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'MaBer',
                'kategori_nama' => 'Makanan Berat',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'Minuman',
                'kategori_nama' => 'Minuman',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'Snack',
                'kategori_nama' => 'Snack',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'KuBas',
                'kategori_nama' => 'Kue Basah',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'KuKer',
                'kategori_nama' => 'Kue Kering',
            ],
            [
                'kategori_id' => 6,
                'kategori_kode' => 'CML',
                'kategori_nama' => 'Cemilan',
            ],
            [
                'kategori_id' => 7,
                'kategori_kode' => 'MNR',
                'kategori_nama' => 'Minuman Ringan',
            ],
        ];

        DB::table('m_kategori')->insertOrIgnore($data);
    }
}
