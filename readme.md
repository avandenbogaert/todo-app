# A simple TODO app

### Installation

Install the symfony application by executing the following commands. 

```shell script
$ php composer install
```
The application uses sqlite so you dont need to create a MySQL database schema. 
Just run the migrations with the following command :

```shell script
$ php bin/console doctrine:migrations:migrate
```

Add some default todo things to have a working list;

```shell script
$ php bin/console doctrine:fixtures:load 
```

Install the frontend application by executing the following commands

```shell script
$ npm install && npm run watch
```

### Starting the application

You're all set you can start using the todo application.

You can configure apache to run the application or use the built-in php webserver

```shell script
$ php -S localhost:8080 -t public/
```

You can access the website through 'http://localhost:8080'


### Running the tests

To run the symfony tests copy the phpunit configuration .dist file 

```shell script
$ cp phpunit.xml.dist phpunit.xml
```

And run the tests 

```shell script
$ php bin/phpunit 
```
