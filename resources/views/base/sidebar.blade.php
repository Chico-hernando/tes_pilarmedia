<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main"
     style="overflow: inherit">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                @if(isset($user) && $user->role == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.absensi')}}">
                            <i class=""></i> Absensi
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.absensi.absen')}}">
                            <i class=""></i> Absen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.logout')}}">
                            <i class=""></i> Logout
                        </a>
                    </li>
                @elseif(isset($user) && $user->role == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.admin')}}">
                            <i></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.admin.absensi')}}">
                            <i></i> Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.logout')}}">
                            <i class=""></i> Logout
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
