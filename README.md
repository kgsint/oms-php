# OMS

Simple order Managment System with PHP utilizing MVC pattern (note: this is not meant to be used in `production`)

## Installation and Setup 

```bash
composer install
```
copy `.env.example` to `.env`
```bash
cp .env.example .env
```
Create a local database called `order_ms` and export tables from `/sql/tables/`


To serve locally, simply run `php serve` or you can optionally run:
```bash
php -S localhost:<portnumber> -t public
```
To run the tests: 
```bash
./vendor/bin/pest
```
