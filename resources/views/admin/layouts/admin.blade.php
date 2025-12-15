<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn Admin</title>

    <!-- CSRF META -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>

/* ============================= */
/* GLOBAL SMOOTH TRANSITION      */
/* ============================= */
body {
    opacity: 0;
    transition: opacity .5s ease, background-color .4s ease, color .3s ease;
}
body.loaded {
    opacity: 1;
}

/* ============================= */
/* SIDEBAR                       */
/* ============================= */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    background: #0d6efd;
    padding-top: 20px;
    transition: .3s;
}

.sidebar .nav-link {
    color: rgba(255,255,255,0.85);
    margin-bottom: 8px;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    transition: .3s;
}

.sidebar .nav-link:hover {
    background: rgba(255,255,255,0.15);
    color: #fff;
}

.sidebar .nav-link.active {
    background: #fff;
    color: #0d6efd;
    font-weight: 600;
}

/* ============================= */
/* MAIN CONTENT                  */
/* ============================= */
.main-content {
    margin-left: 250px;
    padding: 25px;
}

/* ============================= */
/* TOP NAVBAR                    */
/* ============================= */
.admin-topbar {
    background: white;
    box-shadow: rgba(0,0,0,0.1) 0px 2px 6px;
    padding: 12px 22px;
    position: sticky;
    top: 0;
    z-index: 10;
    transition: .3s;
}

/* ============================= */
/* MODERN CARDS                  */
/* ============================= */
.card-modern {
    border-radius: 14px;
    padding: 20px;
    background: white;
    border: none;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
    transition: .3s;
    cursor: pointer;
}

.card-modern:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.14);
}

/* ============================= */
/* DARK MODE                     */
/* ============================= */
.dark-mode {
    background: #1c1c1e !important;
    color: #e5e5e7 !important;
}

/* Sidebar */
.dark-mode .sidebar {
    background: #0f0f0f;
}

.dark-mode .sidebar .nav-link {
    color: #ccc;
}

.dark-mode .sidebar .nav-link.active {
    background: #e5e5e7;
    color: #111;
}

/* Topbar */
.dark-mode .admin-topbar {
    background: #2c2c2e;
    color: white;
}

/* Cards */
.dark-mode .card-modern {
    background: #2c2c2e;
    color: white;
    box-shadow: none !important;
}

/* Smooth change for icons */
.dark-mode .theme-icon {
    color: gold !important;
}

.sidebar h4 a:hover {
    color: #d0e7ff;
    transition: .3s;
}

</style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center mb-4">
            <a href="/" class="text-white text-decoration-none fw-bold" style="font-size:20px;">
                EduLearn
            </a>
        </h4>

        <nav class="nav flex-column">
            <a href="/admin" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>

            <a href="/admin/categories" class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
                <i class="bi bi-tags me-2"></i> Categories
            </a>

            <a href="/admin/teachers" class="nav-link {{ Request::is('admin/teachers*') ? 'active' : '' }}">
                <i class="bi bi-person-badge me-2"></i> Teachers
            </a>

            <a href="/admin/courses" class="nav-link {{ Request::is('admin/courses*') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark-fill me-2"></i> Courses
            </a>
        </nav>
    </div>

    <!-- MAIN -->
    <div class="main-content">

        <!-- TOPBAR -->
        <div class="admin-topbar d-flex justify-content-between align-items-center mb-4">
            <h5 class="m-0 fw-bold">Admin Dashboard</h5>

            <button id="darkToggle" class="btn btn-dark btn-sm d-flex align-items-center gap-1">
                <i id="themeIcon" class="bi bi-moon theme-icon"></i>
                <span id="themeText">Dark Mode</span>
            </button>
        </div>

        @yield('content')
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
/* ================================== */
/* PAGE LOAD SMOOTH ANIMATION        */
/* ================================== */
document.body.classList.add("loaded");

/* ================================== */
/*  DARK / LIGHT MODE PERSISTENCE     */
/* ================================== */
(function () {
    const savedTheme = localStorage.getItem("edulearn_admin_theme");

    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");
    }

    updateThemeUI();
})();

/* BUTTON CLICK */
document.getElementById("darkToggle").addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");

    const mode = document.body.classList.contains("dark-mode") ? "dark" : "light";
    localStorage.setItem("edulearn_admin_theme", mode);

    updateThemeUI();
});

/* Update Icon + Text */
function updateThemeUI() {
    let icon = document.getElementById("themeIcon");
    let text = document.getElementById("themeText");

    if (document.body.classList.contains("dark-mode")) {
        icon.className = "bi bi-sun-fill theme-icon";
        text.innerText = "Light Mode";
    } else {
        icon.className = "bi bi-moon theme-icon";
        text.innerText = "Dark Mode";
    }
}

/* ================================== */
/* AUTO INJECT CSRF TOKEN TO FETCH    */
/* ================================== */
(function () {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    const originalFetch = window.fetch;

    window.fetch = function (input, init = {}) {
        init.headers = init.headers || {};
        init.headers["X-CSRF-TOKEN"] = token;

        return originalFetch(input, init);
    };
})();

/* ================================== */
/* YIELD PAGE-SPECIFIC SCRIPTS        */
/* ================================== */
</script>

@yield('scripts')

</body>
</html>
