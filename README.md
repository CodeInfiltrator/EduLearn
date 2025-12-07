# EduLearn
🚀 EduLearn: Micro-Learning Platform (Supporting SDG 4) 

EduLearn is a simple, efficient, web-based micro-learning platform focused on providing concise and easily digestible educational materials. This project is built using the Laravel 11 framework for the backend and a responsive admin interface utilizing Bootstrap 5. It aims to address the challenge of limited access to brief educational materials and overly complex online learning.

✨ Core Features 

Category Management: Administrators can create, edit, and delete categories (e.g., Programming, Science, Design, Language) to organize learning materials.
Teacher Management: The system manages teacher data based on their field of expertise , allowing administrators to create, edit, and delete teachers. This connects materials to specific instructors to enhance content credibility.
Course Management: The core feature involves managing brief learning materials, including fields such as title, description (micro-learning notes), category_id, and teacher_id. Admin functions include CRUD (Create, Read, Update, Delete) operations for courses.
Public Course Display: Users (visitors) can freely access and browse all learning materials without needing to log in. Users can view the course list, course details, and browse courses by category or teacher.
Admin Dashboard: A feature that enables the Admin to manage all data through Blade Templates and Bootstrap, including data tables and input forms.
Database Relational Structure: Utilizes One-to-Many relationships: Category (1) - (N) Course and Teacher (1) - (N) Course.

💻 Technologies Used 

Backend: Laravel 11 
Database: MySQL 
Admin Interface: Bootstrap 5 & Blade Templates 
Other Tools: PHP 8+, Composer, FakerPHP (Seeder) 

🎯 Project Goal (SDG 4: Quality Education) 

EduLearn supports Sustainable Development Goal (SDG) 4: Quality Education by providing equitable access to digital learning, offering concise, micro-learning based materials, and supporting flexible, continuous learning through technology.
