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
                <form method="POST" action="/settings/change_password" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="PUT">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
    </div>
</div>
@stop