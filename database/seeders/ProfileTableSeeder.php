<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            ['title' => 'Dasar Hukum', 'slug' => Str::slug('Dasar Hukum'), 'body' => Str::random(50), 'created_at' => now()],
            ['title' => 'Visi dan Misi', 'slug' => Str::slug('Visi dan Misi'), 'body' => Str::random(50), 'created_at' => now()],
            ['title' => 'Tugas Pokok Dan Fungsi', 'slug' => Str::slug('Tugas Pokok Dan Fungsi'), 'body' => Str::random(50), 'created_at' => now()],
        ]);
    }
}
