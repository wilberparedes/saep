<?php
set_time_limit(0);
session_start();
// date_default_timezone_set('Pacific/Honolulu');
header('content-type: application/json; charset=utf-8');

require_once 'var.php';
require_once 'PDOConn.php';


require("phpmailer/class.phpmailer.php");
require("phpmailer/class.smtp.php");
require("PHPExcel/PHPExcel.php");

$periodos = ["20211", "20212", "20221"];
$codperiodo_ = (isset($_POST["codperiodo_"]) ? $_POST["codperiodo_"] : "20212" );

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true;
$mail->SMTPSecure = "tls";
$mail->SMTPDebug  = 0;
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;

$mail->Username = "entrevistasbienestar@coruniamericana.edu.co";
$mail->Password = "Entr3vist4#2020";
$mail->SetFrom('entrevistasbienestar@coruniamericana.edu.co', 'Servicios de bienestar institucional');



if(isset($_POST['documento'])){
    $documento = $_POST['documento'];
}

if(isset($_GET['case'])){
    $case=$_GET['case'];
}
if(isset($_GET['estado'])){
    $estado=$_GET['estado'];
}

// VARIABLE menu
if(isset($_POST['codmenu'])){
  $codmenu = $_POST['codmenu'];
}
if(isset($_POST['icono'])){
  $icono_menu = trim($_POST['icono']);
}
if(isset($_POST['nombre_menu'])){
  $nombre_menu = ucfirst(strtolower(trim($_POST['nombre_menu'])));
}
if(isset($_POST['nivel'])){
  $nivel_menu = $_POST['nivel'];
}
if(isset($_POST['link'])){
  $link_menu = strtolower($_POST['link']);
}
if(isset($_POST['padre'])){
  $padre_menu = $_POST['padre'];
}
if(isset($_POST['estado'])){
  $estado_menu = $_POST['estado'];
}
// variables para busqueda
if(isset($_GET['nombre_menu'])){
  $nombre_menu = ucfirst(strtolower(trim($_GET['nombre_menu'])));
}
if(isset($_GET['nivel'])){
  $nivel_menu = $_GET['nivel'];
}
if(isset($_GET['padre'])){
  $padre_menu = $_GET['padre'];
}
// FIN VARIABLE MENU


//variables perfiles
if(isset($_POST['codperfil'])){
  $codperfil = $_POST['codperfil'];
}
if(isset($_POST['nombre_perfil'])){
  $nombre_perfil = trim($_POST['nombre_perfil']);
}
if(isset($_POST['rol'])){
  $rol_perfil = $_POST['rol'];
}
if(isset($_POST['descripcion_perfil'])){
  $descripcion_perfil = $_POST['descripcion_perfil'];
}
if(isset($_POST['estado_perfil'])){
  $estado_perfil = $_POST['estado_perfil'];
}
// FIN VARIABLE PERFILES

//-------------------
//VARIABLES ASIGNARMENU PERFILES
if(isset($_POST['codrol'])){
  $codrol = $_POST['codrol'];
}
if(isset($_POST['menus'])){
  $menus = $_POST['menus'];
}

// variables para mi perfil y para registro empresarial
if(isset($_GET['nombphoto'])){
  $nombphoto = $_GET['nombphoto'];
}
if(isset($_POST['identificacion'])){
  $identificacion = trim($_POST['identificacion']);
}

if(isset($_POST['apellido'])){
  $apellido = trim($_POST['apellido']);
}
if(isset($_POST['direccion'])){
  $direccion = trim($_POST['direccion']);
}
if(isset($_POST['celular'])){
  $celular = trim($_POST['celular']);
}
if(isset($_POST['contraActual'])){
  $contraActual = $_POST['contraActual'];
}
if(isset($_POST['nuevaContra'])){
  $nuevaContra = $_POST['nuevaContra'];
}
// variables 


// variables usuarios.php
if(isset($_POST['codusuario'])){
  $codusuario = $_POST['codusuario'];
}
if(isset($_POST['usuario'])){
  $usuario = $_POST['usuario'];
}
if(isset($_POST['nombre'])){
  $nombre = strtoupper(strtolower(trim($_POST['nombre'])));
}
if(isset($_POST['email'])){
  $email = strtolower($_POST['email']);
}
if(isset($_POST['codperfil'])){
  $codperfil = $_POST['codperfil'];
}
if(isset($_POST['codpsicologocat'])){
  $codpsicologocat = $_POST['codpsicologocat'];
}
if(isset($_POST['estado'])){
  $estado = $_POST['estado'];
}

// variables usuario.php
if(isset($_POST['pass'])){
  $pass = $_POST['pass'];
}

// variables rol
if(isset($_POST['nombre_rol'])){
  $nombre_rol = trim($_POST['nombre_rol']);
}
if(isset($_POST['estado_rol'])){
  $estado_rol = $_POST['estado_rol'];
}   
if(isset($_POST['menus'])){
  $menus = $_POST['menus'];
} 


if(isset($_POST['codaspecto'])){
  $codaspecto = $_POST['codaspecto'];
} 

if(isset($_POST['nombre_aspecto'])){
  $nombreaspecto = strtoupper(strtolower(trim($_POST["nombre_aspecto"])));
} 

if(isset($_GET['codtp'])){
  $codtp = $_GET['codtp'];
}

if(isset($_GET['codstp'])){
  $codstp = $_GET['codstp'];
}

//variables departamento.php

if(isset($_POST["coddepartamento"])){
  $coddepartamento = $_POST["coddepartamento"];
}
if(isset($_GET["coddepartamento"])){
  $coddepartamento = $_GET["coddepartamento"];
}
if(isset($_POST["nombre_departamento"])){
  $nombredepartamento = trim($_POST["nombre_departamento"]);
}
if(isset($_GET["nombredepartamento"])){
  $nombredepartamento = trim($_GET["nombredepartamento"]);
}


//variables municipio.php

if(isset($_POST["codmunicipio"])){
  $codmunicipio = $_POST["codmunicipio"];
}
if(isset($_POST["nombre_municipio"])){
  $nombre_municipio = trim($_POST["nombre_municipio"]);
}

//variables colegios.php
if(isset($_POST["nombre_colegio"])){
  $nombrecolegio = trim($_POST["nombre_colegio"]);
}
if(isset($_POST["codpropiedad"])){
  $codpropiedad = $_POST["codpropiedad"];
}
if(isset($_POST["codcolegio"])){
  $codcolegio = $_POST["codcolegio"];
}

// variables requerimientovirtual.php
if(isset($_POST["codrequerimiento"])){
  $codrequerimiento = $_POST["codrequerimiento"];
}
if(isset($_POST["nombrerequerimiento"])){
  $nombrerequerimiento = trim($_POST["nombrerequerimiento"]);
}


// variable planacompanamiento.php
if(isset($_POST["codplan"])){
  $codplan = strtoupper(strtolower(trim($_POST["codplan"])));
}

if(isset($_POST["nombreplan"])){
  $nombreplan = strtoupper(strtolower(trim($_POST["nombreplan"])));
}

if(isset($_POST["tipoplan"])){
  $tipoplan = $_POST["tipoplan"];
}

//variables conceptos.php

if(isset($_POST["codconcepto"])){
  $codconcepto = $_POST["codconcepto"];
}
if(isset($_POST["nombre_concepto"])){
  $nombreconcepto = ucfirst(strtolower(trim($_POST["nombre_concepto"])));
}
if(isset($_POST["sugerencias"])){
  $sugerencias = $_POST["sugerencias"];
}else{
  $sugerencias = NULL;
}

//variables misentrevistas.php
if(isset($_POST["novedad"])){
  $novedad = strtolower(trim($_POST["novedad"]));
}


//variables linksentrevistas.php

if(isset($_POST["codigolink"])){
  $codigole = trim($_POST["codigolink"]);
}
if(isset($_POST["nombrelink"])){
  $nombrelink = strtoupper(strtolower(trim($_POST["nombrelink"])));
}
if(isset($_POST["ccpsicologo"])){
  $ccpsicologo = trim($_POST["ccpsicologo"]);
}
if(isset($_POST["urllink"])){
  $urllink = strtolower(trim($_POST["urllink"]));
}
if(isset($_POST["correolink"])){
  $correolink = strtolower(trim($_POST["correolink"]));
}
if(isset($_POST["passlink"])){
  $passlink = trim($_POST["passlink"]);
}


//variables usuarios.php
if(isset($_POST["ccpsicologo"])){
  $ccpsicologo = trim($_POST["ccpsicologo"]);
}

if(isset($_POST["codprograma"])){
  $codprograma = trim($_POST["codprograma"]);
}

if(isset($_POST["codperiodo"])){
  $codperiodo = trim($_POST["codperiodo"]);
}

$createtable = array(
  'data' => array()
);

