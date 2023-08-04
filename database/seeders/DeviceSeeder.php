<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Device::create([
                'uid' => 'uid_' . ($i + 1),
                'appId' => 'app_id_' . ($i + 1),
                'language' => rand(0, 1) ? 'en' : 'tr',
                'os' => rand(0, 1) ? 'ios' : 'android',
                'client_token' => bin2hex(random_bytes(32)),
            ]);
        }
    }
}
