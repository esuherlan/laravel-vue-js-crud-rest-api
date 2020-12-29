# laravel-vue-js-crud-rest-api

```
composer install
php artisan passport:install
php artisan migrate
```

Selanjutnya silakan lakukan registrasi untuk user yang bisa menggunakan RESTful API:
#http://localhost:8000/api/register
Dengan method POST dan data yang harus diinput Name, Email dan Password.
Ketika registrasi berhasil maka access token akan masuk ke table oauth_tokens

Silakan di copy access_tokennya dan paste di .ENV file
```
#REST_API_PASSPORT_KEY=paste_access_token_here
#MIX_REST_API_PASSPORT_KEY="${REST_API_PASSPORT_KEY}"
```