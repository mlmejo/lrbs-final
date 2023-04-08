@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('qualifications.edit', $learn_outcome->competency->qualification) }}">
          {{ $learn_outcome->competency->qualification->title }}
        </a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('qualifications.competencies.edit', [
            $learn_outcome->competency->qualification, $learn_outcome->competency]) }}">
          {{ $learn_outcome->competency->title }}
        </a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('competencies.learn_outcomes.edit', [
            $learn_outcome->competency, $learn_outcome]) }}">
          {{ $learn_outcome->objective }}
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{ $task->title }}
      </li>
    </ol>
  </nav>

  <div class="card mb-4">
    <div class="card-body">
      <h1 class="mb-3 h5">Update Task</h1>

      <form action="{{ route('learn_outcomes.tasks.update', [$learn_outcome, $task]) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mb-3 col-lg-6">
          <label for="title" class="col-form-label-sm">Title</label>
          <input type="text"
            name="title"
            id="title"
            class="form-control form-control-sm @error('title') is-invalid @enderror"
            value="{{ $task->title }}"
            required
          />
          @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{ route('competencies.learn_outcomes.edit', [$learn_outcome->competency, $learn_outcome]) }}"
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
      <h1 class="h5">Delete Task</h1>

      <p>If you delete this task, all data related to it will be deleted as well.</p>

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
          Are you sure you want to delete "<strong>{{ $task->title }}</strong>"?
        </div>

        <div class="modal-footer">
          <button type="button"
            class="btn btn-sm btn-secondary"
            data-bs-dismiss="modal"
          >
            Cancel
          </button>
          <form action="{{
              route('learn_outcomes.tasks.destroy', [$learn_outcome, $task])
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
