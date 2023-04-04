@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
  <main class="form w-100 m-auto">

    <img src="{{ asset('img/logo.webp') }}" alt="School Logo" class="mb-4" width="72" height="72" />

    <div class="card text-start">
      <div class="card-body">
        <form action="" method="post">
          @csrf

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
                class="form-control form-control-sm"
                id="password"
                name="password"
                required
            />
          </div>

          <button class="w-100 btn btn-sm btn-primary" type="submit">Sign in</button>
        </form>
      </div>
    </div>

  </main>
@endsection
