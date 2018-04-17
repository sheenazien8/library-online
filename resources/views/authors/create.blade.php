@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

              <li class="breadcrumb-item"><a href="{{route('authors.index')}}">Writers</a></li>

              <li class="breadcrumb-item active" aria-current="page">Add Writers</li>
          </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Add Writers
              <a href="{{ route('authors.create') }}" class="btn btn-primary float-right">+ Add</a>
            </div>
            
            <div class="card-body">
              <form class="form-horizontal" action="{{ route('authors.store') }}" method="post">
                @csrf

                <div class="form-group">
                  <div class="col-md-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="Writer Name" value="{{old('name')}}" autofocus>
                    @if ($errors->has('name'))
                      <span class="invalid-feedback">
                        <strong>{{$errors->first('name')}}</strong>
                      </span>
                    @endif
                  </div>
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
