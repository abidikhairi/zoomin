<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item dropdown">
        <a href="{{ auth()->user()->account }}" class="nav-link">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">{{ 'الرئيسية' }}</span>
        </a>
    </li>
</ul>
<p class="text-muted nav-heading mt-4 mb-1">
    <span>{{ __('Claims') }}</span>
</p>
<ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item dropdown">
        <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-box fe-16"></i>
            <span class="ml-3 item-text">{{ __('names.claims.plural') }}</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{ route('claim.create') }}">
                    <span class="ml-1 item-text">{{ 'تقديم شكوى' }}</span>
                    <i class="fe fe-book-open"></i>
                </a>
            </li>
        </ul>
    </li>
</ul>
