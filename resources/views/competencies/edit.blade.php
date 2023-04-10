@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('qualifications.edit', $qualification) }}">
          {{ $qualification->title }}
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">{{ $competency->title }}</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <h1 class="h5">Update Competency</h1>
      <p>Qualification: {{ $qualification->title }}</p>

      <form action="{{ route('qualifications.competencies.update', [$qualification, $competency]) }}"
        method="post"
      >
        @csrf
        @method('PATCH')

        <div class="mb-3 col-lg-6">
          <label for="title" class="col-form-label-sm">Title</label>
          <input type="text"
            name="title"
            id="title"
            class="form-control form-control-sm @error('title') is-invalid @enderror"
            required
            value="{{ $competency->title }}"
          />
          @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="category" class="col-form-label-sm">Category</label>
          <select name="category"
            id="category"
            class="form-select form-select-sm @error('category') is-invalid @enderror"
          >
            <option value="">Select Category</option>
            @foreach (['basic', 'common', 'core'] as $category)
              @if ($category == $competency->category)
                <option value="{{ $competency->category }}" selected>
                  @php
                    echo Str::title($competency->category) . ' Competency';
                  @endphp
                </option>
              @else
                <option value="{{ $category }}">
                  @php
                    echo Str::title($category) . ' Competency';
                  @endphp
                </option>
              @endif
            @endforeach
          </select>
          @error('category')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{ route('qualifications.edit', $qualification) }}"
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
      <h1 class="mb-3 h5">Learning Outcomes</h1>

      <a href="{{ route('competencies.learn_outcomes.create', $competency) }}"
        class="mb-2 btn btn-sm btn-primary"
      >

        Add Learning Outcome
      </a>
      <div class="table-responsive">
        <table class="datatable table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Objective</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($competency->learn_outcomes as $learn_outcome)
              <tr>
                <td>{{ $learn_outcome->id }}</td>
                <td>{{ $learn_outcome->objective }}</td>
                <td>
                  <a href="{{ route('competencies.learn_outcomes.edit', [$competency, $learn_outcome]) }}"
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
      <h1 class="h5">Delete Competency</h1>

      <p>If you delete this competency, all data related to it will be deleted as well.</p>

      <button class="px-4 btn btn-sm btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#deleteModal"
      >
        Delete
      </button>
    </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Deletion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          Are you sure you want to delete "<strong>{{ $competency->title }}</strong>"?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('qualifications.competencies.destroy', [$qualification, $competency]) }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection
