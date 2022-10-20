# MY AYP API 1.0

## System Requirements

- Docker ^4.x
- Default ports [8082 (app) and 3308 (DB)] must be available, otherwise, it needs adjustment on the exposed ports.
- PHP >= 8.0
- Lumen >= 9.0

## Setup

- Copy environment files by running `cp .env.example .env`.
- Run `docker-compose up -d`.
- If there are no issues, your app should run `http://localhost:8082`.
- Your database should run on port `3308`. Here are the default credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=ayp-group
DB_USERNAME=root
DB_PASSWORD=ayp-group
```

## Installation

Please check the official Lumen installation guide for server requirements before you start. [Official Documentation](https://lumen.laravel.com/docs/5.5/installation)

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php -S localhost:8082 -t public

You can now access the server at http://localhost:8082

**TL;DR command list**

    composer install
    cp .env.example .env

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php -S localhost:8082 -t public

***Note*** : You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

# Database Design

Table `worker`

| **Name** 	 | **Type**     | **Attributes** | **Null** | **Extra**      |  
|------------|--------------|----------------|----------|----------------|
| id (pk)  	 | bigint(20)   | UNSIGNED 	     | No       | AUTO_INCREMENT |
| firstName  | varchar(255) |                | No       |                |  
| lastName 	 | varchar(255) |                | No       |                |
| email      | varchar(255) |                | No       |                |
| created_at | timestamp	|                | Yes      |                |
| updated_at | timestamp    |                | Yes      |                |

Table `employment`

| **Name** 	  | **Type**     | **Attributes** | **Null** | **Extra**      |  
|-------------|--------------|----------------|----------|----------------|
| id (pk)  	  | bigint(20)   | UNSIGNED 	  | No       | AUTO_INCREMENT |
| workerEmail | varchar(255) |                | No       |                |  
| companyName | varchar(255) |                | No       |                |
| jobTitle    | varchar(255) |                | No       |                |
| startDate   | date         |                | No       |                |
| endDate     | date         |                | Yes      |                |
| created_at  | timestamp	 |                | Yes      |                |
| updated_at  | timestamp    |                | Yes      |                |

pk = primary key

# Code overview

## Folders

- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the api controllers
- `database/migrations` - Contains all the database migrations
- `routes` - Contains all the api routes defined in web.php file
- `tests` - Contains all the application tests
- `tests/Feature` - Contains all the api tests

## Environment variables

- `.env` - Environment variables can be set in this file

# Testing API

Run the Lumen development server

    php -S localhost:8082 -t public

The api can now be accessed at

    http://localhost:8082

# API Endpoints

- `GET - /ayp-api/v1/worker` - Show all the workers with employment information
- `POST - /ayp-api/v1/worker` - Create a new worker
- `POST - /ayp-api/v1/employment` - Creating new employment for an employee (worker)
- `PATCH - /ayp-api/v1/employment` - Update the endDate of the worker employment

# Test Cases

- Test show all the workers with employment information

    `vendor/bin/phpunit --filter=testShowAllWorker`

- Test create a new worker

    `vendor/bin/phpunit --filter=testAddNewWorker`

- Test creating new employment for an employee (worker)

    `vendor/bin/phpunit --filter=testAddNewEmployment`

- Test update the endDate of the worker employment

    `vendor/bin/phpunit --filter=testUpdateEmployment`
