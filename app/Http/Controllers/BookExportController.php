<?php

namespace App\Http\Controllers;

use PDF;
use Excel;
use App\Book;
use Illuminate\Http\Request;
use App\Author;


class BookExportController extends Controller
{
	public function export()
	{
		$authors = Author::pluck('name', 'id')->all();
		return view('books.export', compact('authors'));
	}

	public function exportPost(Request $request)
	{
		$request->validate([
			'author_id' =>'required',
			'type' => 'required|in:pdf,xls'
		],[
			'author_id.required' => 'Anda Belum memilih penulis, silahkan pilih minimal satu penulis'
		]);

		$books = Book::whereIn('author_id', $request->author_id)->get();

		// ucfirst() merubah hruf menjadi awal dan untuk memanggil method pdf atau xls
		$handler = 'export' . ucfirst($request->type);

		return $this->$handler($books);
	}

	public function exportPdf($books)
	{
		$pdf = PDF::loadView('pdf.books' ,compact('books'));

		return $pdf->stream('data-buku pdf');
	}

	public function exportXls($books)
	{
		Excel::create('Data buku perpustakaan', function($excel) use ($books){

			$excel->setTitle('Data Buku')->setCreator(auth()->user()->name);

			$excel->sheet('Data buku', function ($sheet) use ($books){
				$row = 1;
				$sheet->row($row,[
					'Title',
					'Amount',
					'Stock',
					'Writers'
				]);

				foreach ($books as $book) {
					$sheet->row(++$row,[
						$book->title,
						$book->ammount,
						$book->stock,
						$book->author->name,
					]);
				}
			})->export('xls');
		});
	}

}
