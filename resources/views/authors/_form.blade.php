<div class="form-group">
  <div class="col-md-4">
    <label for="name">Name</label>
    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="@if (Route::is('authors.edit')) {{ $author->name }} @else {{ old('name') }} 
    @endif" autofocus>


    @if ($errors->has('name'))
      <span class="invalid-feedback">
        <strong>{{$errors->first('name')}}</strong>
      </span>
    @endif
  </div>
</div>