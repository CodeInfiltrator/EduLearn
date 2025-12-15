<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">

        <!-- BRAND -->
        <a class="navbar-brand d-flex align-items-center fw-bold fs-4" href="{{ url('/') }}" 
           style="color:#0d6efd; transition:.3s;">
            <img src="https://img.icons8.com/color/512/graduation-cap.png" 
                 alt="logo" width="32" height="32" class="me-2">
            EduLearn
        </a>

        <!-- MOBILE TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAV MENU -->
        <div class="collapse navbar-collapse" id="navmenu">

            <ul class="navbar-nav ms-auto align-items-center">

                <!-- PUBLIC NAV LINKS -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('courses*') ? 'active' : '' }}" href="{{ url('/courses') }}">
                        Courses
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="{{ url('/categories') }}">
                        Categories
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('teachers*') ? 'active' : '' }}" href="{{ url('/teachers') }}">
                        Teachers
                    </a>
                </li>

                <!-- ADMIN AUTH -->
                @auth
                    <li class="nav-item ms-3">
                        <a href="{{ url('/admin') }}" class="btn btn-outline-primary fw-semibold px-3">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger px-3">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-3">
                        <a href="{{ url('/admin/login') }}" class="btn btn-outline-primary fw-semibold px-3">
                            <i class="bi bi-shield-lock me-1"></i> Admin Panel
                        </a>
                    </li>
                @endauth

                <!-- DARK / LIGHT TOGGLE -->
                <li class="nav-item ms-3">
                    <button onclick="toggleEduLearnTheme()" 
                            class="btn btn-outline-secondary px-3 d-flex align-items-center">
                        <i id="publicThemeIcon" class="bi me-2"></i>
                        <span id="publicThemeText"></span>
                    </button>
                </li>

            </ul>
        </div>
    </div>
</nav>

<style>
    /* PREMIUM NAVBAR UI */
    .navbar-nav .nav-link {
        position: relative;
        padding-bottom: 6px;
        font-weight: 500;
        color: rgba(0,0,0,0.75);
        transition: color .25s ease;
    }

    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        left: 0; bottom: 0;
        width: 0; height: 2px;
        background: #0d6efd;
        border-radius: 3px;
        transition: width .25s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #000 !important;
    }

    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link.active::after {
        width: 100%;
    }

    .navbar-nav .nav-link.active {
        color: #000 !important;
        font-weight: 600;
    }

    /* DARK MODE */
    .dark-mode .navbar {
        background: #111 !important;
    }

    .dark-mode .navbar-brand {
        color: #fff !important;
    }

    .dark-mode .navbar-nav .nav-link {
        color: #d0d0d0 !important;
    }

    .dark-mode .navbar-nav .nav-link.active {
        color: #fff !important;
    }

    .dark-mode .navbar-nav .nav-link::after {
        background: gold !important;
    }
</style>
