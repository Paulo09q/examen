<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"]) and !empty($_POST["txtcuidador_id"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtfecha_nacimiento"]) and !empty($_POST["txtalergia"])) {
        $id = $_POST["txtid"];
        $cuidador_id = $_POST["txtcuidador_id"];
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $fecha_nacimiento = $_POST["txtfecha_nacimiento"];
        $alergia = $_POST["txtalergia"];

        //validar que no exista un niño con el mismo nombre
        $validar = $conexion->query("SELECT * FROM nino WHERE nombre='$nombre' and nino_id != '$id'");
        if ($validar->num_rows > 0) {
            echo '<div class="alert alert-danger">Ya existe un niño con ese nombre</div>';
        } else {
            $conexion->query("UPDATE nino SET cuidador_id='$cuidador_id', nombre='$nombre', apellido='$apellido', fecha_nacimiento='$fecha_nacimiento', alergias='$alergia' WHERE nino_id='$id'");
            echo '<div class="alert alert-success">Niño modificado correctamente</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Debe llenar todos los campos</div>';
    }

    //refrescar la url con js
    echo '<script>window.history.replaceState(null, null, window.location.pathname);</script>';
}
