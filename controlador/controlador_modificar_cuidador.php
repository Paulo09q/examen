<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtespecialidad"]) and !empty($_POST["txttelefono"]) and !empty($_POST["txtemail"])) {
        $id = $_POST["txtid"];
        $nombre = $_POST["txtnombre"];
        $especialidad = $_POST["txtespecialidad"];
        $telefono = $_POST["txttelefono"];
        $email = $_POST["txtemail"];

        //validar que no exista un cuidador con el mismo nombre y diferente id
        $validar = $conexion->query("SELECT * FROM cuidador WHERE nombre='$nombre' AND cuidador_id!='$id'");
        if ($validar->num_rows > 0) {
            echo '<div class="alert alert-danger">Ya existe un cuidador con ese nombre</div>';
        } else {
            $conexion->query("UPDATE cuidador SET nombre='$nombre', especialidad='$especialidad', telefono='$telefono', email='$email' WHERE cuidador_id='$id'");
            echo '<div class="alert alert-success">Cuidador modificado correctamente</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Debe llenar todos los campos</div>';
    }

    //refrescar la url con js
    echo '<script>window.history.replaceState(null, null, window.location.pathname);</script>';
}
