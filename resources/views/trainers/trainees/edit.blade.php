@php
  use Carbon\Carbon;
@endphp

@extends('layouts.trainer')

@section('main')
  <p class="text-muted">View Learner's Record Books</p>

  <div class="card">
    <div class="card-body">
      <p class="text-muted">Trainee: {{ $trainee->user->name }}</p>
      <p class="text-muted">Program: {{ $trainee->program->title }}</p>

        <div class="table-responsive">
          <table class="datatable table table-bordered table-striped">
            <thead>
              <tr>
                <th>Qualification</th>
                <th>Date added</th>
                <th>Progress</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($trainee->registrations as $registration)
                <tr>
                  <td>{{ $registration->qualification->title }}</td>
                  <td>{{ Carbon::parse($registration->created_at)->format('F j, Y') }}</td>
                  <td>
                    <a href="{{ route('remarks.index', [
                        'registration' => $registration->id]) }}"
                      class="action text-decoration-none"
                    >
                      View
                    </a>
                  </td>
                  <td>
                    <a href="#" role="button" class="action text-decoration-none text-danger"
                      data-bs-toggle="modal"
                      data-bs-target="#remove-{{ $registration->id }}-modal"
                    >
                      Remove
                    </a>
                  </td>
                </tr>

                <div class="modal fade"
                  id="remove-{{ $registration->id }}-modal"
                  tabindex="-1"
                  aria-labelledby="remove-{{ $registration->id }}-modal-label"
                  aria-hidden="true"
                >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="remove-{{ $registration->id }}-modal-label">Confirm Removal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to remove
                        "<strong>{{ $registration->qualification->title }}</strong>"?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-sm btn-primary">Confirm</button>
                      </div>
                    </div>
                  </div>
                </div>

              @endforeach
            </tbody>
          </table>
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
