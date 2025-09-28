<nav id="sidebar" class="closed">

    <button class="btn btn-dark me-2" id="sidebarToggleClose">
        ✖
    </button>
    <div class="sidebar-header">
        <h3 style="color: white; cursor:pointer;" onclick="location.href='{{url('/admin/dashboard')}}'">EventSphere</h3>
    </div>

    <ul class="list-unstyled components">
        <li class=" {{ request()->routeIs('admin_dashboard') ? 'active' : '' }} ">
            <a href="{{url('/admin/dashboard')}}">
                <i class="fas fa-tachometer-alt ms-3"></i>
                <span> Dashboard</span>
            </a>
        </li>

        <li class=" {{ request()->routeIs('view.events') ? 'active' : '' }} ">
            <a href="{{url('/admin/eventDec')}}">
                <i class="fas fa-calendar-check ms-3"></i>
                <span> Events Management</span>
            </a>
        </li>

        <li class=" {{ request()->routeIs('view.users') ? 'active' : '' }} ">
            <a href="{{url('/viewUsers')}}">
                <i class="fas fa-users ms-3"></i>
                <span> User Management</span>
            </a>
        </li>

        <li class=" {{ request()->routeIs('adminmedia') ? 'active' : '' }} ">
            <a href="{{url('admin/media')}}">
                <i class="fas fa-photo-video ms-3"></i>
                <span> Media and Uploads</span>
            </a>
        </li>

        <li class=" {{ request()->routeIs('adminfeedback') ? 'active' : '' }} ">
            <a href="{{url('/admin/feedback')}}">
                <i class="fas fa-comments ms-3"></i>
                <span> Feedback</span>
            </a>
        </li>

        <li class=" {{ request()->routeIs('notification.form') ? 'active' : '' }} ">
            <a href="{{url('/admin/notificationForm')}}">
                <i class="fas fa-bell ms-3"></i>
                <span> Notifications</span>
            </a>
        </li>
    </ul>

</nav>
<nav class="headeradmin navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3" style="margin-top: 0;position: fixed !important;
    width: 100%;
    top: 0px !important;
    z-index: 111;">
    <div class="container-fluid">

        <button class="btn btn-dark me-2" id="sidebarToggleOpen">
            ☰
        </button>
      
      	
      
      	<div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav m-auto mt-2 mt-lg-0 gap-2">
            <li class="nav-item ms-0"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                href="{{ route('home') }}">Home</a></li>
            <li class="nav-item ms-0 ms-1 ms-1 ms-1 ms-1"><a class="nav-link {{ request()->routeIs('events') ? 'active' : '' }}"
                href="{{ route('events') }}">Events</a></li>
            <li class="nav-item ms-0 ms-1 ms-1 ms-1"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}"
                href="{{ route('gallery') }}">Gallery</a></li>
            <li class="nav-item ms-0 ms-1 ms-1"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                href="{{ route('about') }}">About Us</a></li>
            <li class="nav-item ms-0 ms-1"><a class="nav-link {{ request()->routeIs('contact_us') ? 'active' : '' }}"
                href="{{ route('contact_us') }}">Contact Us</a></li>
            <li class="nav-item ms-0"><a class="nav-link {{ request()->routeIs('faqs') ? 'active' : '' }}"
                href="{{ route('faqs') }}">FAQ</a></li>
          </ul>
        </div>

        <div class="ms-auto d-flex align-items-center">
            <form class="logout-button" action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-danger logoutbtn" style="background-color:rgb(192, 27, 27); border:0;">Logout</button>
            </form>
            <div class="dropdown ms-3">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">

                    @php
                        $userImagePath = 'images/profile_icons/' . auth()->user()->image;
                      @endphp

                    @if(auth()->user()->image && file_exists(public_path($userImagePath)))
                        <div class="d-flex align-items-center profile-dropdown">
                            <img onclick="location.href='{{ route('profile') }}'" src="{{ asset($userImagePath) }}"
                                alt="Profile Image" class="rounded-circle profile-img">
                            <span class="profile-icon-name ms-2">{{ auth()->user()->first_name }}</span>
                        </div>
                    @else
                        <div class="d-flex align-items-center profile-dropdown">
                            <img onclick="location.href='{{ route('profile') }}'"
                                src="{{ asset('images/profile_icons/default.png') }}" alt="Default Profile Image"
                                class="rounded-circle profile-img">
                            <span class="profile-icon-name ms-2">{{ auth()->user()->first_name }}</span>
                        </div>
                    @endif


                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow" id="profileDropdownMenu aria-labelledby="
                    profileDropdown">
                    <li class="text-center" style="cursor:pointer;" onclick="location.href='{{route('profile')}}'">
                        {{ auth()->user()->first_name }}</li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                    @if(auth()->user()->department === 'participant')
                        <li><a class="dropdown-item" href="{{ route('participant_dashboard') }}">Dashboard</a></li>
                    @elseif(auth()->user()->department === 'organizer')
                        <li><a class="dropdown-item" href="{{ route('organizer_dashbaord') }}">Dashboard</a></li>
                    @elseif(auth()->user()->department === 'admin')
                        <li><a class="dropdown-item" href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                    @endif
                    @if (auth()->user()->department === 'organizer')
                        <li><a class="dropdown-item" href="{{ route('participant_history') }}">History</a></li>
                    @endif

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("sidebar");
        const btnClose = document.getElementById("sidebarToggleClose");
        const btnOpen = document.getElementById("sidebarToggleOpen");

        btnClose.addEventListener("click", function () {
            sidebar.classList.add("closed");
        });

        btnOpen.addEventListener("click", function () {
            sidebar.classList.remove("closed");
        });
    });
</script>