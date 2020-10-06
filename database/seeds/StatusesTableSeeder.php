<?php

use Illuminate\Database\Seeder;


class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get(database_path('seeds/statuses.sql')));

        }
    }

