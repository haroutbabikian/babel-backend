# Getting started

## Prerequisites

Run `php artisan migrate:fresh --seed` to create the tables on the MySQL server. Please check the `.env` file to configure the database connection. Here's a glimpse of the `.env` file:

```DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=babel
DB_USERNAME=root
DB_PASSWORD=
```

## Create a new user

Use postman or any other api testing client to create a new user. The endpoint is `http://localhost:8000/api/register`. The body of the request should be in JSON format. Here's an example:

```json
{
    "name": "John Doe",
    "email": "johndoe@xyz.com",
    "password": "password"
}
```

You can proceed to login and logout using the frontend UI.
