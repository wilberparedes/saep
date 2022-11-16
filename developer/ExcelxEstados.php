<?php

require_once 'var.php';
// require_once 'security.php';
require_once 'PDOConn.php';
require_once dirname(__FILE__) . '/PHPExcel/PHPExcel.php';

if(isset($_POST["inputJson"])){

    $name = datetimeNowString();
    // We'll be outputting an excel file
    header('Content-type: application/vnd.ms-excel');

    // It will be called file.xls
    header('Content-Disposition: attachment; filename="REPORTE_GENERAL_'.$name.'.xlsx"');

    $data = json_decode($_POST["inputJson"], true);

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $rowCount = 1;

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'Sede');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'Psicólogo');
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'Tipo identificación estudiante');
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, 'Identificación estudiante');
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'Nombre estudiante');
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'Nro. teléfono estudiante');
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, 'Código programa acádemico');
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, 'Programa acádemico');
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, 'Fecha');
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, 'Hora');
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, 'Notificado');
    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, 'Nro. de días vencida');
    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, 'En seguimiento');

    $rowCount++;
    foreach ($data['data'] as $key => $value) {
        $id = explode(" ", $value[2]);
        $programa = explode("~", $value[5]);
        $diasvencidosHTML = explode("</span>", $value[9]);
        $diasvencidos = explode(">", $diasvencidosHTML[0]);
        $seguimientoHTML = explode("</span>", $value[10]);
        $seguimiento = explode(">", $seguimientoHTML[0]);
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value[0]);//Sede
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value[1]);//Psicólogo
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $id[0]);//Tipo
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $id[1]);//Identificación
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value[3]);//Nombre
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value[4]);//Nro. teléfono
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $programa[0]);//Código
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $programa[1]);//Programa
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value[6]);//Fecha
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value[7]);//Hora
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value[8]);//Notificado
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $diasvencidos[1]);//Nro. de días vencida
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $seguimiento[1]);//En seguimiento
        $rowCount++;
    }

    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    
    $objWriter->save('php://output');

}else {
	echo '<script>alert("Información no encontrada.")</script>';
	echo '<img src="./assets/img/nodebi.jpg" style="width: 450px;display: block;margin: 0 auto;"/>';
}

?>