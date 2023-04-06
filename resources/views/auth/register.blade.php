@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
  <main class="form w-100 m-auto">

    <img src="{{ asset('img/logo.webp') }}" alt="Department Logo" class="mb-4" width="72" height="72" />

    <div class="card text-start">
      <div class="card-body">
        <form action="{{ route('register', ['role' => 'admin']) }}" method="post">
          @csrf

          <div class="mb-3">
            <label for="name" class="col-form-label-sm">Name</label>
            <input type="text"
              class="form-control form-control-sm @error('name') is-invalid @enderror"
              id="name"
              name="name"
              required
            />
            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="col-form-label-sm">Email address</label>
            <input type="email"
              class="form-control form-control-sm @error('email') is-invalid @enderror"
              id="email"
              name="email"
              required
            />
            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="col-form-label-sm">Password</label>
            <input type="password"
              class="form-control form-control-sm @error('password') is-invalid @enderror"
              id="password"
              name="password"
              required
            />
            @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="col-form-label-sm">Confirm Password</label>
            <input type="password"
                class="form-control form-control-sm"
                id="password_confirmation"
                name="password_confirmation"
                required
            />
          </div>

          <button class="w-100 btn btn-sm btn-primary" type="submit">Sign up</button>
        </form>
      </div>
    </div>

  </main>
@endsection
