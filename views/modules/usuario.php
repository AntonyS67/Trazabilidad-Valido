<?php
session_start();

if(!$_SESSION["validar"]){
    header("Location:ingreso");
    exit();
}

include "views/modules/menu.php";
include "views/modules/cabezote.php";

?>
<!-- Usuarios -->
<div class="usuarios">
        <div class="buscar">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="search" name="buscarUsuario" placeholder="Buscar por DNI o Usuario">
                <button class="btn btn-default fas fa-search" type="submit" ></button>
                <button type="button" class="btn btn-default nuevo-user" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus">Nuevo</i></button>
                <a href="html2pdf/pdf/imprimirUsuario.php" target="blank"><input type="button" class="btn btn-default nuevo-user" name="imprimir" value="Imprimir"></a>
            </form>
           
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <h4 class="modal-title">Nuevo Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <!-- <div class="form-group">
                                    <label for="" class="control-label">Nombres</label>
                                    <input type="text" class="form-control" placeholder="Ingresa tu Nombre completo">
                                </div> -->
                                <div class="form-group">
                                    <label for="" class="control-label">DNI</label>
                                    <input maxlength="8" type="text" name="dniNuevo" class="form-control" placeholder="Ingresa tu DNI">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Primer Nombre</label>
                                    <input type="text" name="primerNombreNuevo" class="form-control" placeholder="Ingresa tu Primer Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Segundo Nombre</label>
                                    <input type="text" name="segundoNombreNuevo" class="form-control" placeholder="Ingresa tu Segundo Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Apellido Paterno</label>
                                    <input type="text" name="apellidoPaternoNuevo" class="form-control" placeholder="Ingresa tu Apellido Paterno">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Apellido Materno</label>
                                    <input type="text" name="apellidoMaternoNuevo" class="form-control" placeholder="Ingresa tu Apellido Materno">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Usuario</label>
                                    <input type="text" name="usuarioNuevo" class="form-control" placeholder="Ingresa tu Usuario">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Contraseña</label>
                                    <input type="password" name="passwordNuevo"class="form-control" placeholder="Ingresa tu Contraseña">
                                </div>
                                <div class="form-group">
                                    <label for="sel1">Sexo:</label>
                                    <select class="form-control" name="sexoNuevo">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="emailNuevo" placeholder="Ingresa tu Email">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Celular</label>
                                    <input maxlength="9" type="text" name="celularNuevo"class="form-control" placeholder="Ingresa tu Celular">
                                </div>
                                <div class="form-group">
                                    <label for="sel1">Tipo de Usuario:</label>
                                    <select class="form-control" id="selTipo" name="tipoNuevo" onclick="agregarCampoCodigo()">
                                        <option value="Administrador">Administrador</option>
                                        <option value="Secretaria">Secretaria</option>
                                        <option value="Director">Director de Escuela</option>
                                        <option value="Estudiante">Estudiante</option>
                                    </select>
                                </div>
                                <div class="form-group" id="tipoSecretaria" style="display:none">
                                    <label for="sel1">Tipo de Secretaria:</label>
                                    <select class="form-control" id="selTipo" name="tipoNuevoSecretaria">
                                        <option value="Escuela">Escuela</option>
                                        <option value="Facultad">Facultad</option>
                                        <option value="Decanatura">Decanatura</option>
                                    </select>
                                </div>
                                <div id="codEstudiante" class="form-group" style="display:none">
                                    <label for="" class="control-label">Codigo Estudiante</label>
                                    <input type="text" name="codigoNuevo" class="form-control" placeholder="Ingresa el Codigo de Estudiante" >
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar</button>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            $crearUsuario=new UsuarioController();
            $crearUsuario->guardarUsuarioController();
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre Completo</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Sexo</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Tipo</th>
                    <th>Agregado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $usuarios= new UsuarioController();
                    if(empty($_POST["buscarUsuario"])){
                        $usuarios->mostrarUsuariosController();
                    }else{
                        $usuarios->buscarUsuarioController();
                    }
                    $usuarios->modificarUsuarioController();
                    $usuarios->eliminarUsuarioController();      
                ?>
            </tbody>
        </table>
    </div> 
    <!-- Fin Usuarios -->
        <!-- Fin Usuarios -->

<script>
    function agregarCampoCodigo(){
        var tipo=document.getElementById("selTipo");
        var valor=tipo.options[tipo.selectedIndex].value;
        if(valor=="Estudiante"){
            var ele=document.getElementById("codEstudiante");
            ele.style.display=(ele.style.display=='none') ? 
            'block':'none';
        }else{
            if(valor=="Secretaria"){
                var eles=document.getElementById("tipoSecretaria");
                eles.style.display=(eles.style.display=='none') ? 
                'block':'none'; 
            }
        }
    }

    
</script>