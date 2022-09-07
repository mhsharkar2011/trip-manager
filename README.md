## Setup project locally (Using Docker)
### Prerequisite
1. Docker and Docker Compose.
Install from [Docker Desktop](https://www.docker.com/products/docker-desktop/) and keep docker running.

### Steps
1. First clone this repo and CD into project root folder and run the following
```
git clone https://git.sandbox3000.com/itc/incubator/boilerplates/laravel-boilerplate.git
cd laravel-boilerplate
```

2. install the dependencies

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```


2. First time it will take some time to pull the images, when done check if the containers are running. You can view with 
```
docker ps
```

3. Run the following
```
cp .env.example .env \
&& touch database/database.sqlite \ 
&& ./vendor/bin/sail up \
&& ./vendor/bin/sail artisan migrate
```

3. At this point you should be able browse the site/app at
[http://127.0.0.1:54321](http://127.0.0.1:54321) 
 you should be able to see the home page.


## Deployment 
TBD


## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
