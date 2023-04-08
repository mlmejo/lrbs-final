@extends('layouts.admin')

@section('main')
  <p class="text-muted">Create Trainer Account</p>

  <div class="card">
    <div class="card-body">
      <form action="{{ route('trainers.store') }}" method="post">
        @csrf

        <div class="mb-3 col-lg-6">
          <label for="name" class="col-form-label-sm">Name</label>
          <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" required />
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="email" class="col-form-label-sm">Email address</label>
          <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" required />
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="password" class="col-form-label-sm">Password</label>
          <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" required />
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="password_confirmation" class="col-form-label-sm">Confirm Password</label>
          <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" required />
        </div>

        <div class="d-flex">
          <a href="{{ route('trainers.index') }}" class="me-2 px-4 btn btn-sm btn-secondary">Go back</a>
          <button class="px-4 btn btn-sm btn-primary" type="submit">Create Trainer Account</button>
        </div>
      </form>
    </div>
  </div>
@endsection
