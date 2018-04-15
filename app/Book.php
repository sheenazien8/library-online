<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $fillable= [
    'title', 'ammount', 'cover', 'author_id'
  ];

  public function author()
  {
    return $this->belongTo(Author::class);
  }
}
