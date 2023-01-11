# Setup project locally (Using Docker)

## Option #1 - Easy setup with PHP and MySQL services only

### Prerequisite
1. If you don't have Docker and Docker Compose already then
Install from [Docker Desktop](https://www.docker.com/products/docker-desktop/) and keep docker running.

### Steps
1. First clone this repo and CD into project root folder and run the following
```
git clone https://git.sandbox3000.com/itc/incubator/boilerplates/laravel-boilerplate.git \
&& cd laravel-boilerplate \
&& docker-compose -f docker-compose.local.yml up -d
```
2. Then run the following to install Laravel dependencies and then some other required steps
```
docker-compose -f docker-compose.local.yml exec www composer install \
&& docker-compose -f docker-compose.local.yml exec www php artisan project:setup
```

5. At this point you should be able browse the site/app at
[http://127.0.0.1:8800](http://127.0.0.1:8800) 
 you should be able to see the home page.

6. For database you can use a mysql client and connect to it
```
Host: 127.0.0.1
Port: 53306
```
Get the database name, user and password from the `docker-compose-local.yml` file

## Option #2 - Laravel Sail for BE developers with multiple needed services
### Prerequisite
1. If you are using Windows you need to get Windows WSL2. Follow these instructions from [here](https://laravel.com/docs/9.x/installation#getting-started-on-windows). For Linux or Mac start from #2.

2. If you don't have Docker and Docker Compose already then
Install from [Docker Desktop](https://www.docker.com/products/docker-desktop/) and keep docker running.

### Steps
1. First clone this repo and CD into project root folder and run the following
```
git clone https://git.sandbox3000.com/itc/incubator/boilerplates/laravel-boilerplate.git \
&& cd laravel-boilerplate \
&& cp .env.example .env \
&& touch database/database.sqlite
```

2. Install Laravel dependencies
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

3. Run the following
```
./vendor/bin/sail up -d \
&& ./vendor/bin/sail artisan migrate
```

4. First time it will take some time to pull the images, when done check if the containers are running. You can view with 
```
docker ps
```

5. At this point you should be able browse the site/app at
[http://127.0.0.1:54321](http://127.0.0.1:54321) 
 you should be able to see the home page.

# Boilerplate Features

# API Client
We have a built in API client, named `Laravel Compass` which is a client like `Postman` that you can use to interact with the API's. Main benefits over Postman are, the routes in the app will show up automatically, a token can be selected by just clicking an icon, payloads and responses can be saved so that others don't have to type those again. All of these are very helpful and saves time.

To use it head over to [http://127.0.0.1:8800/devtools/api-explorer-compass](http://127.0.0.1:8800/devtools/api-explorer-compass) 

To Login, click `"Superadmin Login"` button. This doesn't require a email, password.

There are 2 pre-requisites to using Compass though:

1. Make sure `APP_URL` in `.env` has the correct URL to this app. If you are running the project with docker following Option#1 then it already should have the correct URL. The current `APP_URL` value is displayed in the home screen of `Laravel Compass`.

2. For routes that require token authentication, You have to go under the `Auth` tab for a route and select `bearer` and select a token. If no tokens are available in the list, you can generate one from [http://127.0.0.1:8800/devtools/artisangui-iframe](http://127.0.0.1:8800/devtools/artisangui-iframe), click `project:create-api-token`. After you generate the token, go back to `Laravel Compass` and in the `Auth > Bearer` tab, you can click the refresh icon and you will see it in the list, select and hit `Save Requeust`.


# Authentication
`Register`, `Login`, `Forgot Password`, `Change Password` API are implemented. 
These can be found in the file `api.php`, the routes prefixed under `v1`.

For any route to require authentication, place it under the `auth:sanctum` middleware. You will see an example in the file `api.php`. 

# Authorization
TBD

# CRUD API generator
## Option #1
For this option you have to fill out a form to generate the CRUD for an entity.
Head over to [http://127.0.0.1:8800/devtools/artisangui-iframe](http://127.0.0.1:8800/devtools/artisangui-iframe) and click `project:generate-crud`. 

Then use the form field hints to complete the form and click `Run`. It will show you list of files generated, you can verify by checking the codebase. You can also go to `Laravel Compass` and you will see the newly generated API's (click refresh icon if necessary) and can interact from there. When you commit the files for the CRUD, also commit the file `database.compass.sqlite` in repo. That way others will see the payloads and responses that you saved during development.

## Option #2 (recommended for dev)
Generate the CRUD from a json file. This is actually more useful because usually development happens incrementally. 

Run the command `php artisan project:generate-crud-spec-file <entity_name>`

This would generate a sample json spec file and output the file path. You can then modify the file further and generate CRUD through the command `php artisan project:generate-crud-from-file`

# CRUD & Entity Relationships
1. For a list API, for example, `GET /posts`, to load related data, add the query parameter `?with`. So for example, to load the category and user with each posts, use API endpoint like this `GET /posts?with=category,user`
2. .....TBD

# Attachments (File uploads)
TBD
# Filtering, Sorting & Selected Columns
1. Filtering, sorting will work on any list API (e.g., `GET /posts`). Here is an example request query param and format. For now, only main entity props are supported, related entities are not supported yet but is coming.
```
{
    "query": {
        "sort": {
            "created_at": "desc",
            "firstname": "asc"
        },
        "columns": [
            "id",
            "firstname",
            "lastname"
        ],
        "filters": {
            "firstname": {
                "op": "contains",
                "val": "john"
            },
            "status": "active",
            "created_at": {
                "op": "gt",
                "type": "date",
                "val": "1\/1\/2017"
            },
            "user_id": {
                "op": "empty"
            }
        }
    }
}
```

# Events
## Local event
For local events, Follow Laravel default event mechanism
https://laravel.com/docs/9.x/events

## Externalize Local event
All events we create under `App\Events` will be published to a RabbitMQ Broker.
We do this centrally through a catch all event listener in `EventServiceProvider`. For interacting with RabbitMQ we use our own `App\RabbitMQService` service class. So no extra code is necessary for this. So whatever local events we define under `App\Events` gets published to RabbitMQ by default.

If you want to receive some event/message from the RabbitMQ broker, local or external, doesn't matter, run the following artisan command `php artisan project:consume-rabbitmq-event`  
After running you will get more instruction regarding required inputs.

If you want to deploy RabbitMQ locally or on a server, use the file `docker-compose.rabbitmq.yml` under the folder `rabbitmq` in the project root, so something like 
```
docker-compose -f rabbitmq/docker-compose.rabbitmq.yml up
```  
There is no Dockerfile or other file dependency, so you can also copy the file or content anywhere and use it as needed. 

If you want to know more about the way we use RabbitMQ, as in how and what type of exchange and queues we use, check the following doc, the doc also has POC repo link which you use to try it out as a separate project.
[Events POC - RabbitMQ](https://docs.google.com/document/d/1N1f-7kXIQJiEGDEGaDE9iYx_cf5Awey7qkNtfht87Mo/edit?usp=sharing)

**TODO**
* Push eloquent/model events - We can also do this. Since Laravel eloquent fires events, we can do a central eloquent event listener and push those to RabbitMQ.

## SaaS/Multi-tenancy
TBD

# Deployment 
TBD


# Laravel PHP Framework

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
