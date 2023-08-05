<footer class="footer f-footer pt-3">
    @if(\App\Helpers\AuthUser::isUser())
    <div class="container-fluid" style="background-color: #000; height: 48px;">
        <ul class="nav nav-footer f-nav-main justify-content-center justify-content-lg-end">
            <li class="nav-item f-nav">
                <a href="{{ route('portal.user-verification.edit') }}">
                    <i class="fas fa-hands-helping" style="{{ Request::is('portal/user-verification') ? 'color: #14dfa9;' : '' }}"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="{{ route('portal.profile.index') }}">
                    <i class="fas fa-user" style="{{ Request::is('portal/profile') ? 'color: #14dfa9;' : '' }}"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="{{ route('portal.transaction.index') }}">
                    <i class="fas fa-coins" style="{{ Request::is('portal/transaction') ? 'color: #14dfa9;' : '' }}"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="{{ route('portal.contact.index') }}">
                    <i class="far fa-envelope" style="{{ Request::is('portal/contact') ? 'color: #14dfa9;' : '' }}"></i>
                </a>
            </li>
        </ul>
    </div>
    @endif
</footer>
