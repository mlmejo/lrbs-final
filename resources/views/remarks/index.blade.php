@extends('layouts.trainer')

@section('main')
  <p class="mb-3 text-muted">Qualification: {{ $registration->qualification->title }}</p>

  <a href="{{ route('print', [
      'registration' => $registration->id]) }}"
    class="mb-3 px-4 btn btn-sm btn-primary"
  >
    Print
  </a>

  @if ($basic_competencies->count() > 0)
    <h5>Basic Competencies</h5>
  @endif

  @foreach ($basic_competencies as $competency)
    <h6>{{ $competency->title }}</h6>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Learning Outcome</th>
            <th>Tasks</th>
            <th>Remark</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($competency->learn_outcomes as $learn_outcome)
            <tr>
              <td>{{ $learn_outcome->objective }}</td>
              <td>
                <ul>
                  @foreach ($learn_outcome->tasks as $task)
                    <li>{{ $task->title }}</li>
                  @endforeach
                </ul>
              </td>
              <td>
                {{ $registration->remarks()
                  ->where('learn_outcome_id', $learn_outcome->id)
                  ->first()
                  ->content
                }}
              </td>
              <td>
                <a href="{{ route('remarks.create', [
                    'registration' => $registration->id, 'learn_outcome' => $learn_outcome->id])
                  }}"
                  class="action text-decoration-none">
                  Add/Edit Remark
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach

  @if ($common_competencies->count() > 0)
  <h5>Common Competencies</h5>
  @endif

  @foreach ($common_competencies as $competency)
    <h6>{{ $competency->title }}</h6>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Learning Outcome</th>
            <th>Remark</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($competency->learn_outcomes as $learn_outcome)
            <tr>
              <td>{{ $learn_outcome->objective }}</td>
              <td>
                {{ $registration->remarks()
                  ->where('learn_outcome_id', $learn_outcome->id)
                  ->first()
                  ->content
                }}
              </td>
              <td>
                <a href="{{ route('remarks.create', [
                    'registration' => $registration->id, 'learn_outcome' => $learn_outcome->id])
                  }}"
                  class="action text-decoration-none">
                  Add/Edit Remark
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach

  @if ($core_competencies->count() > 0)
    <h5>Core Competencies</h5>
  @endif

  @foreach ($core_competencies as $competency)
    <h6>{{ $competency->title }}</h6>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Learning Outcome</th>
            <th>Remark</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($competency->learn_outcomes as $learn_outcome)
            <tr>
              <td>{{ $learn_outcome->objective }}</td>
              <td>
                {{ $registration->remarks()
                  ->where('learn_outcome_id', $learn_outcome->id)
                  ->first()
                  ->content
                }}
              </td>
              <td>
                <a href="{{ route('remarks.create', [
                    'registration' => $registration->id, 'learn_outcome' => $learn_outcome->id])
                  }}"
                  class="action text-decoration-none">
                  Add/Edit Remark
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach
@endsection
