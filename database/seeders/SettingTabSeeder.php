<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // query builder
        DB::table('setting')->insert([
            'id_setting' => 1,
            'company_name' => 'Kafe Bisa Ngoding',
            'address' => 'Jl. Niwarna No. 100',
            'phone' => '085161321612',
            'nota_type' => 1, //kecil 
            'path_logo' => '/img/logo.png'
        ]);

    }
}
