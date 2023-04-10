@extends('layouts.trainer')

@section('main')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">{{ $registration->trainee->user->name }}</a>
      </li>
      <li class="breadcrumb-item">
        <a href="#">{{ $learn_outcome->objective }}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Add/Edit Remark</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-body">
      <form action="{{ route('remarks.store', [
          'registration' => $registration, 'learn_outcome' => $learn_outcome]) }}"
        method="post">
        @csrf

        <div class="mb-3 col-lg-6">
          <label for="content" class="col-form-label-sm">Training Remarks</label>
          <textarea name="content"
            id="content"
            cols="30"
            rows="10"
            class="form-control form-control-sm">@if ($remark !== null) {{ $remark->content }} @endif</textarea>

          @error('content')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="#"
            class="me-2 px-4 btn btn-sm btn-secondary"
          >
            Go back
          </a>
          <button type="submit" class="px-4 btn btn-sm btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection
