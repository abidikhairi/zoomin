@extends('layouts.app')

@section('body')
    <body class="vertical light rtl">
        <div class="wrapper">
            <nav class="topnav navbar navbar-light">
                <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                    <i class="fe fe-menu navbar-toggler-icon"></i>
                </button>
                <ul class="nav">
                    <li class="nav-item nav-notif">
                        <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                            <span class="fe fe-bell fe-16"></span>
                            @if(auth()->user()->unreadNotifications->count() != 0)
                                <span class="dot dot-md bg-danger"></span>
                            @else
                                <span class="dot dot-md bg-success"></span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset('images/avatar.png') }}" alt="..." class="avatar-img rounded-circle">
                  </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('forms.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
                <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                    <i class="fe fe-x"><span class="sr-only"></span></i>
                </a>
                <nav class="vertnav navbar navbar-light">
                    <div class="w-100 mb-4 d-flex">
                        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url("/") }}">
                            <img src="{{ asset('/images/cdc-logo.png') }}" alt="logo-cdc" class="img-circle img-fluid" width="80px" height="80px">
                        </a>
                    </div>
                    @switch(auth()->user()->role)
                        @case(\App\AppRoles::ROLE_CITIZEN)
                            @include('layouts.sidebar.citizen')
                            @break
                        @case(\App\AppRoles::ROLE_MAGISTRATE)
                            @include('layouts.sidebar.magistrate')
                            @break
                        @case(\App\AppRoles::ROLE_ROOM_PRESIDENT)
                            @include('layouts.sidebar.room-president')
                            @break
                        @case(\App\AppRoles::ROLE_FIRST_PRESIDENT)
                            @include('layouts.sidebar.first-president')
                            @break
                    @endswitch
                </nav>
            </aside>
            <main role="main" class="main-content">
                @yield('content')
                <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="defaultModalLabel">{{ __('names.notifications.name') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="list-group list-group-flush my-n3" id="notifications-modal">
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        <div class="list-group-item bg-transparent notification-group-item" data-notification="{{ $notification->id }}">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="fe fe-{{$notification->data['icon']}} fe-24"></span>
                                                </div>
                                                <div class="col">
                                                    <small>
                                                        <strong>{{ $notification->data['message'] }}</strong>
                                                    </small>
                                                    <small class="badge badge-pill badge-light text-muted">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div> <!-- / .list-group -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-block" id="clear-notifications" data-dismiss="modal">{{ __('names.notifications.clear-all') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main> <!-- main -->
        </div> <!-- .wrapper -->
    </body>
@endsection
