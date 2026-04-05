# AyoNgekost - Kos Kosan Management System

AyoNgekost is a web-based application for managing kos-kosan (boarding house) operations, built with Laravel and Filament.

## Features

- **Room Management**: Manage rooms, room types, and availability
- **Tenant Management**: Handle tenant registration and profiles
- **Payment Verification**: Verify and track rental payments
- **Virtual Tour**: 360° VR room tours
- **Reviews & Ratings**: Tenant reviews for rooms
- **Invoice Generation**: PDF invoice generation for payments

## Tech Stack

- **Backend**: Laravel 10.x
- **Admin Panel**: Filament
- **Database**: PostgreSQL
- **Storage**: AWS S3 (for images)
- **Frontend**: TailwindCSS, Flowbite

## Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- PostgreSQL
- AWS S3 Bucket

## Installation

1. Clone the repository:
```bash
git clone git@github.com:FuukaSyafiq/koskosan.git
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Configure environment:
```bash
cp .env.example .env
```

4. Update `.env` with your database and S3 credentials:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ayongekost
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

AWS_ACCESS_KEY_ID=your_aws_key
AWS_SECRET_ACCESS_KEY=your_aws_secret
AWS_DEFAULT_REGION=your_region
AWS_BUCKET=your_bucket_name
AWS_URL=your_s3_url
```

5. Generate key and run migrations:
```bash
php artisan key:generate
php artisan migrate
```

6. Seed the database:
```bash
php artisan db:seed --class=InitSeeder
```

7. Build assets:
```bash
npm run build
```

## Development Server

```bash
php artisan serve
```

## Default Credentials

After seeding:
- **Owner**: admin@gmail.com / password
- **Tenant**: penyewa@gmail.com / password

## Project Structure

```
app/
├── Filament/          # Admin panel resources
├── Helpers/           # Utility classes (StoreImages, DeleteImages, etc.)
├── Http/Controllers/  # Controllers
└── Models/            # Eloquent models

database/
├── migrations/        # Database migrations
└── seeders/          # Database seeders

resources/
└── views/            # Blade templates
```

## License

MIT License