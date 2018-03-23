<?php

use Illuminate\Database\Seeder;

class ExamTermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exam_term')->insert([
            array('exam_name' => 'First Term'),
            array('exam_name' => 'Second Term'),
            array('exam_name' => 'Final Term'),
        ]);
    }
}
