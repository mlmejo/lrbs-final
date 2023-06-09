@extends('layouts.trainer')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Trainees</li>
    </ol>
  </nav>

  <a href="{{ route('trainers.trainees.create', request()->user()->trainer) }}"
    class="mb-2 px-3 btn btn-sm btn-primary"
  >
    Create LRB
  </a>

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
              <a href="{{ route('trainers.trainees.edit', [
                  request()->user()->trainer, $trainee]) }}"
                class="action text-decoration-none">
                View LRBs
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
