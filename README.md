# El Hinnawi Ecommerce System
Welcome to El Hinnawi, your one-stop destination for all your automotive needs. Discover a comprehensive selection of high-quality auto parts and accessories, carefully curated to cater to the diverse requirements of car enthusiasts and mechanics alike.
(demo)[https://saico.rf.gd/]
## Getting started
### Installation

Clone the repository
```
git clone https://github.com/saicOo/laravel-ecommerce-spare-parts.git
```
Switch to the repo folder
```
cd laravel-ecommerce-spare-parts
```
Install all the dependencies using composer
```
composer install
```
Copy the example env file and make the required configuration changes in the .env file
```
cp .env.example .env
```
Generate a new application key
```
php artisan key:generate
```
Run the database migrations (Set the database connection in .env before migrating)
```
php artisan migrate:fresh --seed
```
Start the local development server
```
php artisan serve
```

