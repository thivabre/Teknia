<?php
$ubicacion="172.16.15.203";
$usuario="root";
$clave="";
$base="servicio_tecnico_db";
$BD=new mysqli($ubicacion,$usuario,$clave,$base);
if($BD->connect_error){
    die(" Error".$BD->connect_error);
}
else{
    echo "Conexion exitosa";
}
?>