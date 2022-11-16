<?php
    session_start();
    $codrol = $_SESSION['SAEP_codrol'];
    include '../developer/var.php';
    require_once '../developer/PDOConn.php';

    $sqlrolesmenu = "SELECT menus FROM roles WHERE codigo_rol=:codrol AND estado_rol=:estado";
    $rowrolesmenu = row($sqlrolesmenu, array(':codrol'=>$codrol, ':estado' => 'on'));
    $modulos = explode(",", $rowrolesmenu['menus']);

    $html = '';
    $sql = "SELECT codigo_menu, imagen, nombre_menu, nivel, orden, codsuperior, link, estado, target FROM menu WHERE estado = :estado AND nivel = :nivel ORDER BY orden ASC";
    $params = array(':estado' => 'on', ':nivel' => 1);

    $table = table($sql, $params);
    $i = 1;
    foreach ($table as $datarow => $data) {

        $submenu = table("SELECT codigo_menu, nombre_menu, link FROM menu WHERE codsuperior = :codsuperior ORDER BY orden ASC", array(':codsuperior' => $data["codigo_menu"]));
        if(count($submenu) != 0){
            $as = 0;
            $html2 = '';
            foreach ($submenu as $datarow1 => $data1) {
                $pos = in_array($data1["codigo_menu"], $modulos);
                if($pos === false){
                }else{
                    $html2 .= '<li id="m'.$data1["codigo_menu"].'">';
                    $html2 .= '<a onclick="loadpag(\'../'.$data1["link"].'\',\''.$data1["codigo_menu"].'\',\''.$data["codigo_menu"].'\');" class="active"><i class="fa fa-angle-right"></i><span> '.$data1["nombre_menu"].'</span></a>';
                    $html2 .= '</li>';
                    $as++;
                }
            }
            if($as > 0){
                $html .= '<li class="treeview" id="m'.$data["codigo_menu"].'"><a><i class="'.$data["imagen"].'"></i><span> '.$data["nombre_menu"].'</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
                $html .= '<ul class="treeview-menu">';
                $html .= $html2;
                $html .= '</ul>';
                $html .= '</li>';

            }
        }else{
            $pos = in_array($data["codigo_menu"], $modulos);
            if($pos === false){
                
            }else{
                $html .= '<li class="treeview" id="m'.$data["codigo_menu"].'">';
                $html .= '<a onclick="loadpag(\'../'.$data["link"].'\',\''.$data["codigo_menu"].'\');"><i class="'.$data["imagen"].'"></i><span> '.$data["nombre_menu"].'</span></a>';
                $html .= '</li>'; 
            }
        }
        $i++;
    }
    $imp = '<aside class="main-sidebar">';
    $imp .= '<div class="sidebar">';
    $imp .= '<!-- Sidebar user panel -->';
    $imp .= '<div class="user-panel">';
    $imp .= '<div class="image text-center"><img src="'.imgPerfilPHP().'" class="img-circle" alt="User '.$_SESSION["SAEP_nombre_usu"].'"></div>';
    $imp .= '<div class="info">';
    $imp .= '<p>'.$_SESSION["SAEP_nombre_usu"].'</p>';
    $imp .= '<p>'.$_SESSION['SAEP_nombre_rol'].'</p>';
     
    $imp .= '<a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>';
    $imp .= '</div>';

    $imp .= '<ul class="sidebar-menu tree" id="main-menu" data-widget="tree">';
    $imp .= $html;
    $imp .= '</ul>';

    $imp .= '</div>';
    $imp .= '</aside>';
    echo trim($imp);

?>