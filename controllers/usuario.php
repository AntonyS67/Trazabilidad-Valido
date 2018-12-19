<?php
class UsuarioController{
    private $model;
    private $model_secretaria;
    private $model_director;
    private $model_estudiante;
    private $model_tipo_secretaria;
    

    public function __construct()
    {
        $this->model = new UsuarioModel();
        $this->model_secretaria = new SecretariaModel();
        $this->model_director = new DirectorModel();
        $this->model_estudiante =  new EstudianteModel();
        $this->model_tipo_secretaria = new TipoSecretariaModel();
    }

    public function mostrarUsuariosController(){
        $usuarioModel=new UsuarioModel();
        $respuesta=$usuarioModel->mostrarUsuariosModel("t_usuarios","t_tipo_usuario","t_estados");
        foreach($respuesta as $row =>$item){
        echo '<tr>
                <td>'.$item["dni"].'</td>
                <td>'.wordwrap($item["primer_nombre"].' '.$item["segundo_nombre"].' '.$item["ap_paterno"].' '.$item["ap_materno"],20,"<br />\n").'</td>
                <td>'.$item["usuario"].'</td>
                <td>'.$item["tipo_estado"].'</td>
                <td>'.$item["sexo"].'</td>
                <td>'.$item["email"].'</td>
                <td>'.$item["celular"].'</td>
                <td>'.$item["tipo_user"].'</td>
                <td>'.$item["fecha_registro"].'</td>
                <td>
                    <a href="#myModalModificar'.$item["id_user"].'" data-toggle="modal"><span  class="btn btn-info far fa-edit modificar"></span></a>
                </td>
                <td>
                <a href="index.php?action=usuario&idBorrar='.$item["id_user"].'"><span class="btn btn-danger fa fa-times eliminar"></span></a>
                </td>
               
                <!-- Modal -->
                <div class="modal fade" id="myModalModificar'.$item["id_user"].'" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Modificar Usuario</h4>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="id_user" value="'.$item["id_user"].'">
                                    <div class="form-group">
                                    <label for="" class="control-label">DNI</label>
                                     <input type="text" class="form-control" name="dniEditar" placeholder="Ingresa tu dni" value="'.$item["dni"].'">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Primer Nombre</label>
                                    <input type="text" class="form-control" name="primerNombreEditar" placeholder="Ingresa tu Primer Nombre" value="'.$item["primer_nombre"].'">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Segundo Nombre</label>
                                    <input type="text" class="form-control" name="segundoNombreEditar" placeholder="Ingresa tu Segundo Nombre" value="'.$item["segundo_nombre"].'">
                                </div>
                                 <div class="form-group">
                                    <label for="" class="control-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" name="apellidoPaternoEditar" placeholder="Ingresa tu Apellido Paterno" value="'.$item["ap_paterno"].'">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Apellido Materno</label>
                                    <input type="text" class="form-control" name="apellidoMaternoEditar" placeholder="Ingresa tu Apellido Materno" value="'.$item["ap_materno"].'">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Usuario</label>
                                    <input type="text" class="form-control" name="usuarioEditar" placeholder="Ingresa tu Usuario" value="'.$item["usuario"].'">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Nueva Contraseña</label>
                                    <input type="password" class="form-control" name="passwordEditar" value="'.$item["password"].'" placeholder="Ingresa tu Nueva Contraseña">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Sexo</label>
                                    <input type="text" class="form-control" name="sexoEditar" placeholder="Ingresa tu Sexo" value="'.$item["sexo"].'">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="emailEditar" placeholder="Ingresa tu Email" value="'.$item["email"].'">
                                </div>
                                 <div class="form-group">
                                    <label for="" class="control-label">Celular</label>
                                   <input type="text" class="form-control" name="celularEditar" placeholder="Ingresa tu Celular" value="'.$item["celular"].'">
                                </div>
                                <div class="form-group">
                                    <label for="sel1">Tipo de Usuario</label>
                                    <select class="form-control" id="selTipo" name="tipoEditar" disabled>
                                    <option>'.$item["tipo_user"].'</option>
                                    </select>
                                </div>';
                                
                                if ($item["tipo_user"]=="Estudiante"){
                                    
                                    $cod_estudiante = $this->model_estudiante->ObtenerCodigoEstudiante($item["id_user"]);
                                    echo '
                                    <div class="form-group">
                                        <label for="" class="control-label">Codigo Estudiante</label>
                                        <input type="text" name="codigoEstudianteEditar" class="form-control" placeholder="Ingresa el Codigo de Estudiante" value="'.$cod_estudiante.'">
                                    </div>';

                                }else if($item["tipo_user"]=="Secretaria"){ 
                                    $tipose= $this->model_secretaria->ObtenerTipoSecretaria($item["id_user"]);
                                    $tipo_secretaria = new TipoSecretariaModel();
                                    $result = $tipo_secretaria->Listar()->fetchAll(PDO::FETCH_ASSOC);
                                    echo '<div class="form-group">
                                            <label for="sel1">Tipo de Secretaria</label>
                                            <select class="form-control" id="selTipoS" name="tipoEditarSecretaria">';
                                        foreach ($result as $row){
                                            echo '<option value="'.$row['id_tipo_secretaria'].'"';
                                            if ($row['nombre_tipo_secretaria']==$tipose){
                                                echo 'selected="'.$row['nombre_tipo_secretaria'].'">';
                                            }else{
                                                echo '">';
                                            }
                                            echo $row['nombre_tipo_secretaria'].'</option>';
                                        }
                                    echo '</select>
                                    </div>';
                                }
                                echo '<button type="submit" class="btn btn-primary">Guardar</button>
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

    public function guardarUsuarioController(){
        
        if(isset($_POST["usuarioNuevo"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioNuevo"])&&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordNuevo"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailNuevo"])){
                $tipo=$_POST["tipoNuevo"];
                switch ($tipo) {
                    case 'Administrador':
                        $idtipo=1;
                        break;
                    case 'Secretaria':
                        $idtipo=2;
                        $sec = new SecretariaModel();
                        break;
                    case 'Director':
                        $idtipo=3;
                        $dir = new DirectorModel();
                        break;
                    case 'Estudiante':
                        $idtipo=4;
                        $es = new EstudianteModel();
                        break;
                    default:
                        $idtipo=1;
                        break;
                }
                
                //Se Instancian de la clase UsuarioModel
                $alm = new UsuarioModel();
                $alm->usuario = $_POST["usuarioNuevo"];
                $alm->email = $_POST["emailNuevo"];
                $alm->primer_nombre = $_POST["primerNombreNuevo"];
                $alm->segundo_nombre = $_POST["segundoNombreNuevo"];
                $alm->ap_paterno = $_POST["apellidoPaternoNuevo"];
                $alm->ap_materno = $_POST["apellidoMaternoNuevo"];
                $alm->dni = $_POST["dniNuevo"];
                $alm->celular = $_POST["celularNuevo"];
                $alm->sexo = $_POST["sexoNuevo"];
                $alm->password = $_POST["passwordNuevo"];
                $alm->id_tipo_user = $idtipo;
                $alm->intentos = 0;
                $alm->estado = 1;

                try {
                    $alm->fecha_registro = date('Y').'-'.date('m').'-'.(date('d')-1);
                } catch (message $e) {
                    
                }
               
                
                
                //luego se registran los datos
               
                $this->model->Registrar($alm);
                
                
                $id_user = $this->model->ObteneridUser($alm->email);
                //var_dump($id_user); 
            

                //Registrando datos en las otras tablas
                if ($idtipo == 2){
                    
                    $sec->id_tipo_secretaria = intval($this->model_tipo_secretaria->
                    ObtenerxIdTipoSecretaria($_POST["tipoNuevoSecretaria"]));
                    $sec->id_user = intval($id_user);
                   
                    $this->model_secretaria->Registrar($sec);
                }else if ($idtipo == 3){
                    $dir->id_user = intval($id_user);
                    
                    $this->model_director->Registrar($dir);
                }else if($idtipo == 4){
                    $es->cod_estudiante = $_POST["codigoNuevo"];
                    $es->id_user = intval($id_user);
             
                    $this->model_estudiante->Registrar($es);
                   
                }

                    /*Para que sea vea al instante */
                  echo'<script>
                      window.location="usuario";
                  </script>';
    
                

            }
        }
    }

    public function modificarUsuarioController(){
       
       if(isset($_POST["usuarioEditar"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioEditar"])&&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordEditar"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailEditar"])){

                //Se Instancian de la clase UsuarioModel
                $us = new UsuarioModel();
                $us->usuario = $_POST["usuarioEditar"];
                $us->email = $_POST["emailEditar"];
                $us->primer_nombre = $_POST["primerNombreEditar"];
                $us->segundo_nombre = $_POST["segundoNombreEditar"];
                $us->ap_paterno  = $_POST["apellidoPaternoEditar"];
                $us->ap_materno  = $_POST["apellidoMaternoEditar"];
                $us->dni         = $_POST["dniEditar"];
                $us->celular =   $_POST["celularEditar"];
                $us->sexo        = $_POST["sexoEditar"];
                $us->password = $_POST["passwordEditar"];
                $us->id = intval($_POST["id_user"]);

                //luego se Actualizan datos
                $this->model->ActualizarUsuario($us);
                $id_tipo_user =$this->model->ObteneridTipoUser($us->id);
                
                if ($id_tipo_user == 4){
                    $codigo = $_POST["codigoEstudianteEditar"];
                    $this->model_estudiante->ActualizarCodigo($codigo,$us->id); 
                }else if($id_tipo_user == 2){
                $this->model_secretaria->ActualizarTipoSecre(intval($_POST["tipoEditarSecretaria"]),$us->id);
                   
                }
                echo'<script>
                  window.location="usuario";
                    </script>';    
            }
        }
        
    }

    public function eliminarUsuarioController(){
        $eliminarUsuario=new UsuarioModel();
        if(isset($_GET["idBorrar"])){
            $datosController= array(
                "id"=>$_GET["idBorrar"],
                "estado"=>2
            );
            $eliminarUsuario->eliminarUsuarioModel($datosController,"t_usuarios");
            echo'<script>
                        window.location="usuario";
                    </script>';
        }
    }



    public function buscarUsuarioController(){
        if(isset($_POST["buscarUsuario"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["buscarUsuario"])){
                $user_buscar= trim($_POST["buscarUsuario"]);
                $buscarUsuarioModel=new UsuarioModel();
                $respuesta = $buscarUsuarioModel->buscarUsuariosModel($user_buscar,"t_usuarios","t_tipo_usuario","t_estados");
                
                if($respuesta == "ok"){
                    echo'<script>
                            window.location="usuario";
                        </script>';
                }
                
                foreach($respuesta as $item){
                    echo '<tr>
                            <td>'.$item["dni"].'</td>
                            <td>'.wordwrap($item["primer_nombre"].' '.$item["segundo_nombre"].' '.$item["ap_paterno"].' '.$item["ap_materno"],20,"<br />\n").'</td>
                            <td>'.$item["usuario"].'</td>
                            <td>'.$item["tipo_estado"].'</td>
                            <td>'.$item["sexo"].'</td>
                            <td>'.$item["email"].'</td>
                            <td>'.$item["celular"].'</td>
                            <td>'.$item["tipo_user"].'</td>
                            <td>'.$item["fecha_registro"].'</td>
                            <td>
                                <a href="#myModalModificar'.$item["id_user"].'" data-toggle="modal"><span  class="btn btn-info far fa-edit modificar"></span></a>
                            </td>
                            <td>
                            <a href="index.php?action=usuario&idBorrar='.$item["id_user"].'"><span class="btn btn-danger fa fa-times eliminar"></span></a>
                            </td>
                            <!-- Modal -->
                            <div class="modal fade" id="myModalModificar'.$item["id_user"].'" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Modificar Usuario</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <input type="hidden" name="id_user" value="'.$item["id_user"].'">
                                                <div class="form-group">
                                                <label for="" class="control-label">DNI</label>
                                                 <input type="text" class="form-control" name="dniEditar" placeholder="Ingresa tu dni" value="'.$item["dni"].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label">Primer Nombre</label>
                                                <input type="text" class="form-control" name="primerNombreEditar" placeholder="Ingresa tu Primer Nombre" value="'.$item["primer_nombre"].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label">Segundo Nombre</label>
                                                <input type="text" class="form-control" name="segundoNombreEditar" placeholder="Ingresa tu Segundo Nombre" value="'.$item["segundo_nombre"].'">
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="control-label">Apellido Paterno</label>
                                                <input type="text" class="form-control" name="apellidoPaternoEditar" placeholder="Ingresa tu Apellido Paterno" value="'.$item["ap_paterno"].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label">Apellido Materno</label>
                                                <input type="text" class="form-control" name="apellidoMaternoEditar" placeholder="Ingresa tu Apellido Materno" value="'.$item["ap_materno"].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label">Usuario</label>
                                                <input type="text" class="form-control" name="usuarioEditar" placeholder="Ingresa tu Usuario" value="'.$item["usuario"].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label">Nueva Contraseña</label>
                                                <input type="password" class="form-control" name="passwordEditar" value="'.$item["password"].'" placeholder="Ingresa tu Nueva Contraseña">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label">Sexo</label>
                                                <input type="text" class="form-control" name="sexoEditar" placeholder="Ingresa tu Sexo" value="'.$item["sexo"].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label">Email</label>
                                                <input type="email" class="form-control" name="emailEditar" placeholder="Ingresa tu Email" value="'.$item["email"].'">
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="control-label">Celular</label>
                                               <input type="text" class="form-control" name="celularEditar" placeholder="Ingresa tu Celular" value="'.$item["celular"].'">
                                            </div>
                                            <div class="form-group">
                                                <label for="sel1">Tipo de Usuario</label>
                                                <select class="form-control" id="selTipo" name="tipoEditar" disabled>
                                                <option>'.$item["tipo_user"].'</option>
                                                </select>
                                            </div>';
                                            
                                            if ($item["tipo_user"]=="Estudiante"){
                                                
                                                $cod_estudiante = $this->model_estudiante->ObtenerCodigoEstudiante($item["id_user"]);
                                                echo '
                                                <div class="form-group">
                                                    <label for="" class="control-label">Codigo Estudiante</label>
                                                    <input type="text" name="codigoEstudianteEditar" class="form-control" placeholder="Ingresa el Codigo de Estudiante" value="'.$cod_estudiante.'">
                                                </div>';
            
                                            }else if($item["tipo_user"]=="Secretaria"){ 
                                                $tipose= $this->model_secretaria->ObtenerTipoSecretaria($item["id_user"]);
                                                $tipo_secretaria = new TipoSecretariaModel();
                                                $result = $tipo_secretaria->Listar()->fetchAll(PDO::FETCH_ASSOC);
                                                echo '<div class="form-group">
                                                        <label for="sel1">Tipo de Secretaria</label>
                                                        <select class="form-control" id="selTipoS" name="tipoEditarSecretaria">';
                                                    foreach ($result as $row){
                                                        echo '<option value="'.$row['id_tipo_secretaria'].'"';
                                                        if ($row['nombre_tipo_secretaria']==$tipose){
                                                            echo 'selected="'.$row['nombre_tipo_secretaria'].'">';
                                                        }else{
                                                            echo '">';
                                                        }
                                                        echo $row['nombre_tipo_secretaria'].'</option>';
                                                    }
                                                echo '</select>
                                                </div>';
                                            }
                                            echo '<button type="submit" class="btn btn-primary">Guardar</button>
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
        }
    }
    public function impresionUsuariosController(){
        $usuarioModel=new UsuarioModel();
        $respuesta=$usuarioModel->mostrarUsuariosModel("t_usuarios","t_tipo_usuario","t_estados");
        return $respuesta;
    }
}
?>
