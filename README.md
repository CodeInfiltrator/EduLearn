<h1 align="center">🎓 EduLearn</h1>
<p align="center">
  <b>Modern E-Learning Platform</b>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red" />
  <img src="https://img.shields.io/badge/PHP-8.4-blue" />
  <img src="https://img.shields.io/badge/Bootstrap-5.3-purple" />
  <img src="https://img.shields.io/badge/Status-Active%20Development-success" />
</p>

<hr/>

<h2>📌 Project Overview</h2>

<p>
<b>EduLearn</b> adalah platform pembelajaran online berbasis web yang dirancang
dengan pendekatan <i>modern UI/UX</i>, mendukung <b>Dark Mode</b>, serta dilengkapi
<b>Admin Dashboard profesional</b> untuk mengelola konten pembelajaran.
</p>

<p>
Project ini dikembangkan menggunakan <b>Laravel 11</b> dan <b>Bootstrap 5</b>
dengan fokus pada:
</p>

<ul>
  <li>Struktur kode yang rapi & scalable</li>
  <li>Pengalaman pengguna yang smooth & premium</li>
  <li>Separation antara halaman publik & admin</li>
</ul>

<hr/>

<h2>✨ Key Features</h2>

<h3>🌐 Public (User Side)</h3>
<ul>
  <li>Homepage dengan <b>hero background dinamis</b></li>
  <li>Daftar Courses, Categories, dan Teachers</li>
  <li>Dark Mode & Light Mode (persist via LocalStorage)</li>
  <li>Navbar premium dengan smooth transition & underline animation</li>
  <li>Responsive design (mobile-friendly)</li>
</ul>

<h3>🛠️ Admin Panel</h3>
<ul>
  <li>Admin Login Authentication</li>
  <li>Modern Admin Dashboard</li>
  <li>CRUD Categories, Teachers, Courses</li>
  <li>Modal-based Create & Edit (tanpa reload halaman)</li>
  <li>Toast notification (success & error)</li>
  <li>Dark Mode sync dengan halaman public</li>
</ul>

<hr/>

<h2>🎨 UI / UX Highlights</h2>

<ul>
  <li>Premium navbar dengan hover underline</li>
  <li>Smooth page transition & image fade-in</li>
  <li>Modern cards dengan hover animation</li>
  <li>Dark Mode yang konsisten di seluruh halaman</li>
</ul>

<hr/>

<h2>🧱 Tech Stack</h2>

<ul>
  <li><b>Framework:</b> Laravel 11</li>
  <li><b>Language:</b> PHP 8.4</li>
  <li><b>Frontend:</b> Blade, Bootstrap 5.3</li>
  <li><b>Icons:</b> Bootstrap Icons</li>
  <li><b>Editor:</b> TinyMCE</li>
  <li><b>Database:</b> MySQL</li>
  <li><b>Version Control:</b> Git & GitHub</li>
</ul>

<hr/>

<h2>📂 Project Structure (Simplified)</h2>

<pre>
app/
 └── Http/Controllers/
     └── Admin/
         ├── DashboardController.php
         ├── CourseController.php
         ├── CategoryController.php
         └── TeacherController.php

resources/views/
 ├── layouts/
 ├── admin/
 ├── home.blade.php
 ├── courses/
 ├── categories/
 └── teachers/
</pre>

<hr/>

<h2>🔐 Admin Access</h2>

<p>
Admin panel hanya dapat diakses setelah login.
</p>

<p>
Default admin (development):
</p>

<ul>
  <li>Email: <b>admin@edulearn.com</b></li>
  <li>Password: <b>admin123</b></li>
</ul>

<p><i>*Password sebaiknya diganti saat production</i></p>

<hr/>

<h2>🚀 Installation & Run</h2>

<pre>
git clone https://github.com/CodeInfiltrator/EduLearn.git
cd EduLearn
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
</pre>

<hr/>

<h2>📈 Development Progress</h2>

<ul>
  <li>✔ Public Pages (Home, Courses, Categories, Teachers)</li>
  <li>✔ Admin Dashboard</li>
  <li>✔ CRUD System</li>
  <li>✔ Dark Mode Sync</li>
  <li>✔ Authentication</li>
  <li>⬜ Deployment (coming soon)</li>
</ul>

<hr/>

<h2>🎯 Goals</h2>

<p>
EduLearn dikembangkan sebagai:
</p>

<ul>
  <li>Project akademik dengan nilai maksimal</li>
  <li>Portfolio web developer profesional</li>
  <li>Fondasi untuk pengembangan e-learning system skala besar</li>
</ul>

<hr/>

<h2>👤 Author</h2>

<p>
<b>Darren</b><br/>
Informatics Student & Aspiring Software Engineer
</p>

<p>
GitHub: <a href="https://github.com/CodeInfiltrator">https://github.com/CodeInfiltrator</a>
</p>

<hr/>

<p align="center">
✨ <b>EduLearn — Learn Smart, Learn Better</b> ✨
</p>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> 65a1705 (Initial EduLearn project with admin dashboard and CRUD)
