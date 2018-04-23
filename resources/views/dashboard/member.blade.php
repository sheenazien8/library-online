@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
          <div class="text-center"> 
          Welcome <strong>{{ Auth::user()->name }} !! </strong>
          </div>
          @if ($borrowLogs->count() == 0 )
            <div class="text-center"> Tidak     ada buku yang kamu pinjam
            </div>
          @endif

          @if ($borrowLogs->count() > 0)
            <h5>Buku Yang anda Pinjam</h5>
            @foreach ($borrowLogs as $log)
              <div>
                  <table class="table">
                    <tr>
                      <td>
                      <label for="email">
                        {{ $log->book->title }}
                      </label>
                      </td>
                    
                      <td>
                        <form class="form-inline js-confirm float-right" action="{{ route('member.books.return', $log->book->id) }}" method="POST" data-confirm="Apakah anda yakin ingin mengembalikan buku {{ $log->book->title }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-primary " type="submit">Return It</button>
                      </td>
                    </tr>

                    </form>
                  </table>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection