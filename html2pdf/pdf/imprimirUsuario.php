<?php
    require "../../controllers/usuario.php";
    require "../../models/usuario.php";
    require_once '../../models/usuario.php';
    require_once '../../models/secretaria.php';
    require_once '../../models/director.php';
    require_once '../../models/estudiante.php';
    require_once '../../models/tipo_secretaria.php';
    require '../vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;

class ImprimirUsuario{
    public function imprimirUsuarios(){
        $html2pdf = new Html2Pdf('P', 'A4');
        
        $html= <<<EOF
        <div style="margin-left:35%">
            <h2 style="color:#33ff8a">Reporte de Usuarios</h2>
        </div>
        <table style="margin:auto;margin-top:20px;border-top: 2px solid #33ff90;border-bottom: 1px solid #333; text-align:center; line-height: 20px; font-size:10px; font-weight:bold">
            <tr style="border-bottom: 1px solid #333;">
                <td style="width:50px">DNI</td>
                <td style="width:150px">Nombres Completos</td>
                <td style="width:50px">Sexo</td>
                <td style="width:150px">Email</td>
                <td style="width:60px">Celular</td>
                <td style="width:70px">Tipo Usuario</td>
                <td style="width:80px">Fecha Registro</td>
            </tr>
        </table>
EOF;
$html2pdf->writeHTML($html);
    $usuario=new UsuarioController();
    $respuesta=$usuario->impresionUsuariosController();
    foreach($respuesta as $row=>$item){
        if($item['tipo_user'] == 'Administrador'){
            $color='red';
        }else if($item['tipo_user'] == 'Estudiante'){
            $color='green';
        }else if($item['tipo_user']== 'Secretaria'){
        $color='yellow';
        }
        $html2 = <<<EOF
        <table style="margin:auto;border-bottom: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
            <tr class="info-user" style="background-color:$color"> 
                <td style="width:50px">$item[dni]</td>
                <td style="width:150px">$item[primer_nombre] $item[segundo_nombre] $item[ap_paterno] $item[ap_materno]</td>
                <td style=" width:50px">$item[sexo]</td>
                <td style=" width:150px">$item[email]</td>
                <td style=" width:60px">$item[celular]</td>
                <td style=" width:70px">$item[tipo_user]</td>
                <td style=" width:80px">$item[fecha_registro]</td>
            </tr>
        </table>
             
EOF;
    
$html2pdf->writeHTML($html2);

    }
    $html2pdf->output('usuarios.pdf');
    }

}
$a=new ImprimirUsuario();
$a->imprimirUsuarios();
?>