<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-success justify-content-between">
        <a class="navbar-brand" href="#">{{ config('app.name', 'AFC DONATION') }}</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="#">@if(isset(session('company_account')->companyName)) {{session('company_account')->companyName}} @endif</a>

        <ul class="nav navbar-nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="#">{{ucfirst($auth->full_name)}} ( {{ucfirst($auth->user_type)}} )</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{url('logout')}}">Logout</a>
            </li>
        </ul>
    </nav>
</header>