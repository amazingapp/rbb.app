@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-5 col-md-offset-3" style="padding-top: 60px;">
            <div class="panel panel-default">
                <div class="panel-body login">
                    @include('layouts.partials.flash')
                    <form id="form" action="{{route('login')}}" method="POST">
                        {{csrf_field()}}
                    <div class="form-group">
                            <label for="employee_id">Employee ID</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{Input::old('employee_id')}}" />
                        </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                    <div class="form-group text-left">
                                <input id="remember" name="remember" type="checkbox">
                                <label for="remember"><strong>{{ trans('forms.remember_me') }}</strong></label>
                        </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> Sign In </button>
                        <a class="text-muted" href="/forgot">Forgot Password?</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop