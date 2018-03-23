<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('district')->insert([
            array(
            	'district_name' => 'Dhaka',
            	'division_id' => '1',
            ),
            array(
            	'district_name' => 'Narayangonj',
            	'division_id' => '1',
            ),
            array(
            	'district_name' => 'Gazipur',
            	'division_id' => '1',
            ),
            array(
            	'district_name' => 'Tangail',
            	'division_id' => '1',
            ),
            array(
            	'district_name' => 'Kishoregonj',
            	'division_id' => '1',
            ),
            array(
            	'district_name' => 'Narsingdi',
            	'division_id' => '1',
            ),
            array(
            	'district_name' => 'Gopalgonj',
            	'division_id' => '1',
            ),
            array(
            	'district_name' => 'Faridpur',
            	'division_id' => '1',
            ),
        ]);
    }
}
