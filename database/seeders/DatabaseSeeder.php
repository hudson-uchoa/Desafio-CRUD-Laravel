<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'email' => 'fernando123@gmail.com',
                'password' => '$2a$12$HV7vJsc6WbdsflJHab.fq.UIIAZZ.h1VS82Z3PVru.xWpXUzfO8Pq',
            ],
            [
                'email' => 'marcela12@outlook.com',
                'password' => '$2a$12$6zBnhV3CP6RZaQfJLG6piu9P6mssCBWf9udQVJGGCJz/uqGXuOI7y',
            ],
        ]);
    }
}
