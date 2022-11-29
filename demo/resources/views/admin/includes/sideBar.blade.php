@php
$application_logo = App\Models\Setting::where('code','application_logo')->where('hidden','0')->first();
@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    @if(!empty(@$application_logo->value))
                    <img src="{!! @$application_logo->value !== '' ? asset("storage/setting/".@$application_logo->value) : asset('storage/default.png') !!}" alt="image" class="rounded-circle" height="60px" width="60px" style="border-radius:20%!important">
                    @else
                    <img src="{!! asset('storage/setting/default.png') !!}" alt="image" class="rounded-circle" height="60px" width="60px" style="border-radius:20%!important">
                    @endif
                    <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    @if(!empty(@$application_logo->value))
                    <img alt="image" class="rounded-circle" height="60px" width="60px" style="border-radius:20%!important" src="{!! @$application_logo->value !== '' ? asset("storage/setting/".@$application_logo->value) : asset('storage/default.png') !!}">
                    @else
                    <img alt="image" class="rounded-circle" height="60px" width="60px" style="border-radius:20%!important" src="{!! asset('storage/setting/default.png') !!}">
                    @endif
                </div>
            </li>
            <li class="@if(Request::segment('2') == 'dashboard') active @endif">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'branches') active @endif">
                <a href="{{ route('admin.branches.index') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Branches</span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'transactions') active @endif">
                <a href="{{ route('admin.transactions.index') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Transaction</span>
                </a>
            </li>

            <li>
                <a href="#" aria-expanded="false" class="disabled">
                    <span class="nav-label">REPORTS </span>
                </a>
            </li>
            <li class="@if(Request::segment('2') == 'generalreports' || Request::segment('2') == 'branchreports') active @endif">
                <a href="#" aria-expanded="false">
                    <i class="fa fa-columns"></i>
                    <span class="nav-label">Reports</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                    <li class="@if(Request::segment('2') == 'generalreports') active @endif"><a href="{{ route('admin.generalreports.index') }}">General Reports</a></li>
                    <!-- <li class="@if(Request::segment('2') == 'branchreports') active @endif"><a href="{{ route('admin.branchreports.index') }}">Branch Reports</a></li> -->
                </ul>
            </li>

            <li>
                <a href="#" aria-expanded="false" class="disabled">
                    <span class="nav-label">EXPENSES </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'expensetype') active @endif">
                <a href="{{ route('admin.expensetype.index') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Expense Types</span>
                </a>
            </li>
            <li class="@if(Request::segment('2') == 'expenses') active @endif">
                <a href="{{ route('admin.expenses.index') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Expenses</span>
                </a>
            </li>

            <li>
                <a href="#" aria-expanded="false" class="disabled">
                    <span class="nav-label">CONFIGURATION </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'profile') active @endif">
                <a href="{{ route('admin.profile') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Profile </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'setting') active @endif">
                <a href="{{ route('admin.setting.index') }}">
                    <i class="fa fa-cog"></i>
                    <span class="nav-label">Setting </span>
                </a>
            </li>

            <li class="@if(Request::segment('2') == 'logout') active @endif">
                <a href="{{ route('admin.logout') }}">
                    <i class="fa fa-sign-out"></i>
                    <span class="nav-label">Logout </span>
                </a>
            </li>
        </ul>
    </div>
</nav>