<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:login/login.php');
}

?>

<style>
    .miembro {
        background: #A21214;
    }
</style>

<?php
require('./layout/topbar.php');
require('./layout/sidebar.php');
?>

<div class="page-content">

    <script>
        function advertencia(e) {
            if (!confirm("¿Está seguro de eliminar este miembro?")) {
                e.preventDefault();
            }
        }
    </script>

    <h4 class="text-secondary text-center font-weight-bold">LISTA DE NIÑOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_nino.php";
    include "../controlador/controlador_modificar_nino.php";
    include "../controlador/controlador_eliminar_nino.php";
    $sql = $conexion->query(" select nino.*, cuidador.nombre as 'cuidador' from nino
INNER JOIN cuidador ON cuidador.cuidador_id=nino.cuidador_id ");

    ?>

    <a data-toggle="modal" data-target="#exampleModalRegistro"  class="btn bg-dark text-white mb-2"><i class="fas fa-plus"></i> &nbsp;Registrar</a>

    <!-- Modal registro-->
    <div class="modal fade" id="exampleModalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel">Registrar Niños</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">

                        <?php
                        //traer los cuidadores
                        $cuidadores = $conexion->query("SELECT * FROM cuidador");
                        ?>

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <select required class="input input__text" name="txtcuidador_id">
                                <option value="">Seleccione un cuidador</option>
                                <?php
                                while ($cuidador = $cuidadores->fetch_object()) {
                                    echo '<option value="' . $cuidador->cuidador_id . '">' . $cuidador->nombre . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <input required type="text" placeholder="Nombre" class="input input__text" name="txtnombre">
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <input required type="text" placeholder="Apellido" class="input input__text" name="txtapellido">
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <label for="">Fecha de nacimiento</label>
                            <input required type="date" class="input" name="txtfecha_nacimiento" style="z-index: 9999;">
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12">
                            <input required type="text" placeholder="Alergias" class="input input__text" name="txtalergia">
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
                <th class="bg-dark text-white" scope="col">CUIDADOR</th>
                <th class="bg-dark text-white" scope="col">NOMBRE DEL NIÑO</th>
                <th class="bg-dark text-white" scope="col">APELLIDO DEL NIÑO</th>
                <th class="bg-dark text-white" scope="col">FECHA DE NACIOMIENTO</th>
                <th class="bg-dark text-white" scope="col">ALERGIAS</th>
                <th class="bg-dark text-white"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <td><?= $datos->nino_id ?></td>
                    <td><?= $datos->cuidador ?></td>
                    <td><?= $datos->nombre ?></td>
                    <td><?= $datos->apellido ?></td>
                    <td><?= $datos->fecha_nacimiento ?></td>
                    <td><?= $datos->alergias ?></td>

                    <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->nino_id ?>" class=" btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="nino.php?id=<?= $datos->nino_id ?>" onclick="advertencia(event)" class=" btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>

                <!-- Modal editar -->
                <div class="modal fade" id="exampleModal<?= $datos->nino_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->nino_id ?>">
                                    </div>

                                    <?php
                                    //traer los cuidador
                                    $cuidador = $conexion->query("SELECT * FROM cuidador");
                                    ?>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <select required class="input input__text" name="txtcuidador_id">
                                            <option value="">Seleccione un cuidador</option>
                                            <?php
                                            while ($cui = $cuidador->fetch_object()) {

                                                echo '<option ' . ($datos->cuidador_id == $cui->cuidador_id ? "selected" : "") . ' value="' . $cui->cuidador_id . '">' . $cui->nombre . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
                                    </div>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" value="<?= $datos->apellido ?>">
                                    </div>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="date" class="input input__text" name="txtfecha_nacimiento" value="<?= $datos->fecha_nacimiento ?>">
                                    </div>

                                    <div class="fl-flex-label mb-4 px-2 col-12">
                                        <input type="text" placeholder="Alergias" class="input input__text" name="txtalergia" value="<?= $datos->alergias ?>">
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



<?php require('./layout/footer.php'); ?>