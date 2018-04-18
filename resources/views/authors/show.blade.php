@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>

              <li class="breadcrumb-item"><a href="{{route('authors.index')}}">Writers</a></li>

              <li class="breadcrumb-item active" aria-current="page">Data Writer</a></li>

          </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Data Writer
            </div>
            
            <div class="card-body">
              Name: <strong>{{ $author->name }}</strong>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
