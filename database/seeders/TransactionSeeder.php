<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            Transaction::create([
                'receipt' => 'Receipt ' . $i,
                'expire_date' => Carbon::now()->addDays(rand(1, 30)),
                'os' => rand(0, 1) ? 'ios' : 'android',
                'cancelled' => false,
                'processed' => false,
                'retry_count' => 0,
            ]);
        }

        for ($i = 26; $i <= 50; $i++) {
            Transaction::create([
                'receipt' => 'Receipt ' . $i,
                'expire_date' => Carbon::now()->subDays(rand(1, 30)),
                'os' => rand(0, 1) ? 'ios' : 'android',
                'cancelled' => false,
                'processed' => false,
                'retry_count' => 0,
            ]);
        }
    }
}
