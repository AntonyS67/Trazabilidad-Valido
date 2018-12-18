<?php
require_once "conexion.php";
class UsuarioModel{
    public $id;
    public $usuario;
    public $email;
    public $primer_nombre;
    public $segundo_nombre;
    public $ap_paterno;
	public $ap_materno;
	public $dni;
	public $celular;
	public $sexo;
	public $password;
    public $id_tipo_user;
    public $intentos;
    public $estado;
    public $fecha_registro;
  
  
    

    public function mostrarUsuariosModel($tabla1,$tabla2,$tabla3){
        $con=new Conexion();
        $stmt = $con->conectar()->prepare("SELECT $tabla1.id_user,$tabla1.primer_nombre,$tabla1.segundo_nombre,
        $tabla1.ap_paterno,$tabla1.ap_materno,$tabla1.dni,$tabla1.celular,$tabla1.sexo,$tabla1.password,
        $tabla1.usuario, $tabla1.email,$tabla2.tipo_user,$tabla1.id_estado,$tabla1.fecha_registro,
        $tabla3.tipo_estado FROM $tabla1,$tabla2,$tabla3 where 
        $tabla1.id_tipo_user = $tabla2.id_tipo_user AND $tabla1.id_estado = $tabla3.id_estado"  );

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
    }
    

    	//Funcion donde se registra usuarios
	public function Registrar(UsuarioModel $data)
	{
		try 
		{
		$sql = "INSERT INTO t_usuarios(usuario,email,primer_nombre,segundo_nombre,
        ap_paterno,ap_materno,dni,celular,
        sexo,password,id_tipo_user,intentos,id_estado,fecha_registro)
		        VALUES (?, ? , ? , ? , ? , ? , ? , ? , ?, ? , ? , ? , ?, ?)";

        $con=new Conexion();
        $stmt=$con->conectar()->prepare($sql)
        ->execute(
            array(
                        $data->usuario,
                        $data->email,
                        $data->primer_nombre,
                        $data->segundo_nombre,
                        $data->ap_paterno,
                        $data->ap_materno,
                        $data->dni,
                        $data->celular,
                        $data->sexo,
                        $data->password,
                        $data->id_tipo_user,
                        $data->intentos,
                        $data->estado,
                        $data->fecha_registro
            )
        );

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
   

    public function ObteneridUser($email)
	{
		try 
		{
         
            $con=new Conexion();
            $stm = $con->conectar()->prepare("SELECT id_user FROM t_usuarios WHERE email = ?");
			          
			$stm->execute(array($email));
			
            $row= $stm->fetch();
            return $row['id_user'];

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

    public function modificarUsuarioModel($datosModel,$tabla){
        $con=new Conexion();
        $stmt=$con->conectar()->prepare("UPDATE $tabla set usuario=:usuario,email=:email,primer_nombre=:primer_nombre,
        segundo_nombre=:segundo_nombre,ap_paterno=:ap_paterno,ap_materno=:ap_materno,dni=:dni,celular=:celular,sexo=:sexo,password=:password where id_user=:id");

        $stmt->bindParam(":usuario",$datosModel["usuario"],PDO::PARAM_STR);
        $stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
        $stmt->bindParam(":primer_nombre",$datosModel["primer_nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":segundo_nombre",$datosModel["segundo_nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":ap_paterno",$datosModel["ap_paterno"],PDO::PARAM_STR);
        $stmt->bindParam(":ap_materno",$datosModel["ap_materno"],PDO::PARAM_STR);
        $stmt -> bindParam(":dni", $datosModel["dni"], PDO::PARAM_INT);
        $stmt->bindParam(":celular",$datosModel["celular"],PDO::PARAM_STR);
        $stmt->bindParam(":sexo",$datosModel["sexo"],PDO::PARAM_STR);
        $stmt->bindParam(":password",$datosModel["password"],PDO::PARAM_STR);
        $stmt -> bindParam(":id", $datosModel["id_user"], PDO::PARAM_INT);
     

        if($stmt->execute()){
			return "ok";
		}
		else{
			return "error";
		}

		$stmt->close();

    }

    public function eliminarUsuarioModel($datosModel,$tabla){
        $con=new Conexion();
        $stmt = $con->conectar()->prepare("DELETE FROM $tabla WHERE id_user = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}

		else{

			return "error";

		}

		$stmt->close();
        
    }


    public function buscarUsuariosModel($datosModel,$tabla1,$tabla2){
        $con=new Conexion();
        $stmt = $con->conectar()->prepare("SELECT $tabla1.id_user,$tabla1.primer_nombre,$tabla1.segundo_nombre,
        $tabla1.ap_paterno,$tabla1.ap_materno,$tabla1.dni,$tabla1.celular,$tabla1.sexo,$tabla1.usuario,$tabla1.password, $tabla1.email,$tabla2.tipo_user
        FROM $tabla1,$tabla2 where $tabla1.id_tipo_user=$tabla2.id_tipo_user and ($tabla1.usuario=:usuario or $tabla1.dni=:dni)");

        $stmt->bindParam(":usuario",$datosModel,PDO::PARAM_STR);
        $stmt->bindParam(":dni",$datosModel,PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
    }
    
}