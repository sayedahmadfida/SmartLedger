<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ request()->session()->get('user.first_name') }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li class="{{ in_array(request()->segment(1), ['home']) ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->can('user.view') ||
                auth()->user()->can('user.create'))
                <li class="{{ in_array(request()->segment(1), ['users']) ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fa fa-users"></i> <span>Users</span>
                    </a>
                </li>
            @endif

            
                        @can('customer.view')
                            <li class="{{ request()->segment(1) === 'customer' ? 'active' : '' }}">
                                <a href="{{ route('customer.index') }}">
                                    <i class="fa-solid fa-person-shelter"></i> Customers
                                </a>
                            </li>
                        @endcan
                        
                




                        @can('user.create')
                            <li class="{{ request()->segment(1) === 'roles' ? 'active' : '' }}"><a
                                    href="{{ route('roles.index') }}"><i class="fa fa-briefcase"></i> User Roles</a>
                            </li>
                        @endcan












          
            <li class="header"><b>About</b></li>


            <li class="{{ request()->segment(1) === 'user-activities' && request()->segment(2) == null ? 'active' : '' }}">
                <a href="{{ route('user-activities.index') }}">
                    <i class="fa-solid fa-people-carry-box"></i> <span>User Acivities</span>
                </a>
            </li>






            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"> 
                     <i class="fa-solid fa-right-from-bracket"></i> <span>Log out</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
