@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route(
            'qualifications.edit',
            $learn_outcome->competency->qualification,) }}">
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
      <li class="breadcrumb-item active" aria-current="page">Add Task</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <h1 class="h5">Add Task</h1>
      <p>Learning Outcome: {{ $learn_outcome->objective }}</p>

      <form action="{{ route('learn_outcomes.tasks.store', $learn_outcome) }}" method="post">
        @csrf

        <div class="mb-3 col-lg-6">
          <label for="title" class="col-form-label-sm">Title</label>
          <input type="text"
            name="title"
            id="title"
            class="form-control form-control-sm @error('title') is-invalid @enderror"
            required
          />
          @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{
              route('competencies.learn_outcomes.edit', [$learn_outcome->competency, $learn_outcome])
            }}"
            class="me-2 px-4 btn btn-sm btn-secondary"
          >
            Go back
          </a>
          <button type="submit" class="px-4 btn btn-sm btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
@endsection
