<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Laravel Gigs App

Laragigs is a web application to listing jobs using Laravel framework with MySQL database, created during studying Laravel course by Brad Traversy.

## Why Did I Build This?

This project marks my entry into Laravel, one of the most widely used PHP frameworks. The goal was to learn the basics of Laravel before tackling on more complex things.

## Features

- Full user authentication.
- Server side form validation.
- Create listing jobs with the ability to edit and delete them.
- Uploading images.
- Search for a job using keywords.

## Getting Started

To run this project locally, follow these steps:

1. Clone the repository:

```
git clone <repository-url>
```

2. Database Setup + Add Dummy Data

```
php artisan migrate
php artisan db:seed
```

3. File Uploading

```
php artisan storage:link
```

4. Run The App On http://127.0.0.1:8000/

```
php artisan serve
```

## Requirments

-   PHP
-   Composer
-   Laravel

*NOTE* : Don't forget to run the MySQL server.
