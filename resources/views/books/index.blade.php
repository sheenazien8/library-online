@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Books</li>
            </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Books
              <a href="{{ route('books.create') }}" class="btn btn-primary float-right">+ Add</a>
              <a href="{{ route('export.books.xls') }}" class="btn btn-primary float-right">Export</a>
            </div>

            <div class="card-body">
              <!-- cara dataTables -->
              {!! $html->table(['class' => 'table']) !!}
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
  {!! $html->scripts() !!}
@endpush

