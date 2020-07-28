# LEVANTAR EL PROYECTO

## REQUISITOS
* Tener PHP >= 7.2.5
* Tener composer
* Tener nodeJs
* Tener Internet

## Configuración

* Una vez clonado el proyecto, ingresar al proyecto y ejecutar lo siguiente:

```sh
composer install
```

```sh
npm install
```
* crear archivo de configuración y modificar con su gestor de base de datos en .env

```sh
cp .env.example .env
```
DB_HOST=localhost
DB_DATABASE=tu_base_de_datos
DB_USERNAME=root
DB_PASSWORD=

* Crear Base de datos
```sh
php artisan migrate
```

* Crear Base de datos con datos (50)
```sh
php artisan migrate --seed
```

* Generar KEY de laravel
```sh
php artisan key:generate
```

* Puesta en marcha vuejs y laravel
```sh
npm run dev
php artisan serve
```

* Ingresar al servidor que genere php artisan serve Ej.localhost:8000


