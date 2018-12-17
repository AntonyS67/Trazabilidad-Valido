<?php
session_start();

if (!$_SESSION["validar"]) {
    header("Location:ingreso");
    exit();
}
include "views/modules/menu.php";
include "views/modules/cabezote.php";
?>

<div class="usuarios">
    <div class="buscar">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="search" name="buscartipotramite"
                   placeholder="Ingresar Nombre">
            <button class="btn btn-default fas fa-search"
                    type="submit"></button>
            <button type="button" class="btn btn-default nuevo-user"
                    data-toggle="modal" data-target="#myModal"><i
                    class="fas fa-plus">Nuevo</i></button>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <h4 class="modal-title">Nuevo Tramite</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post"
                              enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="" class="control-label">Codigo de Estudiante</label>
                                <input type="text" name="cod_estudiante_nuevo"
                                       class="form-control"
                                       placeholder="Ingrese el codigo de Estudiante">
                            </div>
                            <div class="form-group">
                                <label for=""
                                       class="control-label">Tramite</label>
                                <select name="id_tipo_tramite_nuevo" class="form-control">
                                    <option value="1">Bachiller</option>
                                    <option value="2">Titulo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Fecha Inicio</label>
                                <input type="text" name="fecha_inicio_nuevo"
                                       class="form-control"
                                       placeholder="Ingrese la Fecha de Inicio">
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Fecha Fin</label>
                                <input type="text" name="fecha_fin_nuevo"
                                       class="form-control"
                                       placeholder="Puede dejar este campo vacio">
                            </div>
                            <div class="form-group">
                                <label for=""
                                       class="control-label">Estado</label>
                                <select name="estado_nuevo" class="form-control">
                                    <option value="Iniciado">Iniciado</option>
                                    <option value="En Espera">En Espera</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Finalizado">Finalizado</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Registrar
                            </button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $crearttramite = new TramiteController();
    $crearttramite->guardarTramiteController();
    ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Código de Estudiante</th>
            <th>Tipo de Tramite</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $tramite = new TramiteController();
        if (empty($_POST["buscartipotramite"])) {
            $tramite->mostrarTramiteController();
        } else {
            // $ttramite->buscarUsuarioController();
        }
        $tramite->modificarTramiteController();
        $tramite->eliminarTramiteontroller();
        ?>
        </tbody>
    </table>
</div>
