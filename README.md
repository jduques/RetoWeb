RetoWeb
-------

Configurar .env con la configuración de la base de 
datos necesaria.

Ejecutar el comando "php artisan migrate --seed"
para generar las migraciones y datos de prueba.

Al archivo "docker-compose.yml" se le agregó las siguiemtes
líneas para la imagen del proyecto de Laravel dentro de Docker:
https://github.com/sprintcube/docker-compose-lamp

-------------------------------------------------
services:
  app:
    build:
      context: .
      dockerfile: /retoweb/.docker/Dockerfile
    image: 'laravelapp'
    ports:
      - 8081:80
    volumes:
      - ./:/var/www/html
-------------------------------------------------

Archivo .env

DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=retoweb
DB_USERNAME=docker
DB_PASSWORD=docker


