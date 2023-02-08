# Table of Contents
<!-- TOC -->

- [Table of Contents](#table-of-contents)
- [Setup project locally Using Docker](#setup-project-locally-using-docker)
    - [1. Option #1 - Easy setup with PHP and MySQL services only](#1-option-1---easy-setup-with-php-and-mysql-services-only)
        - [1.1. Prerequisite](#11-prerequisite)
        - [1.2. Steps](#12-steps)
        - [1.3. Helper script like Laravel Sail](#13-helper-script-like-laravel-sail)
    - [2. Option #2 - Laravel Sail for BE developers with multiple needed services](#2-option-2---laravel-sail-for-be-developers-with-multiple-needed-services)
        - [2.1. Prerequisite](#21-prerequisite)
        - [2.2. Steps](#22-steps)
- [Boilerplate Features](#boilerplate-features)
    - [1. API Client](#1-api-client)
    - [2. Authentication](#2-authentication)
        - [2.1. Registration](#21-registration)
        - [2.2. Login](#22-login)
    - [3. Email verificaition](#3-email-verificaition)
    - [4. Forgot Password with verification code in email](#4-forgot-password-with-verification-code-in-email)
        - [4.1. Request a password reset - a code in the email will be sent](#41-request-a-password-reset---a-code-in-the-email-will-be-sent)
        - [4.2. Use the code received to update password](#42-use-the-code-received-to-update-password)
    - [5. Social Login](#5-social-login)
    - [6. Authorization](#6-authorization)
    - [7. CRUD API generator](#7-crud-api-generator)
        - [7.1. Option #1](#71-option-1)
        - [7.2. Option #2 recommended for dev](#72-option-2-recommended-for-dev)
    - [8. CRUD & Entity Relationships](#8-crud--entity-relationships)
    - [9. Attachments File uploads](#9-attachments-file-uploads)
    - [10. Pagination](#10-pagination)
    - [11. Filtering, Sorting & Selective Columns](#11-filtering-sorting--selective-columns)
    - [12. Events](#12-events)
        - [12.1. Local event](#121-local-event)
        - [12.2. Externalize Local event](#122-externalize-local-event)
    - [13. SaaS/Multi-tenancy](#13-saasmulti-tenancy)
- [Deployment](#deployment)

<!-- /TOC -->

# Setup project locally (Using Docker)

## 1. Option #1 - Easy setup with PHP and MySQL services only

### 1.1. Prerequisite
1. If you don't have Docker and Docker Compose already then
Install from [Docker Desktop](https://www.docker.com/products/docker-desktop/) and keep docker running.

### 1.2. Steps
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

6. For database client, PHPMyAdmin is readily available and can be accessed at the following URL

[http://127.0.0.1:8089](http://127.0.0.1:8089) 

If you want to use a different Database client, then you can use the following host and port to connect to it
```
Host: 127.0.0.1
Port: 33006
```
Get the database name, user and password from the `docker-compose-local.yml` file

### 1.3. Helper script like Laravel Sail
You will continuously need to run various commands in the php container, commands like `"php artisan migrate"`, `"composer require pckg/foo"` etc. 
Prefixing these with `docker-compose -f docker-compose.local.yml ....` is tedious, so there is a helper script `./cli` which is a copy of `./vendor/bin/sail` with some necessary adjustments which will proxy the commands to appropriate containers. To use it, give it execute permission and start using it like sail. 
```
chmod +x cli
./cli #will show available commands
```

Here are some examples:
```
./cli up -d
./cli php -v
./cli composer install
./cli art migrate:fresh --seed
./cli tinker
./cli bash
./cli mysql
```


## 2. Option #2 - Laravel Sail for BE developers with multiple needed services

### 2.1. Prerequisite
1. If you are using Windows you need to get Windows WSL2. Follow these instructions from [here](https://laravel.com/docs/9.x/installation#getting-started-on-windows). For Linux or Mac start from #2.

2. If you don't have Docker and Docker Compose already then
Install from [Docker Desktop](https://www.docker.com/products/docker-desktop/) and keep docker running.

### 2.2. Steps
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

## 1. API Client
We have a built in API client, named `Laravel Compass` which is a client like `Postman` that you can use to interact with the API's. Main benefits over Postman are, the routes in the app will show up automatically, a token can be selected by just clicking an icon, payloads and responses can be saved so that others don't have to type those again. All of these are very helpful and saves time.

To use it head over to [http://127.0.0.1:8800/devtools/api-explorer-compass](http://127.0.0.1:8800/devtools/api-explorer-compass) 

To Login, click `"Superadmin Login"` button. This doesn't require a email, password.

There are 2 pre-requisites to using Compass though:

1. Make sure `APP_URL` in `.env` has the correct URL to this app. If you are running the project with docker following Option#1 then it already should have the correct URL. The current `APP_URL` value is displayed in the home screen of `Laravel Compass`.

2. For routes that require token authentication, You have to go under the `Auth` tab for a route and select `bearer` and select a token. If no tokens are available in the list, you can generate one from [http://127.0.0.1:8800/devtools/artisangui-iframe](http://127.0.0.1:8800/devtools/artisangui-iframe), click `project:create-api-token`. After you generate the token, go back to `Laravel Compass` and in the `Auth > Bearer` tab, you can click the refresh icon and you will see it in the list, select and hit `Save Requeust`.


## 2. Authentication
`Register`, `Login`, `Forgot Password`, `Change Password` API are implemented. Request response details given below.
These can be found in the file `api.php`, the routes prefixed under `v1`.

For any route to require authentication, place it under the `auth:sanctum` middleware. You will see an example in the file `api.php`. 

### 2.1. Registration
```
POST /api/v1/register
```

payload
```
{
  "first_name": "john",
  "last_name": "doe",
  "email": "john@example.com",
  "password": "123456"
}
```
success response
```
{
	"status": "OK",
	"message": null,
	"data": {
		"first_name": "john",
		"last_name": "doe",
		"email": "john@example.com",
		"updated_at": "2023-01-17T18:24:25.000000Z",
		"created_at": "2023-01-17T18:24:25.000000Z",
		"id": <id>,
		"profile_photo_url": "https://ui-avatars.com/api/?name=&color=7F9CF5&background=EBF4FF"
	}
}
```

### 2.2. Login
```
POST `/api/v1/login`
```
payload
```
{
  "email": ""
  "password": ""
}
```

success response
```
{
    "status": "OK",
    "message": "",
    "companies": [
        {
            "company_code": null,
            "company_name": "ITC"
        }
    ],
    "roles": [],
    "session": {
        "access_token": "<token>",
        "session_last_access": 0,
        "session_start": 0
    },
    "user_info": {
        "id": ,
        "first_name": "",
        "last_name": "",
        "email": "",
        "email_verified_at": "",
        "current_team_id": ,
        "profile_photo_path": ,
        "role": ,
        "created_at": "",
        "updated_at": "",
        "recovery_code": ,
        "profile_photo_url": ""
    }
}
```
error response
```
{
    "status": "ERROR",
    "message": "Incorrect email or password.",
    "error_code": "RESOURCE_NOT_FOUND",
    "errors": []
}
```

## 3. Email verificaition
There isn't any separate API for this. After registration API call, BE sends the verification email.
And login API checks for if email verification has been done, if not then it sends a bad request response.

However, we should make the email verification check configurative (which helps in non prod environments). 

FE has probable issues however, for example, one issue is, even if backend sends an error response or exception, FE will redirect to registration success page, so assigning Shakil for more investigation.

## 4. Forgot Password (with verification code in email)
NOTE: Usually for password reset, a link in email is sent, clicking which get to a form from which you can reset your password. But we send a code instead of a link because, right now
if we are using a Quasar phone app build, once you leave the app and open the email client you can't get back to the app reset link automatically, hence we are using a code that you have to enter in the current screen.


### 4.1. Request a password reset - a code in the email will be sent
`GET /api/v1/forgot-password?email=<email>`

response
```
{
	"status": "OK",
	"message": "If the email exists in our system then an email has been sent with recovery steps."
}
```


### 4.2. Use the code received to update password

`POST /api/v1/forgot-password`

payload
```
{
	"email": "",
	"code": <code_received>,
	"new_password": "",
	"new_password_confirmation": ""
}
```


## 5. Social Login
Social login has been implemented using [Laravel Socialite](https://laravel.com/docs/socialite).
The following API is used to integrate with Frontend Frameworks

`GET /api/v1/login-social/<provider_name_here>?frontend_redirect_url=<frontend_app_url_here>`

for ITC Gitlab provider would be `"gitlab"` and if frontend app url is `example.com/autologin` then the above API would be:

```GET /api/v1/login-social/gitlab?frontend_redirect_url=example.com/autlogin```

Other providers supported out of the box are: TBD

## 6. Authorization
TBD

## 7. CRUD API generator

### 7.1. Option #1
For this option you have to fill out a form to generate the CRUD for an entity.
Head over to [http://127.0.0.1:8800/devtools/artisangui-iframe](http://127.0.0.1:8800/devtools/artisangui-iframe) and click `project:generate-crud`. 

Then use the form field hints to complete the form and click `Run`. It will show you list of files generated, you can verify by checking the codebase. You can also go to `Laravel Compass` and you will see the newly generated API's (click refresh icon if necessary) and can interact from there. When you commit the files for the CRUD, also commit the file `database.compass.sqlite` in repo. That way others will see the payloads and responses that you saved during development.

### 7.2. Option #2 (recommended for dev)
Generate the CRUD from a json file. This is actually more useful because usually development happens incrementally. 

Run the command `php artisan project:generate-crud-spec-file <entity_name>`

This would generate a sample json spec file and output the file path. You can then modify the file further and generate CRUD through the command `php artisan project:generate-crud-from-file`

The column types available are the following: 
* string
* char
* varchar
* date
* datetime
* time
* timestamp
* text
* mediumtext
* longtext
* json
* jsonb
* binary
* integer
* bigint
* mediumint
* tinyint
* smallint
* boolean
* decimal
* double
* float
* enum

## 8. CRUD & Entity Relationships
1. For a list API, for example, `GET /posts`, to load related data, add the query parameter `?with`. So for example, to load the category and user with each posts, use API endpoint like this `GET /posts?with=category,user`
2. .....TBD

## 9. Attachments (File uploads)
TBD

## 10. Pagination
1. All list API (e.g., `GET /posts`) are by default paginated. Here is an example response:
```
{
  "status": "OK",
  "message": "",
  "data": {
    "data": [
      {//actual data here}
    ],
    "total": 100,
    "per_page": 50, //default
    "from": 1,
    "to": 50,
    "current_page": 1,
    "last_page": 2
  }
}
```
To control pagination, use the following two query params
1. `items_per_page`
2. `page`

So an example would be `GET /posts?items_per_page=20&page=2`

## 11. Filtering, Sorting & Selective Columns
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
            "updated_at": {
                "op": "between",
                "type": "date",
                "val": "1\/1\/2017",
                "val2": "1\/1\/2018",
            },            
            "user_id": {
                "op": "empty"
            }
        }
    }
}
```

2. If no sorting params are found, then the default sorting is applied, which is `orderBy id desc`, which means latest items are shown on top, which is a good default in most cases.

## 12. Events

### 12.1. Local event
For local events, Follow Laravel default event mechanism
https://laravel.com/docs/9.x/events

### 12.2. Externalize Local event
All events we create under `App\Events` or `App\Providers` will be published to a RabbitMQ Broker.
We do this centrally through a catch all event listener in `EventServiceProvider`. For interacting with RabbitMQ we use our own `App\RabbitMQService` service class. So no extra code is necessary for this. So whatever local events we define under `App\Events` or `App\Providers` gets published to RabbitMQ by default.

If you want to receive some event/message from the RabbitMQ broker, local or external, doesn't matter, run the following artisan command `php artisan project:consume-rabbitmq-event`  
After running the command you will get more instruction propmted to you regarding required inputs.

If you need to do additional publish/listen for cross app events then use the following methods of the `App\RabbitMQService` class. 

This is an example code for publishing an event/msg

```
//publish
$routing_key = 'pmapp.card.update'; //this is an example, probable values are explained more later
RabbitMQService::publish($routing_key, $data_array);
```

This is an example code for consuming an event/msg
```
//consume/listen/subscribe
$routing_key = 'pmapp.#' //this is an example, probable values are explained more later
RabbitMQService::consume($routing_key, $callback);

$callback = function($msg) {
    logger('received event from broker: ' . $msg->delivery_info['routing_key'], (array) $msg->body);
    $msg->ack(); //only after ack() rabbitmq will delete the event/msg from queue
}
```
A bit more about routing key. We are using topic based RabbitMQ exchange, it is a list of words, delimited by dots and supports wildcards `(# and *)` in the key which helps consume selective events. Our convention for routing key is: ```<app_slug>.<entity>.<action>```, so some examples would be
```
pmapp.card.created
pmapp.card.state.changed
pmapp.project.state.changed
```

When consuming we can use following wildcards in routing key
```
* (star) can substitute for exactly one word.
# (hash) can substitute for zero or more words
```

Some examples of routing keys with wildcards
```
#                  -> all events
pmapp.#            -> all pmapp related events
pmapp.card.#       -> all pmapp card related events
pmapp.*.state.#    -> all pmapp state related events for any entity
```
You can read more about RabbitMQ topic exchange here
https://www.rabbitmq.com/tutorials/tutorial-five-php.html

For event data payload, our convention is the following:

```
{
  "attributes": {
    "event_name": "Any Name of Event",
    “event_key”: “<app>.<entity>....<sub_entity>.<action>” //pmapp.card.comment.updated     
    “event_id”: "<uuid>" 
    "event_source_app": "Application Name",
    "event_source_app_slug": "ApplicationName",
    "event_source_service_key": "app | email | notification | SMS …",
    "tenant_id": 2232,
    "account_id": 334, //billing
    "user_id": 9937,
    “user_ip”: 
    “server_ip”: 
    "entity_name": "users",
    "entity_primary_key": "id",
    "entity_primary_key_value": "id",
    "entity_url": "", 
    "event_time": "datetime_in_UTC"
    “call_stack_array”: [<arr_of_parent_event_ids>]
  },
  "data": "<json_actual_event_data>"
}
```

Here is a description of each of these attributes

| Attribute      | Description |
| ----------- | ----------- |
| event_name      | A readable name of the event. Something that would make sense to a human.        |
| event_key   | A slug for the event name, that can be used in code and won't change arbitrarily.        |
| event_id   | A UUID that uniquely identifies each event, there will be use cases where this would be neede, one for example can be when we need to mention the parent event for an event.         |
| event_source_app   | A readable name for the source app from where the event has originated        |
| event_source_app_slug   | A slug for the source app name that can be used in code and won't change arbitrarily.        |
| event_source_service_key   | TBD by Reza        |
| tenant_id   | Our apps are multi-tenant aware by default, so the current tenant id under which the event originated from.       |
| account_id   | TBD by Reza       |
| user_id   | Current user's id under which the event originated from, so in the context of an API call, the current user would be the corresponding user to the bearer token for the API call.         |
| user_ip   | Current user's IP, in the context of a PHP backend this would be "REMOTE_ADDR" from the event originating app/server        |
| server_ip   | IP of the server from where the event is being published.        |
| entity_name   | The actual event data payload can have arbitrary key values. So it's important for the originating app/service to mention the main entity for the event         |
| entity_primary_key   | For the same reason mentioned above.        |
| entity_primary_key_value   | Looks like this is redundant, TBD by Reza        |
| entity_url   | If the event has originated due to a API call, then the URI of that API call.        |
| event_time   | The date time in UTC or timestamp when the app/service is publishing the event. This is important/useful for many reasons, for example, you can see if there delay and by how much to receive an event, if an event can be deemed outdated etc.          |
| call_stack_array   | An array of the owing event ids. There would be use cases where events are being fired due to events being received thus forming a parent > child > children relationship. This attribute will store the event ids in order so the relationship is captured.          |

If you want to deploy RabbitMQ locally or on a server, use the file `docker-compose.rabbitmq.yml` under the folder `rabbitmq` in the project root, so something like 
```
docker-compose -f rabbitmq/docker-compose.rabbitmq.yml up
```  
There is no Dockerfile or other file dependency, so you can also copy the file or content anywhere and use it as needed. 

After deployment add the proper host, port, user, pass values in `.env`

```
RABBITMQ_HOST=
RABBITMQ_PORT=5670
RABBITMQ_USER=
RABBITMQ_PASSWORD=
```

If you want to know more about the way we use RabbitMQ, as in how and what type of exchange and queues we use, check the following doc, the doc also has POC repo link which you use to try it out as a separate project.
[Events POC - RabbitMQ](https://docs.google.com/document/d/1N1f-7kXIQJiEGDEGaDE9iYx_cf5Awey7qkNtfht87Mo/edit?usp=sharing)

**TODO**
* Push eloquent/model events - We can also do this. Since Laravel eloquent fires events, we can do a central eloquent event listener and push those to RabbitMQ.

## 13. SaaS/Multi-tenancy
TBD

# Deployment 
TBD


