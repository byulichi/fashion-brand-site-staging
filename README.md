## System Requirements

- PHP
- Composer
- Node.js and npm

## Initial Setup
- `composer install` (php dependencies)
- `npm install` (npm package dependencies)
- `cp .env.example .env` (setup env)
- `php artisan key:generate`
- `php artisan migrate:fresh --seed` (database setup)
- `npm run dev`
- `php artisan serve` (on a different terminal)
- `php artisan migrate:fresh --seed` (migrate and seed data)
