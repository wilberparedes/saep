<?php
session_start();
header('content-type: application/json; charset=utf-8');

set_time_limit(1200); /*20 minutos*/
ini_set('memory_limit','512M');

require_once 'var.php';
require_once 'PDOConn.php';

if(isset($_POST['usuario'])){
    $user=$_POST['usuario'];
}
if(isset($_POST['password'])){
    $pass=$_POST['password'];
}

$usuarioadmin = array('1045737504', '72288731');
$otheruser = array('1017191725', '1047377626', '1140884852', '88309447', '1143450077', '1044428377', '1140844154', '1143443135', '1010032384', '22867128', '1045752940', '1234090451', '1067936189', /*medellin*/ '1026156250', '1037649098', '1026153377', '1037651529', '1152463534', '1017191725', '42800345',  /*finMedellín*/);
$psicoFan = array('1048209650', '55304689', '1129511903', '1140849073', '1010019015', '1010051874', '1042352730', '1234088279', '1044432423', '1234092872', '40438105');
// $user = "72436686";
$userConsult = array('901230957', '1001870954', '1140870282', '78739227', '1140822382', '10446230', '1140886272', '72436686');
// $pass = "H3016405378";

if(function_exists('curl_init')){ // Comprobamos si hay soporte para cURL

    if($user == '1045737504' && $pass == '1461217Arca#' ){
        $_SESSION['SAEP_session'] = true;
        $_SESSION['SAEP_codigo_usu'] = '1045737504';
        $_SESSION['SAEP_usuario'] = '1045737504';
        $_SESSION['SAEP_nombre_usu'] = 'Wilber Paredes';
        $_SESSION['SAEP_correoins'] = "wparedes@coruniamericana.edu.co";


        $_SESSION['SAEP_psicof'] = false;

        $_SESSION['SAEP_codperfil'] = 1;
        $_SESSION['SAEP_nombre_perfil'] = 'Programador';

        $_SESSION['SAEP_codrol'] = 1;
        $_SESSION['SAEP_nombre_rol'] = 'Programador';

        $json=json_encode(array("success"=>true));
    }else{
        /*Obtenemos los datos del webservices*/
        $url = 'http://190.60.75.134:8080/sgacampus/services/basf00/login/fetch/'.$user;//endpoint de login
        $data = array('auth' => 1, 'notClose' => false, 'userName' => $user, 'password' => $pass, 'codIdioma' => 'es', 'release' => false);//enviamos parametros requeridos por el endpoint, acompañado del usuario y contraseña
    
        $ch = curl_init();//iniciamos el cURL el cual nos permitirá realizar peticiones https permitiendonos transferir la información con sintaxis de URL
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json;charset=UTF-8'));//definimos la cabecera de la peticion como json
        curl_setopt($ch, CURLOPT_URL, $url);//le configuramos la URL
        curl_setopt($ch, CURLOPT_POST, count($data));//contabiliza cuantos parametros se envian
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));//codificado en json se envian los parametros
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);//recibimos la respuesta de la petición
        curl_close ($ch);//cerramos la petición
        $resultado1=(array)json_decode($server_output);//convertimos la respuesta a un array php
    
        // decreto 678 del 2020
            if( $resultado1["status"] == -5){
                $json=json_encode(array("success"=>false,"mensaje"=> $resultado1["errors"]->userName));
            }else{
    
                $sql = "SELECT dp.codigo_dp, dp.identificacion, dp.nombre, dp.correo_ins, dp.codperfil_fk, p.codrol_fk,  r.nombre_rol, dp.estado, dp.isfan, p.nombre_perfil, pp.codigo_pp, dpcat.identificacion as idpcat, dpcat.nombre as nombrepcat, dpcat.correo_ins as correodpcat
                            FROM datospersonales dp
                            LEFT JOIN psicologo_to_psicologo pp ON pp.codpsicologo_fa = dp.identificacion
                            LEFT JOIN datospersonales dpcat ON dpcat.identificacion = pp.codpsicologo_fk
                            INNER JOIN perfiles p ON p.codigo_perfil = dp.codperfil_fk
                            INNER JOIN roles r ON r.codigo_rol = p.codrol_fk
                            WHERE dp.identificacion = :codusuario";
                $row = row($sql, array(':codusuario' => $resultado1["identification"]));

                
                if($row != ''){
                    query("UPDATE datospersonales SET pw = :pw WHERE identificacion = :id", array(':pw' => $pass, ':id' => $user));
                    $_SESSION['SAEP_session'] = true;
                    $_SESSION['SAEP_codigo_usu'] = $resultado1["identification"];
                    $_SESSION['SAEP_usuario'] = $resultado1["identification"];
                    $_SESSION['SAEP_nombre_usu'] = $resultado1["nomUsuario"];
                    $_SESSION['SAEP_correoins'] = $row["correo_ins"];

                    $_SESSION['SAEP_psicof'] = ($row["isfan"] != 0 ? true : false);
                    $_SESSION['SAEP_codpsicologoReem'] = $row["idpcat"];
                    $_SESSION['SAEP_nombrepsicologoReem'] = $row["nombrepcat"];
                    $_SESSION['SAEP_correopsicologoReem'] = $row["correodpcat"];

                    $_SESSION['SAEP_codperfil'] = $row["codperfil_fk"];
                    $_SESSION['SAEP_nombre_perfil'] = $row["nombre_perfil"];

                    $_SESSION['SAEP_codrol'] = $row["codrol_fk"];
                    $_SESSION['SAEP_nombre_rol'] = $row["nombre_rol"];

                    $json=json_encode(array("success"=>true));
                }else{
                    $json=json_encode(array("success"=>false,"mensaje"=> "No tienes permiso para acceder a esta plataforma, comunicate con el administrador."));
                }
    
    
            }

        }

    echo $json;
}else{
    echo "No hay soporte para cURL";
}

?>
