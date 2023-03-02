# Migration Product Table

## Seeder
```php
php artisan db:seed --class:ProductSeeder
```

# API EndPoints
## Register
Method `POST`

endppoint : ``host:port/api/register``

![image](https://user-images.githubusercontent.com/34479062/221520577-90d7be18-c9a6-4a4f-b9ec-dd443e7e7214.png)


## Login
Method `POST`

endpoint : ``host:port/api/login``

![image](https://user-images.githubusercontent.com/34479062/222064012-3691e233-32ce-4d78-8b01-54359f2729f3.png)

## Order
Method `POST`

endpoint : ``host:port/api/order``

![image](https://user-images.githubusercontent.com/34479062/222064091-1ea04bfa-2e73-46e9-bfd3-de10cbf5a011.png)

## Show Order
Method `GET`

endpoint : ``host:port/api/order/{invoice_number}``

## Export Excel 
Method `GET`

endpoint : ``host:port/api/export/{invoice_number}``

## Cancel / Delete Order
Method `DELETE`

endpoint : ``host:port/api/order/{invoice_number}``


## Log
Method `GET`

endpoint: ``host:port/api/log_activities/``




