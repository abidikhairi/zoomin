@extends('layouts.app')

@section('body')
    <body class="horizontal light rtl ">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
            <div class="container-fluid">
                <a class="navbar-brand mx-lg-1 mr-0" href="{{ url('/') }}">
                    <img src="{{ asset('/images/cdc-logo.png') }}" alt="logo-cdc" class="img-circle img-fluid" width="80px" height="80px">
                </a>
                <button class="navbar-toggler mt-2 mr-auto toggle-sidebar text-muted">
                    <i class="fe fe-menu navbar-toggler-icon"></i>
                </button>
                <div class="navbar-slide bg-white ml-lg-4 float-right">
                    <a href="#" class="btn toggle-sidebar d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                        <i class="fe fe-x"><span class="sr-only"></span></i>
                    </a>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="ml-lg-2">{{ __('names.claims.claim') }}</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" id="statsDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="ml-lg-2">{{ __('names.stats') }}</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="statsDropdown">
                                <a class="nav-link pl-lg-2" href="{{ route('stats.municipalities') }}"><span class="ml-1">{{ 'البلديات' }}</span></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav">
                    @auth()
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ auth()->user()->account }}" >
                                {{ __('forms.account') }}
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('forms.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}" >
                                {{ __('forms.login') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}" >
                                {{ __('forms.register') }}
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
        <main role="main">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <h2 class="h5 page-title">{{ $report->title }}</h2>
                        <div class="card">
                            <div class="card-header">
                                {{ 'الملاحظات' }}
                                <div class="float-right">
                                    {{ 'ملاحظة '. count($observations) }}
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>{{ 'الجهة الخاضعة للرقابة' }}</th>
                                        <th>{{ 'العنوان' }}</th>
                                        <th>{{ 'الملاحظة' }}</th>
                                        <th>{{ 'الاثر المالي' }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($observations as $observation)
                                            <tr>
                                                @if($loop->first)
                                                    <td rowspan="{{ count($observations)}}">
                                                        {{ $report->establishment->name }}
                                                    </td>
                                                @endif
                                                <td>
                                                    {{ $observation->title }}
                                                </td>
                                                <td>
                                                    {{ $observation->observation }}
                                                </td>
                                                <td>
                                                    {{ $observation->financial_impact }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $observations->links() }}
                            </div>
                        </div>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
        </main> <!-- main -->
    </div> <!-- .wrapper -->
    </body>
@endsection
