<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtcuidador_id"]) && !empty($_POST["txtnombre"]) && !empty($_POST["txtapellido"]) && !empty($_POST["txtfecha_nacimiento"]) && !empty($_POST["txtalergia"])) {
        $cuidador_id = $_POST["txtcuidador_id"];
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $fecha_nacimiento = $_POST["txtfecha_nacimiento"];
        $alergia = $_POST["txtalergia"];

        //validar que no exista un niño con el mismo nombre
        $validar = $conexion->query("SELECT * FROM nino WHERE nombre='$nombre'");
        if ($validar->num_rows > 0) {
            echo '<div class="alert alert-danger">Ya existe un niño con ese nombre</div>';
        } else {
            $conexion->query("INSERT INTO nino (cuidador_id, nombre, apellido, fecha_nacimiento, alergias) VALUES ('$cuidador_id', '$nombre', '$apellido', '$fecha_nacimiento', '$alergia')");
            echo '<div class="alert alert-success">Niño registrado correctamente</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Debe llenar todos los campos</div>';
    }

    //refrescar la url con js
    echo '<script>window.history.replaceState(null, null, window.location.pathname);</script>';
}
