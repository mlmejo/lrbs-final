@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">{{ $program->title }}</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <form action="{{ route('programs.update', $program) }}" method="post">
        <div class="mb-3 col-lg-6">
          <label for="title" class="col-form-label-sm">Title</label>
          <input type="text"
            name="title"
            id="title"
            class="form-control form-control-sm @error('title') is-invalid @enderror"
            value="{{ $program->title }}"
            required
          />
          @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{ route('programs.index') }}"
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

      <div class="d-inline-flex d-none flex-wrap mt-2" id="qualifications-list">
        @foreach ($program->qualifications as $qualification)
          <button class="qualification-button me-1 btn btn-sm btn-primary"
            data-id="{{ $qualification->id }}">
            {{ $qualification->title }}
            <span data-feather="x" class="align-text-bottom"></span>
          </button>
        @endforeach
      </div>

      <form id="qualifications-form">

        <div class="mb-3 col-lg-6">
          <label for="qualifications" class="col-form-label-sm">Qualifications</label>
          <select name="quallifications"
            id="qualifications"
            class="select2 form-select form-select-sm"
          >
            <option value="0" selected>Select Qualification</option>

            @foreach ($qualifications as $qualification)
              <option value="{{ $qualification->id }}">{{ $qualification->title }}</option>
            @endforeach
          </select>
          @error('qualifications')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{ route('programs.index') }}"
            class="me-2 px-4 btn btn-sm btn-secondary"
          >
            Go back
          </a>
          <button type="submit" class="px-4 btn btn-sm btn-primary">Submit</button>
        </div>

      </form>

    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h1 class="h5">Delete Program</h1>

      <p>If you delete this program, all data related to it will be deleted as well.</p>

      <button class="px-4 btn btn-sm btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#delete-modal"
      >
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
          Are you sure you want to delete <strong>{{ $program->title }}</strong>?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('programs.destroy', $program) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('js/programs.js') }}"></script>
@endpush
