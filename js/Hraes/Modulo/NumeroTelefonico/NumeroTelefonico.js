var id_tbl_empleados_hraes = document.getElementById('id_tbl_empleados_hraes').value;

function buscarNumTelefonico(){ //BUSQUEDA
    let buscarNew = clearElement(buscar_nt);
    let buscarlenth = lengthValue(buscarNew);
    
    if (buscarlenth == 0){
        iniciarTabla_nt(null, iniciarBusqueda_nt(),id_tbl_empleados_hraes);
    } else {
        iniciarTabla_nt(buscarNew, iniciarBusqueda_nt(),id_tbl_empleados_hraes);
    }
}

function iniciarTabla_nt(busqueda, paginador, id_tbl_empleados_hraes) { 
    $.post('../../../../App/View/Hraes/Modulo/NumeroTelefonico/tabla.php', {
        busqueda: busqueda, 
        paginador: paginador, 
        id_tbl_empleados_hraes:id_tbl_empleados_hraes
    },
        function (data) {
            $("#modulo_telefono").html(data); 
        }
    );
}

function iniciarTablaTelefono(id_tbl_empleados_hraes) { ///INGRESA LA TABLA
    $.ajax({
        type: 'POST',
        url: '../../../../App/View/Hraes/Modulo/NumeroTelefonico/tabla.php',
        data: { id_tbl_empleados_hraes: id_tbl_empleados_hraes },
        success: function (data) {
            $('#modulo_telefono').html(data);
        }
    });
}

function agregarEditarTelefono(id_object){

    let titulo = document.getElementById("titulo_fijo");
    titulo.textContent = 'Modificar';
    $("#id_object").val(id_object);
    if (id_object == null){
        $("#agregar_editar_telefono").find("input,textarea,select").val("");
        titulo.textContent = 'Agregar';
    }

    $.post("../../../../App/Controllers/Hrae/TelefonoC/DetallesC.php", {
        id_object: id_object
    },
        function (data) {
            var jsonData = JSON.parse(data);//se obtiene el json
            var entity = jsonData.response; //Se agrega a emtidad 
            var estatus = jsonData.estatus; //Se agrega a emtidad 

            $('#id_cat_estatus').empty();
            $('#id_cat_estatus').html(estatus); 
            $("#movil").val(entity.movil);
            $("#telefono").val(entity.telefono);
        }
    );

    $("#agregar_editar_telefono").modal("show");
}

function salirAgregarEditarTelefono(){
    $("#agregar_editar_telefono").modal("hide");
}

function agregarEditarByDbByTelefono() {
    var movil = $("#movil").val();
    var telefono = $("#telefono").val();
    var id_cat_estatus = $("#id_cat_estatus").val();
    var id_object = $("#id_object").val();

    $.post("../../../../App/Controllers/Hrae/TelefonoC/AgregarEditarC.php", {
        movil: movil,
        id_cat_estatus: id_cat_estatus,
        id_object:id_object,
        id_tbl_empleados_hraes:id_tbl_empleados_hraes,
        telefono:telefono
    },
        function (data) {
            if (data == 'edit'){
                mensajeExito('Número telefonico modificado con éxito');
            } else if (data == 'add') {
                mensajeExito('Número telefonico agregado con éxito');  
            } else {
                mensajeError(data);
            }
            $("#agregar_editar_telefono").modal("hide");
            buscarNumTelefonico();
        }
    );
}

function eliminarTelefono(id_object) {//ELIMINAR USUARIO
    Swal.fire({
        title: "¿Está seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
        $.post("../../../../App/Controllers/Hrae/TelefonoC/EliminarC.php", {
                id_object: id_object
            },
            function (data, status) {
                if (data == 'delete'){
                    mensajeExito('Número telefonico eliminado con éxito')
                } else {
                    mensajeError(data);
                }
                buscarNumTelefonico();
            }
        );
    }
    });
}

/*
function buscarNumTelefonico(){
    iniciarTablaTelefono(id_tbl_empleados_hraes);
}



function buscarTelefono(){ //BUSQUEDA
    let buscar = document.getElementById("buscarTelefono").value.trim();
    buscar = buscar.trim().toUpperCase().normalize('NFD').replace(/[\u0300-\u036f]/g,"");
    buscarlenth = buscar.length;
    
    if (buscarlenth == 0){
        iniciarNumeroTelefonico();
    } else {
        iniciarTablaTelefonoByBusqueda(buscar,id_tbl_empleados_hraes);
    }
}


function iniciarTablaTelefonoByBusqueda(buscar, id_tbl_empleados_hraes) { ///INGRESA LA TABLA
    $.ajax({
        type: 'POST',
        url: '../../../../App/View/Hraes/Modulo/NumeroTelefonico/tabla.php',
        data: { 
            buscar: buscar,
            id_tbl_empleados_hraes: id_tbl_empleados_hraes,
         },
        success: function (data) {
            $('#modulo_telefono').html(data);
        }
    });
}

*/