switch ($case) {

    case 'loadPerfiles2':
      $sql = "SELECT codperfil as cod, nombre_perfil as nombre, estado_perfil FROM perfil2 WHERE estado_perfil = 'on'";
      $table = table($sql);
      $json = json_encode($table);
    break;

  /************************ procesos para miperfil.php **************************/

    case 'uploadFotoPerfil':
      if($_FILES['img-perfil']['tmp_name']!=""){
          $file=$_FILES["img-perfil"]['name'];
          $extension= explode(".",$file) ;
          $url="../assets/fotoperfil/".$_GET['nombphoto'].".".$extension[1];                       
          $urlFoto='assets/fotoperfil/'.$_GET['nombphoto'].".".$extension[1];

        if (move_uploaded_file($_FILES['img-perfil']['tmp_name'],$url)) {
          $sql="UPDATE usuarios SET foto='". $urlFoto."' WHERE codigo_usu='".$_SESSION['SAEP_codigo_usu']."'"; 
          query($sql);
          $_SESSION['SAEP_foto']=$urlFoto;
          $json = json_encode(array("success" => true, "mensaje"=>"Foto de perfil actualizada exitosamente.")); 
        }

      }else{
        $json = json_encode(array("success" =>false,"message"=>"Campo vacio"));
      }
    break;

    case 'editUsuario':
      $update = "UPDATE usuarios SET nombre_usu = :nombre WHERE codigo_usu = :codusu";
      $params = array(':nombre' => $nombre, ':codusu'=>$_SESSION["SAEP_codigo_usu"]);

      if(query($update, $params)){

        $_SESSION['SAEP_nombre_usu']=$nombre;
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }
    break;

    case 'editContrasena':
      $select = "SELECT * FROM usuarios WHERE codigo_usu = :codusuario";
      $paramsselect = array(':codusuario' => $_SESSION["SAEP_codigo_usu"]);
      $row = row($select,$paramsselect);

      if($row != ''){
        if($row['password']==sha1($contraActual)){
          $update = "UPDATE usuarios SET password = :password WHERE codigo_usu = :codusuario";
          $params = array(':password'=> sha1($nuevaContra), ':codusuario'=>$_SESSION["SAEP_codigo_usu"]);

          if(query($update, $params)){
            $json = json_encode(array("success"=>true));
          }else{
            $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
          }
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "La contraseña actual ingresada no es correcta"));
        }
      }
    break;
    
  /************************  FIN procesos para miperfil.php ****************************/

  /************************  procesos para usuarios.php *********************************/
    case 'sloadPerfiles':
      $sql = "SELECT codigo_perfil as cod, nombre_perfil as nombre, estado_perfil FROM perfiles WHERE estado_perfil = 'on' AND codigo_perfil != 1";
      $table = table($sql);
      $json = json_encode($table);
    break;

    case 'sloadPsicologoCAT':
      $sql = "SELECT identificacion as cod, nombre, correo_ins as email, estado FROM datospersonales WHERE estado = 'on' AND codperfil_fk = 3 AND isfan = 0 ORDER BY nombre ASC";
      $table = table($sql);
      $json = json_encode($table);
    break;

    case 'loadUsuarios':
      $sql = "SELECT dp.codigo_dp, dp.identificacion, dp.nombre, dp.correo_ins, dp.codperfil_fk, dp.estado, dp.isfan, p.nombre_perfil, pp.codigo_pp, dpcat.identificacion as idpcat, dpcat.nombre as nombrepcat, dpcat.correo_ins as correodpcat
                FROM datospersonales dp
                LEFT JOIN psicologo_to_psicologo pp ON pp.codpsicologo_fa = dp.identificacion
                LEFT JOIN datospersonales dpcat ON dpcat.identificacion = pp.codpsicologo_fk
                INNER JOIN perfiles p ON p.codigo_perfil = dp.codperfil_fk
                ORDER BY dp.codigo_dp ASC";
      $table = table($sql);
      $i = 1;
      foreach ($table as $datarow => $data) {

        $email = ($data["codigo_pp"] != NULL ? $data["correodpcat"] : $data["correo_ins"]);

        $estado = ($data["estado"] == 'on') ? 'Habilitado' : 'Inhabilitado';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar('.$data["codigo_dp"].',  \''.$data["identificacion"].'\', \''.$data["nombre"].'\', \''.$email.'\', '.$data["codperfil_fk"].', '.$data["isfan"].', \''.$data["idpcat"].'\')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Eliminar" data-rel="tooltip" title="Eliminar" onClick="feditEstado('.$data["codigo_dp"].',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado('.$data["codigo_dp"].', \'on\')""><i class="fa fa-undo"></i></a>';
        $options = $edit.$delete;
          
        if ($data["estado"]  == 'on') $options = $edit.$delete;
        else $options = $restore;

        $psicologoCAT = ($data["codigo_pp"] != NULL ? $data["idpcat"].'<br/>'.$data["nombrepcat"] : 'NO APLICA' );
          
        array_push($createtable['data'], array($i, $data["identificacion"], $data["nombre"], $data["correo_ins"],  $data["nombre_perfil"], $psicologoCAT, $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);
    break;

    case 'editItemUsuario':
      $update = "UPDATE datospersonales SET correo_ins = :correo, codperfil_fk = :codperfil, isfan = :isfan WHERE identificacion = :codpsico";
      $params = array(':correo' => $email, ':codperfil' => $codperfil, ':isfan' => ($codpsicologocat == '' ? 0 : 1), ':codpsico' => $usuario);

      if(query($update, $params)){
        $sql = "SELECT * FROM psicologo_to_psicologo WHERE codpsicologo_fa = :codpsicologo";
        $row = row($sql, array(':codpsicologo' => $usuario));

        $updateptp = "UPDATE psicologo_to_psicologo SET codpsicologo_fk = :codpsico WHERE codpsicologo_fa = :codpsicofa";
        $insertptp = "INSERT INTO psicologo_to_psicologo (codpsicologo_fk, codpsicologo_fa) VALUES (:codpsico, :codpsicofa)";
        $deleteptp = "DELETE FROM psicologo_to_psicologo WHERE codpsicologo_fa = :codpsicofa";
        $paramsptp = array(':codpsico' => $codpsicologocat, ':codpsicofa' => $usuario);
        $query = "";
        if($codpsicologocat != ''){
          if($row != ''){
            //UPDATE
            $query = query($updateptp, $paramsptp);
          }else{
            //INSERT
            $query = query($insertptp, $paramsptp);
          }
        }else{
          if($row != ''){
            //DELETE
            $query = query($deleteptp, array(':codpsicofa' => $usuario));
          }else{
            $query = true;
          }
        }
        if($query){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"message" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
        }
      }else{
        $json = json_encode(array("success"=>false,"message" => "No se Actualizó la información. Por favor, intentelo de nuevo 2"));
      }
    break;

    case 'insertItemUsuario':
      $insert = "INSERT INTO datospersonales (identificacion, nombre, correo_ins, codperfil_fk, estado, isfan) VALUES (:identificacion, :nombre, :correo, :codperfil, :estado, :isfan)";
      $params = array(':identificacion' => $usuario, ':nombre' => $nombre, ':correo' => $email, ':codperfil' => $codperfil, ':estado' => $estado, ':isfan' => ($codpsicologocat == '' ? 0 : 1));

      if(query($insert, $params)){
        
        if($codpsicologocat != ''){
          $insertptp = "INSERT INTO psicologo_to_psicologo (codpsicologo_fk, codpsicologo_fa) VALUES (:codpsico, :codpsicofa)";
          $paramsptp = array(':codpsico' => $codpsicologocat, ':codpsicofa' => $usuario);
          if(query($insertptp, $paramsptp)){
            $json = json_encode(array("success"=>true));
          }else{
            $json = json_encode(array("success"=>false,"message" => "No se insertó el usuario. Por favor, intentelo de nuevo."));    
          }
        }else{
          $json = json_encode(array("success"=>true));
        }

      }else{
        $json = json_encode(array("success"=>false,"message" => "No se insertó el usuario. Por favor, intentelo de nuevo 2"));
      }
    break;

    case 'consultarFuncionario':
      $sql = "SELECT * FROM datospersonales WHERE identificacion = :codpsicologo";
      $row = row($sql, array(':codpsicologo' => $documento));
      if($row == ''){
        $url1 = 'http://190.60.75.134/searches/consultar_datos_personales?periodos='.$documento;
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-type: application/json;charset=UTF-8'));
        curl_setopt($ch1, CURLOPT_URL, $url1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        $server_output1 = curl_exec($ch1);
        curl_close ($ch1);
        $resultado11=(array)json_decode($server_output1);

        if(count($resultado11) >= 1){
          $json = json_encode(array('success' => true, 'cc' => $resultado11[0][1], 'nombre' => $resultado11[0][5].' '.$resultado11[0][6], 'email' => $resultado11[0][58]));
        }else{
          $json = json_encode(array('success' => false, 'message' => 'Usuario ingresado no encontrado!'));  
        }
  
      }else{
        $json = json_encode(array('success' => false, 'message' => 'El usuario ingresado ya existe!'));
      }
    break;
  /************************  FIN procesos para usuarios.php ****************************/


  /************************  procesos para gestionarmenu.php *********************************/
    case 'loadMenu':
      $sql = "SELECT codigo_menu, imagen, nombre_menu, nivel, orden, codsuperior, link, estado, target FROM menu WHERE estado = :estado ORDER BY codigo_menu ASC";
      $params = array(':estado' => 'on');

      $table = table($sql, $params);
      $i = 1;
      foreach ($table as $datarow => $data) {

        $icono = '<i class="fa '.$data["imagen"].'"></i>';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Menú" onclick="fmodalEditar('.$data["codigo_menu"].', \''.$data["imagen"].'\',  \''.$data["nombre_menu"].'\', \''.$data["link"].'\', \''.$data["estado"].'\')"><i class="fa fa-edit"></i></a>';

        if($data["codsuperior"] == 0){
          $codsuperior = 'Sin menú superior';
        } else{
          $row = row("SELECT nombre_menu, imagen FROM menu WHERE codigo_menu = :codmenu", array(':codmenu' => $data["codsuperior"]));
          $codsuperior = '<b><i class="fa '.$row["imagen"].'"></i> '.$row["nombre_menu"].'</b>';
        }

        $estado = ($data["estado"] == 'on') ? 'Habilitado' : 'Inhabilitado';

        $options = $edit;
          
        array_push($createtable['data'], array($i, $icono, $data["nombre_menu"],$data["nivel"],$data["orden"], $codsuperior, $data["link"], $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);
    break;

    case 'buscarMenu':
      // estado = :estado AND
      $where ="";
      if($nivel_menu != ''){
        $where .= " AND nivel = ".$nivel_menu;
      }
      if($padre_menu != ''){
        $where .= " AND codsuperior = ".$padre_menu;
      }

      $sql = "SELECT codigo_menu, imagen, nombre_menu, nivel, orden, codsuperior, link, estado, target FROM menu WHERE nombre_menu LIKE '%".$nombre_menu."%' ".$where." ORDER BY codigo_menu ASC";
      // $params = array(':nombre_menu' => $nombre_menu1 );

      $table = table($sql);
      $i = 1;
      foreach ($table as $datarow => $data) {

        $icono = '<i class="fa '.$data["imagen"].'"></i>';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Menú" onclick="fmodalEditar('.$data["codigo_menu"].', \''.$data["imagen"].'\',  \''.$data["nombre_menu"].'\', \''.$data["link"].'\', \''.$data["estado"].'\')"><i class="fa fa-edit"></i></a>';

        if($data["codsuperior"] == 0){
          $codsuperior = 'Sin menú superior';
        } else{
          $row = row("SELECT nombre_menu, imagen FROM menu WHERE codigo_menu = :codmenu", array(':codmenu' => $data["codsuperior"]));
          $codsuperior = '<b><i class="fa '.$row["imagen"].'"></i> '.$row["nombre_menu"].'</b>';
        }

        $options = $edit;

        $estado = ($data["estado"] == 'on') ? 'Habilitado' : 'Inhabilitado';
          
        array_push($createtable['data'], array($i, $icono, $data["nombre_menu"],$data["nivel"],$data["orden"], $codsuperior, $data["link"], $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);
    break;

    case 'loadPadresMenu':
      $sql = "SELECT codigo_menu, nombre_menu, nivel, orden, codsuperior, link, imagen, target, estado FROM menu WHERE estado = :estado AND nivel = :nivel ORDER BY orden ASC";
      $params = array(':nivel'=>'1', ':estado' => 'on');

      $table = table($sql, $params);

      if(count($table)>=1){
        $json = json_encode(array("success"=>true,"menu" =>$table));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No hay Menú disponibles"));
      }
    break;

    case 'insertItemMenu':

      if($nivel_menu == '1'){
        $select = "SELECT max(orden) as \"nivelmax\" FROM menu WHERE nivel = :nivel";
        $params = array(':nivel' =>  $nivel_menu);
        $row = row($select,$params);
        if($row == ''){
          $orden = 1;
        }else{
          $orden = ($row["nivelmax"] + 1);
        }

        $insert = "INSERT INTO menu (nombre_menu, nivel, orden, codsuperior, link, imagen, target, estado) VALUES (:nombre_menu, :nivel, :orden, :codsuperior, :link, :imagen, :target, :estado)";
        $paramsInsert = array(
                              ':nombre_menu' => $nombre_menu,
                              ':nivel' => $nivel_menu, 
                              ':orden' => $orden, 
                              ':codsuperior' => 0, 
                              ':link' => $link_menu, 
                              ':imagen' => $icono_menu, 
                              ':target' => '_self', 
                              ':estado' => $estado_menu
                            );
        
        if(query($insert, $paramsInsert)){
          $json = json_encode(array("success"=>true,"orden" =>$orden));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item para el Menú"));
        }
      }else if($nivel_menu == '2'){
        $select = "SELECT max(orden) as \"nivelmax\" FROM menu WHERE nivel = :nivel AND codsuperior = :codsuperior";
        $params = array(':nivel' =>  $nivel_menu, ':codsuperior' => $padre_menu );
        $row = row($select,$params);
        $orden = ($row["nivelmax"] + 1);

        $insert = "INSERT INTO menu (nombre_menu, nivel, orden, codsuperior, link, imagen, target, estado) VALUES (:nombre_menu, :nivel, :orden, :codsuperior, :link, :imagen, :target, :estado)";
        $paramsInsert = array(
                              ':nombre_menu' => $nombre_menu,
                              ':nivel' => $nivel_menu, 
                              ':orden' => $orden, 
                              ':codsuperior' => $padre_menu, 
                              ':link' => $link_menu, 
                              ':imagen' => $icono_menu, 
                              ':target' => '_self', 
                              ':estado' => $estado_menu
                            );
        if(query($insert, $paramsInsert)){
          $json = json_encode(array("success"=>true,"orden" =>$orden));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item para el Menú"));
        }
      }
    break;

    case 'editItemMenu':
      $update = "UPDATE menu SET imagen = :imagen, nombre_menu = :nombre_menu, link = :link_menu, estado = :estado WHERE codigo_menu = :codmenu";
      $params = array(':imagen' => $icono_menu, ':nombre_menu' => $nombre_menu, ':link_menu' => $link_menu, ':estado' => $estado_menu, ':codmenu'=>$codmenu);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }
    break;
  /************************  FIN procesos para gestionarmenu.php ****************************/

  /************************  procesos para gestionarperfiles.php ****************************/
    case 'loadPerfiles':
      $sql = "SELECT p.codigo_perfil, p.nombre_perfil, p.descripcion, p.estado_perfil, r.codigo_rol, r.nombre_rol, r.menus
              FROM perfiles p
              INNER JOIN roles r ON r.codigo_rol = p.codrol_fk
              ORDER BY p.codigo_perfil ASC";

      $table = table($sql);
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estado = ($data["estado_perfil"] == 'on') ? 'Habilitado' : 'Inhabilitado';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Perfil" onclick="fmodalEditar('.$data["codigo_perfil"].', '.$data["codigo_rol"].', \''.$data["nombre_perfil"].'\', \''.$data["descripcion"].'\', \''.$data["estado_perfil"].'\')"><i class="fa fa-edit"></i></a>';
        $options = $edit;
          
        array_push($createtable['data'], array($i, $data["nombre_perfil"], $data["nombre_rol"], $data["descripcion"], $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);
    break;

    case 'editItemPerfil':
      $update = "UPDATE perfiles SET nombre_perfil = :nombre_perfil, codrol_fk = :codrol, descripcion = :descripcion, estado_perfil = :estado WHERE codigo_perfil = :codperfil";
      $params = array(':nombre_perfil' => $nombre_perfil, ':codrol' => $rol_perfil, ':descripcion' => $descripcion_perfil, ':estado' => $estado_perfil, ':codperfil'=>$codperfil);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }
    break;

    case 'loadRol':

      $sql = "SELECT codigo_rol as cod, nombre_rol as nombre, menus, estado_rol FROM roles WHERE estado_rol = 'on'";
      $table = table($sql);
      $json = json_encode($table);

    break;

    case 'loadPerfilesSelect':
      
      $sql = "SELECT codigo_perfil as cod, nombre_perfil as nombre FROM perfiles WHERE estado_perfil = 'on'";
      $table = table($sql);
      $json = json_encode($table);

    break;

    case 'insertItemPerfil':

        $insert = "INSERT INTO perfiles (nombre_perfil, codrol_fk, descripcion, estado_perfil) VALUES (:nombre_perfil, :rol, :descripcion, :estado)";
        $paramsInsert = array(
                              ':nombre_perfil' => $nombre_perfil,
                              ':rol' => $rol_perfil, 
                              ':descripcion' => $descripcion_perfil,
                              ':estado' => $estado_perfil
                            );
        if(query($insert, $paramsInsert)){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item de Perfil"));
        }

    break;
  /************************  FIN procesos para gestionarmenu.php ****************************/

  /************************  procesos para asignarmenuperfiles.php ****************************/
    case 'loadmodulos':
      $sqlmenu = "SELECT codigo_menu, nombre_menu, nivel,codsuperior FROM menu WHERE link!='#' AND estado=:estado order by codigo_menu asc";
      $tablemenu = table($sqlmenu, array( ':estado' => 'on'));

      $sqlrolesmenu = "SELECT menus FROM roles WHERE codigo_rol=:codrol AND estado_rol=:estado";
      $rowrolesmenu = row($sqlrolesmenu, array(':codrol'=>$codrol, ':estado' => 'on'));
      $modulos = explode(",",$rowrolesmenu['menus']);

      $asignados = array();
      $noasignados = array();

      foreach ($tablemenu as $datarowmenu => $datamenu) {
        $pos = in_array($datamenu['codigo_menu'], $modulos);
        if($pos === false){
          array_push($noasignados, array('nombre_menu'=>$datamenu['nombre_menu'], 'codmenu'=>$datamenu['codigo_menu'],'nivel'=>$datamenu['nivel'],'codsuperior'=>$datamenu['codsuperior']));
        }else{
          array_push($asignados, array('nombre_menu'=>$datamenu['nombre_menu'], 'codmenu'=>$datamenu['codigo_menu'],'nivel'=>$datamenu['nivel'],'codsuperior'=>$datamenu['codsuperior']));
        }
      }

      $json = json_encode(array("success"=>true, 'asignados'=>$asignados, 'noasignados'=>$noasignados));
    break;

    case 'updateConfigRolmenu':
      
      $update = "UPDATE roles SET menus = :menus WHERE codigo_rol = :codrol";
      $params = array(':menus' => $menus, ':codrol'=>$codrol);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;
  /************************  FIN procesos para asignarmenuperfiles.php ****************************/


    
  /************************  procesos para usuarios.php ****************************/
    

  /************************  FIN procesos para clientes.php ****************************/


    
  /************************  procesos para gestionarrol.php ****************************/
    case 'loadRolTable':
      $sql = "SELECT codigo_rol, nombre_rol, menus, estado_rol
              FROM roles ORDER BY codigo_rol ASC";
      // WHERE p.estado = :estado$params = array(':estado' => 'on');

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estado = ($data["estado_rol"] == 'on') ? 'Habilitado' : 'Inhabilitado ';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Rol" onclick="fmodalEditar('.$data["codigo_rol"].', \''.$data["nombre_rol"].'\', \''.$data["menus"].'\', \''.$data["estado_rol"].'\')"><i class="fa fa-edit"></i></a>';
        $options = $edit;
          
        array_push($createtable['data'], array($i, $data["nombre_rol"], $data["menus"], $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);
    break;

    case 'editItemRol':
      $update = "UPDATE roles SET nombre_rol = :nombre_rol, estado_rol = :estado WHERE codigo_rol = :codrol";
      $params = array(':nombre_rol' => $nombre_rol, ':estado' => $estado_rol, ':codrol' => $codrol);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }
    break;

    case 'loadRol':
      $sql = "SELECT codigo_rol as cod, nombre_rol as nombre, menus, estado_rol FROM roles WHERE estado_rol = 'on'";
      // $params = array(':estado' => $estado_rol);,$params

      $table = table($sql);

      $json = json_encode($table);
    break;

    case 'insertItemRol':

        $insert = "INSERT INTO roles (nombre_rol, estado_rol) VALUES (:nombre_rol, :estado_rol)";
        $paramsInsert = array(
                              ':nombre_rol' => $nombre_rol,
                              ':estado_rol' => $estado_rol
                            );
        if(query($insert, $paramsInsert)){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item de Rol"));
        }
    break;
  /************************  FIN procesos para gestionarrol.php ****************************/



  /************************  procesos para nueva entrevista ****************************/
    case 'sLoadColegios':

      $sql = "SELECT cod as value, nombre as label, codpropiedadplantafisica_fk as codpropiedad
                FROM loadcolegios
                WHERE estado_colegio = 'on'  AND nombre LIKE '%".strtoupper(strtolower($_POST['query']))."%' ORDER BY nombre ASC LIMIT 20 ";
      $table = table($sql);
      // foreach ($table as $key => $value) {
      //   $countryResult[] = $value["nombre"];
      // }
      $json = json_encode($table);
    break;

    case 'loadGrupoPriorizado':
      $sql = "SELECT codigo_gp as cod, nombre_gp as nombre FROM grupo_priorizado WHERE estado_gp = 'on' ORDER BY codigo_gp ASC";
      $table = table($sql);
      $json = json_encode($table);
    break;

    case 'loadTipoPoblacion':
      $sql = "SELECT codigo_tp as cod, nombre_tp as nombre FROM tipo_poblacion WHERE estado_tp = 'on' AND codgrupopriorizado_fk = ".$_GET["codgp"]." ORDER BY codigo_tp ASC";
      $table = table($sql);
      $json = json_encode($table);
    break;

    case 'sLoadTipoDiscapacidad':
     $sql = "SELECT codigo_td as cod, nombre_td as nombre, descripcion_td as descripcion FROM tipo_discapacidad WHERE codtipopoblacion_fk = :codtp AND estado_td = :estado ORDER BY codigo_td ASC";
     $params = array(':codtp' => $codtp, ':estado' => 'on');
     $table = table($sql, $params);
     $json = json_encode($table);
    break;

    case 'sLoadSubTipoDiscapacidad':
     $sql = "SELECT codigo_std as cod, nombre_std as nombre, descripcion_std as descripcion FROM subtipo_discapacidad WHERE codtipodiscapacidad_fk = :codstp AND estado_std = :estado ORDER BY codigo_std ASC";
     $params = array(':codstp' => $codstp, ':estado' => 'on');
     $table = table($sql, $params);

     $json = json_encode($table);
    break;

    case 'loadAspectos':
      $datos = array();
      $conceptos = array();

      $sql = "SELECT codigo_ae, nombre_ae, estado_ae FROM aspectos_evaluacion WHERE estado_ae = :estado ORDER BY  codigo_ae";
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

        array_push($datos, array('codigo_ae' => $value['codigo_ae'], 'nombre_ae' => $value['nombre_ae'], 'conceptos' => $conceptos));
          
      }
      $json = json_encode($datos);
    break;

    case 'loadConceptos':
      $sql = "SELECT codigo_ce, nombre_ce, codaspectos_fk, estado_ce FROM concepto_evaluar WHERE codaspectos_fk = :codaspecto AND estado_ce = :estado";
      $params = array(':codaspecto' => $codaspecto, ':estado' => 'on' );
      $table = table($sql, $params);
      $json = json_encode($table);
    break;
    // 1007962276
    // 1140844154
  /************************ fin nueva entrevista ****************************/


  // WEBSERVICE
    case 'consultarEstudiante':

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/consultar_datos_inscritos_bienestarandprograma?periodos=".$documento.",".$codprograma.",$codperiodo_");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      if(count($resultado1) >= 1){
        $json = json_encode(array(
          "success" => true,
          "nombres" => replacein($resultado1[0][9]),
          "direccion" => strtoupper($resultado1[0][14]),
          "codprograma" => $resultado1[0][0],
          "programa" => $resultado1[0][1],
          "email" => $resultado1[0][13],
          "edad" => intval($resultado1[0][8]),
          "lugarresidencia" => $resultado1[0][15],
          "nombarrio" => ($resultado1[0][10] == null ? '' : $resultado1[0][10]),
          "celular" => $resultado1[0][12],
          "fijo" => $resultado1[0][11],
          "estrato" => "1"
        ));
      }else{
        $json = json_encode(array("success"=>false,"msg"=>"Identificación no encontrada en <strong>SINU</strong> como inscrito."));
      }
    break;


    case 'consultarIcfes':

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/consultar_datosicfes_bienestar?periodos=".$documento);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      if(count($resultado1) >= 1){
        $json = json_encode(array(
            "success"=>true,
            "codprograma"=>$resultado1[0][0],
            "codperiodo"=>$resultado1[0][1],
            "registroac"=>$resultado1[0][2],
            "fecharealizacion"=>$resultado1[0][3]
        ));
      }else{
        $json = json_encode(array("success"=>false,"msg"=>"Sin registro de ICFES en SINU."));
      }

    break;

    case 'consultarResultadosIcfes':
      $components = array();
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/consultar_resultadosicfes_bienestar?periodos=".$documento);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      if(count($resultado1) >= 1){
        foreach ($resultado1 as $key => $value) {
          if($value[3] != 'ENTREVISTA'){
            $key = array_search($value[3], array_column($components, 'nombre')); 
            if (empty($key) && !is_numeric($key)){
                array_push(
                    $components, 
                    array(
                        'id' => $value[0],
                        'nombre' => $value[3],
                        'puntaje' => $value[4]
                      )
                );
            }
          }
        }

        $json = json_encode(array('success' => true, 'registroac' => $resultado1[0][1], 'fecharealizacion' => $resultado1[0][2], 'componentes' => $components));
        
      }else{
        $json = json_encode(array('success' => false, 'msg' => 'Sin registro de ICFES en SINU.'));
      }
    break;

  /************************  //WEBSERVICE REPORTES MERCADEO  ****************************/
    case 'sLoadPeriodos':

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/cargar_periodos");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);
      $periodosx = array();

      if(count($resultado1) >= 1){
        foreach ($resultado1 as $key => $value) {
          array_push(
            $periodosx, 
            array(
              'codigo' => $value[0],
              'nombre' => $value[1],
              'fechainicio' => $value[2],
              'fechafin' => $value[3]
            )
          );
        }
        $json = json_encode(array('success' => true, 'periodos' => $periodosx));
      }else{
        $json = json_encode(array("success"=>false,"msg"=>"Dato no encontrado en <strong>SINU</strong>"));
      }
    break;

    case 'loadDonutReporteMercadeo':

      $codperiodo = $_POST['codperiodo'];
      $start = $_POST['datestart'];
      $end  = $_POST['dateend'];
      
      $metodologia = $_POST["metodologia"];
      $sede = $_POST["sede"];
      $codprograma = $_POST["codprograma"];

      $fhour = date("Y-m-d H:i:s"); 
      $events = array();
      $mes = date("n");

      $ch = curl_init();

      // curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/entrevistas_agendadas_reporte?periodos=$codperiodo,$start,$end");
      if($codprograma != 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexprograma?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede == 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/entrevistas_agendadas_reporte?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia != 'todas' && $sede == 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexmetodologia?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede != 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexsede?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede == 'todas' && $codprograma != 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexprograma?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia != 'todas' && $sede != 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexmodalidadandsede?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      

      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      $pendiente = 0;
      $gestionada = 0;
      $vencida = 0;
      $cancelada = 0;

      if(count($resultado1) >= 1){
        // print_r($resultado1);
        foreach ($resultado1 as $key => $value) {
          $bkColor = "";

          $row = row("SELECT codigo_entrevista, estado 
                      FROM entrevistas
                      WHERE codestudiante_fk = '$value[16]' AND codprograma = '$value[1]' AND codperiodo = '$value[0]';");
          if($row != null){
              $gestionada++;
          }else{

            $rowCancelada = row("SELECT fecha_ce, motivos as codmotivo, mc.nombre_mc as motivos
            FROM entrevistas_canceladas ec
            INNER JOIN motivos_cancelacion mc ON mc.codigo_mc = ec.motivos WHERE codestudiante_fk = :codestudiante", array(':codestudiante' => $value[16]));

            if($rowCancelada == ''){
              $fh = $value[10].' '.conversorSegundosHoras(intval($value[20]));
              if($fhour > $fh){
                $vencida++;
              }else{
                $pendiente++;
              }
            }else{
                $cancelada++;
            }
            
          }
          $total = count($resultado1);
          $porges = round(($gestionada/$total)*100, 1);
          $porven = round(($vencida/$total)*100, 1);
          $porpen = round(($pendiente/$total)*100, 1);
          $porcan = round(($cancelada/$total)*100, 1);
          $json = json_encode(array(
            'success' => true, 
            'total' => $total, 
            'gestionadas' => $gestionada, 
            'vencidas' => $vencida, 
            'pendientes' => $pendiente,
            'canceladas' => $cancelada,
            'porges' => $porges,
            'porven' => $porven,
            'porpen' => $porpen,
            'porcan' => $porcan
          ));
        }
        
      }else{
        $json = json_encode(array('success' => true, 'total' => 0, 'gestionadas' => 0, 'vencidas' => 0, 'pendientes' => 0, 'canceladas' => 0,'porges' => 0,
        'porven' => 0,
        'porpen' => 0,
        'porcan' => 0));
      }
    break;


    case 'loadEntrevistasxEstado':

      $codperiodo = $_GET['codperiodo'];
      $start = $_GET['datestart'];
      $end  = $_GET['dateend'];
      

      $fhour = date("Y-m-d H:i:s"); 
      $events = array();
      $mes = date("n");
      $metodologia = $_GET["metodologia"];
      $sede = $_GET["sede"];
      $codprograma = $_GET["codprograma"];
      
      $ch = curl_init();
      if($codprograma != 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexprograma?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede == 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/entrevistas_agendadas_reporte?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia != 'todas' && $sede == 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexmetodologia?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede != 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexsede?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede == 'todas' && $codprograma != 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexprograma?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia != 'todas' && $sede != 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexmodalidadandsede?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      $pendientes = array();
      $vencidas = array();
      $gestionadas = array();

      if(count($resultado1) >= 1){
        foreach ($resultado1 as $key => $value) {

          $row2 = row("SELECT codigo_en, estado 
                      FROM estudiante_notificado
                      WHERE codestudiante_fk = '$value[16]' AND codperiodo = '$value[0]' AND codprograma = '$value[1]';");
          $estadonotificado =  ($row2 == null ? 0 : $row2["estado"]);
          $fh = $value[10].' '.conversorSegundosHoras(intval($value[20]));


          $bkColor = "";
          $table = table("SELECT codigo_oe FROM observaciones_entrevistas WHERE codestudiante_fk = '$value[16]' AND codperiodo = '$value[0]' AND codprograma = '$value[1]';");
          $observaciones = count($table);
          $borrador = '';
          $fechaejecucion = "null";
          $motivos = '';
          $row = row("SELECT codigo_entrevista, to_char(fecha_entrevista, 'YYYY-MM-DD HH12:MI:SS A.M.') as fecha_entrevista, estado 
                      FROM entrevistas
                      WHERE codestudiante_fk = '$value[16]' AND codperiodo = '$value[0]' AND codprograma = '$value[1]';");
          if($row != null){
            if($row["estado"] == 1){
              $bkColor = '#3ace43';
              $aas = 1;
              $estado = 'gestionadas';
              $fechaejecucion = $row["fecha_entrevista"];
              $estadonotificado = 1;
            }else{
              $bkColor = '#f45959';
              $estado = 'vencidas';
              $aas = 0;
            }
          }else{

            $rowCancelada = row("SELECT fecha_ce, motivos as codmotivo, mc.nombre_mc as motivos
            FROM entrevistas_canceladas ec
            INNER JOIN motivos_cancelacion mc ON mc.codigo_mc = ec.motivos WHERE codestudiante_fk = :codestudiante", array(':codestudiante' => $value[16]));
            if($rowCancelada == ''){
              if($fhour > $fh){
                $bkColor = '#f45959';
                $estado = 'vencidas';
                $aas = 3;
              }else{
                $bkColor = '#ffac64';
                $estado = 'pendientes';
                $aas = 2;
              }
            }else{
              $fechaCancelacion = $rowCancelada["fecha_ce"];
              $borrador = 'NO'; 
              $bkColor = '#868E96';
              $estado = 'canceladas';
              $motivos = $rowCancelada["motivos"];
              $aas = 4;
            }
          }
          
          if($_SESSION['SAEP_codperfil'] != 3){
            $snp = 'SI';
          }else{
            $snp = 'NO';
          }

          $formPDF = '<form action="../PDF" method="post">
            <input type="hidden" id="idestudiante" name="idestudiante" value="'.$value[16].'">
            <input type="hidden" id="codprogramatemp" name="codprogramatemp" value="'.$value[1].'">
            <input type="hidden" id="codperiodotemp" name="codperiodotemp" value="'.$value[0].'">
            <button type="submit" id="btnPDF" formtarget="_blank" class="btn btn-sm btn-outline-danger" style="margin-top:2px; width: 115px;"><i class="fa fa-file-pdf-o"></i> VER PDF</button>
          </form>';

          if($estado == $_GET["estado"]){
            array_push($createtable['data'], 
                array(
                  ucwords(strtolower($value[15])),
                  replaceinMin(ucwords(strtolower($value[7]))),
                  formatID($value[17]).' '.$value[16],
                  replaceinMin(ucwords(strtolower($value[18]))),
                  $value[25],
                  $value[1].'~'.ucwords(strtolower($value[2])),
                  $value[10],
                  $value[11],
                  ($estadonotificado == 0 ? 'NO' : 'SÍ'),
                  ( $_GET["estado"] == 'vencidas' ? '<span style="color:red; font-weight:bold">'.returnDays($fh, $fhour).'</span>'  : '<span style="font-weight:bold">0</span>'),
                  ($observaciones == 0 ? '<span style="color:red;font-weight:bold">0</span>' : '<span style="color:green;font-weight:bold">'.$observaciones.'</span>').'<br/><button type="button" class="btn btn-sm btn-info" onclick="floadObservaciones(\''.$value[16].'\', \''.$value[0].'\',\''.$value[1].'\', \''.$value[6].'\', \''.$snp.'\', \''. replaceinMin(ucwords(strtolower($value[18]))).'\', \''.replaceinMin(ucwords(strtolower($value[7]))).'\', \''.ucwords(strtolower($value[2])).'\', \''. $value[10] . ' ' . conversorSegundosHoras(intval($value[20])).'\', \''.$estado.'\', \''.$fechaejecucion.'\')" style="width: 115px;">Ver detalles</button>'.($estado == 'gestionadas' ? $formPDF : '')
                )
            );
          }
          
          $json = json_encode($createtable);
        }
        
      }else{
        $json = json_encode($createtable);
      }
    break;

    case 'loadEntrevistasGestionadas':

      $codperiodo = $_GET['codperiodo'];
      $start = $_GET['datestart'];
      $end  = $_GET['dateend'];
      

      $fhour = date("Y-m-d H:i:s"); 
      $events = array();
      $mes = date("n");
      $metodologia = $_GET["metodologia"];
      $sede = $_GET["sede"];
      $codprograma = $_GET["codprograma"];
      
      $ch = curl_init();
      if($codprograma != 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexprograma?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede == 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/entrevistas_agendadas_reporte?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia != 'todas' && $sede == 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexmetodologia?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede != 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexsede?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia == 'todas' && $sede == 'todas' && $codprograma != 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexprograma?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      else if($metodologia != 'todas' && $sede != 'todas' && $codprograma == 'todos')
        curl_setopt($ch, CURLOPT_URL, "http://190.60.75.134/searches/entrevistas_agendadas_reportexmodalidadandsede?periodos=$codperiodo,$start,$end,$metodologia,$sede,$codprograma");
      
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      $pendientes = array();
      $vencidas = array();
      $gestionadas = array();

      if(count($resultado1) >= 1){
        foreach ($resultado1 as $key => $value) {

          $bkColor = "";
          $borrador = '';
          $fechaejecucion = "null";
          $motivos = '';// HH12:MI:SS A.M.
          $row = row("SELECT codigo_entrevista, to_char(fecha_entrevista, 'YYYY-MM-DD') as fecha_entrevista, estado 
                      FROM entrevistas
                      WHERE codestudiante_fk = '$value[16]' AND codperiodo = '$value[0]' AND codprograma = '$value[1]' AND estado = 1;");

          if($row != null){
            $bkColor = '#3ace43';
            $aas = 1;
            $estado = 'gestionadas';
            $fechaejecucion = $row["fecha_entrevista"];
            $estadonotificado = 1;
            
            $formPDF = '<form action="../PDF" method="post">
              <input type="hidden" id="idestudiante" name="idestudiante" value="'.$value[16].'">
              <input type="hidden" id="codprogramatemp" name="codprogramatemp" value="'.$value[1].'">
              <input type="hidden" id="codperiodotemp" name="codperiodotemp" value="'.$value[0].'">
              <button type="submit" id="btnPDF" formtarget="_blank" class="btn btn-sm btn-outline-danger" style="margin-top:2px; width: 115px;"><i class="fa fa-file-pdf-o"></i> VER PDF</button>
            </form>';
  
            if($estado == $_GET["estado"]){
              array_push($createtable['data'], 
                  array(
                    ucwords(strtolower($value[15])),
                    replaceinMin(ucwords(strtolower($value[7]))),
                    formatID($value[17]).' '.$value[16],
                    replaceinMin(ucwords(strtolower($value[18]))),
                    // $value[25],
                    $value[1].'~'.ucwords(strtolower($value[2])),
                    $fechaejecucion,
                    // $value[11],
                    $formPDF
                  )
              );
            }
            $json = json_encode($createtable);
          }
        }
        
      }else{
        $json = json_encode($createtable);
      }
    break;
  /************************   // FIN REPORTES MERCADEO   ****************************/

    case 'sLoadSedes':
      if($_POST["modalidad"] == 1)
        $sedes = 'SEDE';
      else if($_POST["modalidad"] == 4){
        $sedes = 'CAT';
      }
      $ch = curl_init();
      if($_POST["modalidad"] == 'todas')
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/cargar_sedes");
      else
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/cargar_sedesxmodalidad?periodos=".$sedes);

      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);
      $sedes = array();

      if(count($resultado1) >= 1){
        foreach ($resultado1 as $key => $value) {
          array_push(
            $sedes, 
            array(
              'codigo' => $value[0],
              'nombre' => replacein($value[2]),
            )
          );
        }
        $json = json_encode(array('success' => true, 'sedes' => $sedes));
      }else{
        $json = json_encode(array("success"=>false,"msg"=>"Dato no encontrado en <strong>SINU</strong>."));
      }
    break;

    
    case 'sLoadProgramas':

      $ch = curl_init();
      
      if(($_POST["modalidad"] == 'todas') && ($_POST["sede"] == 'todas'))
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/cargar_programas");
      else if(($_POST["modalidad"] == 'todas') && ($_POST["sede"] != 'todas'))
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/cargar_programasxsede?periodos=".$_POST["sede"]);
      else if(($_POST["modalidad"] != 'todas') && ($_POST["sede"] == 'todas'))
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/cargar_programasxmetodologia?periodos=".$_POST["modalidad"]);
      else 
        curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/cargar_programasxsedeandmetodologia?periodos=".$_POST["sede"].','.$_POST["modalidad"]);

      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);
      $sedes = array();

      if(count($resultado1) >= 1){
        foreach ($resultado1 as $key => $value) {
          array_push(
            $sedes, 
            array(
              'codigo' => $value[2],
              'nombre' =>  $value[2].' - '.replacein($value[3]),
            )
          );
        }
        $json = json_encode(array('success' => true, 'sedes' => $sedes));
      }else{
        $json = json_encode(array("success"=>false,"msg"=>"Dato no encontrado en <strong>SINU</strong>."));
      }
    break;
    
  /************************  procesos para misentrevistas.php ****************************/
    case 'linkEntrevista':
      $sql = "SELECT * 
              FROM links_entrevistas
              WHERE codpsicologo_fk = :codpsicologo AND estado_le = :estado";
      $row = row($sql, array(':codpsicologo' => $_SESSION["SAEP_codigo_usu"], ':estado' => 'on'));

      if($row != '')
        $json = json_encode(array('success' => true, 'link' => $row["link_le"], 'correo' => $row["correo_le"], 'pass' => $row["password_le"] ));
      else
        $json = json_encode(array('success' => false, 'message' => 'No tiene link asignado'));
    break;

    case 'MisEntrevistas':
      
      $start = $_GET['start'];
      $end = $_GET['end'];
      // $year = $_GET['year'];
      // $month = $_GET['month'];
      // $start = _data_first_month_day($year, $month);
      // $end  = _data_last_month_day($year, $month);

      $fhour = date("Y-m-d H:i:s"); 
      $events = array();
      $mes = date("n");

      // $ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/entrevistas_agendadas?periodos=$codperiodoactivo,$start,$end,".$_SESSION['SAEP_codigo_usu']);
      // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      // curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      // $resultado = curl_exec($ch);
      // curl_close($ch);
      // $resultado1=json_decode($resultado);
      // $resultado1=(array)json_decode($resultado);
      $resultado1 = array();
      foreach ($periodos as $key => $value) {
        $arrayperiod = returnDataPeriod($value, $start, $end, $_SESSION['SAEP_codigo_usu']);
        $resultado1 = array_merge($resultado1, $arrayperiod);
      }

      $dataBorrador = file_get_contents('./entrevistas.txt');
      $arrayBorrador = json_decode($dataBorrador, 1);

      if(count($resultado1) >= 1){
        // print_r($resultado1);
        foreach ($resultado1 as $key => $value) {
          $fechaCancelacion = "";
          $motivos = "";
          $bkColor = "";

          $rowObservaciones = row("SELECT codigo_oe FROM observaciones_entrevistas WHERE codestudiante_fk = '$value[16]';");
          $observaciones = ($rowObservaciones != null ? 'SÍ' : 'NO');
          $borrador = '';
          $fechaejecucion = "";
          $row = row("SELECT codigo_entrevista, to_char(fecha_entrevista, 'YYYY-MM-DD HH12:MI:SS A.M.') as fecha_entrevista, estado 
                      FROM entrevistas
                      WHERE codestudiante_fk = '$value[16]' and codperiodo = '$value[0]' and codprograma = '$value[1]';");
          if($row != null){
            if($row["estado"] == 1){
              $bkColor = '#3ace43';
              $aas = 1;
              $estado = 'Gestionada';
              $fechaejecucion = $row["fecha_entrevista"];
              $estadonotificado = 1;
            }else{
              $row2 = row("SELECT codigo_en, estado 
                      FROM estudiante_notificado
                      WHERE codestudiante_fk = '$value[16]' and codperiodo = '$value[0]';");
              $fh = $value[10].' '.conversorSegundosHoras(intval($value[20]));
              $estadonotificado =  ($row2 == null ? 0 : $row2["estado"]);
              $bkColor = '#f45959';
              $estado = 'Vencida';
              $aas = 0;
            }
          }else{
            $rowCancelada = row("SELECT fecha_ce, motivos as codmotivo, mc.nombre_mc as motivos
            FROM entrevistas_canceladas ec
            INNER JOIN motivos_cancelacion mc ON mc.codigo_mc = ec.motivos WHERE codestudiante_fk = :codestudiante and codperiodo = '$value[0]'", array(':codestudiante' => $value[16]));

            $row2 = row("SELECT codigo_en, estado 
                      FROM estudiante_notificado
                      WHERE codestudiante_fk = '$value[16]' and codperiodo = '$value[0]';");
            $estadonotificado =  ($row2 == null ? 0 : $row2["estado"]);
            if($rowCancelada == ''){
              $fh = $value[10].' '.conversorSegundosHoras(intval($value[20]));
              $borrador = 'NO';
              if(is_array($arrayBorrador)){
                if(isset($arrayBorrador[$value[16]])){
                  $borrador = 'SÍ';
                }else{
                  $borrador = 'NO'; 
                }
              }
  
              if($fhour > $fh){
                $bkColor = '#f45959';
                $estado = 'Vencida';
                $aas = 3;
              }else{
                $bkColor = '#ffac64';
                $estado = 'Pendiente';
                $aas = 2;
              }
            }else{
              $fechaCancelacion = $rowCancelada["fecha_ce"];
              $borrador = 'NO'; 
              $bkColor = '#868E96';
              $estado = 'Cancelada';
              $motivos = $rowCancelada["motivos"];
              $aas = 4;
            }
            
          }

          array_push(
            $events, 
            array(
              'codperiodo' => $value[0],
              'id' => $value[16],
              'start' => $value[10] . ' ' . conversorSegundosHoras(intval($value[20])),
              'end' => $value[10] . ' ' . conversorSegundosHoras(intval($value[21])),
              'title' => formatID($value[17]).': '.$value[16],
              'backgroundColor' => $bkColor,
              'borderColor' => $bkColor,
              'stateEvents' => 'Estado: '.$estado,
              'estado' => $estado,
              'observaciones' => $observaciones,
              'borrador' => $borrador,
              'aas' => $aas,
              'iddetresadmision' => $value[23],
              'idadmision' => $value[24],
              'fechaejecucion' => $fechaejecucion,
              'extraData' => array(
                'horainit' => $value[11],
                'horalast' => $value[12],
                'seccional' => ucwords(strtolower($value[15])),
                'sede' => ucwords(strtolower($value[15])),
                'codprograma' => $value[1],
                'programa' => ucwords(strtolower($value[2])),
                'idestudiante' => $value[16],
                'nombreestudiante' => replaceinMin(ucwords(strtolower($value[18]))),
                'emailestudiante' => $value[22],
                'celestudiante' => $value[25],
              ),
              'fechaCancelacion' => $fechaCancelacion,
              'motivos' => $motivos,
              'estNoti' => $estadonotificado
            )
          );
          $json = json_encode($events);

        }
        
      }else{
        $json = json_encode($events);
      }
    break;

    case 'sLoadPlanAcompanamiento':
      $sql = "SELECT codigo as cod, CONCAT(codigo, ' - ', nombre) as nombre FROM plan_acompanamiento WHERE estado = 'on' AND tipo = :tipo";
      $table = table($sql, array(':tipo' => $_POST["params"]));
      $json = json_encode($table);
    break;

    case 'NotificarEntrevista':
      
      $nombreestudiante = (isset($_POST["nombre"]) ? $_POST["nombre"] : null);
      $sede = (isset($_POST["sede"]) ? $_POST["sede"] : null);
      
      $idestudiante = (isset($_POST["idestudiante"]) ? explode(":", $_POST["idestudiante"]) : null);
      $programaacademico = (isset($_POST["programa"]) ? $_POST["programa"] : null);
      $fecha = (isset($_POST["fecha"]) ? $_POST["fecha"] : null);
      $horainicio = (isset($_POST["horaini"]) ? $_POST["horaini"] : null);
      $horafin = (isset($_POST["horafin"]) ? $_POST["horafin"] : null);
      $link = row("SELECT link_le FROM links_entrevistas WHERE codpsicologo_fk = :codpsico", array(':codpsico' => $_SESSION['SAEP_codigo_usu']));
      $modalidad = 1;
      // $email = (isset($_POST["ema"]) ? $_POST["ema"] : null); 'wparedes@coruniamericana.edu.co'; //$_SESSION['SERVICIOSVIRTUALES_emailinstitucional'];
      // $email = "wilberparedes@gmail.com";
      $email = (isset($_POST["ema"]) ? $_POST["ema"] : null);

      $rowEN = row("SELECT codigo_en FROM estudiante_notificado WHERE codestudiante_fk = :id", array(':id' => $documento));
      $update = "UPDATE estudiante_notificado SET estado = :estado, codperiodo = :codperiodo, codprograma = :codprograma WHERE codestudiante_fk = :id";
      $insert = "INSERT INTO estudiante_notificado (codestudiante_fk, estado, codperiodo, codprograma) VALUES (:id, :estado, :codperiodo, :codprograma)";
      $params = array(":estado" => 1, ':codperiodo' => $codperiodo, ':codprograma' => $codprograma, ":id" => $documento);
      $sql = ($rowEN == null ? $insert : $update);

      if($link != ''){
        if(query($sql, $params)){
          
          $html="";
          $html.='<img style="display:block;max-width:100%!important;width:100%;height:auto!important" src="../assets/img/banner_email.png" width="600" border="0"><br><br>';
          $html.='<p style="text-align:justify">Estimado Aspirante,</p>';
          $html.='<p style="text-align:justify">'.utf8_decode('Para la Americana es un placer darte la Bienvenida a nuestra familia, te has inscrito y has seleccionado una entrevista con Bienestar Institucional para tu proceso de ingreso al programa académico seleccionado, para nosotros es un placer atenderte, por esa razón le enviamos la citación a este primer encuentro con Bienestar, a continuación encontrarás los detalles de la entrevista, encontraras un Link el cual deberás usar en la fecha y hora indicada para el encuentro, en caso de que tengas alguna situación que no te permita asistir en esta fecha, deberás escribir al correo que aparece en el detalle "correo del psicólogo" para reprogramar, pero seguirás usando este mismo Link.').'<br><br>';
          $html.=utf8_decode('<b>Datos de entrevista:</b>');
          $html.='<table border="0">';
  
          $html.='<tr>';
          $html.='<td><strong>'.utf8_decode('Sede:').'</strong></td>';
          $html.='<td>'. ucwords(strtolower(utf8_decode($sede))).'</td>';
          $html.='</tr>';
  
          $html.='<tr>';
          $html.='<td><strong>'.$idestudiante[0].': </strong></td>';
          $html.='<td>'.$idestudiante[1].'</td>';
          $html.='</tr>';
  
          $html.='<tr>';
          $html.='<td><strong>'.utf8_decode('Estudiante:').'</strong></td>';
          $html.='<td>'. ucwords(strtolower(utf8_decode(replaceinMin($nombreestudiante)))).'</td>';
          $html.='</tr>';
  
          $html.='<tr>';
          $html.='<td><strong>'.utf8_decode('Programa Académico:').'</strong></td>';
          $html.='<td>'.utf8_decode($programaacademico).'</td>';
          $html.='</tr>';
  
          $html.='<tr>';
          $html.='<td><strong>'.utf8_decode('Nombre del psicólogo:').'</strong></td>';
          $html.='<td>'. ucwords(strtolower(utf8_decode(($_SESSION['SAEP_psicof'] ? $_SESSION['SAEP_nombrepsicologoReem'] : $_SESSION['SAEP_nombre_usu'])))).'</td>';
          $html.='</tr>';
          $html.='<tr>';
  
          $html.='<tr>';
          $html.='<td><strong>'.utf8_decode('Correo del psicólogo:').'</strong></td>';
          $html.='<td>'. strtolower(($_SESSION['SAEP_psicof'] ? $_SESSION['SAEP_correopsicologoReem'] : $_SESSION['SAEP_correoins'])).'</td>';
          $html.='</tr>';
          $html.='<tr>';
          
          $html.='<tr>';
          $html.='<td><strong>Fecha:</strong></td>';
          $html.='<td>'.$fecha.'</td>';
          $html.='</tr>';
          $html.='<td><strong>'.utf8_decode('Hora inico:').'</strong></td>';
          $html.='<td>'.$horainicio.'</td>';
          $html.='<tr>';
          $html.='<td><strong>'.utf8_decode('Hora fin:').'</strong></td>';
          $html.='<td>'.$horafin.'</td>';
          $html.='</tr>';
          $html.='<tr>';
          $html.='<td><strong>'.utf8_decode('Modalidad del Servicio:').'</strong></td>';
          $html.='<td>'.($modalidad==1 ? 'VIRTUAL' : 'PRESENCIAL' ).'</td>';
          $html.='</tr>';
          if($modalidad == 1){/*VIRTUAL*/
            $html.='<tr>';
            $html.='<td><strong>'.utf8_decode('Link de videollamada:').'</strong></td>';
            $html.='<td><a href="'.$link["link_le"].'"><strong>'.utf8_decode('Click aquí, para ingresar a su entrevista').'</strong></a></td>';
            $html.='</tr>';
            $html.='</table>';
          }
          if($modalidad == 1){/*VIRTUAL*/
            
            $html.='<p style="text-align:justify"><b>'.utf8_decode('Requerimientos para recibir el servicio en Modalidad Virtual').'</b></p>';
            $html.='<ul>';
            $html.='<li>'.utf8_decode('Conexión a Internet de banda ancha.').'</li>';
            $html.='<li>'.utf8_decode('Software de navegación de Internet (Mozilla Firefox, Google Chrome).').'</li>';
            $html.='<li>'.utf8_decode('Cámara Web.').'</li>';
            $html.='<li>'.utf8_decode('Micrófono.').'</li>';
            $html.='<li>'.utf8_decode('Audífonos o parlantes.').'</li>';
            $html.='</ul><br>';
          }else{
            $html.='<p style="text-align:justify">'.utf8_decode('Requerimientos para recibir el servicio en Modalidad Presencial').'<br>';
            $html.='<ul>';
            $html.='<li>'.utf8_decode('Presentar el carnet estudiantil o la cédula de ciudadanía en el Bienestar Institucional, ubicado en el 3 piso de la sede Cosmos/Barranquilla.').'</li>';
            $html.='<li>'.utf8_decode('Asistir puntual a su entrevista.').'</li>';
            $html.='</ul>';
            $html.='</p>';
          }
          $html.=utf8_decode('<br><strong><i>"Este e-mail fue generado de manera automática. Por favor, no lo responda".</i></strong><br>');
          $html.='<br>Cordialmente,<br><br>';
          $html.='Bienestar Institucional<br>';
          $html.=utf8_decode('Corporación Universitaria Americana<br>');
          $html.='Tel. (5) 3851027 Ext. 443<br><br>';
          $html.=utf8_decode('Síguenos en Facebook, Twitter e Instagram:<br>');
          $html.='www.facebook.com/coruniamericana<br>';
          $html.='www.twitter.com/coruniamericana<br>';
          $html.='www.instagram.com/coruniamericana<br><br>';
          $html.='<img src="http://190.60.75.134:9090/psicologia/assets/images/acreditacion.png"/>';
          
          $mail->Subject = utf8_decode("Entrevista Psicológica - Proceso de Admisión");
          $mail->AltBody = "";
          $mail->MsgHTML($html);
          $mail->AddAddress($email,"");
          // $mail->AddBCC("wparedes@coruniamericana.edu.co","");
          // $mail->AddCC($emailpsi,"");
          $mail->IsHTML(true);
          $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
          );
  
          if ($mail->Send()) {
            $json = json_encode(array("success" => true, 'message' => 'Notificado exitosamente al correo: <strong>'.$email.'</strong>.'));  //, "codigo_enc"=>$datarow["codigo_enc"]
          }else{
            $json=json_encode(array("success"=>false,"mensaje"=>$mail->ErrorInfo));
          }
         
          
        }else{
          $json = json_encode(array("success"=>false,"message" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
        }
      }else{
        $json = json_encode(array("success"=>false,"message" => "Usted no tiene link de videollamada asignado. contacte a su jefe."));
      }
    break;

    case 'nuevaEncuesta':

      if(isset($_POST["aspectos"])){
        $aspectos = json_decode($_POST["aspectos"]);
      }
      if(isset($_POST["icfes"])){
        $icfes = json_decode($_POST["icfes"]);
      }

      if(isset($_POST["sRequerimientoVirtual"])){
        $requerimientovirtual = implode(",", $_POST["sRequerimientoVirtual"]);
      }else{
        $requerimientovirtual = NULL;
      }

      if(isset($_POST["sTipoDiscapacidadTalento"]) && $_POST["sTipoDiscapacidadTalento"] != null){
        $tipodiscapacidadtalento = $_POST["sTipoDiscapacidadTalento"];
      }else{
        $tipodiscapacidadtalento = 0;
      }

      if(isset($_POST["codacomaca"]) && $_POST["codacomaca"] != ''){
        $codacomacade = $_POST["codacomaca"];
      }else{
        $codacomacade = NULL;
      }

      if(isset($_POST["codacompsi"]) && $_POST["codacompsi"] != ''){
        $codacompsico = $_POST["codacompsi"];
      }else{
        $codacompsico = NULL;
      }

      if(isset($_POST["con"])){
        $con = strtoupper(strtolower($_POST["con"]));
      }

      if(isset($_POST["pruebapsico"])){
        $pruebapsico = $_POST["pruebapsico"];
      }

      $getdate = getdate();

      $insertEntrevista = "INSERT INTO entrevistas (codestudiante_fk, fecha_entrevista, nombre_completo, email_per, codcolegio_fk, fecha_icfes, registro_ac, sexo, edad,  estado_civil, situacion_laboral, telefono, otrotelefono, fijo, direccion, lugar_residencia, barrio_residencia, codprograma, nombre_programa, requisitos_mv, codacomacade, codacompsico, conclusiones, codpsicologo_fk, estado, codpruebapsico, codperiodo, estrato)
                                             VALUES (:codestudiante, :fechaentrevista, :nombrecompleto, :emailper, :codcolegio, :fechaicfes, :registroac, :sexo, :edad, :estadocivil, :situacionlaboral, :telefono, :otrotelefono, :fijo, :direccion, :lugarresidencia, :barrioresidencia, :codprograma, :nombreprograma, :requisitos_mv, :codacomacade, :codacompsico, :conclusiones, :codpsicologo, 1, :pruebapsico, :codperiodo, :estrato) RETURNING codigo_entrevista";
                                              // codagrupacion_fk, codtipopoblacion_fk, codtipodiscapacidad_fk,
                                              // :codagrupacion, :codtipopoblacion, :codtipodiscapacidad,
      $paramsEntrevista = array(
                            ':codestudiante' => $_POST["txtIdentificacion"], 
                            ':fechaentrevista' => $_POST["txtFechaEntrevista"].' '.$getdate["hours"].':'.$getdate["minutes"].':'.$getdate["seconds"], 
                            ':nombrecompleto' => strtoupper(strtolower(replacein($_POST["txtNombreCompleto"]))),
                            ':emailper' => trim($_POST["txtEmail"]),
                            ':codcolegio' => $_POST["selectuser_id"], 
                            ':fechaicfes' => $_POST["txtFechaIcfes"], 
                            ':registroac' => strtoupper(strtolower(trim($_POST["txtAcIcfes"]))), 
                            ':sexo' => $_POST["sSexo"], 
                            ':edad' => $_POST["sEdad"], 
                            ':estadocivil' => $_POST["sEstadoCivil"],
                            ':situacionlaboral' => $_POST["sSituacionLaboral"],
                            // ':codagrupacion' => $_POST["sGrupoPriorizado"], 
                            // ':codtipopoblacion' => $_POST["sTipoPoblacion"], 
                            // ':codtipodiscapacidad' => $tipodiscapacidadtalento,
                            ':telefono' => trim($_POST["txtTelefono"]), 
                            ':otrotelefono' => trim($_POST["txtTelefonoOtro"]),
                            ':fijo' => trim($_POST["txtTelefonoFijo"]), 
                            ':direccion' => strtoupper(strtolower(trim($_POST["txtDireccion"]))), 
                            ':lugarresidencia' => strtoupper(strtolower(trim($_POST["txtLugarResidencia"]))),
                            ':barrioresidencia' => strtoupper(strtolower(trim($_POST["txtBarrio"]))),
                            ':codprograma' => $_POST["txtCodPrograma"],
                            ':nombreprograma' => $_POST["txtCarreraAspira"],
                            ':requisitos_mv' => $requerimientovirtual, 
                            ':codacomacade' => $codacomacade,
                            ':codacompsico' => $codacompsico,
                            ':pruebapsico' => $pruebapsico,
                            ':conclusiones' => $con,
                            ':codpsicologo' => $_SESSION["SAEP_usuario"],
                            ':codperiodo' => $codperiodo_,
                            ':estrato' => $_POST["sEstrato"]
                          );
        $countva = 0;
        $aspectnull = array();
        foreach ($aspectos as $key => $value) {
          $codaspecto = $value->codigo;
          foreach ($value->conceptos as $key1 => $value1) {
            
            $idresp = $_POST["concepto".$codaspecto."C".$value1->codigoce];
            $observacion = strtolower(trim($_POST["observacion".$codaspecto."C".$value1->codigoce]));
            if($idresp == '' || $observacion == ''){
              $countva++;
              array_push($aspectnull, array('cod1' => $codaspecto, 'cod2' => $value1->codigoce));
            }
          }
        }

        if($countva == 0){
          $datarowEntrevista = DataRow($insertEntrevista, $paramsEntrevista);
          if($datarowEntrevista != -1){
            foreach ($aspectos as $key => $value) {
              $codaspecto = $value->codigo;
              foreach ($value->conceptos as $key1 => $value1) {
                
                $idresp = $_POST["concepto".$codaspecto."C".$value1->codigoce];
                $observacion = strtolower(trim($_POST["observacion".$codaspecto."C".$value1->codigoce]));
                
                  $valor = row("SELECT val_respuesta FROM respuestas_concepto WHERE codigo_rc = :co", array(':co' => $idresp));
                  $insertRespuesta = "INSERT INTO respuestas_entrevistas (codentrevista_fk, codconcepto_fk, codrespuesta_fk, valor_rpe, observacion_rpe) VALUES (:codentrevista, :codconcepto, :codrespuesta, :valor, :observacion)";
                  $paramsRespuesta = array(':codentrevista' => $datarowEntrevista["codigo_entrevista"], ':codconcepto' => $value1->codigoce, ':codrespuesta' => $idresp, ':valor' => $valor["val_respuesta"], ':observacion' => $observacion);
                  query($insertRespuesta, $paramsRespuesta);
              }
            }
            foreach ($icfes as $key => $value) {
              $puntaje = $_POST["resp_icfes_".$value->codigo];
              $nombre = $value->nombre;
              $sqlIcfes_ = "SELECT * 
                            FROM puntajes_icfes
                            WHERE codestudiante_fk = :codestudiante 
                            AND nombre_pi = :nombrepi";
              $rowIcfes_ = row($sqlIcfes_, array(':codestudiante' => $_POST["txtIdentificacion"], ':nombrepi' => $nombre));

              if($rowIcfes_ == ''){
                $insertIcfes = "INSERT INTO puntajes_icfes (codestudiante_fk, nombre_pi, puntaje_pi) VALUES (:codestudiante, :nombrepi, :puntajepi)";
                $paramsIcfes = array(':codestudiante' => $_POST["txtIdentificacion"], ':nombrepi' => $nombre, ':puntajepi' => $puntaje);
                query($insertIcfes, $paramsIcfes);
              }else{
                $updateIcfes = "UPDATE puntajes_icfes SET puntaje_pi = :puntajepi WHERE codigo_pi = :codigopi";
                $paramsUpdateIcfes = array(':puntajepi' => $puntaje, ':codigopi' => $rowIcfes_["codigo_pi"]);
                query($updateIcfes, $paramsUpdateIcfes);
              }

            }

            for ($i=1; $i <= $_POST["lengp"]; $i++) { 
              if(isset($_POST["sTipoDiscapacidadTalento_".$i]) && $_POST["sTipoDiscapacidadTalento_".$i] != null){
                $tipodiscapacidadtalento = $_POST["sTipoDiscapacidadTalento_".$i];
              }else{
                $tipodiscapacidadtalento = 0;
              }
              if(isset($_POST["sSubTipoDiscapacidadTalento_".$i]) && $_POST["sSubTipoDiscapacidadTalento_".$i] != ''){
                $subtipodiscapacidadtalento = $_POST["sSubTipoDiscapacidadTalento_".$i];
              }else{
                $subtipodiscapacidadtalento = null;
              }
              $insergp = "INSERT INTO gp_estudiante (codentrevista_fk, codagrupacion_fk, codtipopoblacion_fk, codtipodiscapacidad_fk, ruv, codsubtipodiscapacidad_fk) VALUES (:codentrevista, :codagrupacion, :codtipopoblacion, :codtipodiscapacidad, :ruv, :subtipodiscapacidadtalento)";
              $paramsgp = array(':codentrevista' => $datarowEntrevista["codigo_entrevista"], ':codagrupacion' => $_POST["sGrupoPriorizado_".$i], ':codtipopoblacion' => $_POST["sTipoPoblacion_".$i], ':codtipodiscapacidad' => $tipodiscapacidadtalento, ':ruv' => ($_POST["txtRUV_".$i] == '' ? null : $_POST["txtRUV_".$i]), ':subtipodiscapacidadtalento' => $subtipodiscapacidadtalento );
              query($insergp, $paramsgp);
            }

            $data = file_get_contents('./entrevistas.txt');
            $array = json_decode($data, 1);
            if(is_array($array)){
              if(isset($array[$_POST["txtIdentificacion"]])){
                unset($array[$_POST["txtIdentificacion"]]);
              }
            }
            $json_string = json_encode($array);
            $file = 'entrevistas.txt';
            
            if (file_put_contents($file, $json_string) !== false) {
              $json = json_encode(array("success" => true, "codentrevista" => $datarowEntrevista["codigo_entrevista"])); 
            }else{
              $json = json_encode(array('success' => false, 'message' => 'No se pudo guardar Borrador, comunicate con el administador.'));
            }
  
          }else{
            $json = json_encode(array('success' => false, 'message' => 'ocurrio un error al guardar entrevista.'));
          }
        }else{
          $json = json_encode(array('success' => false, 'asp' => $aspectnull, 'message' => 'Por favor, llene toda la entrevista!'));
        }
        
    break;

    case 'uploadFilePsico':
      if (isset($_FILES)) {
        $error = false;
        $files = array();

        $uploaddir = './files/';
        $arrLlaves=array_keys($_FILES);

        $i = 0;
        foreach ($_FILES as $key => $file) {
          $name = explode("_", $arrLlaves[$i]);
          $namefile = datetimeNowName() .'-'. replaceSpace(basename( $file['name']));
          if (move_uploaded_file($file['tmp_name'], $uploaddir . $namefile)) {
            $insert = "INSERT INTO evidencia_pruebapsico (codentrevista_fk, codpruebapsico_fk, path) VALUES (:codentrevista, :codpruebapsico, :path)";
            $params = array(':codentrevista' => $_POST["id"], ':codpruebapsico' => $name[1], ':path' => $namefile);
            query($insert, $params);
            $files[] = $uploaddir . $file['name'];
          } else {
            $error = true;
          }
          $i++;
        }

        $json = json_encode(array('success' => true));

      } else {
        $json = json_encode(array('success' => false,'message' => 'ERROR AL SUBIR ARCHIVOS'));
      }

    break;

    case 'sendPuntaje':
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134:9990/updating_admission_saep.json");
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "id_par_admision=".$_POST["IDPARADMISION"]."&id_det_res_admision=".$_POST["IDDETRESADMISION"]."&not_cuantitativa=".$_POST["NOTA"]);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $remote_server_output = curl_exec($ch);
      curl_close ($ch);

      $someJSON = str_replace("'", '"', $remote_server_output);
      $resultado1 = json_decode($someJSON, true);

      if($resultado1['result'] == 'ok'){
        $json = json_encode(array('success' => true));
      }else{
        $json = json_encode(array('success' => false, 'message' => 'Ocurrió un error al guardar nota en SINU'));
      }
    break;

    case 'saveTemp': 
      $getdate = getdate();

      if(isset($_POST["sTipoDiscapacidadTalento"]) && $_POST["sTipoDiscapacidadTalento"] != null){
        $tipodiscapacidadtalento = $_POST["sTipoDiscapacidadTalento"];
      }else{
        $tipodiscapacidadtalento = 0;
      }

      if(isset($_POST["sRequerimientoVirtual"])){
        $requerimientovirtual = implode(",", $_POST["sRequerimientoVirtual"]);
      }else{
        $requerimientovirtual = NULL;
      }
      if(isset($_POST["codacomaca"]) && $_POST["codacomaca"] != ''){
        $codacomacade = $_POST["codacomaca"];
      }else{
        $codacomacade = NULL;
      }

      if(isset($_POST["codacompsi"]) && $_POST["codacompsi"] != ''){
        $codacompsico = $_POST["codacompsi"];
      }else{
        $codacompsico = NULL;
      }

      if(isset($_POST["con"])){
        $con = $_POST["con"];
      }

      if(isset($_POST["aspectos"])){
        $aspectos = json_decode($_POST["aspectos"]);
        $respuestas = array();
        foreach ($aspectos as $key => $value) {
          $codaspecto = $value->codigo;
          foreach ($value->conceptos as $key1 => $value1) {
            $idresp = $_POST["concepto".$codaspecto."C".$value1->codigoce];
            $observacion = strtolower(trim($_POST["observacion".$codaspecto."C".$value1->codigoce]));
            if($idresp != ""){
              array_push($respuestas, array('codaspecto' => $codaspecto, 'codconcepto' => $value1->codigoce, 'codrespuesta' => $idresp, 'observacion' => $observacion));
            }
          }
        }

      }
      if(isset($_POST["icfes"])){
        $icfes = json_decode($_POST["icfes"]);

        $newIcfes = array();
        foreach ($icfes as $key => $value) {
          $puntaje = $_POST["resp_icfes_".$value->codigo];
          $nombre = $value->nombre;
          array_push($newIcfes, array('nombre' => $nombre, 'puntaje' => $puntaje));
        }
      }

      if(isset($_POST["pruebapsico"]) && $_POST["pruebapsico"] != ''){
        $pruebapsico = $_POST["pruebapsico"];
      }else{
        $pruebapsico = NULL;
      }

      $gp = array();
      for ($i=1; $i <= $_POST["lengp"]; $i++) { 
        if(isset($_POST["sTipoDiscapacidadTalento_".$i]) && $_POST["sTipoDiscapacidadTalento_".$i] != null){
          $tipodiscapacidadtalento = $_POST["sTipoDiscapacidadTalento_".$i];
        }else{
          $tipodiscapacidadtalento = 0;
        }
        if(isset($_POST["sSubTipoDiscapacidadTalento_".$i]) && $_POST["sSubTipoDiscapacidadTalento_".$i] != ''){
          $subtipodiscapacidadtalento = $_POST["sSubTipoDiscapacidadTalento_".$i];
        }else{
          $subtipodiscapacidadtalento = null;
        }
        array_push($gp, array(
          'codagrupacion' => $_POST["sGrupoPriorizado_".$i],
          'codtipopoblacion' => $_POST["sTipoPoblacion_".$i], 
          'codtipodiscapacidad' => $tipodiscapacidadtalento,
          'ruv' => ($_POST["txtRUV_".$i] == '' ? null : $_POST["txtRUV_".$i]), 
          'codsubtipodiscapacidad' => $subtipodiscapacidadtalento
        ));
      }


      $data = file_get_contents('./entrevistas.txt');
      $array = json_decode($data, 1);

      $entrevista = array(
        'lengp' => $_POST["lengp"],
        'codestudiante' => $_POST["txtIdentificacion"], 
        'fechaentrevista' => $_POST["txtFechaEntrevista"].' '.$getdate["hours"].':'.$getdate["minutes"].':'.$getdate["seconds"], 
        'nombrecompleto' => replacein($_POST["txtNombreCompleto"]),
        'emailper' => trim($_POST["txtEmail"]),
        'codcolegio' => $_POST["selectuser_id"], 
        'nombrecolegio' => $_POST["txtColegio"], 
        'codpropiedadplantafisica' => $_POST["sTipoColegio"], 
        'fechaicfes' => $_POST["txtFechaIcfes"], 
        'registroac' => strtoupper(strtolower(trim($_POST["txtAcIcfes"]))), 
        'sexo' => $_POST["sSexo"], 
        'edad' => $_POST["sEdad"], 
        'estadocivil' => $_POST["sEstadoCivil"],
        'situacionlaboral' => $_POST["sSituacionLaboral"],
        // 'codagrupacion' => $_POST["sGrupoPriorizado"], 
        // 'codtipopoblacion' => $_POST["sTipoPoblacion"], 
        'gp' => $gp,
        // 'codtipodiscapacidad' => $tipodiscapacidadtalento,
        'telefono' => trim($_POST["txtTelefono"]), 
        'otrotelefono' => trim($_POST["txtTelefonoOtro"]),
        'fijo' => trim($_POST["txtTelefonoFijo"]), 
        'direccion' => strtoupper(strtolower(trim($_POST["txtDireccion"]))), 
        'lugarresidencia' => strtoupper(strtolower(trim($_POST["txtLugarResidencia"]))),
        'barrioresidencia' => strtoupper(strtolower(trim($_POST["txtBarrio"]))),
        'codprograma' => $_POST["txtCodPrograma"],
        'nombreprograma' => $_POST["txtCarreraAspira"],
        'requisitos_mv' => $requerimientovirtual, 
        'codacomacade' => $codacomacade,
        'codacompsico' => $codacompsico,
        'pruebapsico' => $pruebapsico,
        'conclusiones' => $con,
        'aspectos' => $aspectos,
        'icfes' => $newIcfes,
        'respuestas' => $respuestas,
        'codperiodo' => $codperiodo_,
        'estrato' => $_POST["sEstrato"],
        'codpsicologo' => $_SESSION["SAEP_usuario"]
      );

      if(is_array($array)){
        if(isset($array[$_POST["txtIdentificacion"]])){
          $array[$_POST["txtIdentificacion"]] = $entrevista;
          $json_string = json_encode($array);
          $file = 'entrevistas.txt';
          
          if (file_put_contents($file, $json_string) !== false) {
            $json = json_encode(array('success' => true));
          }else{
            $json = json_encode(array('success' => false, 'message' => 'No se pudo guardar Borrador, comunicate con el administador.'));
          }
        }else{
          $array[$_POST["txtIdentificacion"]] = $entrevista;
          $json_string = json_encode($array);
          $file = 'entrevistas.txt';
          $resp = file_put_contents($file, $json_string);
          if (file_put_contents($file, $json_string) !== false) {
            $json = json_encode(array('success' => true));
          }else{
            $json = json_encode(array('success' => false, 'message' => 'No se pudo guardar Borrador, comunicate con el administador.'));
          }
        }
      }else{
        $json_string = json_encode(array($_POST["txtIdentificacion"] => $entrevista));
        $file = 'entrevistas.txt';
        $resp = file_put_contents($file, $json_string);
        if ($resp !== false) {
          $json = json_encode(array('success' => true));
        }else{
          $json = json_encode(array('success' => false, 'message' => 'No se pudo guardar Borrador, comunicate con el administador.'));
        }
      }
      
    break;

    case 'saveUpdate':
      $data = file_get_contents('./update.txt');
      $array = json_decode($data, 1);

      if(is_array($array)){
        if(isset($array[$_SESSION["SAEP_usuario"]])){
          $array[$_SESSION["SAEP_usuario"]] = true;
          $json_string = json_encode($array);
          $file = 'update.txt';
          file_put_contents($file, $json_string);
        }else{
          $array[$_SESSION["SAEP_usuario"]] = true;
          $json_string = json_encode($array);
          $file = 'update.txt';
          file_put_contents($file, $json_string);
        }
      }else{
        $json_string = json_encode(array($_SESSION["SAEP_usuario"] => true));
        $file = 'update.txt';
        file_put_contents($file, $json_string);
      }
      $json = json_encode(array('success' => true));

    break;

    case 'loadTemp':

      $data = file_get_contents('./entrevistas.txt');
      $array = json_decode($data, 1);

      if(is_array($array)){
        if(isset($array[$documento])){
          $entrevista = $array[$documento];
          $json = json_encode(array('success' => true, 'entrevista' => $entrevista, 'codprograma' => $codprograma, 'nombreprograma' => strtoupper($_POST["nombreprograma"])));
        }else{
          $json = json_encode(array('success' => false, 'message' => 'Borrador no encontrado'));
        }
      }
    break;

    case 'VerEntrevista':
      $row = row("SELECT codigo_entrevista, codestudiante_fk, fecha_entrevista, nombre_completo, email_per, codcolegio_fk, fecha_icfes, registro_ac, sexo, edad,  estado_civil, situacion_laboral, codagrupacion_fk, codtipopoblacion_fk, codtipodiscapacidad_fk, telefono, otrotelefono, fijo, direccion, lugar_residencia, barrio_residencia, codprograma, nombre_programa, requisitos_mv, codacomacade, codacompsico, conclusiones, codpsicologo_fk, dp.nombre as nombrepsicologo, entrevistas.codperiodo, entrevistas.estrato, entrevistas.estado, codpruebapsico, c.codigo_colegio, c.nombre_colegio, c.codpropiedadplantafisica_fk
                    FROM entrevistas
                    INNER JOIN colegios c ON c.codigo_colegio = entrevistas.codcolegio_fk
                    INNER JOIN datospersonales dp ON dp.identificacion = entrevistas.codpsicologo_fk
                    WHERE codestudiante_fk = :documento
                    AND entrevistas.codprograma = :codprograma
                    AND entrevistas.codperiodo = :codperiodo;", array(':documento' => $documento, ':codprograma' => $codprograma, ':codperiodo' => $codperiodo));
      
      $tablerespuestas = table("SELECT codigo_rpe, codaspectos_fk as codaspecto, codconcepto_fk as codconcepto, codrespuesta_fk as codrespesta, valor_rpe as valor, observacion_rpe as observacion
                                  FROM respuestas_entrevistas re
                                  INNER JOIN concepto_evaluar ce ON ce.codigo_ce = re.codconcepto_fk
                                  WHERE codentrevista_fk = :codentrevista", array(':codentrevista' => $row["codigo_entrevista"]));


      $tableIcfes = table("SELECT codigo_pi, nombre_pi as nombre, puntaje_pi as puntaje FROM puntajes_icfes WHERE codestudiante_fk = :co ORDER BY codigo_pi ASC", array(':co' => $documento));

      $tableGP = table("SELECT codagrupacion_fk as codagrupacion, codtipopoblacion_fk as codtipopoblacion, codtipodiscapacidad_fk as codtipodiscapacidad, ruv, codsubtipodiscapacidad_fk as codsubtipodiscapacidad FROM gp_estudiante WHERE codentrevista_fk = :ce ORDER BY codigo_gpe ASC", array(':ce' => $row["codigo_entrevista"]));
      $tableEvidencePruePsico = table("SELECT path as urlevidence, codpruebapsico_fk as codpruebapsico FROM evidencia_pruebapsico WHERE codentrevista_fk = :cpp AND estado_epp = 'on'", array(':cpp' => $row["codigo_entrevista"]));

      $entrevista = array('success' => true, 'entrevista' => convertEntrevista($row), 'gp' => $tableGP, 'lengp' => count($tableGP), 'respuestas' => $tablerespuestas, 'icfes' => $tableIcfes, 'evidenciasPruebaPsico' => $tableEvidencePruePsico);

      $json = json_encode($entrevista);
    break;

    case 'loadObservaciones':
      $observaciones = array();
      $sql = "SELECT codigo_oe, novedad, codestudiante_fk, codpsicologo_fk, to_char(fecha_hora, 'YYYY-MM-DD HH12:MI:SS A.M.') as fechahora, REPLACE (dp.nombre, ' ', '.') as nombrepsicologo, nombre_perfil as nombreperfil
              FROM observaciones_entrevistas oe
              INNER JOIN datospersonales dp ON dp.identificacion = oe.codpsicologo_fk
              INNER JOIN perfiles p ON p.codigo_perfil = dp.codperfil_fk
              WHERE codestudiante_fk =:codestudiante AND codprograma = :codprograma AND codperiodo = :codperiodo ORDER BY codigo_oe DESC";
      $params = array(':codestudiante' => $documento, ':codprograma' => $codprograma, ':codperiodo' => $codperiodo);
      $table = table($sql, $params);

      $fechaCancelacion = '';
      $motivos = '';
      if(isset($_POST["estado"])){
        if($_POST["estado"] == 'canceladas'){
          $rowCancelada = row("SELECT fecha_ce, motivos as codmotivo, mc.nombre_mc as motivos
          FROM entrevistas_canceladas ec
          INNER JOIN motivos_cancelacion mc ON mc.codigo_mc = ec.motivos WHERE codestudiante_fk = :codestudiante", array(':codestudiante' => $documento));
  
          if($rowCancelada != ''){
              $fechaCancelacion = $rowCancelada["fecha_ce"];
              $motivos = $rowCancelada["motivos"];
          }
        }

      }
      
      foreach ($table as $datarow => $data) {

        array_push($observaciones, array('codigo' => $data["codigo_oe"], 'novedad' => $data["novedad"], 'nombrepsicologo' => $data["nombrepsicologo"], 'fechahora' => $data["fechahora"] , 'nombreperfil' => $data["nombreperfil"]));
      }
      $json = json_encode(array('observaciones' => $observaciones, 'fechaCancelacion' => $fechaCancelacion, 'motivos' => $motivos));
    break;

    case 'saveObservacion':
      $insert = "INSERT INTO observaciones_entrevistas (novedad, codestudiante_fk, codpsicologo_fk, fecha_hora, codperiodo, codprograma) VALUES (:novedad, :codestudiante, :codpsicologo, :fechahora, :codperiodo, :codprograma)";
      $paramsInsert = array(':novedad' => $novedad, ':codestudiante' => $documento, ':codpsicologo' => $_SESSION["SAEP_usuario"], ':fechahora' => 'NOW()', ':codperiodo' => $codperiodo, ':codprograma' => $codprograma);
      
      if($_POST["snp"] == 'NO'){
        
        
        if($_SESSION['SAEP_codrol'] == 3){
          
          $asesoresObservacion = "SELECT oe.codpsicologo_fk, dp.correo_ins 
                                    FROM observaciones_entrevistas oe
                                    INNER JOIN datospersonales dp ON dp.identificacion = oe.codpsicologo_fk
                                    WHERE oe.codestudiante_fk = :doc
                                    AND dp.codperfil_fk = 4
                                    AND oe.codprograma = :codprograma
                                    AND oe.codperiodo = :codperiodo
                                    GROUP BY oe.codpsicologo_fk, dp.correo_ins ";
          $tableAsesores = table($asesoresObservacion, array(':doc' => $documento, ':codprograma' => $codprograma, ':codperiodo' => $codperiodo));

          if(count($tableAsesores) != 0){
            if($_SESSION['SAEP_psicof']){
              $nombrepsicologo = ucwords(strtolower(utf8_decode(replaceinMin($_SESSION['SAEP_nombre_usu'].' ( '.$_SESSION['SAEP_nombrepsicologoReem'].' )'))));
            }else{
              $nombrepsicologo = ucwords(strtolower(utf8_decode(replaceinMin($_SESSION['SAEP_nombre_usu']))));
            }
  
            $html="";
            $html.='<p style="text-align:justify">'.utf8_decode('Estimado asesor').'.</p>';
            $html.='<p style="text-align:justify">'.utf8_decode('A continuación encontrará novedades al estado de entrevista en la que usted realizó una observación:').'</p>';
      
            $html.='<table border="0">';
  
            $html.='<tr>';
            $html.='<td><strong>'.utf8_decode('Cédula del estudiante:').'</strong></td>';
            $html.='<td>'.$documento.'</td>';
            $html.='</tr>';
    
            $html.='<tr>';
            $html.='<td><strong>Nombre del estudiante: </strong></td>';
            $html.='<td>'.ucwords(strtolower(utf8_decode(replaceinMin($_POST["nombre"])))).'</td>';
            $html.='</tr>';
    
            $html.='<tr>';
            $html.='<td><strong>Programa del estudiante: </strong></td>';
            $html.='<td>'. ucwords(strtolower(utf8_decode($_POST["programa"]))).'</td>';
            $html.='</tr>';
    
            $html.='<tr>';
            $html.='<td><strong>Fecha de la entrevista: </strong></td>';
            $html.='<td>'.utf8_decode($_POST["fecha"]).'</td>';
            $html.='</tr>';
    
            $html.='<tr>';
            $html.='<td><strong>Hora de la entrevista:</strong></td>';
            $html.='<td>'.$_POST['horainicio'].'</td>';
            $html.='</tr>';
    
            $html.='<tr>';
            $html.='<td><strong>'.utf8_decode('Psicólogo(a) que registra la novedad').': </strong></td>';
            $html.='<td>'. $nombrepsicologo .'</td>';
            $html.='</tr>';
  
            $html.='<tr>';
            $html.='<td><strong>'.utf8_decode('Correo electrónico').': </strong></td>';
            $html.='<td>'. strtolower($_SESSION['SAEP_correoins']).'</td>';
            $html.='</tr>';
  
            $html.='<tr>';
            $html.='<td><strong>'.utf8_decode('Estado entrevista').': </strong></td>';
            $html.='<td><strong>'.strtoupper(strtolower($_POST['estado'])).'</strong></td>';
            $html.='</tr>';
            
            $html.='<tr>';
            $html.='<td><strong>Nuevos comentarios: </strong></td>';
            $html.='<td>'.utf8_decode($novedad).'</td>';
            $html.='</tr>';
            $html.='</table>';
      
            $html.=utf8_decode('<br><strong><i>"Este e-mail fue generado de manera automática. Por favor, no lo responda".</i></strong><br>');
            $html.='<br>Cordialmente,<br><br>';
            $html.='Bienestar Institucional<br>';
            $html.=utf8_decode('Corporación Universitaria Americana<br>');
            $html.='Tel. (5) 3851027 Ext. 443<br><br>';
            $html.=utf8_decode('Síguenos en Facebook, Twitter e Instagram:<br>');
            $html.='www.facebook.com/coruniamericana<br>';
            $html.='www.twitter.com/coruniamericana<br>';
            $html.='www.instagram.com/coruniamericana<br><br>';
            $html.='<img src="http://190.60.75.134:9090/psicologia/assets/images/acreditacion.png"/>';
          
            $mail->Subject = utf8_decode("Nueva observación de Psicólogo(a): ".$nombrepsicologo." - Entrevista: ".$documento);
            $mail->AltBody = "";
            $mail->MsgHTML($html);
            // $mail->AddAddress($emailpsicologo,"");
            foreach ($tableAsesores as $key => $value) {
              $mail->AddAddress($value['correo_ins'],"");
              // $mail->AddAddress("wilberparedes@gmail.com","");
            }
            // $mail->AddBCC("wparedes@coruniamericana.edu.co","");
            // $mail->AddBCC("hmanotas@coruniamericana.edu.co","");
            // $mail->AddAddress("wilberparedes@gmail.com","");
            // $mail->AddCC($_SESSION['SAEP_correoins'],"");
            // $mail->AddCC("wparedes@coruniamericana.edu.co","");
            $mail->IsHTML(true);
    
            if(query($insert, $paramsInsert)){
              if ($mail->Send()) {
                $json = json_encode(array("success"=>true));
              }else{
                $json=json_encode(array("success"=>false,"message"=> "Observación guardada exitosamente, pero ocurrió un error al enviar notificación. Error: ".$mail->ErrorInfo));
              }
            }else{
              $json = json_encode(array("success"=>false, "message" => "Error al guardar Observación"));
            }

          }else{
            if(query($insert, $paramsInsert)){
              $json = json_encode(array("success"=>true));
            }else{
              $json = json_encode(array("success"=>false, "message" => "Error al guardar Observación"));
            }
          }

        }else{
          if(query($insert, $paramsInsert)){
            $json = json_encode(array("success"=>true, 'aqui' => '??'));
          }else{
            $json = json_encode(array("success"=>false, "message" => "Error al guardar Observación"));
          }
        }
        
      }else{

        $sqlCorreo = "SELECT * FROM datospersonales WHERE identificacion = :codpsicologo";
        $sqlFan = "SELECT pp.*, dp.nombre FROM psicologo_to_psicologo pp INNER JOIN datospersonales dp ON dp.identificacion = pp.codpsicologo_fk WHERE pp.codpsicologo_fa = :codpsicologo";
        $rowFan = row($sqlFan, array(':codpsicologo' => $_POST["idpsicologo"]));
        $nombrepsicologo = '';
        if($rowFan == ''){
          $rowCorreo = row($sqlCorreo, array(':codpsicologo' => $_POST["idpsicologo"]));
          $nombrepsicologo = ucwords(strtolower(utf8_decode(replaceinMin($_POST["nombrepsico"]))));
        }else{
          $rowCorreo = row($sqlCorreo, array(':codpsicologo' => $rowFan["codpsicologo_fk"]));
          $nombrepsicologo = ucwords(strtolower(utf8_decode(replaceinMin($_POST["nombrepsico"].' ( '.$rowCorreo["nombre"].' )'))));
        }
        $emailpsicologo = $rowCorreo["correo_ins"];

        $html="";
        $html.='<p style="text-align:justify">'.utf8_decode('Estimado psicólogo').'.</p>';
        $html.='<p style="text-align:justify">'.utf8_decode('A continuación encontrará novedades al estado de entrevista del siguiente estudiante:').'</p>';
  
        $html.='<table border="0">';
        $html.='<tr>';
        $html.='<td><strong>'.utf8_decode('Psicológo asignado:').'</strong></td>';
        $html.='<td>'.$nombrepsicologo.'</td>';
        $html.='</tr>';

        $html.='<tr>';
        $html.='<td><strong>'.utf8_decode('Cédula del estudiante:').'</strong></td>';
        $html.='<td>'.$documento.'</td>';
        $html.='</tr>';
  
        $html.='<tr>';
        $html.='<td><strong>Nombre del estudiante: </strong></td>';
        $html.='<td>'.ucwords(strtolower(utf8_decode(replaceinMin($_POST["nombre"])))).'</td>';
        $html.='</tr>';
  
        $html.='<tr>';
        $html.='<td><strong>Programa del estudiante: </strong></td>';
        $html.='<td>'. ucwords(strtolower(utf8_decode($_POST["programa"]))).'</td>';
        $html.='</tr>';
  
        $html.='<tr>';
        $html.='<td><strong>Fecha de la entrevista: </strong></td>';
        $html.='<td>'.utf8_decode($_POST["fecha"]).'</td>';
        $html.='</tr>';
  
        $html.='<tr>';
        $html.='<td><strong>Hora de la entrevista:</strong></td>';
        $html.='<td>'.$_POST['horainicio'].'</td>';
        $html.='</tr>';
  
        $html.='<tr>';
        $html.='<td><strong>Usuario que registra la novedad: </strong></td>';
        $html.='<td>'. ucwords(strtolower(utf8_decode(replaceinMin($_SESSION['SAEP_nombre_usu'])))).'</td>';
        $html.='</tr>';

        $html.='<tr>';
        $html.='<td><strong>'.utf8_decode('Correo electrónico').': </strong></td>';
        $html.='<td>'. strtolower($_SESSION['SAEP_correoins']).'</td>';
        $html.='</tr>';
        
        $html.='<tr>';
        $html.='<td><strong>Nuevos comentarios: </strong></td>';
        $html.='<td>'.utf8_decode($novedad).'</td>';
        $html.='</tr>';
        $html.='</table>';
  
        
        $html.=utf8_decode('<br><strong><i>"Este e-mail fue generado de manera automática. Por favor, no lo responda".</i></strong><br>');
        $html.='<br>Cordialmente,<br><br>';
        $html.='Bienestar Institucional<br>';
        $html.=utf8_decode('Corporación Universitaria Americana<br>');
        $html.='Tel. (5) 3851027 Ext. 443<br><br>';
        $html.=utf8_decode('Síguenos en Facebook, Twitter e Instagram:<br>');
        $html.='www.facebook.com/coruniamericana<br>';
        $html.='www.twitter.com/coruniamericana<br>';
        $html.='www.instagram.com/coruniamericana<br><br>';
        $html.='<img src="http://190.60.75.134:9090/psicologia/assets/images/acreditacion.png"/>';
        
        $mail->Subject = utf8_decode("Nueva observación de ".$_SESSION['SAEP_nombre_perfil'].": ".utf8_decode(ucwords(strtolower($_SESSION['SAEP_nombre_usu'])))." - Entrevista: ".$documento);
        $mail->AltBody = "";
        $mail->MsgHTML($html);
        $mail->AddAddress($emailpsicologo,"");
        // $mail->AddAddress("wilberparedes@gmail.com","");
        // $mail->AddBCC("wparedes@coruniamericana.edu.co","");
        // $mail->AddBCC("hmanotas@coruniamericana.edu.co","");
        // $mail->AddCC($_SESSION['SAEP_correoins'],"");
        // $mail->AddCC("wparedes@coruniamericana.edu.co","");
        $mail->IsHTML(true);
  
        if ($mail->Send()) {
          if(query($insert, $paramsInsert)){
            $json = json_encode(array("success"=>true, 'holi' => 'aja'));
          }else{
            $json = json_encode(array("success"=>false, "message" => "Error al guardar Observación"));
          }
        }else{
          $json=json_encode(array("success"=>false,"message"=>$mail->ErrorInfo));
        }
      }
      
    break;

    case 'detalleEntrevista':
      $fhour = date("Y-m-d H:i:s"); 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/detalle_entrevista?periodos=$documento,$codperiodo_");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      if(count($resultado1) >= 1){
        // print_r($resultado1);
        $bkColor = "";
        $fechaCancelacion = "";
        $motivos = "";
        if($_SESSION['SAEP_codperfil'] == 4){
          $snp = 'SI';
        }else{
          $snp = 'NO';
        }
        $tableEvidencePruePsico = [];
        $htmlEvidencePruePsico = "";
        $params = array(':codestudiante' => $resultado1[0][16]);
        $rowObservaciones = row("SELECT codigo_oe FROM observaciones_entrevistas WHERE codestudiante_fk = :codestudiante and codperiodo = '$codperiodo_'", $params);
        $observaciones = ($rowObservaciones != null ? 'SÍ' : 'NO');
        $fechaejecucion = "";
        $row = row("SELECT codigo_entrevista, to_char(fecha_entrevista, 'YYYY-MM-DD HH12:MI:SS A.M.') as fecha_entrevista, estado, codprograma, nombre_programa
                    FROM entrevistas
                    WHERE codestudiante_fk = :codestudiante and codperiodo = '$codperiodo_'", $params);
        if($row != null){
          if($row["estado"] == 1){
            $bkColor = '#3ace43';
            $aas = 1;
            $estado = 'Gestionada';
            $fechaejecucion = $row["fecha_entrevista"];
            $estadonotificado = 1;
            $tableEvidencePruePsico = table("SELECT path as urlevidence, codpruebapsico_fk as codpruebapsico, nombre_ppt as nombrepruebapsico
                                              FROM evidencia_pruebapsico 
                                              INNER JOIN pruebas_psicotecnicas AS ppt ON ppt.codigo_ppt = codpruebapsico_fk  
                                              WHERE codentrevista_fk = :cpp AND estado_epp = 'on'", array(':cpp' => $row["codigo_entrevista"]));
            $htmlEvidencePruePsico = "";
            foreach ($tableEvidencePruePsico as $key => $value) {
              $htmlEvidencePruePsico .= '<a href="'.urlPHP('Evidence/'.$value['urlevidence']).'" target="_blank" class="btn btn-rounded btn-outline-danger" style="float: left;margin-right: 5px; margin-bottom: 5px;"><i class="fa fa-file-pdf-o"></i> '.$value['nombrepruebapsico'].'</a>';
            }

          }else{
            $row2 = row("SELECT codigo_en, estado 
                    FROM estudiante_notificado
                    WHERE codestudiante_fk = :codestudiante and codperiodo = '$codperiodo_'", $params);
            $fh = $resultado1[0][10].' '.conversorSegundosHoras(intval($resultado1[0][20]));
            $estadonotificado =  ($row2 == null ? 0 : $row2["estado"]);
            $bkColor = '#f45959';
            $estado = 'Vencida';
            $aas = 0;
          }
        }else{
          $row2 = row("SELECT codigo_en, estado 
                    FROM estudiante_notificado
                    WHERE codestudiante_fk = :codestudiante and codperiodo = '$codperiodo_'", $params);
          $fh = $resultado1[0][10].' '.conversorSegundosHoras(intval($resultado1[0][20]));
          $estadonotificado =  ($row2 == null ? 0 : $row2["estado"]);

          $rowCancelada = row("SELECT fecha_ce, motivos as codmotivo, mc.nombre_mc as motivos
          FROM entrevistas_canceladas ec
          INNER JOIN motivos_cancelacion mc ON mc.codigo_mc = ec.motivos WHERE codestudiante_fk = :codestudiante and codperiodo = '$codperiodo_'", array(':codestudiante' => $resultado1[0][16]));

          if($rowCancelada == ''){
            if($fhour > $fh){
              $bkColor = '#f45959';
              $estado = 'Vencida';
              $aas = 3;
            }else{
              $bkColor = '#ffac64';
              $estado = 'Pendiente';
              $aas = 2;
            }
          }else{
            $fechaCancelacion = $rowCancelada["fecha_ce"];
            $borrador = 'NO'; 
            $bkColor = '#868E96';
            $estado = 'Cancelada';
            $motivos = $rowCancelada["motivos"];
            $aas = 4;
          }
        }
        
        
          $json = json_encode( 
            array(
              'success' => true,
              'codperiodo' => $resultado1[0][0],
              'id' => $resultado1[0][16],
              'start' => $resultado1[0][10] . ' ' . conversorSegundosHoras(intval($resultado1[0][20])),
              'end' => $resultado1[0][10] . ' ' . conversorSegundosHoras(intval($resultado1[0][21])),
              'title' => formatID($resultado1[0][17]).': '.$resultado1[0][16],
              'backgroundColor' => $bkColor,
              'borderColor' => $bkColor,
              'stateEvents' => 'Estado: '.$estado,
              'estado' => $estado,
              'aas' => $aas,
              'fechagestion' => $fechaejecucion,
              'horainit' => $resultado1[0][11],
              'horalast' => $resultado1[0][12],
              'seccional' => ucwords(strtolower($resultado1[0][15])),
              'sede' => ucwords(strtolower($resultado1[0][15])),
              'codprograma' => ($estado == 'Gestionada' ? $row["codprograma"] : $resultado1[0][1]),
              'programa' => ($estado == 'Gestionada' ? ucwords(strtolower($row["nombre_programa"])) : ucwords(strtolower($resultado1[0][2]))),
              'idestudiante' => $resultado1[0][16],
              'nombreestudiante' => replaceinMin(ucwords(strtolower($resultado1[0][18]))),
              'emailestudiante' => $resultado1[0][22],
              'telefonoestudiante' => $resultado1[0][23],
              'idpsicologo' => $resultado1[0][6],
              'nombrepsicologo' => replaceinMin(ucwords(strtolower($resultado1[0][7]))),
              'estNoti' => ($estadonotificado == 0 ? 'No' : 'Sí'),
              'snp' => $snp,
              'fechacancelacion' => $fechaCancelacion,
              'motivos' => $motivos,
              'evidenciasPruebaPsico' => $htmlEvidencePruePsico
            )
          );

      }else{

        $bkColor = "";
        $fechaCancelacion = "";
        $motivos = "";
        $snp = 'NO';

        $params = array(':codestudiante' => $documento);
        $rowObservaciones = row("SELECT codigo_oe FROM observaciones_entrevistas WHERE codestudiante_fk = :codestudiante and codperiodo = '$codperiodo_'", $params);
        $observaciones = ($rowObservaciones != null ? 'SÍ' : 'NO');
        $fechaejecucion = "";
        $row = row("SELECT codigo_entrevista, e.codestudiante_fk as idestudiante, e.nombre_completo, e.telefono, e.otrotelefono, e.fijo, e.email_per, e.codprograma, e.nombre_programa as programa, dp.identificacion as idpsicologo, dp.nombre as nombrepsicologo, to_char(fecha_entrevista, 'YYYY-MM-DD HH12:MI:SS A.M.') as fecha_entrevista, to_char(fecha_entrevista, 'YYYY-MM-DD') as fecha, e.estado 
                    FROM entrevistas as e
                    INNER JOIN datospersonales dp ON dp.identificacion = e.codpsicologo_fk
                    WHERE codestudiante_fk = :codestudiante and codperiodo = '$codperiodo_'", $params);
        if($row != null){//si lo encontró en la base de datos es porque ya fue gestionada esta entrevista

          if($row["estado"] == 1){
            $bkColor = '#3ace43';
            $aas = 1;
            $estado = 'Gestionada';
            $fechaejecucion = $row["fecha_entrevista"];
            $estadonotificado = 1;
          }

          $json = json_encode( 
            array(
              'success' => true,
              'codperiodo' => $codperiodo_,
              'id' => $row['idestudiante'],
              'start' => null,
              'end' => null,
              'fecha' => $row['fecha'],
              'backgroundColor' => $bkColor,
              'borderColor' => $bkColor,
              'stateEvents' => 'Estado: '.$estado,
              'estado' => $estado,
              'aas' => $aas,
              'fechagestion' => $fechaejecucion,
              'horainit' => null,
              'horalast' => null,
              'seccional' => null,
              'sede' => null,
              'codprograma' => $row['codprograma'],
              'programa' => ucwords(strtolower($row['programa'])),
              'idestudiante' => $row['idestudiante'],
              'nombreestudiante' => replaceinMin(ucwords(strtolower($row['nombre_completo']))),
              'emailestudiante' => $row['email_per'],
              'telefonoestudiante' => $row['telefono'].' - '.$row['otrotelefono'].' - '.$row['fijo'],
              'idpsicologo' => $row['idpsicologo'],
              'nombrepsicologo' => replaceinMin(ucwords(strtolower($row['nombrepsicologo']))),
              'estNoti' => ($estadonotificado == 0 ? 'No' : 'Sí'),
              'snp' => $snp,
              'fechacancelacion' => $fechaCancelacion,
              'motivos' => $motivos
            )
          );




        }else{
          $json = json_encode(array('success' => false, 'message' => 'La identificación no fue encontrada bajo los parametros de esta consulta'));

        }
        
        
          


      }
    break;

    case 'sLoadPruebasPsicotecnicas':
      $sql = "SELECT codigo_ppt as cod, nombre_ppt as nombre, estado_ppt FROM pruebas_psicotecnicas WHERE estado_ppt = 'on'";
      $table = table($sql);
      $json = json_encode($table);
    break;

    case 'cancelarEntrevista':
      $sqlCancelar = "INSERT INTO entrevistas_canceladas (codestudiante_fk, codpsicologo_fk, fecha_ce, codprograma, nombre_programa, codperiodo, motivos) VALUES (:codestudiante, :codpsicologo, :fecha, :codprograma, :nombreprograma, :codperiodo, :motivos);";
      $paramsCancelar = array(':codestudiante' => $documento, ':codpsicologo' => $_SESSION["SAEP_codigo_usu"], ':fecha' => 'NOW()', ':codprograma' => $_POST["codprograma"], ':nombreprograma' => $_POST["nombreprograma"], ':codperiodo' => $codperiodo, ':motivos' => $_POST["motivoscancelacion"]);

      if(query($sqlCancelar, $paramsCancelar)){
        $json = json_encode(array('success' => true));
      }else{
        $json = json_encode(array('success' => false, 'message' => 'Error al intentar cancelar la entrevista, contacte al administrador.'));
      }

    break;
  /************************  FIN procesos para misentrevistas.php ****************************/



  /************************  procesos departamento.php code ****************************/
    case 'loadDepartamentos':

      $sql = "SELECT * FROM departamentos 
              ORDER BY codigo_departamento ASC";

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estadoRow = $data["estado_departamento"];
        $estado = ($estadoRow == 'on') ? 'Habilitado' : 'Inhabilitado ';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar('.$data["codigo_departamento"].', \''.$data["nombre_departamento"].'\')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Eliminar" data-rel="tooltip" title="Eliminar" onClick="feditEstado('.$data["codigo_departamento"].',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado('.$data["codigo_departamento"].', \'on\')""><i class="fa fa-undo"></i></a>';
        $options = $edit.$delete;
          
        if ($estadoRow == 'on') $options = $edit.$delete;
        else $options = $restore;

        array_push($createtable['data'], array($i, $data["nombre_departamento"],  $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);

    break;

    case 'editItemDepartamento':

      $update = "UPDATE departamentos SET nombre_departamento = :nombre WHERE codigo_departamento = :codigo";
      $params = array(':nombre' => $nombredepartamento, ':codigo' => $coddepartamento);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'editEstadoDepartamento':
    
      $update = "UPDATE departamentos SET estado_departamento = :estado WHERE codigo_departamento = :codigo";
      $params = array(':codigo' => $coddepartamento, ':estado' => $estado);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'insertItemDepartamento':

      $insert = "INSERT INTO departamentos (nombre_departamento, estado_departamento) VALUES (:nombredepartamento, :estado)";
      $paramsInsert = array(
                            ':nombredepartamento' => $nombredepartamento,
                            ':estado' => $estado
                          );
      if(query($insert, $paramsInsert)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item de departamento"));
      }

    break;
  /************************  FIN procesos departamento.php code ****************************/


  
  /************************  procesos municipio.php code ****************************/
    case 'sloadDepartamentos':

      $sql = "SELECT codigo_departamento as cod, nombre_departamento as nombre FROM departamentos WHERE estado_departamento = 'on' ORDER BY nombre_departamento ASC";
      $table = table($sql);
      $json = json_encode($table);

    break;

    case 'loadMunicipios':

      if(isset($_GET["coddepartamento"])){
        $coddepartamento = $_GET["coddepartamento"];
      }else{
        $coddepartamento = '';
      }

      if($coddepartamento != ''){
        $where = " WHERE coddepartamento_fk = ".$coddepartamento;
      }else{
        $where = "";
      }

      $sql = "SELECT m.*, d.nombre_departamento FROM municipios m
              INNER JOIN departamentos d ON d.codigo_departamento = m.coddepartamento_fk
              $where ORDER BY codigo_municipio ASC";

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estadoRow = $data["estado_municipio"];
        $estado = ($estadoRow == 'on') ? 'Habilitado' : 'Inhabilitado';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar('.$data["codigo_municipio"].','.$data["coddepartamento_fk"].', \''.$data["nombre_municipio"].'\')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Eliminar" data-rel="tooltip" title="Eliminar" onClick="feditEstado('.$data["codigo_municipio"].',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado('.$data["codigo_municipio"].', \'on\')""><i class="fa fa-undo"></i></a>';
        $options = $edit.$delete;
          
        if ($estadoRow == 'on') $options = $edit.$delete;
        else $options = $restore;

        array_push($createtable['data'], array($i, $data["nombre_departamento"], $data["nombre_municipio"],  $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);

    break;

    case 'editItemMunicipio':
      $update = "UPDATE municipios SET nombre_municipio = :nombre, coddepartamento_fk = :coddepartamento WHERE codigo_municipio = :codigo";
      $params = array(':nombre' => $nombre_municipio, ':coddepartamento' => $coddepartamento, ':codigo' => $codmunicipio);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }
    break;

    case 'editEstadoMunicipio':
      $update = "UPDATE municipios SET estado_municipio = :estado WHERE codigo_municipio = :codigo";
      $params = array(':codigo' => $codmunicipio, ':estado' => $estado);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }
    break;

    case 'insertItemMunicipio':

      $sql = "SELECT * FROM municipios WHERE nombre_municipio = :nombremunicipio AND coddepartamento_fk = :coddepartamento";
      $row = row($sql, array(':nombremunicipio' => $nombre_municipio, ':coddepartamento' => $coddepartamento));

      if($row == ""){
        $insert = "INSERT INTO municipios (nombre_municipio, coddepartamento_fk, estado_municipio) VALUES (:nombremunicipio, :coddepartamento, :estado)";
        $paramsInsert = array(
                              ':nombremunicipio' => $nombre_municipio,
                              ':coddepartamento' => $coddepartamento,
                              ':estado' => $estado
                            );
        if(query($insert, $paramsInsert)){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item de departamento"));
        }
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "El Municipio ya existe"));
      }
    break; 
    
  /************************ FIN procesos gestionarperfiles.php code ****************************/

  /************************  procesos colegios.php code ****************************/
    case 'sloadMunicipios':
      if(isset($_GET["coddepartamento"])){
        $coddepartamento = $_GET["coddepartamento"];
      }
      $sql = "SELECT m.codigo_municipio as cod, m.nombre_municipio as nombre FROM municipios m
              INNER JOIN departamentos d ON d.codigo_departamento = m.coddepartamento_fk
              WHERE coddepartamento_fk = :coddepartamento ORDER BY nombre_municipio ASC";
      $table = table($sql, array(':coddepartamento' => $coddepartamento));
      $json = json_encode($table);
    break;

    case 'loadColegios':
      $where = "";
      if(isset($_GET["codmunicipio"])){
        $codmunicipio = $_GET["codmunicipio"];
      }else{
        $codmunicipio = '';
      }

      if($codmunicipio != '' ){
        $where = " WHERE codmunicipio_fk = ".$codmunicipio;
      }else{
        $where = "";
      }

      $sql = "SELECT d.nombre_departamento,m.nombre_municipio, m.coddepartamento_fk, c.*, ppf.nombre_ppf
                FROM colegios c
                INNER JOIN propiedad_planta_fisica ppf ON ppf.codigo_ppf = c.codpropiedadplantafisica_fk
                INNER JOIN municipios m ON m.codigo_municipio = c.codmunicipio_fk
                INNER JOIN departamentos d ON d.codigo_departamento = m.coddepartamento_fk $where
                ORDER BY codigo_colegio ASC";

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estadoRow = $data["estado_colegio"];

        $estado = ($estadoRow == 'on') ? 'Habilitado' : 'Inhabilitado';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar('.$data["coddepartamento_fk"].','.$data["codmunicipio_fk"].', '.$data["codigo_colegio"].', \''.$data["nombre_colegio"].'\', '.$data["codpropiedadplantafisica_fk"].')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Eliminar" data-rel="tooltip" title="Eliminar" onClick="feditEstado('.$data["codigo_colegio"].',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado('.$data["codigo_colegio"].', \'on\')""><i class="fa fa-undo"></i></a>';
        $options = $edit.$delete;
          
        if ($estadoRow == 'on') $options = $edit.$delete;
        else $options = $restore;

        array_push($createtable['data'], array($i, $data["nombre_departamento"], $data["nombre_municipio"], $data["nombre_colegio"],  $data["nombre_ppf"], $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);
    break;

    case 'sloadPropiedadPlantaFisica':
      $sql = "SELECT codigo_ppf as cod, nombre_ppf as nombre, estado_ppf FROM propiedad_planta_fisica WHERE estado_ppf = 'on'";
      $table = table($sql);
      $json = json_encode($table);
    break;

    case 'insertItemColegio':

      $sqlRow = "SELECT * FROM colegios WHERE nombre_colegio = :nombrecolegio AND codmunicipio_fk = :codmunicipio";
      $row = row($sqlRow, array(':nombrecolegio' => $nombrecolegio, ':codmunicipio' => $codmunicipio));

      if($row == ''){
        $sql = "INSERT INTO colegios (codmunicipio_fk, nombre_colegio, codpropiedadplantafisica_fk, estado_colegio) VALUES (:codmunicipio, :nombrecolegio, :codpropiedad, :estado)";
        $params = array(':codmunicipio' => $codmunicipio, ':nombrecolegio' => $nombrecolegio, ':codpropiedad' => $codpropiedad, ':estado' => 'on');
        if(query($sql, $params)){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar intem"));
        }
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "El Colegio ya existe en este municipio"));
      }

    break;

    case 'editItemColegio':

      $update = "UPDATE colegios SET nombre_colegio = :nombre, codmunicipio_fk = :codmunicipio, codpropiedadplantafisica_fk = :codpropiedad WHERE codigo_colegio = :codigo";
      $params = array(':nombre' => $nombrecolegio, ':codmunicipio' => $codmunicipio, ':codpropiedad' => $codpropiedad, ':codigo' => $codcolegio);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'editEstadoColegio':

      $update = "UPDATE colegios SET estado_colegio = :estado WHERE codigo_colegio = :codigo";
      $params = array(':codigo' => $codcolegio, ':estado' => $estado);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'insertMasivoColegios':

      $res1 = '';
      $resultado = "";
      $contador = 0;
      if($_FILES['fexcel']['tmp_name']!=""){
        $namefile = $_FILES["fexcel"]["name"];
        $extension = pathinfo($namefile, PATHINFO_EXTENSION);
        $allowed_extension = array("XLSX", "XLS","xls", "xlsx", "csv");

        if(in_array($extension, $allowed_extension)){
          $file = $_FILES["fexcel"]["tmp_name"];
          $objPHPExcel = PHPExcel_IOFactory::load($file);

          foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
            $highestRow = $worksheet->getHighestRow();

            for($row=1; $row<=$highestRow; $row++){

              $nombremunicipio = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
              $nombrecolegio = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
              $propiedadplanta = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

              $sqlRowMunicipio = "SELECT codigo_municipio FROM municipios WHERE nombre_municipio = :nombremunicipio AND coddepartamento_fk = :coddepartamento";
              $rowMunicipio = row($sqlRowMunicipio, array(':nombremunicipio' => $nombremunicipio, ':coddepartamento' => $coddepartamento));

              if($rowMunicipio != ''){

                $sqlRow = "SELECT * FROM colegios WHERE nombre_colegio = :nombrecolegio AND codmunicipio_fk = :codmunicipio";
                $rowColegio = row($sqlRow, array(':nombrecolegio' => $nombrecolegio, ':codmunicipio' => $rowMunicipio["codigo_municipio"]));

                if($rowColegio == ''){

                  $sqlRowPropiedadPlanta = "SELECT codigo_ppf FROM propiedad_planta_fisica WHERE nombre_ppf = :nombrepropiedadplanta";
                  $rowPropiedadPlanta = row($sqlRowPropiedadPlanta, array(':nombrepropiedadplanta' => $propiedadplanta));

                  if($rowPropiedadPlanta != ''){

                    $sql = "INSERT INTO colegios (codmunicipio_fk, nombre_colegio, codpropiedadplantafisica_fk, estado_colegio) VALUES (:codmunicipio, :nombrecolegio, :codpropiedad, :estado)";
                    $params = array(':codmunicipio' => $rowMunicipio["codigo_municipio"], ':nombrecolegio' => $nombrecolegio, ':codpropiedad' => $rowPropiedadPlanta["codigo_ppf"], ':estado' => 'on');
                    
                    if(query($sql, $params))
                    {
                      $contador++;
                    }

                  }else{
                    $resultado .= '<li>La Propiedad Planta Física <b>'.$propiedadplanta.'</b> no existe en la base de datos</li>';  
                  }

                }else{
                  $resultado .= '<li> El Colegio <b>'.$nombrecolegio.'</b> ya existe en este Municipio <b>'.$nombremunicipio.'</b></li>';
                }

                
              }else{
                $resultado .= '<li> El municipio <b>'.$nombremunicipio.'</b> no existe en el Departamento <b>'.$nombredepartamento.'</b></li>';
              }

            }
          }
          if($resultado != ''){
            $resultado = '<ul>'.$resultado.'</ul>';
          }
          $json = json_encode(array("success" =>true,"resultado"=>$resultado, "total"=>$contador)); 
        }else{
          $json = json_encode(array("success" =>false,"message"=>"Solo se admiten los siguientes formatos: xls, xlsx, csv"));
        }
      }else{
        $json = json_encode(array("success" =>false,"message"=>"Campo vacio"));
      }

    break;

  /************************  FIN procesos colegios.php code ****************************/


  /************************  procesos para requerimientovirtual.php ****************************/
    
    case 'loadRequerimientos':

      $sql = "SELECT * FROM requerimiento_virtual 
              ORDER BY codigo_rv ASC";

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estadoRow = $data["estado_rc"];

        $estado = ($estadoRow == 'on') ? 'Habilitado' : 'Inhabilitado ';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar('.$data["codigo_rv"].', \''.$data["nombre_rc"].'\')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Eliminar" data-rel="tooltip" title="Eliminar" onClick="feditEstado('.$data["codigo_rv"].',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado('.$data["codigo_rv"].', \'on\')""><i class="fa fa-undo"></i></a>';
        $options = $edit.$delete;
          
        $options = ($estadoRow == 'on') ? $options = $edit.$delete : $options = $restore;

        array_push($createtable['data'], array($i, $data["nombre_rc"],  $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);

    break;

    case 'sLoadRequerimientos':

      $sql = "SELECT * FROM requerimiento_virtual 
              WHERE estado_rc = 'on'
              ORDER BY codigo_rv ASC";
      $table = table($sql);
      $json = json_encode($table);

    break;

    case 'editItemRequerimiento':

      $update = "UPDATE requerimiento_virtual SET nombre_rc = :nombre WHERE codigo_rv = :codigo";
      $params = array(':nombre' => $nombrerequerimiento, ':codigo' => $codrequerimiento);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'editEstadoRequerimiento':

      $update = "UPDATE requerimiento_virtual SET estado_rc = :estado WHERE codigo_rv = :codigo";
      $params = array(':codigo' => $codrequerimiento, ':estado' => $estado);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'insertItemRequerimiento':

      $insert = "INSERT INTO requerimiento_virtual (nombre_rc, estado_rc) VALUES (:nombrerequerimiento, :estado)";
      $paramsInsert = array(
                            ':nombrerequerimiento' => $nombrerequerimiento,
                            ':estado' => $estado
                          );
      if(query($insert, $paramsInsert)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item de Requerimiento modalidad virtual"));
      }

    break;  

  /************************ fin requerimientovirtual.php   ****************************/



  /************************  procesos para planacomapamiento.php ****************************/
    case 'loadPlan':

      $sql = "SELECT * FROM plan_acompanamiento 
              ORDER BY codigo ASC";

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estadoRow = $data["estado"];
        $tipo = ($data["tipo"] == 1) ? 'Acádemico' : 'Psicológico';
        $estado = ($estadoRow == 'on') ? 'Habilitado' : 'Inhabilitado';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar(\''.$data["codigo"].'\', \''.$data["nombre"].'\','.$data["tipo"].')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Deshabilitar" data-rel="tooltip" title="Deshabilitar" onClick="feditEstado(\''.$data["codigo"].'\',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado(\''.$data["codigo"].'\', \'on\')""><i class="fa fa-undo"></i></a>';
          
        if ($estadoRow == 'on') $options = $edit.$delete;
        else $options = $restore;

        array_push($createtable['data'], array($data["codigo"], $data["nombre"],  $tipo, $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);

    break;

    case 'editItemPlan':

      $sql = "SELECT * FROM plan_acompanamiento 
                WHERE nombre = :nombre" ;
      $row = row($sql, array(':nombre' => $nombreplan));

      $sql1 = "SELECT * FROM plan_acompanamiento 
                WHERE codigo = :codigo" ;
      $row1 = row($sql1, array(':codigo' => $codplan));

      if($row1["nombre"] == $nombreplan){
        $update = "UPDATE plan_acompanamiento SET nombre = :nombre, tipo = :tipo WHERE codigo = :codigo";
        $params = array(':nombre' => $nombreplan, ':tipo' => $tipoplan, ':codigo' => $codplan);

        if(query($update, $params)){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
        }
      }else{
        if($row != ''){
          $json = json_encode(array("success"=>false,"mensaje" => "YA EXISTE un Plan de Acompañamiento con este NOMBRE!"));
        }else{
          $update = "UPDATE plan_acompanamiento SET nombre = :nombre, tipo = :tipo WHERE codigo = :codigo";
          $params = array(':nombre' => $nombreplan, ':tipo' => $tipoplan, ':codigo' => $codplan);
    
          if(query($update, $params)){
            $json = json_encode(array("success"=>true));
          }else{
            $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
          }
        }
      }

    break;

    case 'editEstadoPlan':
    
      $update = "UPDATE plan_acompanamiento SET estado = :estado WHERE codigo = :codigo";
      $params = array(':codigo' => $codplan, ':estado' => $estado);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'insertItemPlan':


      $sql = "SELECT * FROM plan_acompanamiento 
                WHERE (codigo = :codigo OR nombre = :nombre)" ;
      $row = row($sql, array(':codigo' => $codplan, ':nombre' => $nombreplan));

      if($row == ''){
        $insert = "INSERT INTO plan_acompanamiento (codigo, nombre, tipo) VALUES (:codplan, :nombreplan, :tipo)";
        $paramsInsert = array(
                              ':codplan' => $codplan,
                              ':nombreplan' => $nombreplan,
                              ':tipo' => $tipoplan
                            );
        if(query($insert, $paramsInsert)){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item de Plan de Acompañamiento"));
        }
      }else{
        if($codplan == $row["codigo"]){
          $json = json_encode(array("success"=>false,"mensaje" => "El Código de Plan de Acompañamiento YA EXISTE!"));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "YA EXISTE un Plan de Acompañamiento con este NOMBRE!"));
        }
      }

    break; 
  /************************ fin planacomapamiento.php   ************************************/ 


  /************************  procesos para aspectos.php ****************************/
    case 'loadAspectosTable':

      $sql = "SELECT * FROM aspectos_evaluacion 
              ORDER BY codigo_ae ASC";

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estadoRow = $data["estado_ae"];
        $estado = ($estadoRow == 'on') ? 'Habilitado' : 'Inhabilitado ';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar('.$data["codigo_ae"].', \''.$data["nombre_ae"].'\')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Eliminar" data-rel="tooltip" title="Eliminar" onClick="feditEstado('.$data["codigo_ae"].',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado('.$data["codigo_ae"].', \'on\')""><i class="fa fa-undo"></i></a>';
        $options = $edit.$delete;
          
        if ($estadoRow == 'on') $options = $edit.$delete;
        else $options = $restore;

        array_push($createtable['data'], array($i, $data["nombre_ae"],  $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);

    break;

    case 'editItemAspectos':

      $update = "UPDATE aspectos_evaluacion SET nombre_ae = :nombre WHERE codigo_ae = :codigo";
      $params = array(':nombre' => $nombreaspecto, ':codigo' => $codaspecto);

      if(query($update, $params)){
        $json = json_encode(array("success" => true));
      }else{
        $json = json_encode(array("success" => false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'editEstadoAspectos':
    
      $update = "UPDATE aspectos_evaluacion SET estado_ae = :estado WHERE codigo_ae = :codigo";
      $params = array(':codigo' => $codaspecto, ':estado' => $estado);

      if(query($update, $params)){
        $json = json_encode(array("success" => true));
      }else{
        $json = json_encode(array("success" => false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'insertItemAspectos':

      $insert = "INSERT INTO aspectos_evaluacion (nombre_ae, estado_ae) VALUES (:nombre, :estado)";
      $paramsInsert = array(
                            ':nombre' => $nombreaspecto,
                            ':estado' => $estado
                          );
      if(query($insert, $paramsInsert)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item"));
      }

    break;  

  /************************ fin aspectos.php   ************************************/ 


  /************************  procesos para conceptos.php ****************************/
    case 'sloadAspectos':

      $sql = "SELECT codigo_ae as cod, nombre_ae as nombre FROM aspectos_evaluacion WHERE estado_ae = 'on' ORDER BY nombre_ae ASC";
      $table = table($sql);
      $json = json_encode($table);

    break;

    case 'loadConceptosTable':

      if(isset($_GET["codaspecto"])){
        $codaspecto = $_GET["codaspecto"];
      }else{
        $codaspecto = '';
      }

      if($codaspecto != ''){
        $where = " WHERE codaspectos_fk = ".$codaspecto;
      }else{
        $where = "";
      }

      $sql = "SELECT ce.*, ae.nombre_ae FROM concepto_evaluar ce
              INNER JOIN aspectos_evaluacion ae ON ae.codigo_ae = ce.codaspectos_fk
              $where ORDER BY codigo_ce ASC";

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estadoRow = $data["estado_ce"];
        $estado = ($estadoRow == 'on') ? 'Habilitado' : 'Inhabilitado';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar('.$data["codigo_ce"].','.$data["codaspectos_fk"].', \''.$data["nombre_ce"].'\', \''.base64_encode($data["sugerencias"]).'\')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Eliminar" data-rel="tooltip" title="Eliminar" onClick="feditEstado('.$data["codigo_ce"].',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado('.$data["codigo_ce"].', \'on\')""><i class="fa fa-undo"></i></a>';
        $options = $edit.$delete;
          
        if ($estadoRow == 'on') $options = $edit.$delete;
        else $options = $restore;

        $sugerencia =  ( $data["sugerencias"] == NULL ? 'Ninguna' : $data["sugerencias"]);

        array_push($createtable['data'], array($i, $data["nombre_ae"], $data["nombre_ce"], $sugerencia,  $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);

    break;

    case 'deco':
      $json = json_encode(array('text' => base64_decode($_POST["text"])));
    break;


    case 'editItemConcepto':
      $update = "UPDATE concepto_evaluar SET nombre_ce = :nombre, sugerencias = :sugerencias, codaspectos_fk = :codaspecto WHERE codigo_ce = :codigo";
      $params = array(':nombre' => $nombreconcepto, ':sugerencias' => $sugerencias,':codaspecto' => $codaspecto, ':codigo' => $codconcepto);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }
    break;

    case 'editEstadoConcepto':
      $update = "UPDATE concepto_evaluar SET estado_ce = :estado WHERE codigo_ce = :codigo";
      $params = array(':codigo' => $codaspecto, ':estado' => $estado);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }
    break;


    case 'insertItemConcepto':

      $sql = "SELECT * FROM concepto_evaluar WHERE nombre_ce = :nombreconcepto AND codaspectos_fk = :codaspecto";
      $row = row($sql, array(':nombreconcepto' => $nombreconcepto, ':codaspecto' => $codaspecto));

      if($row == ""){
        $insert = "INSERT INTO concepto_evaluar (nombre_ce, codaspectos_fk, estado_ce) VALUES (:nombreconcepto, :codaspecto, :estado)";
        $paramsInsert = array(
                              ':nombreconcepto' => $nombreconcepto,
                              ':codaspecto' => $codaspecto,
                              ':estado' => $estado
                            );
        if(query($insert, $paramsInsert)){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "Error al insertar Item"));
        }
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "El Concepto a evaluar ya existe"));
      }
    break; 

  /************************ fin conceptos.php   *************************************/ 

  /************************  procesos para graficas.php ****************************/
    case 'loadDonut':

      $year = $_POST['year'];
      $month = $_POST['month'];
      $start = _data_first_month_day($year, $month);
      $end  = _data_last_month_day($year, $month);

      $fhour = date("Y-m-d H:i:s"); 
      $events = array();
      $mes = date("n");

      $resultado1 = array();
      foreach ($periodos as $key => $value) {
        $arrayperiod = returnDataPeriod($value, $start, $end, $_SESSION['SAEP_codigo_usu']);
        $resultado1 = array_merge($resultado1, $arrayperiod);
      }

      $pendiente = 0;
      $gestionada = 0;
      $vencida = 0;
      $cancelada = 0;

      if(count($resultado1) >= 1){
        // print_r($resultado1);
        foreach ($resultado1 as $key => $value) {
          $bkColor = "";

          $row = row("SELECT codigo_entrevista, estado 
                      FROM entrevistas
                      WHERE codestudiante_fk = '$value[16]' and codperiodo = '$value[0]';");
          if($row != null){
              $gestionada++;
          }else{

            $rowCancelada = row("SELECT fecha_ce, motivos as codmotivo, mc.nombre_mc as motivos
            FROM entrevistas_canceladas ec
            INNER JOIN motivos_cancelacion mc ON mc.codigo_mc = ec.motivos WHERE codestudiante_fk = :codestudiante and codperiodo = '$value[0]'", array(':codestudiante' => $value[16]));
            if($rowCancelada == ''){
              $fh = $value[10].' '.conversorSegundosHoras(intval($value[20]));
              if($fhour > $fh){
                $vencida++;
              }else{
                $pendiente++;
              }
            }else{
              $cancelada++;
            }
          }
          $total = count($resultado1);
          $porges = round(($gestionada/$total)*100, 1);
          $porven = round(($vencida/$total)*100, 1);
          $porpen = round(($pendiente/$total)*100, 1);
          $porcan = round(($cancelada/$total)*100, 1);
          $json = json_encode(array(
            'success' => true, 
            'total' => $total, 
            'gestionadas' => $gestionada, 
            'vencidas' => $vencida, 
            'pendientes' => $pendiente,
            'canceladas' => $cancelada,
            'porges' => $porges,
            'porven' => $porven,
            'porpen' => $porpen,
            'porcan' => $porcan
          ));
        }
        
      }else{
        $json = json_encode(array('success' => true, 'total' => 0, 'gestionadas' => 0, 'vencidas' => 0, 'pendientes' => 0));
      }
    break;
  /************************ fin graficas.php   *************************************/


  /************************  procesos linksentrevistas.php code ****************************/
    case 'loadLinks':

      $sql = "SELECT * FROM links_entrevistas 
              ORDER BY codigo_le ASC";

      $table = table($sql);//, $params
      $i = 1;
      foreach ($table as $datarow => $data) {

        $estadoRow = $data["estado_le"];
        $estado = ($estadoRow == 'on') ? 'Habilitado' : 'Inhabilitado ';

        $edit = '<a class="btn btn-sm btn-primary tooltips" data-rel="tooltip" data-placement="bottom" title="Editar Usuario" onclick="fmodalEditar('.$data["codigo_le"].', \''.$data["nombre_le"].'\', \''.$data["codpsicologo_fk"].'\', \''.$data["link_le"].'\', \''.$data["correo_le"].'\', \''.$data["password_le"].'\')"><i class="fa fa-edit"></i></a>&nbsp;';
        $delete = '<a class="btn btn-danger btn-sm purple tooltips" data-original-title="Eliminar" data-rel="tooltip" title="Eliminar" onClick="feditEstado('.$data["codigo_le"].',\'off\')"><i class="fa fa-trash-o"></i></a>';
        $restore = '<a class="btn btn-success btn-sm purple tooltips" data-original-title="Restaurar" data-rel="tooltip" title="Restaurar" onClick="feditEstado('.$data["codigo_le"].', \'on\')""><i class="fa fa-undo"></i></a>';
        $options = $edit.$delete;
          
        if ($estadoRow == 'on') $options = $edit.$delete;
        else $options = $restore;

          
        array_push($createtable['data'], array($i, $data["codpsicologo_fk"], $data["nombre_le"], $data["link_le"], $data["correo_le"], $data["password_le"], $estado, $options));

        $i++;

      }
      $json = json_encode($createtable);

    break;

    case 'insertItemLink':

      $row = row("SELECT codigo_le FROM links_entrevistas WHERE codpsicologo_fk = :codpsicologo", array(':codpsicologo' => $ccpsicologo));
      if($row == ''){
        $insert = "INSERT INTO links_entrevistas (codpsicologo_fk, nombre_le, link_le, estado_le, correo_le, password_le) VALUES (:codpsicologo, :nombrele, :linkle, :estadole, :correolink, :passlink)";
        $paramsInsert = array(
                              ':codpsicologo' => $ccpsicologo,
                              ':nombrele' => $nombrelink,
                              ':linkle' => $urllink,
                              ':estadole' => $estado,
                              ':correolink' => $correolink,
                              ':passlink' => $passlink
                            );
        if(query($insert, $paramsInsert)){
          $json = json_encode(array("success"=>true));
        }else{
          $json = json_encode(array("success"=>false,"message" => "Error al insertar Link"));
        }
      }else{
        $json = json_encode(array("success"=>false,"message" => "El Psicólogo ingresado ya tiene un link, si necesita cambiarlo, editelo."));
      }
    break;

    case 'editItemLink':

      $update = "UPDATE links_entrevistas SET nombre_le = :nombrele, link_le = :linkle, correo_le = :correolink, password_le = :passlink WHERE codigo_le = :codigo";
      $params = array(':nombrele' => $nombrelink, ':linkle' => $urllink, ':correolink' => $correolink, ':passlink' => $passlink, ':codigo' => $codigole);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'editEstadoLink':
    
      $update = "UPDATE links_entrevistas SET estado_le = :estado WHERE codigo_le = :codigo";
      $params = array(':codigo' => $codigole, ':estado' => $estado);

      if(query($update, $params)){
        $json = json_encode(array("success"=>true));
      }else{
        $json = json_encode(array("success"=>false, "mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
      }

    break;

    case 'updateicfes':
      $sql = "SELECT * FROM puntajes_icfes";
      $table = table($sql);
      foreach ($table as $datarow => $data) {

        $update  = "UPDATE puntajes_icfes SET puntaje_pi1 = :p1 WHERE codigo_pi = :c";
        $params = array(':c' => $data["codigo_pi"], ':p1' => $data["puntaje_pi"] );
        query($update, $params);
      }
    break;

    case 'updatepruebapsico':
      $sql = "SELECT * FROM entrevistas";
      $table = table($sql);
      foreach ($table as $datarow => $data) {

        $update  = "UPDATE entrevistas SET codpruebapsico = :p1 WHERE codigo_entrevista = :c";
        $params = array(':c' => $data["codigo_entrevista"], ':p1' => $data["codpruebapsico_fk"] );
        query($update, $params);
      }
    break;

    case 'updategrupopriorizado':
      $sql = "SELECT * FROM entrevistas";
      $table = table($sql);
      foreach ($table as $datarow => $data) {
        $update  = "INSERT INTO gp_estudiante (codentrevista_fk, codagrupacion_fk, codtipopoblacion_fk, codtipodiscapacidad_fk) VALUES (:codentrevista, :codagrupacion, :codtipopoblacion, :codtipodiscapacidad)";
        $params = array(':codentrevista' => $data["codigo_entrevista"], ':codagrupacion' => $data["codagrupacion_fk"], ':codtipopoblacion' => $data["codtipopoblacion_fk"], ':codtipodiscapacidad' => $data["codtipodiscapacidad_fk"]);
        query($update, $params);
      }
    break;

    case 'updatecodprograma':
      $codperiodo = "20212";
      $start = "2020-05-01";
      $end  = "2021-07-06";

      $fhour = date("Y-m-d H:i:s"); 
      $events = array();
      $mes = date("n");

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/entrevistas_agendadas_reporte?periodos=$codperiodo,$start,$end");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      $pendientes = array();
      $vencidas = array();
      $gestionadas = array();

      if(count($resultado1) >= 1){
        $cant = 0;
        foreach ($resultado1 as $key => $value) {

          
            $paramsEntre = array(':codestudiante' => $value[16], ':codperiodo' => $value[0]);
            $rowEntre = row("SELECT codigo_entrevista, to_char(fecha_entrevista, 'YYYY-MM-DD HH12:MI:SS A.M.') as fecha_entrevista, estado, codprograma, nombre_programa
                        FROM entrevistas
                        WHERE codestudiante_fk = :codestudiante AND codperiodo = :codperiodo", $paramsEntre);
            if($rowEntre != ''){
              if($value[1] != $rowEntre['codprograma']){

                  $updateEntre = "UPDATE entrevistas SET codprograma = :codprograma, nombre_programa = :nombreprograma WHERE codestudiante_fk = :codestudiante AND codperiodo = :codperiodo";
                  $paramsUpdateEntre = array(':codprograma' => $value[1], ':nombreprograma' => $value[2], ':codestudiante' => $value[16], ':codperiodo' => $value[0]);
                  query($updateEntre, $paramsUpdateEntre);
    
                  $row2 = row("SELECT codigo_en, estado 
                          FROM estudiante_notificado
                          WHERE codestudiante_fk = '$value[16]' AND codperiodo = '$value[0]';");
                  $estadonotificado =  ($row2 == null ? 0 : $row2["estado"]);
                  if($estadonotificado != 0){
                    $updateNotificado = "UPDATE estudiante_notificado SET codprograma = :codprograma WHERE codestudiante_fk = :codestudiante AND codperiodo = :codperiodo";
                    query($updateNotificado, array(':codprograma' => $value[1], ':codestudiante' => $value[16], ':codperiodo' => $value[0]));
                  }
    
                  $table = table("SELECT codigo_oe FROM observaciones_entrevistas WHERE codestudiante_fk = '$value[16]' AND codperiodo = '$value[0]';");
                  $observaciones = count($table);
                  if($observaciones != 0){
                    $updateNotificado = "UPDATE observaciones_entrevistas SET codprograma = :codprograma WHERE codestudiante_fk = :codestudiante";
                    query($updateNotificado, array(':codprograma' => $value[1], ':codestudiante' => $value[16]));
                  }
                echo 'codestudiante '.$value[16].' codperiodo '.$value[0].' NUEVO '.$value[1].' - '.$value[2].' OLD '.$rowEntre['codprograma'].' - '.$rowEntre['nombre_programa']. '<br/>';
                $cant++;
            }

          }
          
        }
      }
    break;

    case 'updatecodprogramaxestudiante':
      $codperiodo = $_POST['codperiodo'];
      $start = $_POST['start'];
      $end  = $_POST['end'];
      $idestudiante = $_POST['idestudiante'];
      $update = $_POST['update'];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://190.60.75.134/searches/entrevistas_agendadas_reporte?periodos=$codperiodo,$start,$end");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Connection: Keep-Alive'));
      curl_setopt($ch, CURLOPT_TIMEOUT,3000);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      $resultado = curl_exec($ch);
      curl_close($ch);
      $resultado1=json_decode($resultado);
      $resultado1=(array)json_decode($resultado);

      $pendientes = array();
      $vencidas = array();
      $gestionadas = array();

      if(count($resultado1) >= 1){
        $cant = 0;
        foreach ($resultado1 as $key => $value) {

          if($value[16] == $idestudiante){

              $paramsEntre = array(':codestudiante' => $value[16], ':codperiodo' => $value[0]);
              $rowEntre = row("SELECT codigo_entrevista, to_char(fecha_entrevista, 'YYYY-MM-DD HH12:MI:SS A.M.') as fecha_entrevista, estado, codprograma, nombre_programa
                          FROM entrevistas
                          WHERE codestudiante_fk = :codestudiante AND codperiodo = :codperiodo", $paramsEntre);
            if($rowEntre != ''){

              if($value[1] != $rowEntre['codprograma']){
    
                  if($update == 'si'){
                    $updateEntre = "UPDATE entrevistas SET codprograma = :codprograma, nombre_programa = :nombreprograma WHERE codestudiante_fk = :codestudiante AND codperiodo = :codperiodo";
                    $paramsUpdateEntre = array(':codprograma' => $value[1], ':nombreprograma' => $value[2], ':codestudiante' => $value[16], ':codperiodo' => $value[0]);
                    query($updateEntre, $paramsUpdateEntre);
      
                    $row2 = row("SELECT codigo_en, estado 
                            FROM estudiante_notificado
                            WHERE codestudiante_fk = '$value[16]' AND codperiodo = '$value[0]';");
                    $estadonotificado =  ($row2 == null ? 0 : $row2["estado"]);
                    if($estadonotificado != 0){
                      $updateNotificado = "UPDATE estudiante_notificado SET codprograma = :codprograma WHERE codestudiante_fk = :codestudiante AND codperiodo = :codperiodo";
                      query($updateNotificado, array(':codprograma' => $value[1], ':codestudiante' => $value[16], ':codperiodo' => $value[0]));
                    }
      
                    $table = table("SELECT codigo_oe FROM observaciones_entrevistas WHERE codestudiante_fk = '$value[16]' AND codperiodo = '$value[0]';");
                    $observaciones = count($table);
                    if($observaciones != 0){
                      $updateNotificado = "UPDATE observaciones_entrevistas SET codprograma = :codprograma WHERE codestudiante_fk = :codestudiante";
                      query($updateNotificado, array(':codprograma' => $value[1], ':codestudiante' => $value[16]));
                    }
                  }

                  echo 'codestudiante '.$value[16].' codperiodo '.$value[0].' NUEVO '.$value[1].' - '.$value[2].' OLD '.$rowEntre['codprograma'].' - '.$rowEntre['nombre_programa']. '<br/>';
                  $cant++;
              }else{
                echo 'ES IGUAL codestudiante '.$value[16].' codperiodo '.$value[0].' NUEVO '.$value[1].' - '.$value[2].' OLD '.$rowEntre['codprograma'].' - '.$rowEntre['nombre_programa']. '<br/>';
              }
    
            }
            
          }
          
        }
      }else{
        echo 'no encontrado';
      }
    break;
  /************************ fin linksentrevistas.php   *************************************/
}
echo $json;

?>

