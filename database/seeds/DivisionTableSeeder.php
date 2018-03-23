<?php

use Illuminate\Database\Seeder;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('division')->insert([
            array(
            	'division_name' => 'Dhaka',
            	'country_id' => 1,
            ),
            array(
            	'division_name' => 'Rajshahi',
            	'country_id' => 1,
            ),
            array(
            	'division_name' => 'Chittagong',
            	'country_id' => 1,
            ),
            array(
            	'division_name' => 'Rangpur',
            	'country_id' => 1,
            ),
            array(
            	'division_name' => 'Barisal',
            	'country_id' => 1,
            ),
            array(
            	'division_name' => 'Khulna',
            	'country_id' => 1,
            ),
            array(
            	'division_name' => 'Mymensing',
            	'country_id' => 1,
            ),
            array(
            	'division_name' => 'Sylhet',
            	'country_id' => 1,
            ),
        ]);
    }
}
