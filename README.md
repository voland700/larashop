### Installation
```
Starter source:   git clone https://Drobkov@bitbucket.org/laravel-admin-starter/las-core.git
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

php artisan db:seed --class=CategoriesSeeder
php artisan db:seed --class=AttributeSeeder

admin@mail.mail
Pass123123
```
