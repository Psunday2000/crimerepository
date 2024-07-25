@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            <h4>{{config('app.name')}}</h4>
        </div>
        <div class="row justify-content-around">
            <!-- Crime Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Login</h5>
                        <p class="card-text">Sign in</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>

            <!-- Case Files Card -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Register</h5>
                        <p class="card-text">Create account to gain access</p>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
