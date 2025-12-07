<nav class="navbar navbar-expand-lg navbar-dark" style="background:#0d6efd;">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/">
            <img src="https://img.icons8.com/color/512/graduation-cap.png" width="32" height="32">
            EduLearn
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navmenu" class="collapse navbar-collapse">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('courses*') ? 'active' : '' }}" href="/courses">Courses</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="/categories">Categories</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('teachers*') ? 'active' : '' }}" href="/teachers">Teachers</a></li>

                <li class="nav-item ms-4">
                    <a href="/admin/" class="btn btn-light fw-bold">
                        Admin
                    </a>
                </li>
            </ul>

        </div>

    </div>
</nav>
