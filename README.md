# Instalación/Configuración Prueba

## SERVIDOR LOCAL
Se debe tener instalado en la maquina un servidor local como XAMP, WAMP, WAMPSERVER, etc. el cual nos servira para levantar un entorno de servidor local y poder ejecutar archivos PHP

## BASE DE DATOS
Cuando se tenga instalado el servidor local, se procedera a prender/encender el servidor y asi poder acceder a http://localhost/phpmyadmin. Crear una base de datos e importar el archivo SQL

## GIT
Estando dentro del directorio WWW, HTDOCS etc se debera acceder a git mediante la terminal y escribir la siguiente sentencia ** git clone https://github.com/juancamiloSD/blog.git **, con este comando se procedera a descargar todos los archivos necesarios para la compilación del proyecto

## CONFIGURACIÓN
Una vez terminado el clonado, buscar en el directorio del proyecto el archivo wp-admin.php y configurar los accesos necesarios para conectar el proyecto con la base de datos
define( 'DB_NAME', 'endeavor' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );

## OPCIONES
buscar en la base de datos la tabla endeavor2021_options y en el registro SITEURL y HOME colocar el directorio HTTP donde se encuentra la carpeta del proyecto
EJEMPLO
http://localhost/endeavor

## HTACCESS
Para refrescar las urls del sitio_web/blog se debera acceder al wp-admin y mediante ** Ajustes->Enlaces permanentes->Guardar ** se generara o actualizara el archivo htaccess

## ARCHIVO SQL
El archivo que corresponde a la base de datos esta en el directorio raiz del proyecto wordpress
