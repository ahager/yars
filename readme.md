# YARS
## Yet Another Reservation System

[![ProjectStatus](http://stillmaintained.com/alariva/yars.png)](http://stillmaintained.com/alariva/yars)

> **Advice:** This project is on *alpha* stage under heavy development from scratch. You may collaborate as much as you will.

*YARS* is a web based reservations system under [Laravel 4 PHP Framework](http://github.com/laravel/framework).

So far, I've started *from scratch* to move a tiny-but-growing application called *xbooking* under [Code Igniter 2 PHP Framework](http://ellislab.com/codeigniter). You can see a [LIVE DEMO HERE](https://xbooking.com.ar/demo/) (demo:demo and cliente:cliente). This application is already working but has reached it's limits on scalability and maintainability of the code, and is only available in *spanish*.

The current milestone is getting the basic *Contact Address Book* working on clean code, while trying to achieve:

 - Isolated Business Logic from Controllers
 - Translation Ready files
 - Uniform HTML markup rendering on views

Despite this sounds very a basic goal, it's important to start from the very beginning considering these. This was not easy to achieve with Code Igniter when the app started to grow up.

This is just the beginning, stay tuned :)

## Roadmap

Please see [current milestones](https://github.com/alariva/yars/issues/milestones) to get a full *storytelling* of what is expected to be done.

## How to install *Quick Setup*
### Step 1: Get the code
#### Git Clone

    git clone https://github.com/alariva/yars.git yars

### Step 2: Use Composer to install dependencies

    cd yars
    curl -s http://getcomposer.org/installer | php
    php composer.phar install --dev

> You might want to make [composer be installed globally](http://andrewelkins.com/programming/php/setting-up-composer-globally-for-laravel-4/) for future ease of use.

### Step 3: Configure Database and Language

Update the file ***app/config/database.php***

Update the file ***app/config/app.php***

> **Available languages:** en, es

### Step 4: Populate Database

    php artisan migrate
    php artisan db:seed

### Step 5: Set Encryption Key

    php artisan key:generate

### Step 6: Make sure app/storage is writable by your web server.

    chmod -R 775 app/storage

Fallback:

    chmod -R 777 app/storage

## Step 7: Build Assets

Basset needs to build the assets.

    php artisan basset:build

## Step 8: Start Page

    php artisan serve

### User login

Navigate to your Laravel 4 website and login at /user/login:

    username : user
    password : user

### Admin login

Navigate to /admin

    username: admin
    password: admin

## Official Documentation

Documentation will be available soon.

### Contributing To YARS

**You are welcome to email me or interact with the Trello Board**

[YARS Roadmap Trello Board](https://trello.com/board/yars-yet-another-reservation-system/51ad53d426ed73393e0001f1)

[My Website](http://alariva.com/en/)

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
