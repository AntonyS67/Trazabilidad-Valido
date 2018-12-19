<?php
require_once "conexion.php";
class TipoSecretariaModel{
    private $pdo;
    public $id_tipo_secretaria;
    public $nombre_tipo_secretaria;


    public function __construct()
    {
        try {
            $this->pdo = new Conexion();
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function Listar()
    {
        $sql = $this->pdo->conectar()->query('select id_tipo_secretaria,nombre_tipo_secretaria FROM t_tipo_secretaria');
        return $sql;
    }
    

    public function Registrar(TipoSecretariaModel $data)
	{
		try 
		{
		$sql = "INSERT INTO t_tipo_secretaria(id_tipo_secretaria,nombre_tipo_secretaria)
		        VALUES (?, ?)";

        $con=new Conexion();
        $stmt=$con->conectar()->prepare($sql)
        ->execute(
            array(
                        $data->id_tipo_secretaria,
                        $data->nombre_tipo_secretaria
            )
        );

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
   

    public function ObtenerxIdTipoSecretaria($nombre_tipo)
    {
        try {
            $sql = $this->pdo->conectar()->prepare("select id_tipo_secretaria from 
            t_tipo_secretaria  where  nombre_tipo_secretaria= ?");
            $sql->execute(array($nombre_tipo));
            $row = $sql->fetch();
            return $row['id_tipo_secretaria'];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
   

}



?>