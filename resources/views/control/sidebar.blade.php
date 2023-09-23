@php
    $current_route=request()->route()->getName();
@endphp


<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-header" style="color: gray">Main Navigation</li>

        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{$current_route=='dashboard'?'active':''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item {{ $current_route == 'studentRead'  || $current_route == 'voucherRead' || $current_route == 'studentEdit' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-wifi"></i>
                <p>
                    Campus WiFi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('voucherRead') }}" class="nav-link {{ request()->is('campuswifi/voucher*') ? 'active' : '' }}">
                        <i class="fas fa-money-check nav-icon"></i>
                        <p>Voucher</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('studentRead') }}" class="nav-link {{ request()->is('campuswifi/stud*') ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Students</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('dailyRead') }}" class="nav-link {{ request()->is('daily*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Daily Task
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('eventRead') }}" class="nav-link {{ request()->is('render*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-days"></i>
                <p>
                    Calendar
                </p>
            </a>
        </li>

        @if(Auth::user()->role=='Administrator')
        <li class="nav-item">
            <a href="{{ route('optiontaskRead') }}" class="nav-link {{ request()->is('option*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-bars"></i>
                <p>
                    Task Option
                </p>
            </a>
        </li>
        @endif

        <li class="nav-header" style="color: gray">Reports</li>
        <li class="nav-item">
            <a href="{{ route('genoptionRead') }}" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-pdf"></i>
                <p>
                    Accomplishment Report
                </p>
            </a>
        </li>

        @if(Auth::user()->role=='Administrator')
        <li class="nav-header" style="color: gray">Users Management</li>
        <li class="nav-item">
            <a href="{{ route('userRead') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-gear"></i>
                <p>
                    Users
                </p>
            </a>
        </li>
        @endif

    </ul>
</nav>