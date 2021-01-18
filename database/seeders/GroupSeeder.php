<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;
use Str;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
          'id' => Str::random(4)+Str(rand(161,173)),
        ]);
    }
}
