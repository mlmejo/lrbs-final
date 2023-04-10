@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
  <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ url('/dashboard') }}">
      <img src="{{ asset('img/logo.webp') }}"
        alt="Department Logo"
        width="24"
        height="24"
        class="me-1 d-inline-block align-text-top"
      />
      Trainee
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu"
      aria-controls="sidebarMenu"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="w-100"></div>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap dropdown">
        <form action="{{ route('logout') }}" method="post" id="logout-form">
          @csrf
          @method('DELETE')
          <a href="#"
            class="nav-link dropdown-toggle px-3"
            role="button"
            data-bs-toggle="dropdown"
          >
            {{ auth()->user()->name }}
          </a>
          <ul class="position-absolute dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
              >
                Sign out
              </a>
            </li>
          </ul>
        </form>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                href="{{ url('/dashboard') }}"
              >
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase">
              Resultants
            </h6>
            <li class="nav-item">
              <a class="nav-link"
                href="{{ route('trainees.qualifications.index', request()->user()->trainee) }}"
              >
                <span data-feather="book" class="align-text-bottom"></span>
                Your LRBs
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    @yield('main')
  </main>
@endsection
