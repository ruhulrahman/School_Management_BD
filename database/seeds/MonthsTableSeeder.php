<?php

use Illuminate\Database\Seeder;

class MonthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('months')->insert([
            array('month_name' => 'January'),
            array('month_name' => 'February'),
            array('month_name' => 'March'),
            array('month_name' => 'April'),
            array('month_name' => 'May'),
            array('month_name' => 'June'),
            array('month_name' => 'July'),
            array('month_name' => 'August'),
            array('month_name' => 'September'),
            array('month_name' => 'October'),
            array('month_name' => 'November'),
            array('month_name' => 'December'),
        ]);
    }
}
