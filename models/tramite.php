<?php
require_once 'conexion.php';

class TramiteModel
{
    private $pdo;
    public $id_tramite;
    public $cod_estudiante;
    public $id_tipo_tramite;
    public $fecha_inicio;
    public $fecha_fin;
    public $estado;

    public function mostrarTramiteModel($tabla1)
    {
        try {
            $con = new Conexion();
            $stmt = $con->conectar()->prepare(
                "Select * From $tabla1"
            );

            $stmt->execute();

            return $stmt->fetchAll();

            $stmt->close();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(TramiteModel $data)
    {
        try {
            $sql = "INSERT INTO t_tramite(cod_estudiante, id_tipo_tramite, fecha_inicio,
                    fecha_fin, estado)
		        VALUES (?, ? , ? , ? , ?)";

            $con = new Conexion();
            if ($con->conectar()->prepare($sql)
                ->execute(
                    array(
                        $data->cod_estudiante,
                        $data->id_tipo_tramite,
                        $data->fecha_inicio,
                        $data->fecha_fin,
                        $data->estado
                    )
                )) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obteneridttramite($cod, $idttramite)
    {
        try {

            $con = new Conexion();
            $stm = $con->conectar()->prepare("SELECT id_tramite FROM trazabilidad.t_tramite WHERE id_tipo_tramite = ? and cod_estudiante=?");

            $stm->execute(array($cod, $idttramite));

            $row = $stm->fetch();
            return $row['id_tramite'];

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function modificarTramiteModel($datosModel, $tabla)
    {
        $con = new Conexion();
        $stmt = $con->conectar()->prepare(
            "UPDATE $tabla set 
                      cod_estudiante=:cod_estudiante, 
                      id_tipo_tramite=:id_tipo_tramite,
                      fecha_inicio=:fecha_inicio,
                      fecha_fin=:fecha_fin,
                      estado=:estado
                      where id_tramite=:id_tramite"
        );

        $stmt->bindParam(":cod_estudiante", $datosModel["cod_estudiante"], PDO::PARAM_INT);
        $stmt->bindParam(":id_tipo_tramite", $datosModel["id_tipo_tramite"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inicio", $datosModel["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datosModel["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tramite", $datosModel["id_tramite"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public function eliminarTramiteModel($datosModel, $tabla)
    {
        $con = new Conexion();
        $stmt = $con->conectar()->prepare("DELETE FROM $tabla WHERE id_tramite = :id_tramite");

        $stmt->bindParam(":id_tramite", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

}