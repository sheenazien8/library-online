@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('members.index')}}">Members</a></li>
              <li class="breadcrumb-item active" aria-current="page">Show Member</li>
            </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Member <strong>{{ $member->name }}</strong>
            </div>

            <div class="card-body">
              <p>Buku yang sedang di pinjam:<p>
              <table class="table table-stripped table-condensed">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Date Borrowed</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($member->borrowLogs()->borrowed()->get() as $log)
                    <tr>
                      <td>{{ $log->book->title }}</td>
                      <td>{{ $log->created_at->format('d-m-Y')}}</td>
                    </tr>
                  @empty

                    <tr>
                      <td colspan="2" class="alert alert-warning text-center"> No Data. </td>
                    </tr>

                  @endforelse
                </tbody>
              </table>
              <div class="card-body">
              <p>Buku yang sudah di kembalikan:<p>
              <table class="table table-stripped table-condensed">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Date Returned</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($member->borrowLogs()->returned()->get() as $log)
                    <tr>
                      <td>{{ $log->book->title }}</td>
                      <td>{{ $log->updated_at->format('d-m-Y')}}</td>
                    </tr>
                  @empty

                    <tr>
                      <td colspan="2" class="alert alert-warning text-center"> No Data. </td>
                    </tr>

                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection