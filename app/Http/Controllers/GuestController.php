<?php

namespace App\Http\Controllers;
use DataTables;
use App\Book;
use Yajra\DataTables\Html\Builder;
use Laratrust\LaratrustFacade as Laratrust;
use Illuminate\Http\Request;

class GuestController extends Controller
{
   public function index(Request $request, Builder $builder)
    {
        if ($request->ajax()) {
            $books = Book::with('author')->get();

            return Datatables::of($books)
               ->addColumn('action', function ($book) {
                    if (Laratrust::hasRole('admin')) {
                        return '';
                    }
                    return '<a href=" '.route('guest.books.borrow', $book->id).' " class="btn btn-secondary"> Borrow </a>';
                })->toJson();

        }
        $html = $builder->columns([
            ['data' => 'title', 'name' => 'title', 'title' => 'Books of Title' ],
            ['data' => 'ammount', 'name' => 'ammount', 'title' => 'Amount of Books' ],
            ['data' => 'author.name', 'name' => 'author.name', 'title' => 'Authors' ],
            ['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false ],
        ]);

        return view('guest.index', compact('html'));
    }
}
