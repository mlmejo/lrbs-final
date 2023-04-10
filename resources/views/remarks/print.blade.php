@php
  use Carbon\Carbon;
@endphp

@extends('layouts.app')

@push('styles')
  <style>
    @media print {
      .col-lg-6 {
        page-break-inside: avoid;
      }

      .pagebreak {
        page-break-after: always;
      }
    }
  </style>
@endpush

@section('content')
  <div class="container-fluid p-3">

    <div class="row">
      <div class="col-lg-6 text-center">
        <div class="d-flex flex-column justify-content-center">
          <div class="d-flex align-items-center">
            <img src="{{ asset('img/smcc.webp') }}" alt="SMCC Logo" width="38" height="38" />
            <div class="ms-2 text-center">
              <p class="mb-0 fw-bold">Saint Michael College of Caraga</p>
              <p>Atupan St., Nasipit, Agusan del Norte</p>
            </div>
          </div>

          <h2>Learner's Record Book</h2>

          <div>
            <img src="" alt="" width="64" height="64">
          </div>

          <p>Trainee's No.:</p>

          <div class="d-flex flex-column mx-auto text-start">
            <p class="mb-2">Name: {{ $registration->trainee->user->name }}</p>
            <p class="mb-2">Qualification: {{ $registration->qualification->title }}</p>
            <p class="mb-2">Duration: {{ $registration->qualification->duration }} hours</p>
            <p class="mb-2">Trainer: {{ $registration->trainer->user->name }}</p>
          </div>
        </div>
      </div>

      <div class="col-lg-6 d-flex justify-content-center">
        <p>
        Instructions:<br>
        This Learner's Record Book (LRB) is intended to serve as record of al accomplishment/task/activities while undergoing training in the industry. It will eventually become evidence that can be submitted for portfolio assessment and for whatever purpose it will serve you. It is therefore important that all its contents are viably entered by both the trainees and instructor.
        <br>
        The Learner's Record Book contains all the required competencies in your chosen qualification. All you have to do is to fill in the column "Task Required" and "Date Accomplished" with all the activities in accordance with the training program and to be taken up in the school and with the guidance of the instructor. The instructor will likewise indicate his/her remarks on the "Trainer's Remarks" column regarding the outcome of the task accomplished by the trainees. Be sure that the trainee will personally accomplish the task and confirmed by the instructor.
        <br>
        It is of great importance that the content should be writter legibly on ink. Avoid any corrections or erasures and maintain cleanliness of this record.
        This will be collected by your trainer and submit the same to the Voicational Instruction Trainer (VIT) and shall from part of the permanent trainee's document on file.
        <br>
        THANKYOU
        </p>
      </div>
  </div>

    <div class="row"></div>
      <div class="col-lg-6">
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
                  <th>Date Accomplished</th>
                  <th>Remark</th>
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
                      {{ Carbon::parse($registration->remarks()
                        ->where('learn_outcome_id', $learn_outcome->id)
                        ->first()
                        ->created_at)->format('F j, Y') }}
                    </td>
                    <td>
                      {{ $registration->remarks()
                        ->where('learn_outcome_id', $learn_outcome->id)
                        ->first()
                        ->content
                      }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endforeach
      </div>

      <div class="col-lg-6">
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
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endforeach
      </div>

      <div class="col-lg-6">
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
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
