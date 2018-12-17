<?php
require_once 'models/usuario.php';
require_once 'models/tramite.php';
require_once 'models/tipotramite.php';
require_once 'models/estudiante.php';


class TramiteController
{
    private $model;
    private $model_estudiante;
    private $model_ttramite;

    public function __construct()
    {
        $this->model_estudiante = new EstudianteModel();
        $this->model_ttramite = new TipotramiteModel();
    }

    public function mostrarTramiteController()
    {
        $tramireModel = new TramiteModel();
        $respuesta = $tramireModel->mostrarTramiteModel("t_tramite");

        foreach ($respuesta as $row => $item) {
            echo '<tr>
                <td>' . $item["id_tramite"] . '</td>
                <td>' . $item["cod_estudiante"] . '</td>
                <td>' . $item["id_tipo_tramite"] . '</td>
                <td>' . $item["fecha_inicio"] . '</td>
                <td>' . $item["fecha_fin"] . '</td>
                <td>' . $item["estado"] . '</td>
                <td>
                    <a href="#myModalModificar' . $item["id_tramite"] . '" data-toggle="modal"><span  class="btn btn-info far fa-edit modificar"></span></a>
                </td>
                <td>
                <a href="index.php?action=tramite&idBorrar=' . $item["id_tramite"] . '"><span class="btn btn-danger fa fa-times eliminar"></span></a>
                </td>
               
                <!-- Modal -->
                <div class="modal fade" id="myModalModificar' . $item["id_tramite"] . '" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Modificar Tramite</h4>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="id_tramite" value="' . $item["id_tramite"] . '">
                                    <div class="form-group">
                                    <label for="" class="control-label">Codigo Estudiante</label>
                                     <input type="text" class="form-control" name="cod_estudiante" placeholder="Ingresa tu dni" value="' . $item["cod_estudiante"] . '">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Tipo Tramite</label>
                                    <input type="text" class="form-control" name="id_tipo_tramite" placeholder="Ingresa tu Primer Nombre" value="' . $item["id_tipo_tramite"] . '">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha de Inicio</label>
                                    <input type="text" class="form-control" name="fecha_inicio" placeholder="Ingresa tu Segundo Nombre" value="' . $item["fecha_inicio"] . '">
                                </div>
                                 <div class="form-group">
                                    <label for="" class="control-label">Fecha Fin</label>
                                    <input type="text" class="form-control" name="fecha_fin" placeholder="Ingresa tu Apellido Paterno" value="' . $item["fecha_fin"] . '">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Estado</label>
                                    <select name="estado" class="form-control">
                                        <option value="Iniciado">Iniciado</option>
                                        <option value="En Espera">En Espera</option>
                                        <option value="En Proceso">En Proceso</option>
                                        <option value="Finalizado">Finalizado</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                 </form>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                                </div>
                                </div>
                                </div>
                                </tr>';
        }
    }

    public function guardarTramiteController()
    {
        if (
            isset($_POST["cod_estudiante_nuevo"]) &&
            isset($_POST["id_tipo_tramite_nuevo"]) &&
            isset($_POST["fecha_fin_nuevo"]) &&
            isset($_POST["estado_nuevo"])
        ) {

            //Se Instancian de la clase UsuarioModel
            $alm = new TramiteModel();
            $alm->cod_estudiante = $_POST["cod_estudiante_nuevo"];
            $alm->id_tipo_tramite = $_POST["id_tipo_tramite_nuevo"];
            $alm->fecha_inicio = $_POST["fecha_inicio_nuevo"];
            $alm->fecha_fin = $_POST["fecha_fin_nuevo"];
            $alm->estado = $_POST["estado_nuevo"];

            //luego se registran los datos
            $this->model = new TramiteModel();
            $respuesta = $this->model->Registrar($alm);

            if ($respuesta == "ok") {
                echo '<script>
                    window.location="tramite";
                </script>';;
            }
        }
    }

    public function modificarTramiteController()
    {
        if (
            isset($_POST["cod_estudiante"]) &&
            isset($_POST["id_tipo_tramite"]) &&
            isset($_POST["fecha_inicio"]) &&
            isset($_POST["estado"])
        ) {
            $editarTramiteModel = new TramiteModel();
            $datosController = array(
                "id_tramite" => $_POST["id_tramite"],
                "cod_estudiante" => $_POST["cod_estudiante"],
                "id_tipo_tramite" => $_POST["id_tipo_tramite"],
                "fecha_inicio" => $_POST["fecha_inicio"],
                "fecha_fin" => $_POST["fecha_fin"],
                "estado" => $_POST["estado"]);
            $respuesta = $editarTramiteModel->modificarTramiteModel($datosController, "t_tramite");
            if ($respuesta == "ok") {
                echo '<script>
                    window.location="tramite";
                </script>';;
            }
        }
    }

    public function eliminarTramiteontroller()
    {
        $eliminarTramite = new TramiteModel();
        if (isset($_GET["idBorrar"])) {
            $datosController = $_GET["idBorrar"];
            $respuesta = $eliminarTramite->eliminarTramiteModel($datosController, "t_tramite");
            if ($respuesta == "ok") {
                echo '<script>
                window.location="tramite";
            </script>';
            }
        }
    }
}
