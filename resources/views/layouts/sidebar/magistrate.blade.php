<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item">
        <a href="{{ url(auth()->user()->account) }}" class="nav-link">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">Dashboard</span>
        </a>
    </li>
</ul>
<p class="text-muted nav-heading mt-4 mb-1">
    <span>{{ __('Reports') }}</span>
</p>
<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item dropdown">
        <a href="#reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">{{ __('Reports') }}</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="reports">
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('report.index') }}">
                    <i class="fe fe-list"></i>
                    <span class="ml-1 item-text">{{ __('List Reports') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('report.create') }}">
                    <i class="fe fe-plus"></i>
                    <span class="ml-1 item-text">{{ __('Add Report') }}</span>
                </a>
            </li>

        </ul>
    </li>
</ul>

<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item dropdown">
        <a href="#claims" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">{{ __('Claims') }}</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="claims">
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('report.claim.index') }}">
                    <i class="fe fe-list"></i>
                    <span class="ml-1 item-text">{{ __('List Claims') }}</span>
                </a>
            </li>
        </ul>
    </li>
</ul>
