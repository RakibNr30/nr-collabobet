
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start bg-white" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="" href="{{ route('portal.dashboard.index') }}">
        <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="...">
        {{--<span class="ms-3 font-weight-bold">COLLABOBET</span>--}}
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav {{ \App\Helpers\AuthUser::isAdmin() ? '' : 'sidenav-custom' }}">
        @if(\App\Helpers\AuthUser::isAdmin())
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('portal/dashboard') ? 'active' : '') }}" href="{{ url('/portal/dashboard') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-chart-line text-{{ (Request::is('portal/dashboard') ? 'white' : 'dark')  }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('portal/user') ? 'active' : '') }} " href="{{ url('/portal/user') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user text-{{ (Request::is('portal/user') ? 'white' : 'dark')  }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('portal/transaction') ? 'active' : '') }} " href="{{ url('/portal/transaction') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-coins text-{{ (Request::is('portal/transaction') ? 'white' : 'dark')  }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transactions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('portal/faq') ? 'active' : '') }} " href="{{ url('/portal/faq') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-solid fa-question text-{{ (Request::is('portal/faq') ? 'white' : 'dark')  }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Faqs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('portal/contact') ? 'active' : '') }} " href="{{ url('/portal/contact') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-map-marker-alt text-{{ (Request::is('portal/contact') ? 'white' : 'dark')  }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Contacts</span>
                </a>
            </li>
        @endif

        @if(\App\Helpers\AuthUser::isUser())
            <div class="progress-wrapper w-100 m-auto" style="padding: 0 2rem 1rem 2rem;">
                <div class="progress-info">
                    <div class="progress-percentage">
                        <span class="text-xs font-weight-bold">{{ \App\Helpers\AuthUser::getProfileProgress() }}%</span>
                    </div>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-gradient-info w-{{ \App\Helpers\AuthUser::getProfileProgress() }}" role="progressbar" aria-valuenow="{{ \App\Helpers\AuthUser::getProfileProgress() }}" aria-valuemin="0" aria-valuemax="100" style="height: 10px; margin-top: 0;"></div>
                </div>
            </div>

            <li class="nav-item">
                <a class="nav-link {{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::ACCOUNT_CREATED ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="height: 24px; width: 24px;">
                        <i class="fas fa-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::ACCOUNT_CREATED ? 'check' : 'times' }} text-{{ (\App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::ACCOUNT_CREATED ? 'white' : 'dark')  }}" style="font-size: 14px; margin-bottom: 3px;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Account Created</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="height: 24px; width: 24px;">
                        <i class="fas fa-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED ? 'check' : 'times' }} text-{{ (\App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::PERSONAL_DETAILS_CREATED ? 'white' : 'dark')  }}" style="font-size: 14px; margin-bottom: 3px;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Details Created</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::VERIFICATION_COMPLETED ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="height: 24px; width: 24px;">
                        <i class="fas fa-{{ \App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::VERIFICATION_COMPLETED ? 'check' : 'times' }} text-{{ (\App\Helpers\AuthUser::getProfileStatus() >= \App\Constants\ProfileStatus::VERIFICATION_COMPLETED ? 'white' : 'dark')  }}" style="font-size: 14px; margin-bottom: 3px;"></i>
                    </div>
                    <span class="nav-link-text ms-1">Verification Completed</span>
                </a>
            </li>
        @endif
    </ul>
  </div>
</aside>
