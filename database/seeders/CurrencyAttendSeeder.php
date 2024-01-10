<?php

namespace Database\Seeders;

use App\Models\CurrencyAttend;
use Illuminate\Database\Seeder;

class CurrencyAttendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurrencyAttend::create([
            'currency_id' => 2,
            'is_default' => 1,
            'user_id' => 1,
            'admin_id' => 1
        ]);
    }
}
