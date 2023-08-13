<footer class="footer f-footer pt-3">
    @if(\App\Helpers\AuthUser::isUser())
    <div class="container-fluid f-nav-c" style="background-color: #000; height: 48px;">
        <ul class="nav nav-footer f-nav-main justify-content-center justify-content-lg-end">
            <li class="nav-item f-nav">
                <a href="{{ route('portal.user-verification.edit') }}">
                    <i class="fas fa-hands-helping" style="{{ \App\Helpers\UrlHelper::isMatch('portal/user-verification') ? 'color: #14dfa9;' : '' }}"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="{{ route('portal.profile.index') }}">
                    <i class="fas fa-user" style="{{ \App\Helpers\UrlHelper::isMatch('portal/profile') ? 'color: #14dfa9;' : '' }}"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="{{ route('portal.transaction.index') }}">
                    <i class="fas fa-coins" style="{{ \App\Helpers\UrlHelper::isMatch('portal/transaction') ? 'color: #14dfa9;' : '' }}"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="{{ route('portal.contact.index') }}">
                    <i class="far fa-envelope" style="{{ \App\Helpers\UrlHelper::isMatch('portal/contact') ? 'color: #14dfa9;' : '' }}"></i>
                </a>
            </li>
        </ul>
    </div>
    @endif
</footer>
