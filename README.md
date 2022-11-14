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
git clone https://github.com/AndresBojaca/api-restfull-doublevpartners.git
cd api-restfull-doublevpartners
composer install
composer install
```

Levantar el Servidor de PHP

```sh
php -S localhost:8888
```

En el caso de usar un servidor local como XAMPP/WAMP, mover a la carpeta /www o cloner directamente en la ruta:
```sh
cd C:/wamp64/www
git clone https://github.com/AndresBojaca/api-restfull-doublevpartners.git
cd api-restfull-doublevpartners
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



## Docker

Dillinger is very easy to install and deploy in a Docker container.

By default, the Docker will expose port 8080, so change this within the
Dockerfile if necessary. When ready, simply use the Dockerfile to
build the image.

```sh
cd dillinger
docker build -t <youruser>/dillinger:${package.json.version} .
```

This will create the dillinger image and pull in the necessary dependencies.
Be sure to swap out `${package.json.version}` with the actual
version of Dillinger.

Once done, run the Docker image and map the port to whatever you wish on
your host. In this example, we simply map port 8000 of the host to
port 8080 of the Docker (or whatever port was exposed in the Dockerfile):

```sh
docker run -d -p 8000:8080 --restart=always --cap-add=SYS_ADMIN --name=dillinger <youruser>/dillinger:${package.json.version}
```

> Note: `--capt-add=SYS-ADMIN` is required for PDF rendering.

Verify the deployment by navigating to your server address in
your preferred browser.

```sh
127.0.0.1:8000
```


**Gracias por la oportunidad!**
