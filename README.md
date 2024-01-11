# OMS

Simple order management system with PHP utilizing MVC pattern

## Requirement 
`php >= 8.2`

## Installation and Setup 

clone this repo with:
```bash
git clone https://github.com/kgsint/oms-php.git
```

And then, run:
```bash
composer setup
```

Create a local database called `order_ms` and import tables from `/sql/tables/`


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
composer test
```
