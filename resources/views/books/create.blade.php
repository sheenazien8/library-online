@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>

              <li class="breadcrumb-item active" aria-current="page">Add Book</li>
          </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Add Books
              
            </div>
            
            <div class="card-body">

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a href="#input" class="nav-link active" id="input-tab" role="tab" aria-control="input" data-toggle="tab" aria-selected="true">Input</a>
                </li>

                <li class="nav-item">
                  <a href="#upload" class="nav-link" id="upload-tab" role="tab" aria-control="upload" data-toggle="tab" aria-selected="false">Upload</a>
                </li>
                
              </ul>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="input" role="tabpanel" aria-labelledy="input-tab">
                  <form class="form-horizontal" action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                     <div class="form-group">
                      <div class="col-md-6">
                        <label for="title">Book Title</label>
                        <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="title" name="title" value="{{ old('title') }}" placeholder="Book Title"  autofocus>


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
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
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
                        <input type="text" class="form-control {{$errors->has('ammount') ? 'is-invalid' : ''}}" id="ammount" name="ammount" placeholder="Book Amount" value="{{ old('ammount') }}" autofocus>


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
                        <input type="file" class="form-control" id="cover" name="cover" value="" autofocus>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-4 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">Save!</button>
                      </div>
                    </div>
                  </form>

                </div>

                <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledy="upload-tab">
                  <form class="" action="{{ route('import.books.excel') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('books._import')
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
</div>


@endsection
