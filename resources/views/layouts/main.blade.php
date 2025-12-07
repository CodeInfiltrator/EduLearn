<!DOCTYPE html>
<html lang="en">
<style>

/* ===== Smooth Scroll untuk seluruh website ===== */
html {
    scroll-behavior: smooth;
}

/* ===== NAVBAR ANIMATION ===== */
.navbar-nav .nav-link {
    position: relative;
    font-weight: 500;
    padding-bottom: 5px;
    color: rgba(255, 255, 255, 0.75);
    transition: 0.3s ease;
}

/* Underline defaultnya hidden */
.navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0%;
    height: 2px;
    background: #ffc107;
    border-radius: 5px;
    transition: width 0.35s ease-in-out;
}

/* Saat hover, underline muncul */
.navbar-nav .nav-link:hover::after {
    width: 100%;
}

/* Saat hover, warna link berubah elegan */
.navbar-nav .nav-link:hover {
    color: #ffffff !important;
}

/* Active link underline always visible */
.navbar-nav .nav-link.active::after {
    width: 100%;
}

.navbar-nav .nav-link.active {
    color: #ffffff !important;
    font-weight: 600;
}

.navbar-nav .nav-link.active::after {
    width: 100%;
}

body {
    opacity: 0.1;
    transition: opacity 0.6s ease-in-out;
}

body.loaded {
    opacity: 1;
}

img {
    opacity: 0.1;
    transition: opacity 0.8s ease-in-out;
}

img.loaded-image {
    opacity: 1;
}

nav.navbar {
    box-shadow: rgba(0, 0, 0, 0.12) 0px 4px 12px;
}

</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    @include('layouts.navbar')

    <div class="container py-4">
        @yield('content')
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    // Fade in whole page after content loaded
    window.addEventListener("load", function() {
        document.body.classList.add("loaded");

        // Fade-in for all images
        document.querySelectorAll("img").forEach(img => {
            if (img.complete) {
                img.classList.add("loaded-image");
            } else {
                img.addEventListener("load", () => {
                    img.classList.add("loaded-image");
                });
            }
        });
    });
</script>
</html>
