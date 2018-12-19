<?php
require_once "conexion.php";
class SecretariaModel{
    private $pdo;
    public $id_user;
    public $id_tipo_secretaria;
  


    public function __construct()
    {
        try {
            $this->pdo = new Conexion();
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }
    /*
    public function Listar()
    {
        $sql = $this->pdo->conectar()->query('select id_secretaria,tipo_secretaria FROM t_secretaria');
        return $sql;
    }
    */

    public function ObtenerTipoSecretaria($id_user)
    {
        try {
            $sql = $this->pdo->conectar()->prepare("select ti.nombre_tipo_secretaria from 
            t_secretaria se,t_tipo_secretaria ti where 
            se.id_tipo_secretaria = ti.id_tipo_secretaria and id_user= ?");
            $sql->execute(array($id_user));
            $row = $sql->fetch();
            return $row['nombre_tipo_secretaria'];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
   


    public function Registrar(SecretariaModel $data){
        try 
		{
		$sql = "INSERT INTO t_secretaria(id_user,id_tipo_secretaria)
		        VALUES (?, ? )";

    
        $stmt=$this->pdo->conectar()->prepare($sql)
        ->execute(
            array(
                        $data->id_user,
                        $data->id_tipo_secretaria
            )
        );

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
    }

    public function ActualizarTipoSecre($id_tipo_secre,$id){
		try {
			$sql = "UPDATE t_secretaria SET id_tipo_secretaria = ? WHERE id_user = ? " ;

			if ($this->pdo->conectar()->prepare($sql)->execute(array($id_tipo_secre,$id))){
                return "ok";
            }else{
                return "error";
            }

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}



?>