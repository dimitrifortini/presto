# Presto

## Full-Stack E-Commerce Web Application

Presto is a full-stack e-commerce web application developed with **Laravel, PHP and MySQL**.

The project was created as a final web development project and focuses on building a complete online marketplace experience, combining a responsive frontend with a Laravel backend, authentication, database management and role-based functionality.

## ✨ Features

- User registration and authentication
- Product and category management
- Product search
- Shopping cart and checkout
- Order management
- User reviews and ratings
- Product moderation system
- Revisor role and article approval/rejection
- Rejection notifications via email
- User roles and permissions
- Responsive interface
- Dynamic navigation and categories
- Multilingual interface
- Database-driven content
- Form validation and server-side authorization
- CRUD operations

## 🛠️ Technologies

### Backend

- PHP
- Laravel
- MySQL
- Laravel Fortify
- Livewire
- TNTSearch

### Frontend

- Blade
- HTML5
- CSS3
- JavaScript
- Bootstrap
- Swiper
- Bootstrap Icons

### Tools

- Vite
- NPM
- Composer
- Git
- GitHub

## 📁 Project Structure

The application follows the standard Laravel architecture, with dedicated directories for:

- `app/` — application logic, models and controllers
- `database/` — migrations, factories and seeders
- `resources/` — Blade views, CSS and JavaScript
- `routes/` — application routes
- `public/` — public assets
- `config/` — application configuration
- `tests/` — automated tests

## 🌍 Languages

The application supports multiple languages:

- Italian
- English
- Spanish

## 👥 User Roles

### User

Users can:

- create and manage their listings
- browse available listings
- search for products
- add products to the cart
- place and manage orders
- leave reviews
- manage their profile

### Revisor

Revisors can:

- review submitted listings
- accept listings
- reject listings
- provide a rejection reason
- notify the listing author via email

### Admin

Administrators can manage:

- users
- listings
- orders
- application data

## 🎯 Project Goals

The main goal of the project was to develop a complete web application while applying the concepts learned throughout the web development course.

Particular attention was given to:

- MVC architecture
- Database relationships
- Authentication and authorization
- CRUD operations
- Server-side validation
- Search functionality
- Responsive UI design
- Role-based functionality
- Database management
- Reusable components
- Accessibility and semantic HTML

## 🚀 Installation

Clone the repository and install the PHP and JavaScript dependencies:

```bash
git clone https://github.com/dimitrifortini/presto.git
cd presto

composer install
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the database connection in the `.env` file and run the migrations:

```bash
php artisan migrate
```

If seeders are available, run:

```bash
php artisan db:seed
```

Build the frontend assets:

```bash
npm run build
```

Start the Laravel development server:

```bash
php artisan serve
```

For frontend development, run:

```bash
npm run dev
```

## 📚 About the Project

Presto was developed as a final project during the **Hackademy web development course at Aulab**.

The project was created to put full-stack web development concepts into practice, from database design and backend logic to frontend development, authentication, authorization and user interaction.

The application combines Laravel's MVC architecture with a responsive Bootstrap-based interface and a relational MySQL database.

---

**Developed by Dimitri Fortini**