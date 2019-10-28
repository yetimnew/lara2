<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        {{-- <div class="avatar"><img src="{{ asset(Auth::user()->profile->image)}}" alt="User Name"
        class="img-fluid rounded-circle">
    </div> --}}
    <div class="title">
        <h1 class="h4">{{Auth::user()->name}}</h1>
        <p>{{Auth::user()->type}}</p>
    </div>
    <div class="">
        <a href="{{route('profile')}}" alt="Edit Profile"> <i class="fa fa-cog" aria-hidden="true"></i></a>
    </div>
    </div>

    <!-- Sidebar Navidation Menus-->
    <span class="heading">Main</span>
    <ul>
        <li class="{{ Request::is('dasboard') ? 'active' : ''}}"><a href="{{route('dasboard')}}">Home</a>
        </li>


        <li class="{{ Request::is('truck*') ? 'active' : ''}}"><a href="#exampledropdownDropdown" aria-expanded="false"
                data-toggle="collapse"> <i class="fa fa-truck" aria-hidden="true"></i> Trucks </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li class="{{ Request::is('truck') ? 'active' : ''}}"><a href="{{route('truck')}}">Truck</a>
                </li>
                <li class="{{ Request::is('vehecletype') ? 'active' : ''}}"><a href="{{route('vehecletype')}}">Truck
                        Model</a>
                </li>
            </ul>
        </li>
        <li class="{{ Request::is('driver') ? 'active' : ''}}"><a href="{{route('driver')}}"> <i
                    class="fa fa-user green"></i>Driver </a>
        </li>
        <li class="{{ Request::is('operation*') ? 'active' : ''}}"><a href="#exampledropdownDropdown2"
                aria-expanded="false" data-toggle="collapse"> <i class="fa fa-tasks blue"
                    aria-hidden="true"></i>Operations </a>
            <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                <li class="{{ Request::is('operation*') ? 'active' : ''}}"><a
                        href="{{route('operation')}}">Operation</a>
                </li>
                <li class="{{ Request::is('place') ? 'active' : ''}}"><a href="{{route('place')}}">Operations Place</a>
                </li>
                <li class="{{ Request::is('region') ? 'active' : ''}}"><a href="{{route('region')}}">Operations
                        Region</a></li>
                {{-- <li><a href="operation_place_distance.php">Place Distance</a></li> --}}
            </ul>
        </li>
        <li class="{{ Request::is('customer') ? 'active' : ''}}"><a href="{{route('customer')}}"> <i
                    class="fa fa-users green" aria-hidden="true"></i> Customers </a>
        </li>


        {{-- for users  --}}

        <li class="{{ Request::is('performace') ? 'active' : ''}}"><a href="{{route('performace')}}"> <i
                    class="fa fa-tasks" aria-hidden="true"></i> Performance </a>

        </li>


        <li class="{{ Request::is('status*') ? 'active' : ''}}"><a href="#exampledropdownDropdown3"
                aria-expanded="false" data-toggle="collapse"> <i class="fa fa-assistive-listening-systems red"
                    aria-hidden="true"></i>Status </a>
            <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                <li class="{{ Request::is('status') ? 'active' : ''}}"><a href="{{route('status')}}">Status </a> </li>

                <li class="{{ Request::is('statustype*') ? 'active' : ''}}"><a href="{{route('statustype')}}">Status
                        Type</a></li>

            </ul>
        </li>
        <li class="{{ Request::is('drivertruck') ? 'active' : ''}}"><a href="{{route('drivertruck')}}"> <i
                    class="fa fa-suitcase" aria-hidden="true"></i>Truck Driver Assign </a>
        </li>

        <li class="{{ Request::is('performance_*') ? 'active' : ''}}"><a href="#exampledropdownDropdown6"
                aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart orange" aria-hidden="true"></i>
                Report </a>
            <ul id="exampledropdownDropdown6" class="collapse list-unstyled ">
                <li class="{{ Request::is('performance_by_driver') ? 'active' : ''}}"><a
                        href="{{ route('performance_by_driver')}}">Performance By Driver</a> </li>

                <li class="{{ Request::is('performance_of_all_driver') ? 'active' : ''}}"><a
                        href="{{ route('performance_of_all_driver')}}">Performance Of All Driver</a> </li>

                <li class="{{ Request::is('performance_by_truck') ? 'active' : ''}}"><a
                        href="{{ route('performance_by_truck')}}">Performance By Truck</a> </li>
                <li class="{{ Request::is('performance_by_opration') ? 'active' : ''}}"><a
                        href="{{ route('performance_by_opration')}}">Operation & performance</a> </li>
                <li class="{{ Request::is('performance_by_status') ? 'active' : ''}}"><a
                        href="{{ route('performance_by_status')}}">Status By Date</a> </li>
                <li class="{{ Request::is('performance_by_model') ? 'active' : ''}}"><a
                        href="{{ route('performance_by_model')}}">Performance By Model</a> </li>

            </ul>

        <li><a href="#exampledropdownDropdown7" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cogs"
                    aria-hidden="true"></i> Setting </a>
            <ul id="exampledropdownDropdown7" class="collapse list-unstyled ">
                <li><a href="{{ route('backup')}}"><i class="fa fas-trash-restore-alt" aria-hidden="true"></i>Back
                        Up</a> </li>
            </ul>
        </li>

        <li><a href="#exampledropdownDropdown8" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cogs"
                    aria-hidden="true"></i> Role and Permission </a>
            <ul id="exampledropdownDropdown8" class="collapse list-unstyled ">
                <li><a href="{{ route('role')}}"><i class="fa fas-trash-restore-alt" aria-hidden="true"></i>Role</a>
                </li>
                <li><a href="{{ route('permission')}}"><i class="fa fas-trash-restore-alt"
                            aria-hidden="true"></i>Permission</a> </li>
            </ul>
        </li>
        @if (Auth::user()->admin)
        <li class=""><a href="{{route('user')}}"> <i class="fa fa-users" aria-hidden="true"></i> User Mangment </a>

            @endif
        </li>

    </ul>
</nav>