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
                <form method="POST" action="/settings/profile" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="PUT">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="employee_id">User ID</label>
                        <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{old('employee_id')?:$user->employee_id}}"/>
                    </div>
                    <div class="form-group">
                        <label for="name">Fullname</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')?:$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')?:$user->email}}"/>
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" value="{{old('designation')?:$user->designation}}"/>
                    </div>
                    <div class="form-group">
                        <label for="current_branch">Current Branch</label>
                        <input type="text" class="form-control" id="current_branch" name="current_branch" value="{{old('current_branch')?:$user->current_branch}}"/>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="{{old('dob')?:$user->dob}}"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
    </div>
</div>
@stop