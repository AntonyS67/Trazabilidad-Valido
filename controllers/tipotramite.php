<?php
require_once 'models/tipotramite.php';

class TipotramiteController
{
    private $model;

    public function __construct()
    {
        $this->model = new TipotramiteModel();
    }

    public function mostrarTipotramiteController()
    {
        $tipotramiteModel = new TipotramiteModel();
        $respuesta = $tipotramiteModel->mostrarTipotramiteModel("t_tipo_tramite");

        foreach ($respuesta as $row => $item) {
            echo '<tr>
                <td>' . $item["id_tipo_tramite"] . '</td>
                <td>' . $item["nombre_tipo_tramite"] . '</td>
                <td>' . $item["descripcion"] . '</td>
                <td>
                    <a href="#myModalModificar' . $item["id_tipo_tramite"] . '" data-toggle="modal"><span  class="btn btn-info far fa-edit modificar"></span></a>
                </td>
                <td>
                    <a href="index.php?action=tipotramite&idBorrar=' . $item["id_tipo_tramite"] . '"><span class="btn btn-danger fa fa-times eliminar"></span></a>
                </td>
                <!-- Modal -->
                <div class="modal fade" id="myModalModificar' . $item["id_tipo_tramite"] . '" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Modificar Tipo de Tramite</h4>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="id_tipo_tramite" value="' . $item["id_tipo_tramite"] . '">
                                    <div class="form-group">
                                        <label for="" class="control-label">Nombre de Tramite</label>
                                        <input type="text" class="form-control" name="nombre_tipo_tramite" placeholder="Ingresa tu dni" value="' . $item["nombre_tipo_tramite"] . '">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" placeholder="Ingresa tu Primer Nombre" value="' . $item["descripcion"] . '">
                                    </div>;
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

    public function guardarTipotramiteController()
    {
        if (isset($_POST["nombre_tipo_tramite_nuevo"]) && isset($_POST["descripcion_nuevo"])) {
            //Se Instancian de la clase UsuarioModel
            $alm = new TipotramiteModel();
            $alm->nombre_tipo_tramite = $_POST["nombre_tipo_tramite_nuevo"];
            $alm->descripcion = $_POST["descripcion_nuevo"];

            //luego se registran los datos
            $this->model = new TipotramiteModel();
            $respuesta = $this->model->Registrar($alm);
            if ($respuesta == "ok") {
                echo '<script>
                    window.location="tipotramite";
                </script>';;
            }
        }
    }

    public function modificarTipotramiteController()
    {
        if (isset($_POST["nombre_tipo_tramite"]) && isset($_POST["descripcion"])) {


            $datosController = array("id_tipo_tramite" => $_POST["id_tipo_tramite"],
                "nombre_tipo_tramite" => $_POST["nombre_tipo_tramite"],
                "descripcion" => $_POST["descripcion"]);
            $editarttramiteModel = new TipotramiteModel();
            $respuesta = $editarttramiteModel->modificarTipotramiteModel($datosController, "t_tipo_tramite");
            if ($respuesta == "ok") {
                echo '<script>
                            window.location="tipotramite";
                        </script>';
            }

        }
    }

    public function eliminarTipotramiteController()
    {
        $eliminarTtramite = new TipotramiteModel();
        if (isset($_GET["idBorrar"])) {
            $datosController = $_GET["idBorrar"];
            $respuesta = $eliminarTtramite->eliminarTipotramiteModel($datosController, "t_tipo_tramite");
            if ($respuesta == "ok") {
                echo '<script>
                        window.location="tipotramite";
                    </script>';
            }
        }
    }

}
