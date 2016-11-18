<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()  // aqui se coloca cual seed se va a ejecutar, si no, no se ejecuta nada
    {

        $this->call(NotesTableSeeder::class);
        
    }
}
