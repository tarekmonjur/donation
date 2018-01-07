
<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link @if($menu == '') active @endif" href="{{url('/')}}">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($menu == 'donations') active @endif" href="{{url('/donations')}}">Donation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($menu == 'logs') active @endif" href="{{url('/logs')}}">Logs</a>
        </li>
        {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#">Export</a>--}}
        {{--</li>--}}
    </ul>

    {{--<ul class="nav nav-pills flex-column">--}}
        {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#">Nav item</a>--}}
        {{--</li>--}}
        {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#">Nav item again</a>--}}
        {{--</li>--}}
        {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#">One more nav</a>--}}
        {{--</li>--}}
        {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#">Another nav item</a>--}}
        {{--</li>--}}
    {{--</ul>--}}
</nav>