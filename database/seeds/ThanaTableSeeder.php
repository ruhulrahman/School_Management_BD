<?php

use Illuminate\Database\Seeder;

class ThanaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('thana')->insert([
            array(
                'thana_name' => 'Ramna',
                'district_id' => '1',
            ),
            array(
                'thana_name' => 'Dhanmondi',
                'district_id' => '1',
            ),
        ]);
        
    }
}
