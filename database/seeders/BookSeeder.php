<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::pluck('id'); 

        Book::factory(1000)->make()->each(function ($book) use ($authors) {
            $book->author_id = $authors->random(); 
            $book->save();
        });
    }
}
