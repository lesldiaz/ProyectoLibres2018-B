# Sistema de Gestion de Objetos de Aprendizaje

El Sistema OA es una herramienta diseñada para crear y gestionar objetos de aprendizaje de manera interactiva. Y se puede acceder desde el siguiente enlace:

[http://sistema-oa.rf.gd](http://sistema-oa.rf.gd)

## Primeros pasos

### Prerrequisitos

- Sistema operativo (Windows, macOS o Linux)
- [Xampp](https://www.apachefriends.org/index.html) debe ser instalado para el correcto funcionamiento del sistema. Xampp provee un servidor Apache, PHP en su ultima version y MySQL como gestor de base de datos.
- [Git](https://git-scm.com/) para poder clonar el repositorio.

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

Para que el sistema funcione correctamente se debe crear la base de datos `sistemaoa` en su computador. El script para la creacion de la base de datos se encuentra en el archivo `sistemaoa.sql`.http://ohmyz.sh/

Para conectar el sistema con la base de datos que acaba de modificar el archivo `pdo.php.example`. Para esto se debe quitar la extension `.example` del archivo y modificar el contenido agregando `root` como usuario de la base de datos y vacio para la contraseña.

## Uso del Sistema

Para el correcto uso del sistema se proporciona un [manual de usuario](https://github.com/franizus/SistemaGestionOA/blob/master/Manual-Usuario.pdf).