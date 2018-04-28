<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use App\BorrowLog;


class StatisticsController extends Controller
{
	public function index(Request $request, Builder $builder)
	{
		if ($request->ajax()) {
    //ngambil dari model role yang di pangiil di model user menggunakan laratrust
    $statistics = BorrowLog::with('book','user');

    return DataTables::of($statistics)
            ->addColumn('returned_at', function($statistic){
              if ($statistic->is_returned) {
              	return $statistic->updated_at->format('d-m-Y');
              }

              return "<span class='text-primary'>Masih dipinjam </span>";
            })->rawColumns(['returned_at'])
            ->toJson();
  }
  $html = $builder->columns([
     ['data' => 'book.title', 'name' => 'book.title', 'title' => 'Title'],
     ['data' => 'user.name', 'name' => 'user.name', 'title' => 'Member'],
     ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date Borrowed'],
     ['data' => 'returned_at', 'name' => 'returned_at', 'title' => 'Date Returned'],
   ]);

  return view('statistics.index', compact('html'));
	}
}
