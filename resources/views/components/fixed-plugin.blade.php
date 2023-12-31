<div class="fixed-plugin">
    {{--<a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>--}}
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-0">
        <div class="{{ (Request::is('rtl') ? 'float-end' : 'float-start') }}">
          <h5 class="mt-3 mb-0">{{ auth()->user()->full_name ?? '-' }}</h5>
        </div>
        <div class="{{ (Request::is('rtl') ? 'float-start mt-4' : 'float-end mt-4') }}">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <div>
          <h6 class="mb-0">Mobile Number</h6>
        </div>
          {{ config('core.country_code') }}{{ auth()->user()->mobile ?? '-' }}

        <div class="mt-3">
          <h6 class="mb-0">Safety</h6>
        </div>
        <a href="{{ route('portal.user-change-password.edit') }}" class="switch-trigger background-color {{ Request::is('portal/user-change-password') ? 'text-primary' : '' }}">
            Change Password
        </a>

        @if(\App\Helpers\AuthUser::isUser())
              <div class="mt-3">
                  <h6 class="mb-0">Service</h6>
              </div>
              <a href="{{ route('portal.faq.index') }}" class="switch-trigger background-color {{ Request::is('portal/faq') ? 'text-primary' : '' }}">
                  Faq
              </a>
              <br>
              <a href="{{ route('portal.contact.index') }}" class="switch-trigger background-color my-1 {{ Request::is('portal/contact') ? 'text-primary' : '' }}">
                  Contact Us
              </a>

              <div class="mt-3">
                  <h6 class="mb-0">Rules</h6>
              </div>
              <a href="{{ route('portal.terms-and-conditions.index') }}" class="switch-trigger background-color {{ Request::is('portal/terms-and-conditions') ? 'text-primary' : '' }}">
                  Terms and Conditions
              </a>
          @endif

          <hr class="horizontal dark my-5">

        <div class="my-5">
            <a href="{{ route('portal.logout')}}" class="btn bg-gradient-primary w-100 mb-2 active">
                <i class="fa fa-sign-out me-sm-1"></i>
                <span class="">Sign Out</span>
            </a>
        </div>

      </div>
    </div>
  </div>
