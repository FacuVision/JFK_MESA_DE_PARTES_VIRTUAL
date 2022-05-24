<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Storage::disk('public')->deleteDirectory('principal');
        Storage::disk('public')->deleteDirectory('file');
        Storage::disk('public')->deleteDirectory('answer');
        Storage::disk('public')->makeDirectory('principal');
        Storage::disk('public')->makeDirectory('file');
        Storage::disk('public')->makeDirectory('answer');

        $this->call(OfficeSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(IdentitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProcedingSeeder::class);
    }
}
