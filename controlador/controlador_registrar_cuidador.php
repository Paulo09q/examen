<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) && !empty($_POST["txtespecialidad"]) && !empty($_POST["txttelefono"]) && !empty($_POST["txtemail"])) {
        $nombre = $_POST["txtnombre"];
        $especialidad = $_POST["txtespecialidad"];
        $telefono = $_POST["txttelefono"];
        $email = $_POST["txtemail"];

        //validar que no exista un cuidador con el mismo nombre
        $validar = $conexion->query("SELECT * FROM cuidador WHERE nombre='$nombre'");
        if ($validar->num_rows > 0) {
            echo '<div class="alert alert-danger">Ya existe un cuidador con ese nombre</div>';
        } else {
            $conexion->query("INSERT INTO cuidador (nombre, especialidad, telefono, email) VALUES ('$nombre', '$especialidad', '$telefono', '$email')");
            echo '<div class="alert alert-success">Cuidador registrado correctamente</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Debe llenar todos los campos</div>';
    }

    //refrescar la url con js
    echo '<script>window.history.replaceState(null, null, window.location.pathname);</script>';
}
