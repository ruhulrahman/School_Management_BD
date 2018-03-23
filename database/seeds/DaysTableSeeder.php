<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            array('day' => 'Saturday'),
            array('day' => 'Sunday'),
            array('day' => 'Monday'),
            array('day' => 'Tuesday'),
            array('day' => 'Wednessday'),
            array('day' => 'Thursday'),
        ]);
    }
}
