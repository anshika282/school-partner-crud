<?php

namespace Database\Seeders;

use App\Models\SchoolPartner;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolPartner::factory()->count(30)->create();
    }
}
