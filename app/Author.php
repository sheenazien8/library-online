<?php

namespace App;
use Session;

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
  //event function
  public static function boot()
  {
  	//mengambil sebagian dari ini
  	parent::boot();

  	self::deleting(function($author)
  	{
  		//cek penulis apakah punya buku belum
  		if ($author->books->count() > 0) {
  			$messageHtml = 'Penulis tidak bisa di hapus karena masih memilik buku';
  			$messageHtml .= '<ul>';

  			foreach ($author->books as $book) {
  				$messageHtml .= "<li>$book->title</li>";
  			}

  			$messageHtml .= '</ul>';
  			Session::flash('flash_notification',[
  			  'level' => 'danger',
  			  'message' => $messageHtml,
        ]);

        return false;
  		}
  	});
  }
}
