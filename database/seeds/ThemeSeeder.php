<?php

use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theme')->insert([
            array(
            	'color_class_name' => 'default',
            	'color_code' => '#4A8BC2',
        	),array(
            	'color_class_name' => 'green',
            	'color_code' => '#74B749',
        	),array(
            	'color_class_name' => 'gray',
            	'color_code' => '#2d2d2d',
        	),array(
            	'color_class_name' => 'purple',
            	'color_code' => '#7265ae',
        	),array(
                'color_class_name' => 'red',
                'color_code' => '#DE577B',
            ),array(
            	'color_class_name' => 'orange',
            	'color_code' => 'orange',
        	),
        ]);
    }
}
