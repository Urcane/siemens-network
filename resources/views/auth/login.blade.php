@extends('layouts.app')

@section('content')
<style>
  /* 1) solid dark-blue behind your transparent PNG
     2) then your PNG on top, covering the entire area */
  .bg-image {
    background-color: #021b79; /* dark blue */
    background-image: url("{{ asset('siemens') }}/media/auth/bg-11.png");
    background-repeat: no-repeat;
    background-position: center bottom;
    background-size: cover;
  }

  /* Siemens teal accents */
  .btn-teal {
    background-color: #00a39d;
    border: none;
  }
  .btn-teal:hover {
    background-color: #008f89;
  }
  .text-teal {
    color: #00a39d !important;
  }
</style>
<div class="min-vh-100 d-flex align-items-center justify-content-center position-relative bg-image">
  <div class="card p-5 shadow rounded-lg p-20" style="max-width: 400px;">
    <div class="text-center mb-4">
      <h2 class="fw-bold text-teal mb-1 h-1">SIEMENS</h2>
      <p class="mb-0">Welcome to <strong>Intrusion Detection System</strong>!</p>
      <small class="text-muted">Please login here</small>
    </div>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <input
          type="email"
          name="email"
          class="form-control form-control-lg rounded-pill"
          placeholder="Email"
          value="{{ old('email') }}"
          required
          autofocus
        >
      </div>
      <div class="mb-3">
        <input
          type="password"
          name="password"
          class="form-control form-control-lg rounded-pill"
          placeholder="Password"
          required
        >
      </div>
      <div class="form-check mb-4">
        <input
          class="form-check-input"
          type="checkbox"
          name="remember"
          id="remember"
          {{ old('remember') ? 'checked' : '' }}
        >
        <label class="form-check-label" for="remember">
          Remember me
        </label>
      </div>
      <button type="submit" class="btn btn-teal btn-lg w-100 rounded-pill">
        Login
      </button>
    </form>
    <p class="text-center text-muted mt-3 mb-0">
      Forget Password?
      <a href="{{ route('password.request') }}" class="text-teal">Reset Password</a>
    </p>
  </div>
</div>
@endsection