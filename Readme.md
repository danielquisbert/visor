# Readme

*Control de versiones*

##Curso GIS

###INSTALANDO GEOSERVER

- instalar unzip para descomprimir archivos
sudo apt-get install unzip

- copiar el archivo comprimido de geoserver al directorio de tomcat8
sudo cp geoserver-2.11.1-war.zip /var/lib/tomcat8/webapps/

- cambiarse al directorio de tomcat donde se copio el archivo comprimido
cd /var/lib/tomcat8/webapps/


- descomprimir geoserver
sudo unzip geoserver-2.11.1-war.zip 

- cambiar usuario y grupo  del archivo geoserver a tomcat8 para evitar problemas de permisos
sudo chown tomcat8:tomcat8 geoserver.war

- verificar si existe la variable de entorno JAVA
echo $JAVA_HOME

- Si no devuelve resultados comprobar que java este instalado
java --version
  Tomcat8 necesita OpenJDK 8

- Editar el siguiente archivo para que JAVA funcione con Tomcat

sudo nano  /etc/default/tomcat8

Adicionar en la linea catorce
JAVA_HOME=/usr/lib/jvm/java-8-openjdk-amd64  
 es el directorio donde se encuentra java instalado

- iniciar tomcat 
sudo service tomcat8 start

Geoserver esta corriendo en 
http://IP del SERVIDOR/geoserver


JAVA_GHOME = /usr/lib/jvm/..

Usuario por defecto de geoserver
```
user admin 
pass geoserver




###Configuracionde PosGIS

- cambiarse al usuario postgres
sudo su
su postgres
psql=#  // para abrir linea de comandos de postgres
CTRL+D para salir de la linea de comandos

postgres@...$ createuser cursouser
postgres@...$ createdb dbcursogis -O cursouser // creando una base de datos del usuario cursouser

=# \du //lista de usuarios
=# \l // lista de base de datos
// Asignando contraseña al usuario
=#ALTER USER cursouser with password 'cursouser';
// Dandole permisos de suerusuario 
=# ALTER ROLE cursouser WITH superuser;
// Quitandole permisos de suerusuario 
- Dandole permisos de nosuerusuario y ejecutar los scripts SQL para volver la Base de Datos, espacial 

$psql -h localhost -u cursouser -d dbcursouser -f /usr/share/postgres/9.4/contrib/postgis-2.3/postgis.sql
$psql -h localhost -u cursouser -d dbcursouser -f /usr/share/postgres/9.4/contrib/postgis-2.3/legacy.sql
$psql -h localhost -u cursouser -d dbcursouser -f /usr/share/postgres/9.4/contrib/postgis-2.3/spatial_ref_sys.sql
$psql -h localhost -u cursouser -d dbcursouser -f /usr/share/postgres/9.4/contrib/postgis-2.3/postgis_comments.sql



-- extra ARCHIVOS DE CONFIGURACION DE POSTGRESQL

/etc/postgresql/9.4/main/postgresql.conf
/etc/postgresql/9.4/main/pg_hba.conf

 

- Conversión .shp a .sql
Se utiliza los comandos:
```
shp2pgsql -s 4326 archivoShape.shp nombreNuevaTabla dbcursogis > nombreArchivo.sql
```

### paso 3

- Importar el archivo SQL a postGIS

```
psql -h localhost -U cursouser -d dbcursogis -f /PATH/ARCHIVO/SHAPE/nombreArchivo.sql
```

###Proxy Host
cp /home/gisuser/files/proxy.cgi /usr/lib/cgi-bin


- Adicionar al array "allowed host"

'ip del servidor virtual:8080','geo.gob.bo'
localhost 127.0.0.1

- habilitar en apache cgi

sudo a2enmod cgi
sudo service apache restart



