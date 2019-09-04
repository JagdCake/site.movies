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
- process the CSS with `make public/css/main.css`

## Development
- start the development server with `bin/console server:run` or `symfony server:start`
- make your changes and inspect them on the server
    - if editing TypeScript files, run `make` from the [public/js/](./public/js/) directory
- to generate and build the static site — `make` from the root dir
    - make sure to install the tools (can be found in the [Makefile](./Makefile)) used to minify / optimize website assets

## Testing
- first update the `DATABASE_URL` for the test environment in [.env.test](./.env.test)
- to set up the test environment — `cd tests/` and `make`
- run `bin/phpunit` or `bin/phpunit --testdox` (displays an overview of the test cases)
    - to run specific tests `bin/phpunit tests/SomeTestFile.php`, `bin/phpunit tests/SomeTestDirectory/` or `bin/phpunit --filter {someTestMethodName}`
      - [Controller tests](./tests/Controller/) (fast) use Symfony's default testing components: [BrowserKit](https://symfony.com/doc/current/components/browser_kit.html) and [DomCrawler](https://symfony.com/doc/current/components/dom_crawler.html)
      - [JavaScript functionality tests](./tests/JavaScript/) (slow) use [Symfony Panther](https://github.com/symfony/panther)
