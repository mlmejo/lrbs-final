@extends('layouts.trainee')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">{{ request()->user()->name }}</li>
    </ol>
  </nav>

  <div class="table-responsive">
    <table class="datatable table table-bordered table-striped">
      <thead>
        <tr>
          <th>Qualification</th>
          <th>Progress</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($registrations as $registration)
          <tr>
            <td>{{ $registration->qualification->title }}</td>
            <td>
              <a href="{{ route('remarks.show',
                  ['registration' => $registration->id]) }}"
                class="action text-decoration-none"
              >
                View
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
