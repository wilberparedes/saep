<?php
date_default_timezone_set('America/Bogota');
include 'config.php';

/*Funciones de operacion retorna 0 o 1*/
function query($sql,$params=null){
    try {
        
        $conn= new PDO(connstring,user,pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $sw= true; 
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
        // $sw=json_encode(array("mensaje" => $ex->getMessage()));
        $sw=false;
    }
  return $sw;
}

/*Devuelve una fila*/
function row($sql,$params=null){
    try {
        
        $conn= new PDO(connstring,user,pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
  return $row;
}

/*Devuelve una id del que se insertó*/
function DataRow($sql,$params=null){
    try {
        
        $conn= new PDO(connstring,user,pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $DataRow = $stmt->fetch(PDO::FETCH_ASSOC);
         
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
  return $DataRow;
}

/*Devuelve una tabla*/
function table($sql,$params=null){
    $data=array();
    
    try {
        
        $conn= new PDO(connstring,user,pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
             $data[] = $row;   
        }  
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
  return $data;
}

// *Devolver hora actual*

function datetimeNow(){
    $actual = date("Y-m-d H:i:s");
    return $actual;
}
function datetimeNowString(){
    $actual = date("Ymd_His");
    return $actual;
}
function datetimeNowName(){
    $actual = date("YmdHis");
    return $actual;
}

function dateNow(){

    $fechaactual = getdate();

    $anio=$fechaactual['year'];
    $mes=$fechaactual['mon'];
    $dia=$fechaactual['mday'];


    $actual =  ($anio<=9 ? '0' .$anio : $anio)."-".($mes<=9 ? '0' .$mes : $mes)."-".($dia<=9 ? '0' .$dia : $dia);

    return $actual;
}

function conversorSegundosHoras($tiempo_en_segundos) {
    $horas = floor($tiempo_en_segundos / 3600);
    $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

    return ($horas < 10 ? '0'.$horas : $horas) . ':' . ($minutos < 10 ? '0'.$minutos : $minutos) . ":" . ($segundos < 10 ? '0'.$segundos : $segundos);
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'ano',
        'm' => 'mes',
        'w' => 'semana',
        'd' => 'dia',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? 'Hace ' . implode(', ', $string) : 'Justo ahora';
}

function formatID($nID){
    $nID = trim($nID);
    //lo hice así, porque así lo quise.
    if($nID == 'C'){
        return 'C.C';
    }
    else if($nID == 'CC'){
        return 'C.C';
    }
    else if($nID == 'E'){
        return 'C.E';
    }
    else if($nID == 'CE'){
        return 'C.E';
    }
    else if($nID == 'T'){
        return 'T.I';
    }
    else if($nID == 'TI'){
        return 'T.I';
    }
    else{
        return $nID;
    }
}

function convertEntrevista($entrevista){

    $entre = array(
        'codigoentrevista' => $entrevista["codigo_entrevista"],
        'codestudiante' => $entrevista["codestudiante_fk"],
        'fechaentrevista' => $entrevista["fecha_entrevista"],
        'nombrecompleto' => replacein($entrevista["nombre_completo"]),
        'emailper' => $entrevista["email_per"],
        'codcolegio' => $entrevista["codcolegio_fk"],
        'fechaicfes' => $entrevista["fecha_icfes"],
        'registroac' => $entrevista["registro_ac"],
        'sexo' => $entrevista["sexo"],
        'edad' => $entrevista["edad"],
        'estadocivil' => $entrevista["estado_civil"],
        'situacionlaboral' => $entrevista["situacion_laboral"],
        'codagrupacion' => $entrevista["codagrupacion_fk"],
        'codtipopoblacion' => $entrevista["codtipopoblacion_fk"],
        'codtipodiscapacidad' => $entrevista["codtipodiscapacidad_fk"],
        'telefono' => $entrevista["telefono"],
        'otrotelefono' => $entrevista["otrotelefono"],
        'fijo' => $entrevista["fijo"],
        'direccion' => $entrevista["direccion"],
        'lugarresidencia' => $entrevista["lugar_residencia"],
        'barrioresidencia' => $entrevista["barrio_residencia"],
        'codprograma' => $entrevista["codprograma"],
        'nombreprograma' => $entrevista["nombre_programa"],
        'requisitosmv' => $entrevista["requisitos_mv"],
        'codacomacademico' => $entrevista["codacomacade"],
        'codacompsicologico' => $entrevista["codacompsico"],
        'pruebapsico' => $entrevista["codpruebapsico"],
        'conclusionesentrevista' => UppercaseAccent($entrevista["conclusiones"]),
        'codpsicologo' => $entrevista["codpsicologo_fk"],
        'nombrepsicologo' => $entrevista["nombrepsicologo"],
        'estadoentrevista' => $entrevista["estado"],
        'nombrecolegio' => $entrevista["nombre_colegio"],
        'codpropiedadplantafisica' => $entrevista["codpropiedadplantafisica_fk"],
        'estrato' => $entrevista["estrato"],
        'codperiodo' => $entrevista["codperiodo"],
    );
    return $entre;
}

function _data_last_month_day($year, $month) { 
    $day = date("d", mktime(0,0,0, $month+1, 0, $year));

    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
};

/** Actual month first day **/
function _data_first_month_day($year, $month) {
    return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
}

function replacein($data){
    $newname = str_replace("?", "Ñ", $data);
    return $newname;
}

function replaceinMin($data){
    $newname = str_replace("?", "ñ", $data);
    return $newname;
}
function replaceSpace($data){
    $newname = str_replace(" ", "-", $data);
    return strtoupper(strtolower($newname));
}
function myUppercase($data){
    $newname = ucfirst(strtolower($data));
    return $newname;
}
function UppercaseAccent($data){
    $search = array("á", "é", "í", "ó", "ú", "ñ");
    $replace = array("Á", "É", "Í", "Ó", "Ú", "Ñ");
    $texto_salida = str_replace($search, $replace, $data);
    return $texto_salida;
}


function returnDays($datestart, $dateend){
    $fecha1= new DateTime($datestart);
    $fecha2= new DateTime($dateend);
    $diff = $fecha1->diff($fecha2);
    return $diff->days;
}

?>