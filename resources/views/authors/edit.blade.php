@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

              <li class="breadcrumb-item"><a href="{{route('authors.index')}}">Writers</a></li>

              <li class="breadcrumb-item active" aria-current="page">Update Writers</li>
          </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Update Writers
            </div>
            
            <div class="card-body">
              <form class="form-horizontal" action="{{ route('authors.update', $author->id) }}" method="post">
                @csrf
                @method('PATCH')

                @include('authors._form')

                <div class="form-group">
                  <div class="col-md-4 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">Update!</button>
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
