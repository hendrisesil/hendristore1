<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_perusahaan' => 'Hendri Store',
            'alamat' => 'Jl.Jaksa Agung Suprapto I/16 Malang',
            'telepon' => '08123217539',
            'tipe_nota' => 1, // kecil
            // dibawah ini setting jumlah diskon untuk member
            'diskon' => 5,
            'path_logo' => '/img/hendristore3.jpeg',
            'path_kartu_member' => '/img/member1.png',
        ]);
    }
}
