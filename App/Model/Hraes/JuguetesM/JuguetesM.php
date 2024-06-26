<?php

class ModelJuguetesM
{
    public function listarById($id_object,$paginator)
    {
        $listado = pg_query("SELECT 
                                ctrl_test_bas.id_ctrl_test_bas,
                                cat_test_bas.nombre,
                                cat_estatus_test.nombre
                            FROM ctrl_test_bas
                            INNER JOIN cat_estatus_test
                            ON ctrl_test_bas.id_cat_estatus_test =
                                cat_estatus_test.id_cat_estatus_test
                            INNER JOIN cat_test_bas
                            ON ctrl_test_bas.id_cat_test_bas =
                                cat_test_bas.id_cat_test_bas
                            WHERE ctrl_test_bas.id_tbl_empleados_hraes = $id_object
                            ORDER BY ctrl_test_bas.id_ctrl_test_bas DESC
                            LIMIT 3 OFFSET $paginator;");
        return $listado;
    }

    public function listarByNull()
    {
        return $raw = [
            'id_ctrl_juguetes_hraes' => null,
            'id_cat_fecha_juguetes' => null,
            'id_cat_estatus_juguetes' => null,
            'id_tbl_empleados_hraes' => null,
            'id_ctrl_dependientes_economicos_hraes' => null
        ];
    }

    public function listarEditById($id_object)
    {
        $listado = pg_query("SELECT *
                             FROM ctrl_test_bas
                             WHERE id_ctrl_test_bas = $id_object");
        return $listado;
    }

    public function editarByArray($conexion, $datos, $condicion)
    {
        $pg_update = pg_update($conexion, 'ctrl_test_bas', $datos, $condicion);
        return $pg_update;
    }

    public function agregarByArray($conexion, $datos)
    {
        $pg_add = pg_insert($conexion, 'ctrl_test_bas', $datos);
        return $pg_add;
    }

    public function eliminarByArray($conexion, $condicion)
    {
        $pgs_delete = pg_delete($conexion, 'ctrl_test_bas', $condicion);
        return $pgs_delete;
    }

    public function listarByBusqueda($id_object, $busqueda,$paginator)
    {
        $listado = pg_query("SELECT 
                                ctrl_test_bas.id_ctrl_test_bas,
                                cat_test_bas.nombre,
                                cat_estatus_test.nombre
                            FROM ctrl_test_bas
                            INNER JOIN cat_estatus_test
                            ON ctrl_test_bas.id_cat_estatus_test =
                                cat_estatus_test.id_cat_estatus_test
                            INNER JOIN cat_test_bas
                            ON ctrl_test_bas.id_cat_test_bas =
                                cat_test_bas.id_cat_test_bas
                            WHERE ctrl_test_bas.id_tbl_empleados_hraes = $id_object
                            AND (
                                TRIM(UPPER(UNACCENT(cat_test_bas.nombre))) LIKE '%$busqueda%' OR
                                TRIM(UPPER(UNACCENT(cat_estatus_test.nombre))) LIKE '%$busqueda%'
                            )
                            ORDER BY ctrl_test_bas.id_ctrl_test_bas DESC
                            LIMIT 3 OFFSET $paginator;");
        return $listado;
    }

    public function validarMenorAdd($curp,$id_cat_fecha)
    {
        $listado = pg_query("SELECT COUNT (ctrl_juguetes_hraes.id_ctrl_juguetes_hraes)
                                    FROM ctrl_juguetes_hraes
                                    INNER JOIN ctrl_dependientes_economicos_hraes
                                    ON ctrl_juguetes_hraes.id_ctrl_dependientes_economicos_hraes =
                                        ctrl_dependientes_economicos_hraes.id_ctrl_dependientes_economicos_hraes
                                    WHERE ctrl_dependientes_economicos_hraes.curp = '$curp'
                                    AND ctrl_juguetes_hraes.id_cat_fecha_juguetes = $id_cat_fecha;");
        return $listado;
    }

    public function validarMenorEdit($curp,$id_cat_fecha,$id_object)
    {
        $listado = pg_query("SELECT COUNT (ctrl_juguetes_hraes.id_ctrl_juguetes_hraes)
                            FROM ctrl_juguetes_hraes
                            INNER JOIN ctrl_dependientes_economicos_hraes
                            ON ctrl_juguetes_hraes.id_ctrl_dependientes_economicos_hraes =
                                ctrl_dependientes_economicos_hraes.id_ctrl_dependientes_economicos_hraes
                            WHERE ctrl_dependientes_economicos_hraes.curp = '$curp'
                            AND ctrl_juguetes_hraes.id_cat_fecha_juguetes = $id_cat_fecha
                            AND ctrl_juguetes_hraes.id_ctrl_juguetes_hraes <> $id_object;");
        return $listado;
    }
}
