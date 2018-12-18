<?php 
    require '../vendor.autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;

    ob_start();
    require_once '../../views/modules/usuario.php';
    $html=ob_get_clean();
    if(isset($_POST["imprimir"])){
        $html2pdf=new Html2Pdf('P','A4','es','true','UTF-8');
        $html2pdf->writeHTML($html);
        $html2pdf->output('usuario.pdf');
    
    }
    
?>   