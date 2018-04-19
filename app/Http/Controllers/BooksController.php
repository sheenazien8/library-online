<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Author;
use App\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BookRequest;
use Illuminate\Contracts\Filesystem\Illuminate;

class BooksController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, Builder $builder)
  {
    if ($request->ajax()) {
      $books = Book::with('author')->get();

      return DataTables::of($books)
              ->addColumn('action', function($book){
                return view('datatable._action',[
                  'edit_url' => route('books.edit', $book->id),
                  'detail_url' => route('books.show', $book->id),
                  'delete_url' => route('books.destroy', $book->id),
                  'confirm_message' => 'Yakin ingin menghapus '.$book->title .'?'
                ]);
              })->toJson();
    }
    $html = $builder->columns([
       ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
       ['data' => 'ammount', 'name' => 'ammount', 'title' => 'Jumlah Buku'],
       ['data' => 'author.name', 'name' => 'author.name', 'title' => 'Writers'],
       ['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false],
     ]);

    return view('books.index', compact('html'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $authors = Author::all();

    return view('books.create', compact('authors'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BookRequest $request)
  {

    $book = Book::create($request->except('cover'));

    //cek jika user upload gambar
    if ($request->hasFile('cover')) {
      $uploadedImage = $request->file('cover');

      //mengambil extension file
      $extension = $uploadedImage->getClientOriginalExtension();

      //membuat nama file menjadi random
      $fileName = md5(time()).'.'. $extension;

      // simpan gambar ke folder public/cover
      $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'cover';

      $uploadedImage->move($destinationPath,$fileName);

      //simpan filename ke dalam database
      $book->cover = $fileName;
      $book->save();
    }

    return redirect()->route('books.index')->with('flash_notification',[
      'level' => 'success',
      'message' => "Berhasil menyimpan buku dengan judul <strong class='text-primary'>".$book->title."</strong>"
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function show(Book $book)
  {
    return view('books.show', compact('book','authors'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function edit(Book $book)
  {
    $authors = Author::all();
    return view('books.edit' , compact('book' , 'authors'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function update(BookRequest $request, Book $book)
  {
    $book->update($request->all());

    if ($request->hasFile('cover')) {
      $fileName = null;
      $uploadedImage = $request->file('cover');
      $extension = $uploadedImage->getClientOriginalExtension();

      $fileName = md5(time()).'.' . $extension;
      $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'cover';

      $uploadedImage->move($destinationPath,$fileName);

      if ($book->cover) {
        $oldImage = $book->cover;
        $filePath = public_path() . DIRECTORY_SEPARATOR . 'cover' . DIRECTORY_SEPARATOR .$book->cover;

        try {
          File::delete($filePath);
        } catch (FileNotFoundException $e) {

        }

        $book->cover = $fileName;
        $book->save();

      }
    }

    return redirect()->route('books.index')->with('flash_notification',[
      'level' => 'success',
      'message' => "Berhasil memperbarui buku dengan Judul $book->title"
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function destroy(Book $book)
  {
    if (!$book->delete()) {
      return redirect()->back();
    }

    return redirect()->route('books.index')->with('flash_notification',[
     'level' => 'secondary',
     'message' => '<strong class="text-primary">' . $book->title .'</strong> Berhasil dihapus'
    ]);;
  }
}
