<?php

namespace Database\Seeders;

use App\Models\PaymentList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentList::factory(50)->create()->count();
    }
}
