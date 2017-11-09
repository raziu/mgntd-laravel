MGNTD LARAVEL
====
Migration from Zend to Laravel

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 
See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
to do
```

### Installing

A step by step series of examples that tell you have to get a development env running

1. Make sure you've installed PHP >= 7
```
OSX: curl -s http://php-osx.liip.ch/install.sh | bash -s 7.0
```
2. Create application using stable Laravel in APPLICATION_DIRECTORY
```
composer create-project laravel/laravel APPLICATION_DIRECTORY --prefer-dist
```
3. Add auth module to application at the begining
```
cd test
php artisan make:auth
```
4. Create database tables
```
php artisan make:migration create_products_table --create=products
php artisan make:migration create_basket_table --create=baskets
...
```
5. Update database scheme
```
php artisan migrate
```
6. Create models
```
php artisan make:model Product
php artisan make:model Basket
...
```
7. Make a migration
```
php artisan make:migration 
```
8. Create controllers
```
php artisan make:controller BasketController
...
```
9. Social auth
Add to composer:
```
composer require laravel/socialite
```
config/app.php add:
```
'providers' => [
  //...
  Laravel\Socialite\SocialiteServiceProvider::class,
]
'aliases' => [
  //...
  'Socialite' => Laravel\Socialite\Facades\Socialite::class,
]
```
config/services.php add:
```
'instagram' => [
  'client_id' => env('INSTAGRAM_CLIENT'),
  'client_secret' => env('INSTAGRAM_SECRET'),
  'redirect' => env('INSTAGRAM_REDIRECT'),
],
```
Create new controller
```
php artisan make:controller SocialAuthInstagramController
```

Update composer with instagram provider:
composer require socialiteproviders/instagram

Create model:
php artisan make:model SocialAccounts -m
+
php artisan migrate:refresh


## Built With

* [Laravel Framework](https://laravel.com/docs) - The web framework used

## Authors

* **Tomasz Razik** - *Initial work* - [raziu](https://github.com/raziu)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* Inspiration
* etc