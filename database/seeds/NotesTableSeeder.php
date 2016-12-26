<?php

use Illuminate\Database\Seeder;
use App\Note;
use App\Category;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create();
        factory(Note::class, 100)->create(); // lo podemos hacer directamente en la consola sin necesidad del archivo seeder
    }
}
