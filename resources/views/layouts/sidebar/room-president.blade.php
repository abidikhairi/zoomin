<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item dropdown">
        <a href="{{ url(auth()->user()->account) }}" data-toggle="collapse" aria-expanded="false" class="nav-link">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">Dashboard</span>
        </a>
    </li>
</ul>
<p class="text-muted nav-heading mt-4 mb-1">
    <span>{{ __('sidebar.claims.name') }}</span>
</p>
<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100">
        <a class="nav-link" href="{{ route('room-president.claim.index') }}">
            <i class="fe fe-layers fe-16"></i>
            <span class="ml-3 item-text">{{ __('sidebar.claims.list') }}</span>
        </a>
    </li>
    <li class="nav-item w-100">
        <a class="nav-link" href="{{ route('room-president.claim.archive.index') }}">
            <i class="fe fe-archive fe-16"></i>
            <span class="ml-3 item-text">{{ __('sidebar.claims.archive') }}</span>
        </a>
    </li>
</ul>
