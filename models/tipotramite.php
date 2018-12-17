<?php
require_once 'conexion.php';

class TipotramiteModel
{
    public $id_tipo_tramite;
    public $nombre_tipo_tramite;
    public $descripcion;

    public function mostrarTipotramiteModel($tabla1)
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

    public function Registrar(TipotramiteModel $data)
    {
        try {
            $sql = "INSERT INTO t_tipo_tramite(nombre_tipo_tramite, descripcion)
		        VALUES (?, ?)";

            $con = new Conexion();

            if ($con->conectar()->prepare($sql)->execute(array(
                $data->nombre_tipo_tramite,
                $data->descripcion,
            ))) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obteneridttramite($nombre)
    {
        try {

            $con = new Conexion();
            $stm = $con->conectar()->prepare("SELECT id_user FROM trazabilidad.t_tipo_tramite WHERE nombre_tipo_tramite = ?");

            $stm->execute(array($nombre));

            $row = $stm->fetch();
            return $row['nombre_tipo_tramite'];

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function modificarTipotramiteModel($datosModel, $tabla)
    {
        $con = new Conexion();
        $stmt = $con->conectar()->prepare("update $tabla set nombre_tipo_tramite=:nombre_tipo_tramite,descripcion=:descripcion where id_tipo_tramite=:id");

        $stmt->bindParam(":id", $datosModel["id_tipo_tramite"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_tipo_tramite", $datosModel["nombre_tipo_tramite"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
    }

    public function eliminarTipotramiteModel($datosModel, $tabla)
    {
        $con = new Conexion();
        $stmt = $con->conectar()->prepare("DELETE FROM $tabla WHERE id_tipo_tramite = :id_tipo_tramite");

        $stmt->bindParam(":id_tipo_tramite", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public function buscarTipotramiteModel($datosModel, $tabla)
    {
        $con = new Conexion();
        $stmt = $con->conectar()->prepare(
            "Select * From $tabla where nombre_tipo_tramite=:nombre_tipo_tramite"
        );

        $stmt->bindParam(":nombre_tipo_tramite", $datosModel, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();
    }
}