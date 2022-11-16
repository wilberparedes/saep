<?php

    @session_start();

    $update = true;


    if(!isset($_SESSION["SAEP_session"])){
        echo json_encode(array('refresh'=>true, 'ss' => true, 'title' => 'Inactividad en su sesión', 'message' => '<br/><p>Por inactividad deberá actualizar su sesión <br/> Por favor, dé click en OK y evite errores en su sistema. <br/><br/> ¡Muchas gracias por utilizar SAEP!</p>'));
    }
    else if($update){
        $data = file_get_contents('./developer/update.txt');
        $array = json_decode($data, 1);
        if(isset($array[$_SESSION["SAEP_usuario"]])){
            echo json_encode(array('refresh' => false, 'ss' => false));
        }else{
            // echo json_encode(array('refresh'=>true, 'ss' => true, 'title' => '¡Actualización disponible!', 'message' => '<br/><p>¿Desea actualizar su plataforma? <br/><br/> <strong><u>Novedades</u></strong> <br/>  <strong>Asesor:</strong> desde ahora te será notificado cualquier observación realizada por un Psicólogo en una entrevista en la que previamente hayas realizado una observación. <br/> <strong>Psicólogo:</strong> desde ahora podrás elegir más de un Grupo Priorizado.<br/> <strong>Otras actualizaciones:</strong> SAEP día a día sigue mejorando para brindarte una mejor experiencia!<br/><br/> <i><strong>Nota:</strong> recuerde que para el correcto funcionamiento de su plataforma, esta deberá mantenerse actualizada. Si estás haciendo algo importante puedes presionar Cancelar y la actualización se pospondrá por 10 segundos.</i></p>'));
            echo json_encode(array('refresh'=>true, 'ss' => true, 'title' => '¡Actualización importante disponible!', 'message' => '<br/><p>¿Desea actualizar su plataforma? <br/><br/> <strong><u>Novedades</u></strong> <br/> Corrección de errores y ajustes a consultas.<br/><br/> <i><strong>Nota:</strong> recuerde que para el correcto funcionamiento de su plataforma, esta deberá mantenerse actualizada. Si estás haciendo algo importante puedes presionar Cancelar y la actualización se pospondrá por 10 segundos.</i></p>'));
        }
    }
    else{
        echo json_encode(array('refresh'=>false,'ass' => $_SESSION["SAEP_usuario"], 'ss' => false));
    }

?>