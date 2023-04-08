@extends('layouts.admin')

@section('main')
  <p class="mb-3 text-muted">Accounts Management</p>

  <ul class="nav nav-tabs mb-2">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('trainees.index') }}">
        Trainees
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link active"
        aria-current="page"
        href="{{ route('trainers.index') }}"
      >
        Trainers
      </a>
    </li>
  </ul>

  <a href="{{ route('trainers.create') }}"
    class="mb-2 btn btn-sm btn-primary"
  >
    Create Trainer Account
  </a>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($trainers as $trainer)
          <tr>
            <td>{{ $trainer->id }}</td>
            <td>{{ $trainer->user->name }}</td>
            <td>{{ $trainer->user->email }}</td>
            <td>
              <a href="{{ route('trainers.edit', $trainer) }}"
                class="action text-decoration-none">
                Edit
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
