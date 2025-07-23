<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('categories')->insert([
            [
                'name' => 'Bahasa Indonesia',
                'slug' => 'bahasa-indonesia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],

            [
                'name' => 'Maetematika',
                'slug' => 'matematika',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],

            [
                'name' => 'Ips',
                'slug' => 'ips',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],

            [
                'name' => 'Ipa',
                'slug' => 'ipa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],

            [
                'name' => 'Agama Islam',
                'slug' => 'agama-islam',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],

            [
                'name' => 'Agama Kristen',
                'slug' => 'agama-kristen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],

            [
                'name' => 'Bahasa Inggris',
                'slug' => 'bahasa-inggris',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],

            [
                'name' => 'Pendidikan Kewarganegaraan',
                'slug' => 'pkn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ],

            [
                'name' => 'Pendidikan Jasamani',
                'slug' => 'pjok',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            [
                'name' => 'TIK',
                'slug' => 'tik',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                    
            ],        
                
         ]);
    }
}
