<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-cogs"></i>
        {{ __('Authentication') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('role') }}'><i class='nav-icon la la-question'></i>
                {{ __('Roles') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('permission') }}'><i class='nav-icon la la-question'></i>
                {{ __('Permissions') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('team') }}'><i class='nav-icon la la-question'></i>
                {{ __('Teams') }}
            </a>
        </li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-cogs"></i>
        {{ __('names.administration.administration') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('sector') }}'><i class='nav-icon la la-question'></i>
                {{ __('names.administration.sectors') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('establishment') }}'><i class='nav-icon la la-question'></i>
                {{ __('names.administration.establishments') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('governorate') }}'><i class='nav-icon la la-question'></i>
                {{ __('names.administration.governorates') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('room') }}'><i class='nav-icon la la-question'></i>
                {{ __('names.administration.rooms') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('report-type') }}'><i class='nav-icon la la-question'></i>
                {{ __('names.administration.report-type') }}
            </a>
        </li>
    </ul>
</li>




<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-users-cog"></i>
        {{ __('names.administration.users') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('magistrate') }}'><i class='nav-icon la la-question'></i>
                {{ __('names.administration.magistrates') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('government-commission') }}'><i class='nav-icon la la-question'></i>
                {{ __('government-commissioner') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('room-president') }}'><i class='nav-icon la la-question'></i>
                {{ __('Room Presidents') }}
            </a>
        </li>

        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('first-president') }}'><i class='nav-icon la la-question'></i>
                {{ __('First Presidents') }}
            </a>
        </li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-users-cog"></i>
        {{ __('Citizens') }}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('profile') }}'><i class='nav-icon la la-question'></i>
                {{ __('profiles') }}
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('claim-type') }}'><i class='nav-icon la la-question'></i>
                {{ __('Claim.Types') }}
            </a>
        </li>
    </ul>
</li>
