<?php
date_default_timezone_set('America/Mexico_City');
$timestamp = date('Y-m-d H:i:s');
class BitacoraM
{
    function agregarByArray($conexion, $datos,$nombre)
    {
        $pg_add = pg_insert($conexion, $nombre, $datos);
        return $pg_add;
    }
}
