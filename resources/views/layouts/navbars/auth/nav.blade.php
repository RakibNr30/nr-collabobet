<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 position-sticky blur shadow-blur left-auto top-0 z-index-sticky" id="navbarBlur" navbar-scroll="true" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <a class="align-items-center nav-image" href="{{ route('portal.dashboard.index') }}">
                <img src="{{ asset('assets/img/logo-ct.png') }}" style="height: 48px" class="navbar-brand-img" alt="...">
            </a>
            {{--<h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>--}}
        </nav>
        <div class="collapse navbar-collapse {{--mt-sm-0 mt-2 me-md-0 me-sm-4 --}}d-flex justify-content-end" id="navbar">
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('portal.logout')}}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-sign-out me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-4 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                    </a>
                </li>
                <li class="nav-item px-3 ps-4 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
