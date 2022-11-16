<?php


// Include the main TCPDF library (search for installation path).
require_once 'var.php';
require_once 'security.php';
require_once 'PDOConn.php';
require_once('./tcpdf/tcpdf.php');

define('PATH_IMAGES','./images/');

if(isset($_POST["idestudiante"])){


	$documento = $_POST["idestudiante"];
	$codprograma = $_POST["codprogramatemp"];
	$codperiodo = $_POST["codperiodotemp"];

	$sqlPPP = "SELECT codigo_ppf as cod, nombre_ppf as nombre, estado_ppf FROM propiedad_planta_fisica WHERE estado_ppf = 'on'";
	$tablePPP = table($sqlPPP);
	$estadoCivil = array('CA' => 'Casado/a', 'DI' => 'Divorciado/a', 'SO' => 'Soltero/a', 'UL' => 'UniÓn libre', 'CO' => 'Viudo/a');

	$sqlAcomAcade = "SELECT codigo as cod, CONCAT(codigo, ' - ', nombre) as nombre FROM plan_acompanamiento WHERE estado = 'on' AND tipo = :tipo";
	$tableAcomAcade = table($sqlAcomAcade, array(':tipo' => 1));
	$sqlAcomPsico = "SELECT codigo as cod, CONCAT(codigo, ' - ', nombre) as nombre FROM plan_acompanamiento WHERE estado = 'on' AND tipo = :tipo";
	$tableAcomPsico = table($sqlAcomPsico, array(':tipo' => 2));

	$sqlPruebasPsico = "SELECT codigo_ppt as cod, nombre_ppt as nombre, estado_ppt FROM pruebas_psicotecnicas WHERE estado_ppt = 'on'";
	$tablePruebasPsico = table($sqlPruebasPsico);

	$aspectos = array();
	$sql = "SELECT codigo_ae, nombre_ae, estado_ae FROM aspectos_evaluacion WHERE estado_ae = :estado ORDER BY  codigo_ae asc";
	$params = array(':estado' => 'on');
	$table = table($sql, $params);

	foreach ($table as $key => $value) {

		$sqlConceptos = "SELECT codigo_ce, nombre_ce, codaspectos_fk, estado_ce, sugerencias FROM concepto_evaluar WHERE codaspectos_fk = :codaspectos AND estado_ce = :estado ORDER BY codigo_ce ASC";
		$paramsConceptos = array(':codaspectos' => $value["codigo_ae"], ':estado' => 'on');
		$tableConceptos = table($sqlConceptos, $paramsConceptos);
		$conceptos = array();

		foreach ($tableConceptos as $key1 => $value1) {

			$sqlRespuestas = "SELECT codigo_rc, nombre_rc, val_respuesta FROM respuestas_concepto WHERE codconcepto_fk =:codconcepto ORDER BY orden_ac ASC";
			$paramsRespuestas = array(':codconcepto' => $value1["codigo_ce"]);
			$tableRespuestas = table($sqlRespuestas, $paramsRespuestas);

			array_push($conceptos, array('codigo_ce' => $value1['codigo_ce'], 'nombre_ce' => $value1['nombre_ce'], 'codaspecto' => $value1["codigo_ce"], 'sugerencias' => ($value1["sugerencias"] == NULL ? 'Ninguna' : nl2br($value1["sugerencias"])), 'respuestas' => $tableRespuestas));

		}

		array_push($aspectos, array('codigo_ae' => $value['codigo_ae'], 'nombre_ae' => $value['nombre_ae'], 'conceptos' => $conceptos));

	}



	$row = row("SELECT codigo_entrevista, codestudiante_fk, to_char(fecha_entrevista, 'YYYY-MM-DD HH12:MI:SS A.M.') as fecha_entrevista, nombre_completo, email_per, codcolegio_fk, TO_CHAR(fecha_icfes, 'dd/mm/yyyy') as fecha_icfes, registro_ac, sexo, edad,  estado_civil, situacion_laboral, codagrupacion_fk, codtipopoblacion_fk, codtipodiscapacidad_fk, telefono, otrotelefono, fijo, direccion, lugar_residencia, barrio_residencia, codprograma, nombre_programa, requisitos_mv, codacomacade, codacompsico, conclusiones, codpsicologo_fk, dp.nombre as nombrepsicologo, entrevistas.codperiodo, entrevistas.estrato, entrevistas.estado, codpruebapsico, c.codigo_colegio, c.nombre_colegio, c.codpropiedadplantafisica_fk
						FROM entrevistas
						INNER JOIN colegios c ON c.codigo_colegio = entrevistas.codcolegio_fk
						INNER JOIN datospersonales dp ON dp.identificacion = entrevistas.codpsicologo_fk
						WHERE codestudiante_fk = :documento
						AND entrevistas.codprograma = :codprograma
						AND entrevistas.codperiodo = :codperiodo;", array(':documento' => $documento, ':codprograma' => $codprograma, ':codperiodo' => $codperiodo));

	$tablerespuestas = table("SELECT codigo_rpe, codaspectos_fk as codaspecto, codconcepto_fk as codconcepto, codrespuesta_fk as codrespesta, valor_rpe as valor, observacion_rpe as observacion
								FROM respuestas_entrevistas re
								INNER JOIN concepto_evaluar ce ON ce.codigo_ce = re.codconcepto_fk
								WHERE codentrevista_fk = :codentrevista
								order by codaspecto, codconcepto_fk  asc ", array(':codentrevista' => $row["codigo_entrevista"]));

	$tableIcfes = table("SELECT codigo_pi, nombre_pi as nombre, puntaje_pi as puntaje FROM puntajes_icfes WHERE codestudiante_fk = :co ORDER BY codigo_pi ASC", array(':co' => $documento));

	$tableGP = table("SELECT codagrupacion_fk as codagrupacion, gp.nombre_gp as nombreagrupacion, gpe.codtipopoblacion_fk as codtipopoblacion, tp.nombre_tp as nombretipopoblacion, gpe.codtipodiscapacidad_fk as codtipodiscapacidad, td.nombre_td as nombrediscapacidad, td.descripcion_td as descripciondiscapacidad, ruv, gpe.codsubtipodiscapacidad_fk as codsubtipodiscapacidad, stp.nombre_std as nombresubtipodiscapacidad, descripcion_std
						FROM gp_estudiante gpe
						INNER JOIN grupo_priorizado AS gp ON gp.codigo_gp = gpe.codagrupacion_fk 
						INNER JOIN tipo_poblacion AS tp ON tp.codigo_tp = gpe.codtipopoblacion_fk 
						LEFT JOIN tipo_discapacidad AS td ON td.codigo_td = gpe.codtipodiscapacidad_fk 
						LEFT JOIN subtipo_discapacidad AS stp ON stp.codigo_std = gpe.codsubtipodiscapacidad_fk 
						WHERE codentrevista_fk = :ce
						ORDER BY codigo_gpe ASC", array(':ce' => $row["codigo_entrevista"]));

	$entrevista = array('success' => true, 'entrevista' => convertEntrevista($row), 'gp' => $tableGP, 'lengp' => count($tableGP), 'respuestas' => $tablerespuestas, 'icfes' => $tableIcfes);

	$dataEntrevista = $entrevista['entrevista'];

	$sTipoColegio = array_search($dataEntrevista['codpropiedadplantafisica'], array_column($tablePPP, 'cod')); 

	$nombrePDF = 'PERIODO-'.$codperiodo.'-ENTREVISTA-'.$dataEntrevista['codestudiante'].'-'.replaceSpace($dataEntrevista['nombrecompleto']).'-PROGRAMA-ACADÉMICO-'.$dataEntrevista['codprograma'].'-'.replaceSpace($dataEntrevista['nombreprograma']);

	// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {
		//Page header
		public function Header() {
			// get the current page break margin
			$bMargin = $this->getBreakMargin();
			// get current auto-page-break mode
			$auto_page_break = $this->AutoPageBreak;
			// disable auto-page-break
			$this->SetAutoPageBreak(false, 0);
			// set bacground image
			$img_file = PATH_IMAGES.'background-2.png';
			// $this->Image($img_file, 0, 0, 210, 300, '', '', '', false, 300, '', false, false, 0);
			$this->Image($img_file, 0, 0, 215, 280, '', '', '', false, 300, '', false, false, 0);
			// restore auto-page-break status
			$this->SetAutoPageBreak($auto_page_break, $bMargin);
			// set the starting point for the page content
			$this->setPageMark();
		}
	}

	// create new PDF document     n     
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor($dataEntrevista['nombrepsicologo']);
	$pdf->SetTitle($nombrePDF);
	$pdf->SetSubject('Sistema de Admisión y Entrevista Psicológica');
	// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(0);
	$pdf->SetFooterMargin(0);

	// remove default footer
	$pdf->setPrintFooter(false);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('helvetica', '', 12);

	// add a page
	$pdf->AddPage();

	$dad = 'background-color: #0073b7; font-family: helvetica; font-weight:bold; color: white; font-size: 10px; ';
	$child = 'font-size: 9px; ';

	$html = '<table style="padding-top: 0px;">
		<tr>
			<td>
				<table border="1" cellpadding="5" cellspacing="0" style="width:100%">
					<tr>
						<td style="'.$dad.'">Fecha entrevista:</td>
						<td style="'.$child.'">'.$dataEntrevista['fechaentrevista'].'</td>
						<td style="'.$dad.'">Identificación:</td>
						<td style="'.$child.'">'.$dataEntrevista['codestudiante'].'</td>
					</tr>
					<tr>
						<td style="'.$dad.'">Nombre completo:</td>
						<td style="'.$child.'">'.$dataEntrevista['nombrecompleto'].'</td>
						<td style="'.$dad.'">E-Mail:</td>
						<td style="'.$child.'">'.$dataEntrevista['emailper'].'</td>
					</tr>
					<tr>
					
						<td style="'.$dad.'">Nombre del colegio:</td>
						<td style="'.$child.'">'.$dataEntrevista['nombrecolegio'].'</td>
						<td style="'.$dad.'">Tipo de colegio:</td>
						<td style="'.$child.'">'.$tablePPP[$sTipoColegio]['nombre'].'</td>
					</tr>
					<tr>
						<td style="'.$dad.'">Fecha presentación ICFES:</td>
						<td style="'.$child.'">'.$dataEntrevista['fechaicfes'].'</td>
						<td style="'.$dad.'">Registro AC ICFES:</td>
						<td style="'.$child.'">'.$dataEntrevista['registroac'].'</td>
					</tr>
					<tr>
						<td style="'.$dad.'">Sexo:</td>
						<td style="'.$child.'">'.($dataEntrevista['sexo'] === 'F' ? 'FEMENINO' : 'MASCULINO').'</td>
						<td style="'.$dad.'">Edad:</td>
						<td style="'.$child.'">'.$dataEntrevista['edad'].'</td>
					</tr>
					<tr>
						<td style="'.$dad.'">Estado civil:</td>
						<td style="'.$child.'">'.strtoupper(strtolower($estadoCivil[$dataEntrevista['estadocivil']])).'</td>
						<td style="'.$dad.'">Situación laboral:</td>
						<td style="'.$child.'">'.strtoupper(strtolower($dataEntrevista['situacionlaboral'])).'</td>
					</tr>
					<tr>
						<td style="'.$dad.'">Teléfono móvil:</td>
						<td style="'.$child.'">'.$dataEntrevista['telefono'].'</td>
						<td style="'.$dad.'">Otro Teléfono:</td>
						<td style="'.$child.'">'.$dataEntrevista['otrotelefono'].'</td>
					</tr>
					<tr>
						<td style="'.$dad.'">Teléfono fijo:</td>
						<td style="'.$child.'">'.$dataEntrevista['fijo'].'</td>
						<td style="'.$dad.'">Dirección de residencia:</td>
						<td style="'.$child.'">'.$dataEntrevista['direccion'].'</td>
					</tr>
					<tr>
						<td style="'.$dad.'">Estrato socioeconómico:</td>
						<td style="'.$child.'">'.($dataEntrevista['estrato'] ? $dataEntrevista['estrato'] : '1' ).'</td>
						<td style="'.$dad.'">Lugar de residencia:</td>
						<td style="'.$child.'">'.$dataEntrevista['lugarresidencia'].'</td>
					</tr>
					<tr>
						<td style="'.$dad.'">Barrio de residencia:</td>
						<td style="'.$child.'">'.$dataEntrevista['barrioresidencia'].'</td>
						<td style="'.$dad.'">Carrera a cual aspira:</td>
						<td style="'.$child.'">'.$dataEntrevista['codprograma'].' - '.$dataEntrevista['nombreprograma'].'</td>
					</tr>';

					if($dataEntrevista['requisitosmv']){
						$html .= '
						<tr>
							<td style="'.$dad.'">Requerimiento modalidad virtual:</td>';

							$requisitosmv = explode(",", $dataEntrevista['requisitosmv']);
							$i = 1;
							$htmlrequisitos = '';
							foreach ($requisitosmv as $key => $requisitomv) {
								$htmlrequisitos .= $requisitomv. ($i < count($requisitosmv) ? ', ' : '');
								$i++;
							}

						$html .= '
							<td style="'.$child.'" colspan="3">'.$htmlrequisitos.'</td>
						</tr>';
					}
		$html .= '</table>
			</td>
		</tr>
		<tr>
			<td>';
			$i = 1;
			foreach ($entrevista['gp'] as $key => $value) {
				$html .= '
					<table border="1" cellpadding="5" cellspacing="0" style="width:100%">
						<tr>
							<td style="'.$dad.'">Grupo priorizado '.$i.':</td>
							<td style="'.$dad.'">Tipo de población '.$i.':</td>';
							if($value['codtipodiscapacidad']){
								$html .= '<td style="'.$dad.'">'.($value['codtipopoblacion'] == 1 ? 'Tipo de discapacidad ' : 'Talento excepcional ').$i.':</td>';
								if($value['codsubtipodiscapacidad']){
									$html .= '<td style="'.$dad.'">Subipo de discapacidad '.$i.':</td>';
								}
							}
							if($value['ruv']){
								$html .= '<td style="'.$dad.'">RUV '.$i.':</td>';
							}
				$html .= '</tr>
						<tr>
							<td style="'.$child.'">'.$value['nombreagrupacion'].'</td>
							<td style="'.$child.'">'.$value['nombretipopoblacion'].'</td>';
							if($value['codtipodiscapacidad']){
								$html .= '<td style="'.$child.'">'.$value['nombrediscapacidad'].'</td>';
								if($value['codsubtipodiscapacidad']){
									$html .= '<td style="'.$child.'">'.$value['nombresubtipodiscapacidad'].'</td>';
								}
							}
							if($value['ruv']){
								$html .= '<td style="'.$child.'">'.$value['ruv'].'</td>';
							}
				$html .= '</tr>';
				$html .= '</table>';
				$i++;
			}
	$html .= '</td>
		</tr>
		<tr>
			<td>';
			$sumGen = 0;
			foreach ($aspectos as $key => $value) {
				$html .= '
						<table border="1" cellpadding="5" cellspacing="0" style="width:100%">
							<tr>
								<td style="'.$dad.'; padding: 10px" colspan="4">'.$value{'nombre_ae'}.'</td>
							</tr>
							<tr>
								<td style="'.$dad.'; width: 50%">CONCEPTO A EVALUAR</td>
								<td style="'.$dad.'; width: 15%">RANGO DE EVALUACIÓN</td>
								<td style="'.$dad.'; width: 25%">OBSERVACIONES ESPECIFICAS</td>
								<td style="'.$dad.'; background-color: rgb(51, 51, 51); width: 10%; text-align: center;">PUNTAJE</td>
							</tr>';

						$puntajeAspecto = 0;
						foreach ($value{'conceptos'} as $key => $concepto) {
							$indexRespuesta = array_search($concepto['codigo_ce'], array_column($entrevista['respuestas'], 'codconcepto')); 
							$indexNombreRespuesta = array_search($entrevista['respuestas'][$indexRespuesta]['codrespesta'], array_column($concepto['respuestas'], 'codigo_rc')); 
							$html .= '
							<tr>
								<td style="'.$child.'; width: 50%">'.$concepto['nombre_ce'].'</td>
								<td style="'.$child.'; width: 15%;">'.$concepto['respuestas'][$indexNombreRespuesta]['nombre_rc'].'</td>
								<td style="'.$child.'; width: 25%">'.myUppercase($entrevista['respuestas'][$indexRespuesta]['observacion']).'</td>
								<td style="'.$child.'; width: 10%; text-align: center;">'.$entrevista['respuestas'][$indexRespuesta]['valor'].'</td>
							</tr>';
							$puntajeAspecto = $puntajeAspecto + floatval($entrevista['respuestas'][$indexRespuesta]['valor']);
						}
						$html .= '
							<tr>
								<td style="'.$dad.'; background-color: rgb(51, 51, 51);" colspan="3">PUNTAJE TOTAL: '.$value{'nombre_ae'}.'</td>
								<td style="'.$child.'text-align: center; font-weight: bold; font-size: 10px;">'.$puntajeAspecto.'</td>
							</tr>';
						$sumGen = $sumGen + $puntajeAspecto;

				$html .= '</table>';
			}
			
	$html .= '
			</td>
		</tr>
		<tr>
			<td>
				<table border="1" cellpadding="5" cellspacing="0" style="width:100%;">
					<tr>
						<td style="'.$dad.'; background-color: rgb(51, 51, 51); text-align: right;" colspan="2">PUNTAJE TOTAL DE LA ENTREVISTA</td>
						<td style="'.$child.'; font-weight: bold; font-size: 10px;" colspan="2">'.$sumGen.'</td>
					</tr>
				</table>
			</td>
		</tr>';

	$html .= '
		<tr>
			<td>
				<table border="1" cellpadding="5" cellspacing="0" style="width:100%">
					<tr>
						<td style="'.$dad.';" colspan="2">ASPECTOS EVALUATIVOS PRUEBAS SABER</td>
					</tr>
					<tr>
						<td style="'.$dad.'">COMPONENTES SABER 11</td>
						<td style="'.$dad.'">PUNTAJE ICFES</td>
					</tr>';
					foreach ($entrevista['icfes'] as $key => $icfes) {
						$html .= '
						<tr>
							<td style="'.$child.'">'.$icfes['nombre'].'</td>
							<td style="'.$child.'">'.$icfes['puntaje'].'</td>
						</tr>';
					}
				$html .= '
				</table>
			</td>
		</tr>';


		$html .= '
		<tr>
			<td>
				<table border="1" cellpadding="5" cellspacing="0" style="width:100%">
					<tr>
						<td style="'.$dad.'; " colspan="2">CONCEPTO FINAL ENTREVISTA</td>
					</tr>
					<tr>
						<td style="'.$dad.'; background-color: rgb(51, 51, 51); text-align:right">ADMITIDO:</td>
						<td style="'.$child.'">SÍ</td>
					</tr>
					<tr>
						<td style="'.$dad.'; background-color: rgb(51, 51, 51); text-align:right">ACOMPAÑAMIENTO ACADÉMICO:</td>
						<td style="'.$child.'">'.($dataEntrevista['codacomacademico'] ? 'SÍ' : 'NO').'</td>
					</tr>';
					
					if($dataEntrevista['codacomacademico']){
						$html .= '
						<tr>
							<td style="'.$child.'; font-weight: bold;" colspan="2">';
							$acomAcade = explode(",", $dataEntrevista['codacomacademico']);
							$i = 1;
							foreach ($acomAcade as $key => $codAcomAcade) {
								$indexAcomAcade = array_search($codAcomAcade, array_column($tableAcomAcade, 'cod')); 
								$html .= $i.'. '.$tableAcomAcade[$indexAcomAcade]['nombre']. ($i < count($acomAcade) ? ' <br/>' : '');
								$i++;
							}
						$html .= '
							</td>
						</tr>';
					}
					

					$html .= '
					<tr>
						<td style="'.$dad.'; background-color: rgb(51, 51, 51); text-align:right">ACOMPAÑAMIENTO PSICOLÓGICO:</td>
						<td style="'.$child.'">'.($dataEntrevista['codacompsicologico'] ? 'SÍ' : 'NO').'</td>
					</tr>';
					if($dataEntrevista['codacompsicologico']){
						$html .= '
						<tr>
							<td style="'.$child.'; font-weight: bold;" colspan="2">';
							$acomPsico = explode(",", $dataEntrevista['codacompsicologico']);
							$i = 1;
							foreach ($acomPsico as $key => $codAcomPsico) {
								$indexAcomPsico = array_search($codAcomPsico, array_column($tableAcomPsico, 'cod')); 
								$html .= $i.'. '.$tableAcomPsico[$indexAcomPsico]['nombre']. ($i < count($acomPsico) ? ' <br/>' : '');
								$i++;
							}
						$html .= '
							</td>
						</tr>
						<tr>
							<td style="'.$child.'; font-weight: bold;" colspan="2">Nota: Los acompañamientos descritos en este instrumento obedecen a una impresión diagnostica del proceso de entrevista, que requerirá validar con un profesional especialista.</td>
						</tr>';
					}
					
					$i = 0;
					$descripcionesDiscapacidad = '';
					foreach ($entrevista['gp'] as $key => $value) {
						
						if($value['nombresubtipodiscapacidad']){
							if($i > 0){
								$descripcionesDiscapacidad .= '<br/><br/>';
							}
							$i++;
							$descripcionesDiscapacidad .= $i.'. '.$value['nombresubtipodiscapacidad'].': '.($value['descripcion_std'] ? $value['descripcion_std'] : 'Sin descripción.' );
						}else if($value['descripciondiscapacidad']){
							if($i > 0){
								$descripcionesDiscapacidad .= '<br/><br/>';
							}
							$i++;
							$descripcionesDiscapacidad .= $i.'. '.$value['nombrediscapacidad'].': '.$value['descripciondiscapacidad'];
						}
					}
					if($i > 0){
						$html .= '
						<tr>
							<td style="'.$dad.'; background-color: rgb(51, 51, 51); text-align:right">ACOMPAÑAMIENTO POR DISCAPACIDAD:</td>
							<td style="'.$child.'" colspan="2">SÍ</td>
						</tr>';
						$html .= '
						<tr>
							<td style="'.$child.'; font-weight: bold;" colspan="2">'.$descripcionesDiscapacidad.'</td>
						</tr>';
					}

					$html .= '
				</table>
			</td>
		</tr>';


		$html .= '
		<tr>
			<td>
				<table border="1" cellpadding="5" cellspacing="0" style="width:100%">
					<tr>
						<td style="'.$dad.'; " colspan="2">APLICACIÓN DE PRUEBAS PSICOTECNICAS</td>
					</tr>
					<tr>
						<td style="'.$child.'; font-weight: bold;" colspan="2">';

							if($dataEntrevista['pruebapsico']){
								$i = 0;
								$pruebasPsico = explode(",", $dataEntrevista['pruebapsico']);
								foreach ($pruebasPsico as $key => $codprueba) {
									$i++;
									$indexPruebaPsico = array_search($codprueba, array_column($tablePruebasPsico, 'cod')); 
									$html .= $i.'. '.$tablePruebasPsico[$indexPruebaPsico]['nombre'].' <br/>';
								}
							}
					$html .= '
						</td>
					</tr>
				</table>
			</td>
		</tr>';

		$html .= '
		<tr>
			<td>
				<table border="1" cellpadding="5" cellspacing="0" style="width:100%">
					<tr>
						<td style="'.$dad.'; " colspan="2">CONCLUSIONES DE ADMISIÓN E IMPRESIÓN DIAGNOSTICA DE ASPECTOS EN EL ACOMPAÑAMIENTO DETERMINADO</td>
					</tr>
					<tr>
						<td style="'.$child.'; font-weight: bold;" colspan="2"><p>'.UppercaseAccent($dataEntrevista['conclusionesentrevista']).'</p></td>
					</tr>
				</table>
			</td>
		</tr>';

		$html .= '
		<tr>
			<td>
				<table border="1" cellpadding="5" cellspacing="0" style="width:100%;">
					<tr>
						<td style="'.$dad.'; background-color: rgb(51, 51, 51); text-align: right;" colspan="2">ENTREVISTA GESTIONADA POR: </td>
						<td style="'.$child.'; font-weight: bold; font-size: 10px;" colspan="2">'.$dataEntrevista['nombrepsicologo'].'</td>
					</tr>
				</table>
			</td>
		</tr>';

	$html .= '</table>';

	$pdf->writeHTML($html, true, false, true, false, '');

	//Close and output PDF document
	$pdf->Output($nombrePDF.'.pdf', 'I');


	//============================================================+
	// END OF FILE
	//============================================================+
}else {
	echo '<script>alert("Información no encontrada.")</script>';
	echo '<img src="./assets/img/nodebi.jpg" style="width: 450px;display: block;margin: 0 auto;"/>';
}
