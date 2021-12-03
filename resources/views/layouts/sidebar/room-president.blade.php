<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item dropdown">
        <a href="{{ url(auth()->user()->account) }}"  class="nav-link">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">{{ __('sidebar.dashboard') }}</span>
        </a>
    </li>
</ul>
<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item w-100">
        <a class="nav-link" href="{{ route('room-president.report.index') }}">
            <i class="fe fe-list fe-16"></i>
            <span class="ml-3 item-text">{{ __('sidebar.magistrate.reports') }}</span>
        </a>
    </li>
    <li class="nav-item w-100">
        <a class="nav-link" href="{{ route('room-president.claim.index') }}">
            <i class="fe fe-layers fe-16"></i>
            <span class="ml-3 item-text">{{ __('sidebar.magistrate.list_claim') }}</span>
        </a>
    </li>
    <li class="nav-item w-100">
        <a class="nav-link" href="{{ route('room-president.claim.archive.index') }}">
            <i class="fe fe-archive fe-16"></i>
            <span class="ml-3 item-text">{{ ('الارشيف') }}</span>
        </a>
    </li>
</ul>
