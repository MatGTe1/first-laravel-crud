## Requirements

- Composer
- Node.js & npm
- MySQL

## Setup Instructions

1. Install PHP dependencies:

   composer install

2. Install JavaScript dependencies:

   npm install

3. Set up environment configuration:

   - Copy the example environment file:
     cp .env.example .env

   - Open the `.env` file and update the following fields with database settings:

     DB_DATABASE=your_database_name  
     DB_USERNAME=your_db_user  
     DB_PASSWORD=your_db_password

4. Generate application key:

   php artisan key:generate

5. Run database migrations:

   php artisan migrate

6. Start development servers use two terminals:

   Terminal 1:  
   php artisan serve

   Terminal 2:  
   npm run dev

## CRUD and Admin Panel Access

To access the admin panel and use CRUD at `/admin/dashboard`:

1. Register a new user through the application or insert a user into the `users` table.
2. In database, update the `usertype` column for that user to `admin`
