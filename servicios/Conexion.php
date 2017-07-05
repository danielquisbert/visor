<?php

         /**
           * Clase para consultas a la base de datos.
           * @author Miguel R. <mikefoxtrotboa@gmail.com>
           */
    class Conexion{
        //Atributos
        private $host;
        private $user;
        private $passwd;
        private $port;
        private $db;
        public function __construct(){
            //  VARIABLES DE CONFIGURACION. CONEXION A LA LBASE DE DATOS
//            $this->host = '192.168.43.203';
            $this->host = '192.168.56.101';
            $this->port = '5432';
            $this->user = 'cursouser';
            $this->passwd = 'cursouser';
            $this->db = 'dbcursogis';
            $strCnx = "host=$this->host port=$this->port dbname=$this->db user=$this->user password=$this->passwd";
            $link = pg_connect($strCnx) or die ("Error de conexion a la Base de Datos ". pg_last_error());
        }
        public function consultaSimple($query){
            pg_query($query) ;//or die('La consulta fallo: ' . pg_last_error());
        }
        public function consultaRetorno($query){
            $consulta = pg_query($query);// or die('La consulta fallo: ' . pg_last_error());
            return $consulta;
        }
        public function get($atributo){
            return $this->$atributo;
        }
    }

?>
