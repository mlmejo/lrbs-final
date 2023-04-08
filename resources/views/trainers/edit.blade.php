@extends('layouts.admin')

@section('main')
  <div class="card">
    <div class="card-body">
      <h1 class="mb-3 h5">Profile Information</h1>

      <form action="{{ route('trainers.store') }}" method="post">
        @csrf

        <div class="mb-3 col-lg-6">
          <label for="name" class="col-form-label-sm">Name</label>
          <input type="text"
            class="form-control form-control-sm @error('name') is-invalid @enderror"
            id="name"
            name="name"
            value="{{ $trainer->user->name }}"
            required
          />
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="email" class="col-form-label-sm">Email address</label>
          <input type="email"
            class="form-control form-control-sm @error('email') is-invalid @enderror"
            id="email"
            name="email"
            required
            value="{{ $trainer->user->email }}"
          />
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{ route('trainers.index') }}" class="me-2 px-4 btn btn-sm btn-secondary">Go back</a>
          <button class="px-4 btn btn-sm btn-primary" type="submit">Create Trainer Account</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h1 class="h5">Delete Account</h1>
      <div class="col-lg-6 mb-3">
        <p>
          Deleting your account will result in permanent loss of all your
          account information, settings, and preferences. Please note
          that this action cannot be undone.
        </p>
      </div>

      <button class="px-4 btn btn-sm btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#delete-modal"
      >
        Delete
      </button>
    </div>
  </div>

  <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="delete-modal-label">Confirm Deletion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete "<strong>{{ $trainer->user->name }}</strong>"?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Delete</button>
        </div>
      </div>
    </div>
  </div>
@endsection
