# OMS

Simple order Managment System with PHP utilizing MVC pattern

## Installation and Setup 

clone this repo with `git clone https://github.com/kgsint/oms-php.git`
```bash
composer install
```
copy `.env.example` to `.env`
```bash
cp .env.example .env
```
Create a local database called `order_ms` and export tables from `/sql/tables/`


To serve locally, simply run 
```bash
php serve
```

or you can optionally run:
```bash
php -S localhost:<portnumber> -t public
```
To run the tests: 
```bash
./vendor/bin/pest
```
