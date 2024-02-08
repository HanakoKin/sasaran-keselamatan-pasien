@extends('entry.main')

@section('container')

<div class="col d-flex flex-column justify-content-center align-items-center vh-100">

    @if (session()->has('status'))
    <div class="alert alert-success alert-dismissible fade show notif" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show notif" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <form action="/login" method="POST" class="form-signin">
        @csrf

        <img class="mb-4" src="{{ asset('assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating mb-2">
            <input type="text" class="form-control" id="loginNameInput" name="username" placeholder="username">
            <label for="loginNameInput">Username</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control" id="loginPasswordInput" name="password" placeholder="Password">
            <label for="loginPasswordInput">Password</label>
        </div>

        <div class="text-center py-2">
            <button type="submit" class="btn btn-primary w-50 py-2">Sign In</button>
            <p class="py-3">Don't have an account yet? Please <a href="/register"
                    class="text-decoration-none text-primary">REGISTER</a>
            </p>
        </div>
    </form>

</div>

@endsection
