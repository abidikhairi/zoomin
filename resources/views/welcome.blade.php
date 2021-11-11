@extends('layouts.app')

@section('body')
    <body class="horizontal light rtl ">
        <div class="wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
                <div class="container-fluid">
                    <a class="navbar-brand mx-lg-1 mr-0" href="{{ url('/') }}">
                        <svg id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                  <g>
                      <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                      <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                      <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                  </g>
                </svg>
                    </a>
                    <button class="navbar-toggler mt-2 mr-auto toggle-sidebar text-muted">
                        <i class="fe fe-menu navbar-toggler-icon"></i>
                    </button>
                    <div class="navbar-slide bg-white ml-lg-4 float-right">
                        <a href="#" class="btn toggle-sidebar d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                            <i class="fe fe-x"><span class="sr-only"></span></i>
                        </a>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a href="#" id="statsDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="ml-lg-2">Statistiques</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="statsDropdown">
                                    <a class="nav-link pl-lg-2" href="{{ route('stats.municipalities') }}"><span class="ml-1">Municipalities</span></a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="ml-lg-2">Claim</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" id="formsDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="ml-lg-2">Liens utiles</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="formsDropdown">
                                    <a class="nav-link pl-lg-2" href="./form_elements.html"><span class="ml-1">Basic Elements</span></a>
                                    <a class="nav-link pl-lg-2" href="./form_advanced.html"><span class="ml-1">Advanced Elements</span></a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <span class="ml-lg-2">A propos</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="navbar-nav">
                        @auth()
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ auth()->user()->account }}" >
                                    {{ __('Account') }}
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ url('/'.auth()->user()->roles->first()->name) }}" >
                                    {{ __('Logout') }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/login') }}" >
                                    {{ __('Login') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/register') }}" >
                                    {{ __('Register') }}
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
            <main role="main" class="main-content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <h2 class="h5 page-title">ZoomIn</h2>
                            <div id="public-map-app">
                            </div>
                        </div> <!-- .col-12 -->
                    </div> <!-- .row -->
                </div> <!-- .container-fluid -->
            </main> <!-- main -->
        </div> <!-- .wrapper -->
    </body>
@endsection
