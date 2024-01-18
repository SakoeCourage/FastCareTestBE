<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $availableMethods = ["MoMo","Cash","Bank"];

        foreach($availableMethods as $method){
            Payment::create([
                "mode" => $method
            ]);
        }
    }
}
