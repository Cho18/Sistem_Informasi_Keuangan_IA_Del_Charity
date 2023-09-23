<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button
        id="sidebarToggleTop"
        class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        
        <!-- Nav Item - Alerts -->
        {{-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Notifikasi
            </h6>
            @foreach(auth()->user()->unreadNotifications as $notification)
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ $notification->created_at->format('d F Y') }}</div>
                        <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                    </div>
                </a>
            @endforeach
            <a class="dropdown-item text-center small text-gray-500" href="#">Tampilkan semua notifikasi</a>
            </div>
        </li> --}}

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a
                class="nav-link dropdown-toggle"
                href="#"
                id="userDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-900 small"> 
                        {{ Auth::user()->name }}
                    </span>
                    <img class="img-profile rounded-circle" src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profile Picture">
            </a>

            <!-- Dropdown - User Information -->
            <div
                class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/account">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Account
                </a>
                <div class="dropdown-divider"></div>
                {{-- <a
                    class="dropdown-item"
                    href="/logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a> --}}
                <a
                    class="dropdown-item"
                    href="" 
                    data-toggle="modal"
                    data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>