<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
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
        {{ auth()->user()->mobile ?? '-' }}

        <div class="mt-2">
          <h6 class="mb-0">Safety</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
            Change Password
        </a>

        <div class="mt-2">
            <h6 class="mb-0">Service</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
            Faq
        </a>
          <br>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          Contact Us
        </a>

        <div class="mt-5">
            <a href="{{ route('portal.logout')}}" class="btn bg-gradient-primary w-100 mb-2 active">
                <i class="fa fa-sign-out me-sm-1"></i>
                <span class="">Sign Out</span>
            </a>
        </div>

      </div>
    </div>
  </div>
