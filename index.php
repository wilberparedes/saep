<?php

session_start();
if($_SESSION["SAEP_session"]){
  header('Location:./dashboard/');
}else{
  header('Location:./login/');
}

?>
