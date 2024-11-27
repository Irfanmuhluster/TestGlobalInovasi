<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Langkah Menjalankan Aplikasi

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- composer install
- npm install && npm run dev
- Daftarkan nama db, username, password di .env
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve

## Library/Package

- composer require spatie/laravel-permission
- composer require tymon/jwt-auth

## API

- GET|HEAD  / .................................................................................................................
- POST      _ignition/execute-solution .......... ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
- GET|HEAD  _ignition/health-check ...................... ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
- POST      _ignition/update-config ................... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
- POST      api/companies/store ....................................................................... CompanyController@store
- POST      api/employees/search ..................................................................... EmployeeController@index
- GET|HEAD  api/employees/search ..................................................................... EmployeeController@index
- POST      api/employees/store ...................................................................... EmployeeController@store
- PUT       api/employees/{id} ...................................................................... EmployeeController@update
- DELETE    api/employees/{id} ..................................................................... EmployeeController@destroy
- GET|HEAD  api/employees/{id} ........................................................................ EmployeeController@show
- POST      api/login .................................................................................... AuthController@login
- POST      api/logout .................................................................................. AuthController@logout
- POST      api/manager/search ........................................................................ ManagerController@index
- PUT       api/manager/{id} ......................................................................... ManagerController@update
- GET|HEAD  api/user ..........................................................................................................
- GET|HEAD  sanctum/csrf-cookie ............................. sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show

