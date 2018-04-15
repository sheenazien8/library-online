<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //sampel penulis
      $author1 = Author::create(['name' => 'Ozanio']);
      $author2 = Author::create(['name' => 'Masashi Kisimoto']);
      $author3 = Author::create(['name' => 'Sandi']);

      //sampel buku
      $book1 = Book::create([
        'title' => 'kupinang kau dengan bismillah',
        'ammount' => 3,
        'author_id' => $author1->id
      ]);
      $book2 = Book::create([
        'title' => 'Naruto',
        'ammount' => 8,
        'author_id' => $author2->id
      ]);
      $book3 = Book::create([
        'title' => 'Ayat ayat cinta',
        'ammount' => 90,
        'author_id' => $author3->id
      ]);
      $book4 = Book::create([
        'title' => 'Sherlock homes',
        'ammount' => 46,
        'author_id' => $author3->id
      ]);


    }
}
