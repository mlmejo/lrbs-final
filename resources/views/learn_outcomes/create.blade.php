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
        <a href="{{ route('qualifications.competencies.edit',
          [$competency->qualification, $competency]) }}">
          {{ $competency->title }}
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Add Learning Outcome</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <h1 class="h5">Add Learning Outcome</h1>
      <p>Unit of Competency: {{ $competency->title }}</p>

      <form action="{{ route('competencies.learn_outcomes.store', $competency) }}" method="post">
        @csrf

        <div class="mb-3 col-lg-6">
          <label for="objective" class="col-form-label-sm">Objective</label>
          <input type="text"
            name="objective"
            id="objective"
            class="form-control form-control-sm @error('objective') is-invalid @enderror"
            required
          />
          @error('objective')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{
              route('qualifications.competencies.edit', [$competency->qualification, $competency])
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
