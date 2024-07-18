<?php
session_start();
error_reporting(0);
if (empty($_SESSION['id'])) {
    header('location:login/login.php');
}

?>

<style>
    .club {
        background: #A21214;
    }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

<script>
    function advertencia(e) {
        if (!confirm("¿Está seguro de eliminar este cuidador?")) {
            e.preventDefault();
        }
    }
</script>

    <h4 class="text-secondary text-center font-weight-bold">LISTA DE CUIDADORES</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_cuidador.php";
    include "../controlador/controlador_modificar_cuidador.php";
    include "../controlador/controlador_eliminar_cuidador.php";
    $sql = $conexion->query(" SELECT * from cuidador ");

    ?>

    <a data-toggle="modal" data-target="#exampleModalRegistro" class="btn bg-dark text-white mb-2"><i class="fas fa-plus"></i> &nbsp;Registrar</a>

    <!-- Modal registro-->
    <div class="modal fade" id="exampleModalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel">Registrar cuidador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <input required type="text" placeholder="Nombre" class="input input__text" name="txtnombre">
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <input required type="text" placeholder="especialidad" class="input input__text" name="txtespecialidad">
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <input required type="text" placeholder="telefono" class="input input__text" name="txttelefono">
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <input required type="email" placeholder="Email" class="input input__text" name="txtemail">
                        </div>


                        <div class="text-right p-2">
                            <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <table class="table table-bordered table-hover w-100 table-secondary" id="">
        <thead>
            <tr>
                <th class="bg-dark text-white" scope="col">ID</th>
                <th class="bg-dark text-white" scope="col">NOMBRE</th>
                <th class="bg-dark text-white" scope="col">ESPECIALIDAD</th>
                <th class="bg-dark text-white" scope="col">TELEFONO</th>
                <th class="bg-dark text-white" scope="col">EMAIL</th>
                <th class="bg-dark text-white"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <td><?= $datos->cuidador_id ?></td>
                    <td><?= $datos->nombre ?></td>
                    <td><?= $datos->especialidad ?></td>
                    <td><?= $datos->telefono ?></td>
                    <td><?= $datos->email ?></td>

                    <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->cuidador_id ?>" class=" btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="inicio.php?id=<?= $datos->cuidador_id ?>" onclick="advertencia(event)" class=" btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>

                <!-- Modal editar -->
                <div class="modal fade" id="exampleModal<?= $datos->cuidador_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-between">
                                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar cuidador</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div hidden class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->cuidador_id ?>">
                                    </div>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
                                    </div>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="text" placeholder="especialidad" class="input input__text" name="txtespecialidad" value="<?= $datos->especialidad ?>">
                                    </div>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="text" placeholder="telefono" class="input input__text" name="txttelefono" value="<?= $datos->telefono ?>">
                                    </div>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="email" placeholder="Email" class="input input__text" name="txtemail" value="<?= $datos->email ?>">
                                    </div>


                                    <div class="text-right p-2">
                                        <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php }
            ?>


        </tbody>
    </table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>