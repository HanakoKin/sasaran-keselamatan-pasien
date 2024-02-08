@extends('entry.main')

@section('container')

<div class="d-flex justify-content-center align-items-center vh-100">
    <form action="/register" method="POST" class="form-register">
        @csrf

        <img class="mb-4" src="{{ asset('assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please register</h1>

        <div class="form-floating mb-2 w-100">
            <input type="text" class="form-control" id="registerUsername" name="username" placeholder="username">
            <label for="registerUsername">Username</label>
        </div>
        <div class="form-floating mb-2">
            <input type="text" class="form-control" id="registerName" name="nama" placeholder="yourname">
            <label for="registerName">Name</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Password">
            <label for="registerPassword">Password</label>
        </div>
        <div class="form-floating mb-2">
            <input type="text" class="form-control" id="registerRole" name="role" placeholder="Role">
            <label for="registerRole">Role</label>
        </div>

        <div class="text-center py-2">
            <button class="btn btn-primary w-50 py-2" type="submit">Register</button>
            <p class="py-3">Already have an yet? Please <a href="/login"
                    class="text-decoration-none text-primary">LOGIN</a>
            </p>
        </div>
    </form>
</div>

@endsection
