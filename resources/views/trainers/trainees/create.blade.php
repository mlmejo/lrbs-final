@extends('layouts.trainer')

@section('main')
  <p class="text-muted">Create Learner's Record Book</p>

  <div class="card">
    <div class="card-body">
      <form action="{{ route('trainers.trainees.store', request()->user()->trainer) }}"
        method="post">
        @csrf

        <div class="mb-3 col-lg-6">
          <label for="program_id" class="col-form-label-sm">Program</label>
          <select name="program_id"
            id="program_id"
            class="select2 form-select form-select-sm"
          >
            <option value="0" selected>Select Program</option>
            @foreach ($programs as $program)
              <option value="{{ $program->id }}">{{ $program->title }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3 col-lg-6">
          <label for="qualification_id" class="col-form-label-sm">Qualification</label>
          <select name="qualification_id"
            id="qualification_id"
            class="select2 form-select form-select-sm"
          >
            <option value="0" selected>Select Qualification</option>
          </select>
          @error('qualification_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3 col-lg-6">
          <label for="trainee_id" class="col-form-label-sm">Trainees</label>
          <select name="trainee_id"
            id="trainee_id"
            class="select2 form-select form-select-sm"
          >
            <option value="0" selected>Select Trainee</option>
            @foreach ($trainees as $trainee)
              <option value="{{ $trainee->id }}">{{ $trainee->user->name }}</option>
            @endforeach
          </select>
          @error('trainee_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-flex">
          <a href="{{ route('trainers.trainees.index', request()->user()->trainer) }}"
            class="me-2 px-4 btn btn-sm btn-secondary"
          >
            Go back
          </a>
          <button class="px-4 btn btn-sm btn-primary" type="submit">Create LRB</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      $('#program_id').on('change', function() {
        const program = $(this).val();
        const $qualifications = $('#qualification_id');

        $.ajax({
          url: `http://localhost:8000/programs/${program}/qualifications`,
          dataType: 'json',
          success: function(data) {
            const options = data.qualifications.map(function(item) {
              return { id: item.id, text: item.title }
            });

            if (options.length === 0) {
              $qualifications.empty().select2({
                data: [
                  {
                    id: 0,
                    text: 'Select Qualification',
                  }
                ],
                theme: 'bootstrap-5',
                width: $( this )
                  .data( 'width' ) ? $( this )
                  .data( 'width' ) : $( this )
                  .hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                closeOnSelect: true,
                selectOnClose: true,
                selectionCssClass: 'select2--small',
                dropdownCssClass: 'select2--small',
              });
              return;
            }

            $qualifications.empty().select2({
              data: options,
              theme: 'bootstrap-5',
              width: $( this )
                .data( 'width' ) ? $( this )
                .data( 'width' ) : $( this )
                .hasClass( 'w-100' ) ? '100%' : 'style',
              placeholder: $( this ).data( 'placeholder' ),
              closeOnSelect: true,
              selectOnClose: true,
              selectionCssClass: 'select2--small',
              dropdownCssClass: 'select2--small',
            });
          }
        })
      });
    });
  </script>
@endpush
