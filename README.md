## About

This repo contains an simple Project Management App, that's build with Laravel 5.5.


## Features
* Login, Register Etc
* Admin & User role 
* User just can access his own project and task
* Admin can access all project and task but can't modify or delete 
* Ajax select dropdwon and Datepicker
* CRUD Companies, Projects, Tasks, and Comments

## Use Case Diagram

![UseCase](https://i.imgur.com/kUe1ZNZ.png)

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

* Note

Change role_id on users tabel value to 1 for set as Admin, because that default is 3

**Run Application**

	php artisan serve

## Screenshot

* Company Index

![CompanyIndex](https://i.imgur.com/9OCKa3M.png)

* Company detail

![CompanyDetail](https://i.imgur.com/D5aeb94.png)

* Project Index

![ProjectIndex](https://i.imgur.com/qXtOhZ7.png)

* Project Detail

![ProjectDetail](https://i.imgur.com/L8fQwD2.png)

* User Project detail page viewed by admin

![ViewedByAdmin](https://i.imgur.com/m3YzTOZ.png)






