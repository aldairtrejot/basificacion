<?php
include '../librerias.php';

$modelJefeM = new ModelJefeM();
$bitacoraM = new BitacoraM();

$condicion = [
    'id_ctrl_lengua_idioma' => $_POST['id_object']
];

if (isset($_POST['id_object'])){
    if ($modelJefeM-> eliminarByArray($connectionDBsPro, $condicion)){
        $dataBitacora = [
            'nombre_tabla' => 'ctrl_lengua_idioma',
            'accion' => 'ELIMINAR',
            'valores' => json_encode($condicion),
            'fecha' => $timestamp,
            'id_users' => $_SESSION['id_user']
        ];
        $bitacoraM->agregarByArray($connectionDBsPro,$dataBitacora,'bitacora_hraes');
        echo 'delete';
    }
} 
