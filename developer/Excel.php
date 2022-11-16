<?php

require_once 'var.php';
require_once 'security.php';
require_once 'PDOConn.php';
require_once dirname(__FILE__) . '/PHPExcel/PHPExcel.php';

if(isset($_POST["inputJson"])){

    $name = datetimeNowString();
    // We'll be outputting an excel file
    header('Content-type: application/vnd.ms-excel');

    // It will be called file.xls
    header('Content-Disposition: attachment; filename="REPORTE_ENTREVISTAS_GESTIONADAS_'.$name.'.xlsx"');

    $data = json_decode($_POST["inputJson"], true);

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $rowCount = 1;

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'Sede');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'Psicólogo');
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'Tipo identificación estudiante');
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, 'Identificación estudiante');
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'Nombre estudiante');
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'Código programa acádemico');
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, 'Programa acádemico');
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, 'Fecha');

    $rowCount++;
    foreach ($data['data'] as $key => $value) {
        $id = explode(" ", $value[2]);
        $programa = explode("~", $value[4]);
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value[0]);
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value[1]);
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $id[0]);
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $id[1]);
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value[3]);
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $programa[0]);
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $programa[1]);
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value[5]);
        $rowCount++;
    }

    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    
    $objWriter->save('php://output');

}else {
	echo '<script>alert("Información no encontrada.")</script>';
	echo '<img src="./assets/img/nodebi.jpg" style="width: 450px;display: block;margin: 0 auto;"/>';
}

?>