@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
               <div class="jumbotron splash">
                  <h2>
                      Welcome to Rastriya Banijya Bank Social App!
                  </h2>
                  <br />
                  <h4>
                      if you are a new user please go to <a href="/register">Register</a> or
                      <a href="/login">Login</a> if you are existing user.
                  </h4>
                  <br />
                    <hr />
                  <small class="text-muted">
                      Be advised that inorder to run you need to have at least Google Chrome Installed on your machine.
                      Because of JavaScript version that this app uses it may not support Internet Explorer < 8version.
                  </small>
               </div>
            </div>
        </div>
    </div>
@stop
