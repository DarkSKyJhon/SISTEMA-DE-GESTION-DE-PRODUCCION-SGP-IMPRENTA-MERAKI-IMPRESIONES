<?php
class BaseDatos{
    public static $instancia = null;
    public static function crearInstancia(){
        if(!isset(self::$instancia)){
            $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            self::$instancia = new PDO('mysql:host=localhost;dbname=aplicacion_web', 'root', '', $opciones);
            echo "conectado...";
        }
        return self::$instancia;
    }
}
?>
