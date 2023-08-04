# Mobile App Subscriptions

## Installation
Clone Repository

````
git clone https://github.com/cangzms/mobile-app-subscription.git
````

Copy & rename api/.env.example to api/.env file

````
cp api/.env.example api/.env
````

Docker Containers run

````
docker-compose up -d
````

Composer install

````
docker exec -ti api_container_id composer install
````

Generate laravel app key

````
docker exec -ti api_container_id php artisan key:generate
````

Migrate
````
php artisan migrate:fresh --seed
````

API
````
Register - DeviceController.php
Purchase - PurchaseController.php
Check Sub - CheckSubsController.php
````

Worker(cron)
````
app/Console/Command/CheckExpire.php

Mock Api - CheckOsController.php
````

Callback
````
app/Events/ Start,Cancel,Renewed
app/Listeners/ PostToThirdParty.php

3rd Party Endpoint - CallbackController.php
Trigger Event - TriggerEventController.php
````

Report
````
ReportController.php
````
