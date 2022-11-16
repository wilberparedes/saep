<?php
session_start();
// date_default_timezone_set('Pacific/Honolulu');
header('content-type: application/json; charset=utf-8');


require_once 'PDOConn.php';

if(isset($_GET['case'])){
    $case=$_GET['case'];
}

// VARIABLE Login
if(isset($_POST['usuario'])){
  $usuario = strtolower(trim($_POST['usuario']));
}
if(isset($_POST['password'])){
  $password = strtolower(trim($_POST['password']));
}


switch ($case) {

    /************************  procesos para login.php ****************************/
    case 'iniciarsesion':
      
      $select = "SELECT us.codigo_usu, us.usuario, us.password, us.estado, us.nombre_usu, us.foto, us.estado, pf.codigo_perfil, pf.nombre_perfil, ro.codigo_rol, ro.nombre_rol FROM usuarios us
                  INNER JOIN perfiles pf ON pf.codigo_perfil = codperfil_fk 
                  INNER JOIN roles ro ON ro.codigo_rol = pf.codrol_fk
                  WHERE us.usuario = :usuario";
      $params = array(':usuario' => $usuario);
      $row = row($select,$params);

      if($row != ''){
      	if($row['password']==sha1($password)){

      		if($row['estado']=='on'){
      			$_SESSION['SAEP_session'] = true;
      			$_SESSION['SAEP_codigo_usu']=$row['codigo_usu'];
            $_SESSION['SAEP_usuario']=$row['usuario'];
      			$_SESSION['SAEP_nombre_usu']=$row['nombre_usu'];
      			$_SESSION['SAEP_codperfil']=$row['codigo_perfil'];
      			$_SESSION['SAEP_nombre_perfil']=$row['nombre_perfil'];
            $_SESSION['SAEP_foto']=$row['foto'];

            $_SESSION['SAEP_codrol']=$row['codigo_rol'];
            $_SESSION['SAEP_nombre_rol']=$row['nombre_rol'];

	      		$json=json_encode(array("success"=>true));
	      	}else{
	      		$json=json_encode(array("success"=>false,'mensaje' => "Error: Usuario deshabilitado"));
	      	}
      	}else{

      		$json=json_encode(array("success"=>false,'mensaje' => "Error: Usuario y Contraseña no coinciden"));
      	}
      }else{
        $json=json_encode(array("success"=>false,'mensaje' => "Error: Usuario inexistente ".$row));
      }

    break;

}
echo $json;

?>

