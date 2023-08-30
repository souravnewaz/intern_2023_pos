@extends('layouts.auth')
@section('title', 'Registration | ')
@section('content')

<form style="width:480px" class="p-5 bg-white border shadow-sm rounded" method="post">
    @CSRF
    <center>
        <img class="mb-1" src="{{ asset('assets/images/icons/cart.png') }}" alt="icon">
        <h1 class="h3 mb-3 fw-normal">Sign up</h1>
    </center>
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" required>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Sign up</button>
    <p>Already registered here? <a href="/login">Login</a></p> 

    @include('flash-message')
</form>

@endsection