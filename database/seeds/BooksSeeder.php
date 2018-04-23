<?php

use App\User;
use App\Book;
use App\Author;
use App\BorrowLog;
use Illuminate\Database\Seeder;


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

    //buat contoh peminjaman buku
    $member = User::where('email', 'member@gmail.com')->first();

    BorrowLog::create([
      'user_id' => $member->id,
      'book_id' => $book1->id,
      'is_returned' => 0
    ]);

    BorrowLog::create([
      'user_id' => $member->id,
      'book_id' => $book2->id,
      'is_returned' => 0
     ]);

    BorrowLog::create([
      'user_id' => $member->id,
      'book_id' => $book3->id,
      'is_returned' => 1
    ]);

  }
}
