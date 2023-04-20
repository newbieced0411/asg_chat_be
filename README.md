Link for the frontend: 


# Create a database
Name: chat_db

# Install Dependencies
composer install

# Update the file format 
.env.example to .env
# Laravel Sanctum Authentication Setup
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# Migrations
php artisan migrate

# Seed the database
php artisan db:seed

# Run the server
php artisan serve