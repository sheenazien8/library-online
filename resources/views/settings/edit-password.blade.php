@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Password</li>
            </ol>
          </nav>
          <div class="card">
            <div class="card-header">
              Edit Profile
            </div>

            <div class="card-body">
            <form action="{{ route('password.update') }}" method="post">
            @csrf
              <div class="form-group-row">
                <label for="password" class="col-sm-4 col-form-label-md-right">Old Password</label>

                  <div class="col-md-6">
                    <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is_invalid' : '' }}">

                    @if ($errors->has('password'))
                      <span class="invalied-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group-row">
                  <label for="new_password" class="col-sm-4 col-form-label-md-right">New Password</label>

                    <div class="col-md-6">
                      <input type="password" id="new_password" name="new_password" class="form-control {{ $errors->has('new_password') ? 'is_invalid' : '' }}">

                      @if ($errors->has('new_password'))
                        <span class="invalied-feedback">
                          <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group-row">
                  <label for="new_password_confirmation" class="col-sm-4 col-form-label-md-right">New Password Confirmation</label>
                    <div class="col-md-6">
                      <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control {{ $errors->has('new_password_confirmation') ? 'is_invalid' : '' }}">

                      @if ($errors->has('new_password_confirmation'))
                        <span class="invalied-feedback">
                          <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group-row">
                    <div class="col-sm-4"></div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary">Update</button>
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