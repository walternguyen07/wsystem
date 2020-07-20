# Walter system
[![GitHub license](https://img.shields.io/github/license/viralsolani/laravel-adminpanel.svg?style=plastic)](https://github.com/viralsolani/laravel-adminpanel/blob/master/LICENSE.txt)
[![GitHub stars](https://img.shields.io/github/stars/viralsolani/laravel-adminpanel.svg?style=plastic)](https://github.com/viralsolani/laravel-adminpanel/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/viralsolani/laravel-adminpanel.svg?style=plastic)](https://github.com/viralsolani/laravel-adminpanel/network)
[![GitHub issues](https://img.shields.io/github/issues/viralsolani/laravel-adminpanel.svg?style=plastic)](https://github.com/viralsolani/laravel-adminpanel/issues)
![StyleCI](https://img.shields.io/badge/styleCI-passed-brightgreen.svg?style=plastic)


## Additional Features
* Built-in Laravel Boilerplate Module Generator,
* Dynamic Menu/Sidebar Builder
* Pages Module
* Blog Module
* FAQ Module
* API Boilerplate
* Mailables
* Responses
* Vue Components
* Laravel Mix
* Object based javascript Implementation



**Command list**

    git clone https://github.com/viralsolani/laravel-adminpanel.git
    cd laravel-adminpanel
    cp .env.example .env
    composer install
    npm install
    npm run development
    php artisan storage:link
    php artisan key:generate
    php artisan passport:install
    php artisan vendor:publish --tag=lfm_public
    php artisan migrate
    php artisan passport:install

## Please note

- To run test cases, add SQLite support to your php

## Other Important Commands
- To fix php coding standard issues run - composer format
- To perform various self diagnosis tests on your Laravel application. run - php artisan self-diagnosis
- To clear all cache run - composer clear-all
- To built Cache run - composer cache-all
- To clear and built cache run - composer cc

## Logging In

`php artisan db:seed` adds three users with respective roles. The credentials are as follows:

* Administrator: `admin@admin.com`
* Backend User: `executive@executive.com`
* Default User: `user@user.com`

Password: `1234`

## ScreenShots

## Dashboard
![Screenshot](screenshots/dashboard.png)

## User Listing
![Screenshot](screenshots/users.png)

## Settings
![Screenshot](screenshots/settings.png)

## Issues

If you come across any issues please report them [here](https://github.com/viralsolani/laravel-adminpanel/issues).

## Contributing
Feel free to create any pull requests for the project. For proposing any new changes or features you want to add to the project, you can send us an email at following addresses.

    (1) Viral Solani - viral.solani@gmail.com
    (2) Vipul Basapati - basapativipulkumar@gmail.com
    (3) Vallabh Kansagara - vrkansagara@gmail.com
    (4) Kamlesh Gupta - webworldgk@gmail.com

## License

[MIT LICENSE](https://github.com/viralsolani/laravel-adminpanel/blob/master/LICENSE.txt)
