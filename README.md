# Time API Challenge

## Description

#### Create an API that can be used to:
1. Find out the number of days between two datetime parameters.
2. Find out the number of weekdays between two datetime parameters.
3. Find out the number of complete weeks between two datetime parameters.
4. Accept a third parameter to convert the result of (1, 2 or 3) into one of seconds, minutes, hours, years.
5. Allow the specification of a time zone for comparison of input parameters from different time zones.

## System Requirements

#### System Requirements for Running Locally
1. Operating system
    - Windows, macOS, or Linux
2. PHP
    - PHP 8.0 or higher (PHP 8.1 or later is recommended for newer Laravel versions)
3. Composer
    - Composer is required to manage Laravel dependencies.
4. web Server
    -  Apache or Nginx is required to serve the application.
       - Laravel provides a built-in PHP development server (via php artisan serve) for local development.
         
#### System Requirements for Running With Docker
1. Install Docker Desktop for your OS
2. WSL 2 (For Windows Users):
    - Windows users need WSL 2 (Windows Subsystem for Linux) installed and configured to use Docker with Sail.

## Installation

Clone this repository to your local machine. If you're running the project locally, use the command ```composer install``` to install the necessary dependencies. After the dependencies are installed, open a terminal and start the local server by running ```php artisan serve```. The application will be accessible at http://127.0.0.1:8000.

 If you are running the project with docker, you can run the following command inside a docker container to install the dependencies.

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install
```

Once the docker container has installed all relevent dependencies, you must open a command terminal and run ```./vendor/bin/sail up``` to start the docker container. The application will be accessible at http://localhost.

## Usage

## External Libraries and Tooling
This project utlises these libraries
- Laravel Pint (an opinionated PHP code style fixer for minimalists)
- Larastan (a PHPStan wrapper for Laravel that adds static typing and bug detection to improve code quality and productivity)
- Scramble (An OpenAPI (Swagger) documentation generator for Laravel, NOTE: route available at /docs/api)






