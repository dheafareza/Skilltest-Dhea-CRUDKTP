<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ktp;

class KtpSeeder extends Seeder
{
    public function run()
{
    \App\Models\KTP::factory(10000)->create();
}

}
