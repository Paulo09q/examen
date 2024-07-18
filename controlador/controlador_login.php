<?php
session_start();
if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = md5($_POST["password"]);

        $consulta=$conexion->query("SELECT * FROM usuario WHERE usuario='$usuario' AND password='$password'");
        if ($datos = $consulta->fetch_object()) {
            $_SESSION["id"] = $datos->id_usuario;
            header("location:../inicio.php");
        } else {
            echo "El usuario no existe";
        }
        
    } else {
        echo "Ingrese los datos";
    }
}
