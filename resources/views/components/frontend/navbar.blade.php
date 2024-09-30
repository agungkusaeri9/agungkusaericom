<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand font-weight-bold text-dark" href="{{ route('home') }}">
                    {{ \Str::upper($setting->site_name) }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav justify-content-end">
                        <li class="nav-item @if (Route::currentRouteName() === 'home') active @endif"><a class="nav-link"
                                href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item @if (Route::currentRouteName() === 'about') active @endif"><a class="nav-link"
                                href="{{ route('about') }}">About</a></li>
                        <li class="nav-item @if (Route::currentRouteName() === 'projects.index' || Route::currentRouteName() === 'projects.show') active @endif"><a class="nav-link"
                                href="{{ route('projects.index') }}">Projects</a></li>
                        <li class="nav-item @if (Route::currentRouteName() === 'posts.index' || Route::currentRouteName() === 'posts.show') active @endif"><a class="nav-link"
                                href="{{ route('posts.index') }}">Blog</a></li>
                        <li class="nav-item @if (Route::currentRouteName() === 'contact.index') active @endif"><a class="nav-link"
                                href="{{ route('contact.index') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
