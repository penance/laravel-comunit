<?php

use Illuminate\Database\Seeder;

class AddDiscussionStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'title' => 'rejected'
        ]);

        DB::table('statuses')->insert([
            'title' => 'suggested'
        ]);

        DB::table('statuses')->insert([
            'title' => 'approved'
        ]);

        DB::table('statuses')->insert([
            'title' => 'complete'
        ]);
    }
}
