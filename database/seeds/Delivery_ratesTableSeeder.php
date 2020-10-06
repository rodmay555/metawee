<?php

use Illuminate\Database\Seeder;


class Delivery_ratesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get(database_path('seeds/delivery_rates.sql')));


    }
}
