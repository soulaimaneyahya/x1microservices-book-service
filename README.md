# Book service

Generate key
```sh
php -r "echo 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;"
```

Run Service
```sh
php -S localhost:8002 -t public
```
