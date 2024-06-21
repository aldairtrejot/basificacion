<?php
include '../librerias.php';

$id_object = $_POST['id_object'];
$modelEspecialidadM = new ModelEspecialidadM();
$catEspecialidadM = new catEspecialidadM();
$catEspecialidadC = new CatEspecialidadC();
$row = new Row();

if ($id_object != null){
    $response = $row->returnArray($modelEspecialidadM->listarByIdEdit($id_object));
    $especialidad = $catEspecialidadC->selectByIdObject($catEspecialidadM->listarByAll(),$row->returnArrayById($catEspecialidadM->obtenerElemetoById($response['id_cat_especialidad_hraes'])));
    $var = [
        'especialidad' => $especialidad,
        'cedula' => $response['cedula'],
        'id_cat_especialidad_hraes' => $response['id_cat_especialidad_hraes'],
        'especialidadx' =>$response['especialidad'],
    ];
    echo json_encode($var);
} else {
    $especialidad = $catEspecialidadC->selectByAll($catEspecialidadM->listarByAll());
    $response = $modelEspecialidadM->listarByNull();
    $var = [
        'especialidad' => $especialidad,
        'cedula' => null,
        'id_cat_especialidad_hraes' => null,
        'especialidadx' => null,
    ];
    echo json_encode($var);
}
