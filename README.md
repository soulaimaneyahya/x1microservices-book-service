# Book service

- [User service / API Gateway](https://github.com/soulaimaneyahya/x1microservices-user-service)
- [Author Service](https://github.com/soulaimaneyahya/x1microservices-author-service)
- [Book service / API Gateway](https://github.com/soulaimaneyahya/x1microservices-book-service)

```sh
composer install
cp .env.example .env
```

Generate key
```sh
php -r "echo 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;"
```

Set Permissions
```sh
sudo chmod -R 775 storage
```

Run Service
```sh
php -S localhost:8002 -t public
```

DB Seed
```sh
php artisan migrate
php artisan db:seed
```

