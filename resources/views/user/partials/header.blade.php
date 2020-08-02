<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top fixedToTop" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/theme/logo.png') }}" width="80px" alt="{{ config('app.name', 'Laravel') }}">
        </a>

        <style>
            .nav-link {
                color: white !important;
            }

        </style>

        <button class="navbar-toggler nonauth" type="button" data-toggle="collapse" data-target="#guestMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="text-white" data-feather="menu"></span>
        </button>
        <div class="collapse navbar-collapse navbar-right" id="guestMenu">
            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav mr-5">
                    @foreach(header_menus() as $menu)
                    <li class="nav-item">

                        <a href="{{ $menu->link }}" target="_self" style="" class="nav-link">
                            <span>{{ $menu->name }}</span>
                        </a>
                    </li>
                    @endforeach

                </ul>

                @auth

                    @if(has_role('admin'))
                    <li>
                        <a href="/admin" class="btn btn-light px-4 py-2 border border-dark text-uppercase">Dashboard</a>
                    </li>
                    @endif

                @else

                    <li>
                        <a href="/login" class="btn btn-light px-4 py-2 border border-dark text-uppercase">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
