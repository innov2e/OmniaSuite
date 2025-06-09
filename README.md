# OmniaSuite

<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

## About OmniaSuite

OmniaSuite is a comprehensive web application built with Laravel 12, designed to provide a modern and efficient solution for managing various aspects of business operations. The application leverages the power of Laravel's ecosystem along with Filament admin panel for a robust and user-friendly interface.

## Technical Stack

- **Framework:** Laravel 12.17.0
- **PHP Version:** 8.4.7
- **Database:** PostgreSQL
- **Admin Panel:** Filament v3.3.20
- **Authentication & Authorization:** Spatie Permissions v6.19.0
- **Frontend Components:** Livewire v3.6.3

## Key Features

- Modern admin interface powered by Filament
- Role-based access control using Spatie Permissions
- Real-time updates with Livewire
- PostgreSQL database for robust data management
- SMTP mail configuration for notifications
- File-based caching and session management

## Environment Configuration

- **Environment:** Local
- **Debug Mode:** Enabled
- **URL:** omniasuite.test
- **Timezone:** Europe/Rome
- **Locale:** Italian (it)

## Getting Started

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   ```
3. Set up your environment variables:
   ```bash
   cp .env.example .env
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Run database migrations:
   ```bash
   php artisan migrate
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```

## Development

The application uses several Laravel features and packages:

- Filament for admin panel management
- Spatie Permissions for role and permission management
- Livewire for dynamic frontend components
- PostgreSQL as the primary database
- SMTP for email functionality

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
