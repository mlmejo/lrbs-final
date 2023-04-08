@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Programs</li>
    </ol>
  </nav>

  <a href="{{ route('programs.create') }}" class="mb-2 btn btn-sm btn-primary">Add Program</a>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($programs as $program)
          <tr>
            <td>{{ $program->id }}</td>
            <td>{{ $program->title }}</td>
            <td>
              <a href="{{ route('programs.edit', $program) }}"
                class="action me-1 text-primary text-decoration-none">
                Edit
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
