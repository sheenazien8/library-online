<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
     return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    switch ($this->method()) {
      case 'POST':
          return[
            //didalam table books dalam column title harus beda
            'title' => 'required|unique:books,title',
            //didalam table authors harus sudah ada id author untuk di masukkan kedalam table book
            'author_id' => 'required|exists:authors,id',
            'ammount' => 'required|numeric',
            'cover' => 'image|max:2048'
          ];
        break;

       case 'PUT' :
       case'PATCH':
           return [
            'title' => 'required|unique:books,title,'. $this->route('book.id'),
            'author_id' => 'required|exists:authors,id',
            'ammount' => 'required|numeric',
            'cover' => 'image|max:2048'
           ];
         break;

      default:
        // code...
        break;
    }
  }
}
