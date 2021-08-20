<p align="center">
    <a href="https://b2b.mixon.ua/" target="_blank">
        <img src="https://b2b.mixon.ua/dist/img/logo-red.svg" width="400">
    </a>
</p>

----------

## Installation

Please check the official laravel installation guide for server requirements before you start.
[Official Documentation](https://laravel.com/docs/master)

- Clone the repository `git clone git@gitlab.com:Sheshlyuk/mixon-lk.git`
- Switch to the repo folder
- Install all the dependencies using composer and npm
- Copy the example env file and make the required configuration changes in the .env file
- Generate a new application key
- Run the database migrations (**Set the database connection in .env before migrating**)
- Run `npm run prod`
- Start the local development server
- Run the database seeder and you're done `php artisan db:seed`

# Code overview

## Main dependencies

### PHP

Name| 
---| 
laravel/framework| 
nwidart/laravel-modules| 
inertiajs/inertia-laravel|
maatwebsite/excel|


### JS

Name | 
--- | 
vue |
@inertiajs/inertia-vue3 |
bootstrap |
vee-validate |

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application
fully working.

## System requirements

* Nginx
* PHP 8+
* Node.js 14.15+, npm 6.14+
* MySQL 5.7 / MariaDB10.4
* Supervisor

Scheduler: `/path_to_php/php /project_path/artisan schedule:run`
