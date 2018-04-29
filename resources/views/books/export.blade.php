@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>

              <li class="breadcrumb-item active" aria-current="page">Export Book</li>
          </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Export Books
              
            </div>
            
            <div class="card-body">
              <form class="form-horizontal" action="{{ route('export.books.post') }}" method="post" enctype="multipart/form-data" target="blank">
                @csrf

                <div class="form-group">
                  <div class="col-md-6">


                    <label for="author_id">Writers</label>
                      
                      <select class="form-control {{$errors->has('author_id') ? 'is-invalid' : ''}} js-selectize" name="author_id[]" id="author_id" multiple autofocus placeholder="Choose Writers">
                          @foreach ($authors as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
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
                    <div class="radio">
                      <label for="type" class="form-label">Chosse Output
                        {{-- <div class="invalid-feedback">
                          {{$errors->has('type') ? 'required' : ''}}
                        </div> --}}
                      </label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="type" value="xls">Excel </label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="type" value="pdf"> PDF </label>
                    </div>
                  </div>
                    


                    @if ($errors->has('type'))
                      <span class="invalid-feedback">
                        <strong>{{$errors->first('type')}}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group">
                  <div class="col-md-4 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">Download!</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>


@endsection
