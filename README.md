# Sistema de Gestion de Objetos de Aprendizaje

El Sistema OA es una herramienta diseñada para crear y gestionar objetos de aprendizaje de manera interactiva. Y se puede acceder desde el siguiente enlace:

[http://proyectolibres.000webhostapp.com/](http://proyectolibres.000webhostapp.com/)

Es temporal.

## Primeros pasos

### Prerrequisitos

- Sistema operativo (Windows, macOS o Linux)
- [Xampp](https://www.apachefriends.org/index.html) debe ser instalado para el correcto funcionamiento del sistema. Xampp provee un servidor Apache, PHP en su ultima version y MySQL como gestor de base de datos.
- [Git](https://git-scm.com/) para poder clonar el repositorio.
- [PHPMailer](https://github.com/PHPMailer/PHPMailer). Una clase de transferencia y creación de correo electrónico con todas las funciones para PHP

### Instalación

El sistema se instala clonando el repositorio de GitHub en su computador. Se puede ejecutar el siguiente comando en el terminal.

```
git clone https://github.com/franizus/SistemaGestionOA.git
```

O descargar el zip que proporciona GitHub y descomprimirlo en su computador.

El siguiente paso es copiar el contenido que se descargo dentro de la carpeta htdocs en donde instalo el programa Xampp. 

En Windows es:

```
C:\xampp\htdocs
```

En sistemas Unix es:

```
/opt/lampp/htdocs
```

Una vez realizado esto ya se puede acceder desde el navegador a la aplicacion con el siguiente enlace:

```
http://localhost/sistemaoa/index.php
```

### Habilitacion de la base de datos

Para que el sistema funcione correctamente se debe crear la base de datos `sistemaoa` en su computador. El script para la creacion de la base de datos se encuentra en el archivo `sistemaoa.sql`.

Para conectar el sistema con la base de datos que acaba de modificar el archivo `pdo.php.example`. Para esto se debe quitar la extension `.example` del archivo y modificar el contenido agregando `root` como usuario de la base de datos y vacio para la contraseña.

## Uso del Sistema

Para el correcto uso del sistema se proporciona un [manual de usuario](https://github.com/franizus/SistemaGestionOA/blob/master/Manual-Usuario.pdf).

<<<<<<< HEAD
## Manual de Instalación

Proximamente

## Aclaraciones

Algunos archivos se encuentran desactualizados. Se tratará lo mas pronto posible actualizarlos para tener una versión funcional completa.
=======

>>>>>>> 6fdd7c3d1e83192755b37f53f8a4604de9fb73db
