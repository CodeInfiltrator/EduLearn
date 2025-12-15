<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EduLearn - @yield('title', 'Home')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ----- global ----- */
        html { scroll-behavior: smooth; }
        body { opacity: 0; transition: opacity .45s ease, background-color .35s ease, color .25s ease; }
        body.loaded { opacity: 1; }

        /* ----- container ----- */
        .bg-light-custom { background: #f8f9fa; }

        /* ----- navbar tweaks ----- */
        .navbar-brand img { height: 28px; width: 28px; margin-right: 8px; }

        /* ----- navbar link fancy underline ----- */
        .navbar-nav .nav-link { position: relative; padding-bottom: 6px; transition: color .3s ease; color: rgba(0,0,0,.75); }
        .navbar-nav .nav-link::after { content: ""; position: absolute; left: 0; bottom: 0; width: 0; height: 2px; background: #ffc107; transition: width .32s ease; border-radius: 4px; }
        .navbar-nav .nav-link:hover { color: #000 !important; }
        .navbar-nav .nav-link:hover::after { width: 100%; }
        .navbar-nav .nav-link.active { color: #000 !important; }
        .navbar-nav .nav-link.active::after { width: 100%; }

        /* ----- hero card, cards, rounded ----- */
        .card-rounded { border-radius: 14px; }

        /* ----- image fade ----- */
        img { opacity: 0; transition: opacity .7s ease-in-out; }
        img.loaded-image { opacity: 1; }

        /* ========== DARK MODE (match admin) ========== */
        .dark-mode { background: #1c1c1e !important; color: #e5e5e7 !important; }
        .dark-mode .navbar { background: #111 !important; }
        .dark-mode .navbar .nav-link { color: #cfcfcf !important; }
        .dark-mode .navbar .nav-link.active { color: #fff !important; }
        .dark-mode .card { background: #2c2c2e; color: #e5e5e7; border: none; box-shadow: none; }
        .dark-mode .bg-light-custom { background: #171717 !important; }
        .dark-mode .footer { background: #131313 !important; color: #aaa; }
        .dark-mode .theme-icon { color: gold !important; }

        .dark-mode h1,
        .dark-mode h2,
        .dark-mode h3,
        .dark-mode h4,
        .dark-mode h5,
        .dark-mode h6,
        .dark-mode p,
        .dark-mode span,
        .dark-mode small,
        .dark-mode li,
        .dark-mode a {
            color: #ffffff !important;
        }

        /* Bootstrap muted text */
        .dark-mode .text-muted {
            color: #cfcfcf !important;
        }

        /* Card specific */
        .dark-mode .card-title,
        .dark-mode .card-text {
            color: #ffffff !important;
        }

        /* List group (teachers usually use this) */
        .dark-mode .list-group-item {
            background-color: #2c2c2e;
            color: #ffffff;
            border-color: #3a3a3c;
        }

        /* Tables (courses often use table) */
        .dark-mode table {
            background-color: #2c2c2e;
            color: #ffffff;
        }

        .dark-mode table th,
        .dark-mode table td {
            color: #ffffff !important;
            border-color: #3a3a3c;
        }

        /* small responsive tweaks */
        @media (max-width: 767px) {
            .hero-text { font-size: 1.15rem; }
        }
    </style>
</head>
<body class="bg-light-custom">

    @include('layouts.navbar')

    <main class="container py-4">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page load & image fade-in -->
    <script>
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');

            // Fade in images
            document.querySelectorAll('img').forEach(img => {
                if (img.complete) img.classList.add('loaded-image');
                else img.addEventListener('load', () => img.classList.add('loaded-image'));
            });
        });
    </script>

    <!-- Dark mode persistence (use the same key as admin for sync) -->
    <script>
        (function () {
            const key = 'edulearn_admin_theme'; // same key used in admin layout
            const saved = localStorage.getItem(key);

            // apply saved theme
            if (saved === 'dark') {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }

            // expose toggle function for navbar button
            window.toggleEduLearnTheme = function () {
                document.body.classList.toggle('dark-mode');
                const isDark = document.body.classList.contains('dark-mode');
                localStorage.setItem(key, isDark ? 'dark' : 'light');

                // update icon/text in navbar (if present)
                const icon = document.querySelector('#publicThemeIcon');
                const text = document.querySelector('#publicThemeText');
                if(icon && text) {
                    if(isDark) {
                        icon.className = 'bi bi-sun-fill theme-icon';
                        text.innerText = 'Light Mode';
                    } else {
                        icon.className = 'bi bi-moon theme-icon';
                        text.innerText = 'Dark Mode';
                    }
                }
            };

            // initialize public toggle UI if present
            document.addEventListener('DOMContentLoaded', function() {
                const icon = document.querySelector('#publicThemeIcon');
                const text = document.querySelector('#publicThemeText');
                if(icon && text) {
                    if(document.body.classList.contains('dark-mode')) {
                        icon.className = 'bi bi-sun-fill theme-icon';
                        text.innerText = 'Light Mode';
                    } else {
                        icon.className = 'bi bi-moon theme-icon';
                        text.innerText = 'Dark Mode';
                    }
                }
            });
        })();
    </script>

    {{-- allow page-specific scripts --}}
    @yield('scripts')
</body>
</html>
