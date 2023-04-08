@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">{{ $qualification->title }}</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <h1 class="mb-3 h5">Update Qualification</h1>

      <form action="{{ route('qualifications.update', $qualification) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mb-3 col-lg-6">
          <label for="title" class="col-form-label-sm">Title</label>
          <input type="text"
            name="title"
            id="title"
            class="form-control form-control-sm @error('title') is-invalid @enderror"
            required
            value="{{ $qualification->title }}"
          />
          @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="duration" class="col-form-label-sm">Duration</label>
          <input type="number"
            name="duration"
            id="duration"
            class="form-control form-control-sm"
            required
            value="{{ $qualification->duration }}"
          />
          @error('duration')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{ route('qualifications.index') }}"
            class="me-2 px-4 btn btn-sm btn-secondary"
          >
            Go back
          </a>
          <button type="submit" class="px-4 btn btn-sm btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h1 class="h5">Competencies</h1>

      <a href="{{ route('qualifications.competencies.create', $qualification) }}"
        class="mb-2 px-3 btn btn-sm btn-primary"
      >
        Add Competency
      </a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($qualification->competencies as $competency)
              <tr>
                <td>{{ $competency->id }}</td>
                <td>{{ $competency->title }}</td>
                <td>@php echo Str::title($competency->category); @endphp</td>
                <td>
                  <a href="{{ route('qualifications.competencies.edit', [$qualification, $competency]) }}"
                    class="action me-1 text-primary text-decoration-none">
                    Edit
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h1 class="h5">Delete Qualification</h1>

      <p>If you delete this qualification, all data related to it will be deleted as well.</p>

      <button class="px-4 btn btn-sm btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#delete-modal">
        Delete
      </button>
    </div>
  </div>

  <div class="modal fade"
    id="delete-modal"
    tabindex="-1"
    aria-labelledby="delete-modal-label"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="delete-modal-label">Confirm Deletion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          Are you sure you want to delete <strong>{{ $qualification->title }}</strong>?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('qualifications.destroy', $qualification) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection
