# OMS

Simple order management system with PHP utilizing MVC pattern and database layer as MySQL. 

![screenshot](/public/screen-shot.png)

>If you are not using MySQL, you can optionally switch another database layer by following the steps,

> - In `.env` file, switch db connection, for example `DB_CONNECTION=pgsql`
>- Create your database layer in `\src\Core\Database` for example, `PostgreSql.php`,
>- extend base `Database` class and you may want to overwrite the `connect()` method
>- then implement `App\Contracts\DataOperationsInterface`
>- register entry in `/src/bootstrap.php`

  ```php
    $app->bind(Database::class, function() {
        return match($_ENV['DB_CONNTECTION']) {
            'mysql' => new MySQL(),
            'pgsql' => new PostgreSql()
    };
  ```

## Requirement 
`php >= 8.2`

## Installation and Setup 

clone this repo with:
```bash
git clone "https://github.com/kgsint/oms-php.git"
```

And then, to setup `.env` file and install required dependencies, run:
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
