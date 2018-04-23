@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

              <li class="breadcrumb-item"><a href="{{route('books.index')}}">Writers</a></li>

              <li class="breadcrumb-item active" aria-current="page">Data Writer</a></li>

          </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Books detail
            </div>
            
            <div class="card-body">
              Judul : <strong>{{ ' '.$book->title }}</strong>
            </div>
            <div class="card-body"> 
              Writers : {{ $book->author->name }}
            </div>

            <div class="card-body">
              Book Amount : <strong>{{ ' '.$book->ammount }}</strong> {{ ' Halaman' }}
            </div>
            <div class="card-body">
              <p>Cover</p> : <img src="{{ asset('cover/'. $book->cover) }}" height="200" class="img-rounded img-responsive">
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
