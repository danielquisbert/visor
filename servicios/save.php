<?php
// Servicio para registro de GeoJSon a PostgreSQL
$obj = json_decode($_POST["myData"]);

//echo $obj->nombre; 
//echo $obj->geom; 

$jsonor = $obj->geom;
$json = json_decode($jsonor);

//echo $json->geometry->type;
//echo "la geom";
$tipo =  $json->geometry->type;
//echo $tipo;
$jsonor =  substr($jsonor,strpos($jsonor,'['));
$jsonor = substr($jsonor,0,strripos($jsonor,"]")+1);




    require_once('Conexion.php');
            $con = new Conexion();

	$sql = "INSERT INTO gdata(nombre, geom) VALUES ('$obj->nombre',ST_GeomFromGeoJSON('{\"type\":\"$tipo\", \"coordinates\":$jsonor, \"crs\":{\"type\":\"name\", \"properties\":{\"name\":\"urn:ogc:def:crs:OGC:1.3:CRS84\"}}}'))";

          $pr =$con->consultaRetorno($sql);
	echo $pr;
