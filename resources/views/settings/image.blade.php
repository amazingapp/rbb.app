@extends('layouts.master')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-2 col-md-offset-1 user-nav">
               @include('settings.partials.tabs')
            </div>
            <div class="col-md-7 settings">
                @include('layouts.partials.errors')
                @include('layouts.partials.flash')
                <h3>Upload your image here</h3>
                    <p class="text">Your existing image will be replaced.</p>
                  <form action="/settings/picture" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input name="image" type="file"  accept="image/*" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                  </form>
            </div>
    </div>
</div>
@stop