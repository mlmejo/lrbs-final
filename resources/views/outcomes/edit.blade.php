@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('qualifications.edit', $competency->qualification) }}">
          {{ $competency->qualification->title }}
        </a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('qualifications.competencies.edit', [
            $competency->qualification, $competency]) }}">
          {{ $competency->title }}
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{ $outcome->objective }}
      </li>
    </ol>
  </nav>

  <div class="card mb-4">
    <div class="card-body">
      <h1 class="mb-3 h5">Update Learning Outcome</h1>

      <form action="{{ route('competencies.outcomes.update', [$competency, $outcome]) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mb-3 col-lg-6">
          <label for="objective" class="col-form-label-sm">Objective</label>
          <input type="text"
            name="objective"
            id="objective"
            class="form-control form-control-sm @error('objective') is-invalid @enderror"
            value="{{ $outcome->objective }}"
            required
          />
          @error('objective')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{ route(
              'qualifications.competencies.edit',
              [$competency->qualification, $competency]),
            }}"
            class="me-2 px-4 btn btn-sm btn-secondary"
          >
            Go back
          </a>
          <button type="submit" class="px-4 btn btn-sm btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h1 class="mb-3 h5">Tasks</h1>

      <a href="{{ route('outcomes.tasks.create', $outcome) }}"
        class="mb-2 btn btn-sm btn-primary"
      >

        Create Task
      </a>
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
            @if (!$tasks->count() > 0)
              <tr>
                <td colspan="4" class="text-center">No data available in table</td>
              </tr>
            @endif

            @foreach ($tasks->get() as $task)
              <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>
                  <a href="{{ route('outcomes.tasks.edit', [$outcome, $task]) }}"
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
      <h1 class="h5">Delete Learning Outcome</h1>

      <p>If you delete this learning outcome, all data related to it will be deleted as well.</p>

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
          Are you sure you want to delete "<strong>{{ $outcome->objective }}</strong>"?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{
              route('competencies.outcomes.destroy', [$competency, $outcome])
            }}"
            method="post"
          >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
