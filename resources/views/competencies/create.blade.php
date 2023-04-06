@extends('layouts.admin')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('qualifications.edit', $qualification) }}">
          {{ $qualification->title }}
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Add Competency</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <h1 class="h5">Add Competency</h1>
      <p>Qualification: {{ $qualification->title }}</p>

      <form action="{{ route('qualifications.competencies.store', $qualification) }}" method="post">
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

        <div class="mb-3 col-lg-6">
          <label for="category" class="col-form-label-sm">Category</label>
          <select name="category"
            id="category"
            class="form-select form-select-sm @error('category') is-invalid @enderror"
          >
            <option value="">Select Category</option>
            <option value="basic">Basic Competency</option>
            <option value="common">Common Competency</option>
            <option value="core">Core Competency</option>
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
          <button type="submit" class="px-4 btn btn-sm btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
@endsection
