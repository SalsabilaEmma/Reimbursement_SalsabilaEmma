<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengajuan;
use Carbon\Carbon;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengajuanData = [
            [
                'tgl' => '2015-04-09',
                'nama' => 'srznara',
                'deskripsi' => 'Est',
                'fileType' => 'image',
                'status' => '0',
                'statusReimburse' => '0',
                'file' => '1715322559.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2021-09-03',
                'nama' => 'srznara',
                'deskripsi' => 'Temporibus',
                'fileType' => 'pdf',
                'status' => '1',
                'statusReimburse' => '1',
                'file' => '1715322583_b5.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '1977-12-13',
                'nama' => 'DONA',
                'deskripsi' => 'Rem eaque voluptas e',
                'fileType' => 'image',
                'status' => '1',
                'statusReimburse' => '0',
                'file' => '1715322747.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            // ... other pengajuan data
        ];

        foreach ($pengajuanData as $pengajuan) {
            Pengajuan::insert($pengajuan);
        }
    }
}
