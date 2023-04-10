@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Qualifications</li>
    </ol>
  </nav>

  <a href="{{ route('qualifications.create') }}"
    class="mb-2 btn btn-sm btn-primary"
  >
    Add Qualification
  </a>

  <div class="table-responsive">
    <table class="datatable table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Duration</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($qualifications as $qualification)
          <tr>
            <td>{{ $qualification->id }}</td>
            <td>{{ $qualification->title }}</td>
            <td>{{ $qualification->duration }} hours</td>
            <td>
              <a href="{{ route('qualifications.edit', $qualification) }}"
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
