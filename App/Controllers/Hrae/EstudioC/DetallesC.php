<?php
include '../librerias.php';

$id_object = $_POST['id_object'];
$catEstudioC = new CatEstudioC();
$catEstudioM = new CatEstudioM();
$modelEstudioM = new ModelEstudioM();
$catCarrerasHraesC = new CatCarrerasHraesC();
$catCarrerasHraesM = new CatCarrerasHraesM();
$row = new Row();

if ($id_object != null){
    $response = $row->returnArray($modelEstudioM->listarByIdEdit($id_object));
    $estudio = $catEstudioC ->selectById($catEstudioM->listarByAll(),$row->returnArrayById($catEstudioM->listarElemetoById($response['id_cat_nivel_estudios'])));
    $carrera = $catCarrerasHraesC->selectAll($catCarrerasHraesM ->listarByAll());
    ///VALIDACION DE INFORMACION EN NULL
    if ($response['id_cat_carrera_hraes'] != ''){
        $carrera = $catCarrerasHraesC->selectByIdObject($catCarrerasHraesM->listarByAll(),$row->returnArrayById($catCarrerasHraesM->obtenerElemetoById($response['id_cat_carrera_hraes'])));
    }
    $cedula_ca = $response['cedula'];
    $carrera_ca = $response['carrera'];
    $estudio_id = $response['id_cat_carrera_hraes'];

    $var = [
        'estudio' => $estudio,
        'carrera' => $carrera,
        'cedula_ca' => $cedula_ca,
        'carrera_ca' => $carrera_ca,
        'estudio_id' => $estudio_id,
    ];
    echo json_encode($var);
} else {
    $estudio = $catEstudioC ->selectByAll($catEstudioM->listarByAll());
    $carrera = $catCarrerasHraesC->selectAll($catCarrerasHraesM ->listarByAll());
    $var = [
        'estudio' => $estudio,
        'carrera' => $carrera,
        'cedula_ca' => null,
        'carrera_ca' => null,
        'estudio_id' => null,
    ];
    echo json_encode($var);
}
