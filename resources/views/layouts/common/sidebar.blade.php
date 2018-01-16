
<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link @if($menu == '') active @endif" href="{{url('/')}}">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($menu == 'donations') active @endif" href="{{url('/donations')}}">Donation</a>
        </li>
        @if($auth->user_type != "support")
        <li class="nav-item">
            <a class="nav-link @if($menu == 'mr-list') active @endif" href="{{url('/mr-list')}}">MR List</a>
        </li>
        @endif

        @if($auth->user_type == "admin")
        <li class="nav-item">
            <a class="nav-link @if($menu == 'logs') active @endif" href="{{url('/logs')}}">Logs</a>
        </li>
        @endif
    </ul>
</nav>