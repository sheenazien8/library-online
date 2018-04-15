<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  protected $fillable =['name'];
  /*
  Get the books for the model
  */

  public function books()
  {
    return $this->hasMany(Book::class);
  }
}
