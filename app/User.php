<?php

namespace App;
use App\Mail\SendVerification;
use App\BorrowLog;
use App\Book;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\BookExceptions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
  use LaratrustUserTrait;
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
   'password', 'remember_token',
  ];

  //bawaan
  protected $cast = ['is_verified'];


  function borrowLogs()
  {
    return $this->hasMany(BorrowLog::class);
  }

  public function borrow(Book $book)
  {
    // cek stock buku
    if ($book->stock < 1) {
      throw new BookExceptions("Buku $book->title sedang tidak tersedia");
    }

    if ($this->borrowLogs()->where('book_id', $book->id)->where('is_returned', 0)->count() > 0) {
      throw new BookExceptions('Buku '.$book->title .' sedang anda pinjam!');
    }

    return BorrowLog::create([
      'user_id' => auth()->user()->id,
      'book_id' => $book->id,
    ]);
  }

  public function sendEmailVerification()
  {
    $token = $this->generateVerificationCode();

    $user = $this;

    Mail::to($user)->send(new SendVerification($user));
  }

  public function generateVerificationCode()
  {
    $token = $this->verification_token;

    if (!$token) {
      $token =str_random(40);
      $this->verification_token = $token;
      $this->save();
    }

    return $token;
  }

  public function verify()
  {
    $this->is_verified = 1;
    $this->verification_token = null;
    $this->save();
  }
}
