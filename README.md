## Installing dependencies

Clone the project, open terminal, go to the project path ...

```bash
$ composer install
```

## Running the app

```bash
$ php artisan serve

```
## Create the file .env

copy the file .env.exemple and rename in .env

## First running

### Setup database connection

We are using MongoDB, so in order to use it with Laravel, we have to add a mongoDB driver for php.

Follow these steps :
+ Download the mongoDB PHP driver at this link :

  [MongoDB PHP driver Link](https://www.php.net/manual/fr/mongodb.setup.php)
  
+ Go to your php.ini and add your driver :

```bash
extension=mongodb 

```

### Migrate database

```bash
$ php artisan migrate

```

### Seed database

```bash
$ php artisan db:seed

```

## NEED A HELP 

[let us talk here](https://www.messenger.com/t/1920364741398702)

## Hope all is fine for you!!
