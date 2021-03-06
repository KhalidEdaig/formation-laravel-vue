<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersQuestionAnswersSeeder::class,
            FavoriteTableSeeder::class,
            VotablesTablesSeeder::class
        ]);
    }
}