<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Purchase::create([
                'receipt' => 'Receipt ' . $i,
                'status' => false,
                'client_token' => bin2hex(random_bytes(32)),
            ]);
        }
    }
}
