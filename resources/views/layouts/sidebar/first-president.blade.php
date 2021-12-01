<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item">
        <a href="{{ auth()->user()->account }}" class="nav-link">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">{{ __('sidebar.dashboard') }}</span>
        </a>
    </li>
</ul>
<p class="text-muted nav-heading mt-4 mb-1">
    <span>{{ ('الدوائر') }}</span>
</p>
<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item dropdown">
        <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">{{ ('الدوائر') }}</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('first-president.room.index') }}">
                    <span class="ml-1 item-text">
                        {{ ('قائمة الدوائر') }}
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('first-president.room-president.form') }}">
                    <span class="ml-1 item-text">
                        {{ ('تعيين رئيس الدائرة') }}
                    </span>
                </a>
            </li>
        </ul>

    </li>
    <li class="nav-item dropdown">
        <a href="#claims-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">{{ ('الشكاوي') }}</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="claims-elements">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('first-president.claim.index') }}">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">{{ __('sidebar.magistrate.list_claim') }}</span>
                </a>
            </li>
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('first-president.claim.archive.index') }}">
                    <i class="fe fe-archive fe-16"></i>
                    <span class="ml-3 item-text">{{ ('الارشيف') }}</span>
                </a>
            </li>
        </ul>
    </li>
</ul>
