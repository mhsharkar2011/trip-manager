### 1.1. Prerequisite

1. If you don't have Docker and Docker Compose already then
   Install from [Docker Desktop](https://www.docker.com/products/docker-desktop/) and keep docker running.

### 1.2. Steps

1. First clone this repo and CD into project root folder and run the following

```
git clone https://github.com/mhsharkar2011/trip-manager.git \
&& cd trip-manager \
&& docker-compose -f docker-compose.local.yml up -d
```

2. Then run the following to install Laravel dependencies and then some other required steps

```
docker-compose -f docker-compose.local.yml exec www composer install \
&& docker-compose -f docker-compose.local.yml exec www php artisan project:setup
```

3. At this point you should be able browse the site/app at
   [http://127.0.0.1:8803](http://127.0.0.1:8800)
   you should be able to see the home page.

4. For database client, PHPMyAdmin is readily available and can be accessed at the following URL

[http://127.0.0.1:8093](http://127.0.0.1:8089)

If you want to use a different Database client, then you can use the following host and port to connect to it

```
Host: 127.0.0.1
Port: 33006
```

Get the database name, user and password from the `docker-compose-local.yml`.


### Project Demo
![Screenshot from 2023-08-27 00-58-41](https://github.com/mhsharkar2011/trip-manager/assets/51879416/67bb758e-2f8f-41e9-93a4-eb827b7a5fce)

![Screenshot from 2023-08-27 00-58-55](https://github.com/mhsharkar2011/trip-manager/assets/51879416/71216e7f-2c9d-4efb-b324-1907a838a7fe)

![Screenshot from 2023-08-27 00-59-05](https://github.com/mhsharkar2011/trip-manager/assets/51879416/fd92bba4-d37c-4a6e-8b77-0afd36ec4284)
