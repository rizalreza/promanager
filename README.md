## About

This repo contains an simple Project Management App, that's build with Laravel 5.5.


## Features
* Login, Register Etc
* Admin & User role 
* User just can access his own project and task
* Admin can access all project and task but can't modify or delete 
* Ajax select dropdwon and Datepicker
* CRUD Companies, Projects, Tasks, and Comments

## How To Use

**Clone this Repo**

	git clone https://github.com/rizalreza/promanager.git

**Setup Database**

* Create new database
* Edit credentials database on .env file	

		DB_DATABASENAME=
		DB_USERNAME=
		DB_PASSWORD=

* Migrate	

		php artisan migrate

**Run Application**

	php artisan serve






