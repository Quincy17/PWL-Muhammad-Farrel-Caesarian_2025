<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'PT Mencari Cinta Abadi',
                'supplier_alamat' => 'Jl. qefcweqwfr'
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'PT Jual Beli Musang',
                'supplier_alamat' => 'Jl. asdsadrf'
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'Critasena',
                'supplier_alamat' => 'Jl.qefcva'
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}