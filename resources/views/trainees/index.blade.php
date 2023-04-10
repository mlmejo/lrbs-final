@extends('layouts.admin')

@section('main')
  <p class="mb-3 text-muted">Accounts Management</p>

  <ul class="nav nav-tabs mb-2">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="{{ route('trainees.index') }}">
        Trainees
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('trainers.index') }}">Trainers</a>
    </li>
  </ul>

  <a href="{{ route('trainees.create') }}" class="mb-2 btn btn-sm btn-primary">Create Trainee Account</a>

  <div class="table-responsive">
    <table class="datatable table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Program</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($trainees as $trainee)
          <tr>
            <td>{{ $trainee->id }}</td>
            <td>{{ $trainee->user->name }}</td>
            <td>{{ $trainee->user->email }}</td>
            <td>{{ $trainee->program->title }}</td>
            <td>
              <a href="{{ route('trainees.edit', $trainee) }}"
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
