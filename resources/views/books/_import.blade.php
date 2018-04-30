<div class="form-group-row">
  <label class="col-sm-4 col-form-label-md-right">Gunakan template terbaru</label>

    <div class="col-md-6">
      <a href="{{ route('template.books') }}" class="btn btn-xs btn-success">Download</a>
    </div>
  </div>

  <div class="form-group-row">
    <label for="file" class="col-sm-4 col-form-label-md-right">Pilih File</label>

      <div class="col-md-6">
        <input type="file" id="excel" name="excel" class="form-control {{ $errors->has('excel') ? 'is-invalid' : '' }}" value="{{ old('excel') }}">

        @if ($errors->has('excel'))
          <span class="invalid-feedback"> 
            <strong>{{ $errors->first('excel') }}</strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group-row">
      <div class="col-md-4"></div>
      <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>


  </form>
</div>