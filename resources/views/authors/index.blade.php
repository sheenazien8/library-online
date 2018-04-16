@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Writers</li>
            </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Writers
            </div>

            <div class="card-body">
              {{-- cara biasa
              <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Writers Name</th>
                </tr>
                @foreach ($authors as $key => $author)
                  <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$author->name}}</td>
                  </tr>
                @endforeach
              </table>--}}

              <!-- cara dataTables -->
              {!! $html->table((['class' => 'table-striped'])) !!}
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
  {!! $html->scripts() !!}
@endsection
