@extends('layouts.app')

@section('content')
@Auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
                    <h1> Logged in</h1>
                </div>
            </div>
        </div>
    </div>
@else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
                    <h1> Not logged in</h1>
                </div>
            </div>
        </div>
    </div>
@endAuth
@endsection
