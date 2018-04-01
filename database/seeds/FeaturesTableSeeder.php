<?php

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('features')->insert([
            array('feature' => 'Student Management'),
            array('feature' => 'Teacher Management'),
            array('feature' => 'User Management'),
            array('feature' => 'Parents Management'),
            array('feature' => 'Exam Management'),
            array('feature' => 'Fees Management'),
            array('feature' => 'Result Management'),
            array('feature' => 'Notice Board Management'),
            array('feature' => 'Notification Management'),
            array('feature' => 'Report Management'),
            array('feature' => 'Class Routine Management'),
            array('feature' => 'Staff Management'),
            array('feature' => 'Staff Salary Management'),
            array('feature' => 'Staff Promotion Management'),
            array('feature' => 'Techer-Student Conversation'),
            array('feature' => 'Techer-Techer Conversation'),
            array('feature' => 'Student-Student Conversation'),
            array('feature' => 'Admin Panel'),
        ]);
    }
}
