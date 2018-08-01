<?php

require_once '../../controllers/SuscribersController.php';
require_once '../../models/SuscribersModel.php';


class SuscribersImpresion {

public function imprimirSuscriptores(){

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->AddPage();

$htmlsuscriptores = <<<EOF

    <table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>

		<tr>
			<td width="200px"></td>
			<td style="width:140px"><img src="images/logotipo.jpg"></td>
			<td width="200px"></td>
		</tr>
	</table>

	<table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Nombre</td>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Email</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($htmlsuscriptores, false, false, false, false, ''); 

$respuesta = SuscribersController::imprimirSuscriptores("suscriptores");
// la solución para imprimirlo es crearlo de manera estática 

foreach($respuesta as $key => $item) {

$htmlsuscriptores2 = <<<EOF

    <table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
			<td style="border: 1px solid #666;">$item[nombre]</td>
			<td style="border: 1px solid #666;">$item[email]</td>
		</tr>
	</table>



EOF;

$pdf->writeHTML($htmlsuscriptores2, false, false, false, false, ''); 

}


$pdf->Output('suscribers.pdf', 'I');

}


}

$impresion = new SuscribersImpresion();
$impresion->imprimirSuscriptores();