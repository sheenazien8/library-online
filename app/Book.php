<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Book extends Model
{
  public static function boot()
  {
    parent::boot();

    self::updating(function ($book)
    {
      if ($book->ammount < $book->borrowed) {
        Session::flash('flash_notification',[
          'level' => 'danger',
          'message' => "Jumlah buku $book->title harus lebih dari ".$book->borrowed
        ]);
        return false;
      }
    });
  }

  protected $fillable= [
    'title', 'ammount', 'cover', 'author_id'
  ];

  public function author()
  {
    return $this->belongsTo(Author::class);
  }

  public function borrowLogs()
  {
  	return $this->hasMany(BorrowLog::class);
  }

  public function getStockAttribute()
  {
  	$borrowed = $this->borrowLogs()->borrowed()->count();

  	$stock = $this->ammount - $borrowed;

  	return $stock;
  }

  public function getBorrowedAttribute()
  {
    return $this->borrowLogs()->borrowed()->count();
  }
}
