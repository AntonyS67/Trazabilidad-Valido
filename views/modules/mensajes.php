<?php
session_start();

if(!$_SESSION["validar"]){
    header("Location:ingreso");
    exit();
}

include "views/modules/menu.php";
include "views/modules/cabezote.php";

?>

<div class="bandejaMensajes col-lg-4 col-sm-4 col-md-4 col-xs-4">
    <div>
        <h1>Bandeja de Entrada</h1>
        <hr>
    </div>
    <div class="botonEnviarCorreo">
        <hr>
        <button id="enviarCorreoMasivo" class="btn btn-success" onclick="mostrar_ocultar_mensaje_todos('mensajeTodos')">Enviar Mensaje a todos los Usuarios</button>
        <hr>
    </div>
    <div class="well well-sm">
        <a href="#"><span class="fa fa-times text-right"></span></a>
        <p>2018-12-16 11:58</p>
        <h3>De: Antoni</h3>
        <h5>Email: antony_grone12@live.com</h5>
        <input type="text" class="form-control" value="Lorem ipsum 1 dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet,consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit" readonly="">
        <br>
        <button class="btn btn-info btn-sm leerMensaje" onclick="mostrar_ocultar_contenido_mensaje('contenidoMensaje')">Leer</button>
    </div>
    
    
</div>

<div id="lecturaMensajes" class="lecturaMensajes col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div id="visorMensajes" class="visorMensajes" >
        <div class="well well-sm" id="contenidoMensaje" style="display:none">
            <h3>De: Antoni</h3>
            <h5>Email: antony_grone12@live.com</h5>
            <br>
            <p style="background:#fff;padding:10px">
            Lorem ipsum 1 dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet,consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit
            </p>
            <button class="btn btn-info btn-sm responderMensaje" onclick="mostrar_ocultar_responder('responderMensaje')">Responder</button>
        </div>
        <form action="" method="post" id="mensajeTodos" style="display:none">
            <p>Para: Todos los Usuarios</p>
            <input type="text" class="form-control" placeholder="Titulo del Mensaje" name="tituloMasivo">
            <textarea name="mensajeMasivo" class="form-control" id="" cols="30" rows="10" placeholder="Escribe tu Mensaje"></textarea>
            <input type="submit" value="Enviar" class="form-control btn btn-primary">
        </form>
        <form action="" method="post" id="responderMensaje" style="display:none">
            <p>Para:
                <input type="email" value=" antony_grone12@live.com" name="enviarEmail" readonly="" style="border:0">
            </p>
            <input type="text" name="enviarTitulo" placeholder="Título del Mensaje" class="form-control">
            <textarea name="enviarMensaje" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea>
            <input type="submit" class="form-control btn btn-primary" value="Enviar">
        </form>
    </div>
</div>