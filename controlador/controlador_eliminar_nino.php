<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $conexion->query("DELETE FROM nino WHERE nino_id='$id'");
    echo '<div class="alert alert-success">Niño eliminado correctamente</div>';
    echo '<script>window.history.replaceState(null, null, window.location.pathname);</script>';

}
