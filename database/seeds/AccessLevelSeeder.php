<?php

use Illuminate\Database\Seeder;

class AccessLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_levels')->insert([
            'title' => 'douche'
        ]);

        DB::table('access_levels')->insert([
            'title' => 'admin'
        ]);
    }
}
