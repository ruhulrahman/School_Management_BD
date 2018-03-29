<?php

use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class')->insert([
            array('class_name' => 'One'),
            array('class_name' => 'Two'),
            array('class_name' => 'Three'),
            array('class_name' => 'Four'),
            array('class_name' => 'Five'),
            array('class_name' => 'Six'),
            array('class_name' => 'Seven'),
            array('class_name' => 'Eight'),
            array('class_name' => 'Nine'),
            array('class_name' => 'Ten'),
        ]);
    }
}
