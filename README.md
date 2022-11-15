# API RESTFULL 
##### Prueba técnica Double V Partners
#
Requerimientos: 
Queremos un API que nos permita crear, eliminar, editar y recuperar tickets con paginación. Que se pueda recuperar todos o filtrar por uno específico. Los ticket tienen un id, un usuario, una fecha de creación, una fecha de actualización y un estatus (abierto/cerrado).

Exponer el servicio mediante http RESTFUL, valorable GRPC y GraphQL.
Debes realizar la prueba en PHP
Dejar en el readme la manera de poder probar en local. Utiliza el lenguaje de
programación (PHP). Tener en cuenta, para la ejecución en local, la base

Referencia : https://drive.google.com/file/d/1NmVi4IlpkQE3J4iJO-VL7k_7ybpuyyJP/view

Esta prueba fue desarollada en su totalidad por @AndresBojaca con un tiempo estimado de 24h, fue iniciada el día Domingo
13/11/2022 y terminada el dia Lunes.

## Tecnologías Empleadas
- [PHP 8.0.1](https://www.php.net/manual/es/intro-whatis.php)- Lenguaje Base utilizado para el core de la aplicacion
- [Slim Framework v4](http://dev.slimframework.com/)- Microframework de PHP utilizado para la elaboracion del API 
- [MySQL](https://www.mysql.com/) - Gestor de la BD
- [Docker](https://www.docker.com/) - Contenedor para correr la BD

## Instalación

#### ES NECESARIO TENER INSTALADO COMPOSER PREVIAMENTE!

Clonar el repositorio de Github desde una terminal o bash

```sh
$ git clone https://github.com/AndresBojaca/api-restfull-doublevpartners.git
$ cd api-restfull-doublevpartners
$ composer install
$ composer start
```

Levantar el Servidor de PHP

```sh
$ php -S localhost:8888
```

En el caso de usar un servidor local como XAMPP/WAMP, mover a la carpeta /www o cloner directamente en la ruta:
```sh
$ cd C:/wamp64/www
$ git clone https://github.com/AndresBojaca/api-restfull-doublevpartners.git
$ cd api-restfull-doublevpartners
$ composer install
$ composer start
```



## Documentación
### Endpoints: 

#### Tickets:

- Todos los Tickets: `GET /api/tickets/all`
--Parametros Adicionales: 
`limit`(Default: 5) & `page`(Default: 1) (Limite de registros por consulta y paginacion de los datos)
    Ejemplo:
    ```
    /api/tickets/all?page=2&limit=10
    ```

- Crear Ticket: `POST /api/tickets/add`
--`JSON Body` 
    ```
    {
        "user": "UserName",
        "status":"Abierto"
    }
    ```
- Update User: `PUT /api/tickets/{id}`
     --`JSON Body` 
    ```
    {
        "user": "UserNameEdit",
        "status":"Abierto"
    }
- Delete User: `DELETE /api/tickets/{id}`


**Gracias por la oportunidad!**
