@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>

              <li class="breadcrumb-item active" aria-current="page">Edit Book</li>
          </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Edit Books
              
            </div>
            
            <div class="card-body">
              <form class="form-horizontal" action="{{ route('books.update', $book->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                 <div class="form-group">
                  <div class="col-md-6">
                    <label for="title">Book Title</label>
                    <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="title" name="title" value="{{ $book->title }}" placeholder="Book Title"  autofocus>


                    @if ($errors->has('title'))
                      <span class="invalid-feedback">
                        <strong>{{$errors->first('title')}}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-6">
                    <label for="author_id">Writers</label>
                      <select class="custom-select form-control js-selectize {{$errors->has('author_id') ? 'is-invalid' : ''}} " name="author_id" id="author_id">
                        <option>-- Choose Writers --</option>
                          @foreach ($authors as $author)
                            <option value="{{ $author->id }}" 

                            @if( $book->author_id == $author->id ) 
                              selected 
                            @endif>

                            {{ $author->name }}  

                            </option>
                          @endforeach
                      </select>
                    @if ($errors->has('author_id'))
                      <span class="invalid-feedback">
                        <strong>{{$errors->first('author_id')}}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-6">
                    <label for="ammount">Book Amount</label>
                    <input type="text" class="form-control {{$errors->has('ammount') ? 'is-invalid' : ''}}" id="ammount" name="ammount" placeholder="Book Amount" value="{{ $book->ammount }}" >


                    @if ($errors->has('ammount'))
                      <span class="invalid-feedback">
                        <strong>{{$errors->first('ammount')}}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <label for="cover">Book Cover</label>
                    <input type="file" class="form-control" id="cover" name="cover" >
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  @if ($book->cover)
                    <img src="{{ asset('cover/'. $book->cover) }}" height="200" class="img-rounded img-responsive">
                  @endif
                </div>

                <div class="form-group">
                  <div class="col-md-4 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">Save!</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
