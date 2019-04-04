# site.movies

## First Time Setup
#### Symfony 4
- make sure you have PHP (7.1.3+) installed
- download [composer](https://getcomposer.org/download/) and [install](https://getcomposer.org/doc/00-intro.md#globally) it globally
- run `composer install` 
- start the development server with `bin/console server:run` or `php bin/console server:run`

#### Tailwind CSS
- run `yarn` or `npm install`

#### Database:
- open `.env` and edit `DATABASE_URL="db_driver://db_user:db_password@db_host:db_port/db_name"`, e.g. `postgres://jagdcake:password_for_stuff@127.0.0.1:5432/stuff`
- delete all migration files inside `src/Migrations/`
- run a migration with `bin/console make:migration`
- make sure the migration won't do something you don't want (like drop every table from your database) by reviewing it, inside `src/Migrations/`
- execute the migration `bin/console doctrine:migrations:migrate`
- *To be continued*
- import the database dump (there is no dump yet) in your database using `psql -U db_user -d db_name -1 -f database_dump_file`
