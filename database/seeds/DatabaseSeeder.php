<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
	        SuperAdminTableSeeder::class,
	        DaysTableSeeder::class,
	        ExamTermTableSeeder::class,
            MonthsTableSeeder::class,
            CountryTableSeeder::class,
            DivisionTableSeeder::class,
            DistrictTableSeeder::class,
            ThanaTableSeeder::class,
            ThemeSeeder::class,
	    ]);
    }
}
