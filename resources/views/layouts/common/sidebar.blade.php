
<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link @if($menu == '') active @endif" href="{{url('/')}}">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($menu == 'donations') active @endif" href="{{url('/donations')}}">Donation</a>
        </li>

        @if($auth->user_type == "admin" || $auth->user_type == "company")
            <li class="nav-item">
                <a class="nav-link @if($menu == 'mr-list') active @endif" href="{{url('/mr-list')}}">MR List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($menu == 'doctors-program') active @endif" href="{{url('/doctors-program')}}">Doctor Program</a>
            </li>
        @endif

        @if($auth->user_type == "company")
            <li class="nav-item">
                <a class="nav-link @if($menu == 'coupons') active @endif" href="{{url('/coupons')}}">Coupons</a>
            </li>
        @endif

        @if($auth->user_type == "admin")
            <li class="nav-item">
                <a class="nav-link @if($menu == 'coupon-manager') active @endif" href="{{url('/coupon-manager')}}">Coupon Manage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($menu == 'company-account') active @endif" href="{{url('/company-account')}}">Company Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($menu == 'logs') active @endif" href="{{url('/logs')}}">Logs</a>
            </li>
        @endif
    </ul>
</nav>