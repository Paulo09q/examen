<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $conexion->query("DELETE FROM cuidador WHERE cuidador_id='$id'");
    echo '<div class="alert alert-success">Cuidador eliminado correctamente</div>';
    echo '<script>window.history.replaceState(null, null, window.location.pathname);</script>';
}
