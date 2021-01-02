## Requerimientos
- [composer versión 2.0.8](https://getcomposer.org/doc/00-intro.md)
- [Laravel versión 8.12.0](https://laravel.com/docs/8.x/installation)
- [npm version 6.14.6](https://www.npmjs.com/get-npm)
- [PHP version 7.4.8](https://www.php.net/manual/es/install.php)

# Pasos para poder ejecutar este proyecto
- Generar el archivo .env
```
cp .env.example2 .env
```

- Generar token de acceso a github, [más información de como hacerlo](https://docs.github.com/en/free-pro-team@latest/github/authenticating-to-github/creating-a-personal-access-token).

- Poner el usuario y token en el archivo .env

- Instalar dependencias de composer.
```
composer install
```
- Instalar dependencias de npm.
```
npm install
```
- Procesar archivos de JavaScript.
```
npm run dev
```
- Generar llave de Laravel.
```
php artisan key:generate
```
- Correr el servidor local de Laravel.
```
php artisan serve
```