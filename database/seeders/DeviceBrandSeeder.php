<?php

namespace Database\Seeders;

use App\Models\DeviceBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeviceBrand::insert([
            ['name' => 'Samsung'],
            ['name' => 'Apple'],
            ['name' => 'Google'],
            ['name' => 'Xiaomi'],
            ['name' => 'Huawei'],
            ['name' => 'Oppo'],
            ['name' => 'Vivo'],
            ['name' => 'OnePlus'],
            ['name' => 'Nokia'],
            ['name' => 'Asus'],
            ['name' => 'Lenovo'],
            ['name' => 'Motorola'],
            ['name' => 'OnePlus'],
            ['name' => 'LG'],
            ['name' => 'HP'],
            ['name' => 'Acer'],
            ['name' => 'Dell'],
            ['name' => 'Sony'],
            ['name' => 'Fujitsu'],
            ['name' => 'BlackBerry']
        ]);
    }
}
