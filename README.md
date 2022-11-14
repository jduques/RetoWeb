RetoWeb
-------

Ejecutar el comando "php artisan migrate --seed"
para generar las migraciones y datos de prueba.

Al archivo "docker-compose.yml" del proyecto Docker:
"https://github.com/sprintcube/docker-compose-lamp",
se le agregaron las siguientes líneas correspondientes
a la imagen del proyecto de Larevel para Docker.

Laravel se ejecuta en el puerto 8081
-------------------------------------------------
services:
  app:
    build:
      context: .
      dockerfile: retoweb/.docker/Dockerfile
    image: 'laravelapp'
    ports:
      - 8081:80
    volumes:
      - ./:/var/www/html
------------------------------------------------

Archivo .env

DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=retoweb
DB_USERNAME=docker
DB_PASSWORD=docker


