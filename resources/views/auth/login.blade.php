@extends('layouts.auth')
@section('title', 'Signin | ')
@section('content')

<form style="width:480px" class="p-5 bg-white border shadow-sm rounded" method="POST">
@CSRF
    <center>
        <img class="mb-1" src="{{ asset('assets/images/icons/cart.png') }}" alt="icon">
        <h1 class="h3 mb-3 fw-normal">Sign in</h1>
    </center>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remembercheck" name="remember">
        <label class="form-check-label" for="remembercheck">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Sign in</button>
    <p>New here? <a href="/register">Signup</a></p> 

    @include('flash-message')
</form>

@endsection