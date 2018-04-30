<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Author;
use App\Book;
use Excel;

class BookImportController extends Controller
{
  public function generateExcelTemplate()
  {
  	Excel::create('Template Import Buku',function($excel){
  		$excel->setTitle('Template Import Buku')
  					->setCreator('Library Online')
  					->setCompany('Library Online')
  					->setDescription('Template import buku untuk Library Online');

  		$excel->sheet('Data Buku', function($sheet){
  			$row = 1;
  			$sheet->row($row,[
					'title',
					'writers',
					'amount'
				]);
  		});
  	})->export('xls');
  }
  public function importExcel(Request $request)
  {
  	// validasi file yand di upload harus excel
  	$request->validate([
			'excel' => 'required|mimes:xls,xlsx,ods'
		]);

		$excel = $request->excel;

		// baca sheet pertama
		$excels = Excel::selectSheetsByIndex(0)->load($excel)->get();

		// validasi row pertama

		$rowRules =[
			'title' => 'required|unique:books,title',
			'writers' => 'required',
			'amount' => 'required'
		];

		// catat semua ID buku baru untuk menghitung total buku yang berhasil di import
		$book_id = [];

		// looping dari setiap baris dari baris kedua, yang pertama adalah nama kolom

		foreach ($excels as $row) {
			//validasi untuk role excel
			$validator = Validator::make($row->toArray(), $rowRules);

			// lewati baris yang tidak valis, lanjut ke baris selanjutnya
			if ($validator->fails()) {
				continue;
			}

			// jika valid maka di eksekusi &cek apakah data sudah ada di database
			$author = Author::where('name', $row['writers'])->first();

			// buat penulis jika belum tercatat di dalam database
			if (!$author) {
				$author = Author::create(['name' => $row['writers']]);
			}

			// buat buku baru
			$book = Book::create([
				'title' => $row['title'],
				'author_id' => $author->id,
				'ammount' => $row['amount']
			]);

			// catat id buku yang berhasil dibuat
			array_push($book_id, $book->id);
		}

		// get semua buku yang baru dibuat
		$books = Book::whereIn('id', $book_id)->get();

		// redirect ke form jika tidak ada buku yang berhasil di import
		if ($books->count() == 0) {
			return redirect()->back()->with('flash_notification',[
				'level' => 'danger',
				'message' => 'Tidak ada buku yang berhasil di import atau data buku sudah ada'
			]);
		}

		// jika berhasil tersimpan
		return redirect()->route('books.index')->with('flash_notification',[
			'level' => 'success',
			'message' => "Berhasil menyimpan ".$books->count()." buku."
		]);
  }
}
