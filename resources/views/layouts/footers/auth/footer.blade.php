<footer class="footer f-footer pt-3  ">
    @if(\App\Helpers\AuthUser::isUser())
    <div class="container-fluid" style="background-color: #000">
        <ul class="nav nav-footer f-nav-main justify-content-center justify-content-lg-end">
            <li class="nav-item f-nav">
                <a href="{{ route('portal.user-verification.edit') }}">
                    <i class="fas fa-hands-helping"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="{{ route('portal.profile.index') }}">
                    <i class="fas fa-user"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="#">
                    <i class="fas fa-coins"></i>
                </a>
            </li>
            <li class="nav-item f-nav">
                <a href="#">
                    <i class="far fa-envelope"></i>
                </a>
            </li>
        </ul>
    </div>
    @endif
</footer>
