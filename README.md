# site.movies

## First Time Setup
#### Symfony 4
- make sure you have PHP (7.1.3+) installed
- download [composer](https://getcomposer.org/download/) and [install](https://getcomposer.org/doc/00-intro.md#globally) it globally
- run `composer install` 

#### Database
- make sure you have PostgreSQL (version 10) installed and running
- open [.env](./.env) and edit `DATABASE_URL="db_driver://db_user:db_password@db_host:db_port/db_name"`, to e.g. `postgres://jagdcake:password@127.0.0.1:5432/movies`
- extract the database dump `tar -xavf database_dump.movies.tar.xz`
- import the database dump using `psql -U db_user -d db_name -1 -f movies_dump`

#### Tailwind CSS
- run `yarn` or `npm install`
- process the CSS with `npx tailwind build public/css/tailwind.css -c tailwind.js -o public/css/main.css`

## Development
- start the development server with `bin/console server:run` or `php bin/console server:run`
- generate a static page by going to `localhost:8000/generate`
- go through the build process by following the steps outlined in [build_static_site.sh](./build_static_site.sh)
  - can't run the script itself without [this](https://github.com/JagdCake/bash.scripts/blob/master/scripts/build_web_project.sh) script which is just a wrapper around commands used to minify / optimize website assets

## Testing
- first update the `DATABASE_URL` for the test environment in [.env.test](./.env.test)
- create the test database with `bin/console -e test doctrine:database:create`
- execute the migrations `bin/console -e test doctrine:migrations:migrate`
- load the movie data fixture `bin/console -e test doctrine:fixtures:load`
- run `bin/phpunit` or `bin/phpunit --testdox` (displays an overview of the test cases)
