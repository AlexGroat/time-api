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
After successfully installing the application and starting the web server, you can begin making API calls. The following documentation uses APIDog for testing purposes.

The available routes within the API are as follows:
1. ```yourlocaldomain/api/days-interval``` (Find out the number of days between two datetime parameters.)
2. ```yourlocaldomain/api/weekdays-interval``` (Find out the number of weekdays between two datetime parameters.)
3. ```yourlocaldomain/api/complete-weeks-interval``` (Find out the number of complete weeks between two datetime parameters.)

Starting with finding out the days between two datetime parameters, make a post request to ```yourlocaldoman/api/days-interval```.

Given the request is a GET, the query parameters are within the url.

In this example, the user has set the startDate key to one day before the endDate. The correct data is returned in the data key of the JSON object. Additionally, the user has specified the Australia/Adelaide timezone.

<img width="779" alt="days-between-days" src="https://github.com/user-attachments/assets/c7e11a70-7632-4358-8f69-f07a645b6e7d">

----

The user can also include an additional query parameter (units) to specify the format in which the value will be returned.

In this example, the user has specified the seconds value under the units key. This will return the value of 1 day in seconds in the json object data key.

<img width="773" alt="days-between-seconds" src="https://github.com/user-attachments/assets/43bc9954-16d7-40fe-a0dc-0867e3b407b8">

----

In this example, the user has specified the minutes value under the units key. This will return the value of 1 day in minutes in the json object data key.

<img width="769" alt="days-between-minutes" src="https://github.com/user-attachments/assets/10246c9b-95ef-48f9-b500-4e7ab07edd38">

----

The next available API route is ```yourlocaldomain/api/weekdays-interval```.

In this example, the user has specified a start date of Saturday the 31st of August and an end date of Friday the 6th of September. With no unit specified the default value returned will be the exact number of weekdays between the two time periods.

<img width="769" alt="weekdays-between-days" src="https://github.com/user-attachments/assets/aeed6787-8ab9-4ad9-b64c-7d383148d093">

---- 

In this example, the user has specified the same time period as the previous example, but set the units key to minutes.

<img width="747" alt="weekdays-between-minutes" src="https://github.com/user-attachments/assets/2a7a4757-2dcf-41f6-9c19-9f0347a1faf3">

---- 

In this example, the user has specified the same time period as the previous example, but set the units key to hours.

<img width="769" alt="weekdays-between-hours" src="https://github.com/user-attachments/assets/dd9e0e96-6fa0-4433-b6df-6b81a17acef3">

---- 

The next available API route is ```yourlocaldomain/api/complete-weeks-interval```.

Note: This API route also accepts a ```precision``` key, which if set to true, will return the complete weeks value to three decimal places.

In this example, the user has not specified the precision key, so the data returned will the be the the complete number of weeks.

<img width="762" alt="complete-weeks-days-wo-precision" src="https://github.com/user-attachments/assets/70d805c7-2e17-40b4-8e16-6a83da1a44b4">

---- 

In this example, the user has specified the precision key, which returns the total number of complete weeks along with a decimal representing the additional days.

<img width="765" alt="complete-weeks-w-precision" src="https://github.com/user-attachments/assets/b14edff3-f6bd-4c44-88c2-12815d46f141">

---- 

In this example, the user has set the units key to seconds, which returns the total number of complete weeks within a month, measured in seconds.

<img width="756" alt="complete-weeks-seconds" src="https://github.com/user-attachments/assets/c03eb631-f1b2-4c11-b8d5-7e362c6d994d">

---- 

In this example, the user has set the units key to years, which returns the total number of complete weeks within a year, expressed in years.

<img width="762" alt="complete-weeks-years" src="https://github.com/user-attachments/assets/bd5ee445-cf08-4933-9569-b464e4d676fa">

## External Libraries and Tooling
This project utlises these libraries
- Laravel Pint (an opinionated PHP code style fixer for minimalists)
- Larastan (a PHPStan wrapper for Laravel that adds static typing and bug detection to improve code quality and productivity)
- Scramble (An OpenAPI (Swagger) documentation generator for Laravel, NOTE: route available at /docs/api)






