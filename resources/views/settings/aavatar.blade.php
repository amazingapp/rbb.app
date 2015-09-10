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
                <h3>Upload your Aavatar here</h3>
                    <p class="text">Your existing avatar will be replaced.</p>
                  <form action="/settings/aavatar" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input name="aavatar" type="file"  accept="image/*" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                  </form>
            </div>
    </div>
</div>
@stop