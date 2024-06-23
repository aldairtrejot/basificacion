<?php
include '../librerias.php';

$modelJuguetesM = new ModelJuguetesM();
$bitacoraM = new BitacoraM();

$condicion = [
    'id_ctrl_test_bas' => $_POST['id_object']
];

if (isset($_POST['id_object'])){
    if ($modelJuguetesM-> eliminarByArray($connectionDBsPro, $condicion)){
        $dataBitacora = [
            'nombre_tabla' => 'ctrl_test_bas',
            'accion' => 'ELIMINAR',
            'valores' => json_encode($condicion),
            'fecha' => $timestamp,
            'id_users' => $_SESSION['id_user']
        ];
        $bitacoraM->agregarByArray($connectionDBsPro,$dataBitacora,'bitacora_hraes');
        echo 'delete';
    }
} 
