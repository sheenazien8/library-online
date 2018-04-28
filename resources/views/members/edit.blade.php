@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('members.index')}}">Members</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Member</li>
            </ol>
          </nav>
          <div class="card">
            <div class="card-header">
             Edit Member
            </div>

            <div class="card-body">
            <form action="{{ route('members.update', $member->id) }}" method="post">
            @csrf
            @method('PATCH')
              <div class="form-group-row">
                <label for="name" class="col-sm-4 col-form-label-md-right">Nama</label>

                  <div class="col-md-6">
                    <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is_invalid' : '' }}" value="{{ $member->name }}" >

                    @if ($errors->has('name'))
                      <span class="invalied-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group-row">
                  <label for="email" class="col-sm-4 col-form-label-md-right">Email</label>

                    <div class="col-md-6">
                      <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is_invalid' : '' }}" value="{{ $member->email }}">

                      @if ($errors->has('email'))
                        <span class="invalied-feedback">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group-row">
                    <div class="col-sm-4"></div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>


                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection