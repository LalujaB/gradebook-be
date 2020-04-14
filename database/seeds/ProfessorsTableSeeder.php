<?php

use Illuminate\Database\Seeder;
use App\Professor;

class ProfessorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Professor::class, 10)->create();
    }
}
