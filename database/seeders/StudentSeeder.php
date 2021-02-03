<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;
use Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
          'id' => rand(17010001, 17019999),
          'name' => Str::random(10)
        ]);
    }
}
