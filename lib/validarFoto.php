<?php

function validacion($nombre){

    global $dir_subida;
    global $ruta_subida;
    global $error;

    $dir_subida = "fotos/$nombre";
    
    $foto = $_FILES['foto'];
    
    $nombre_foto = $foto['name'];
    $nombre_tmp = $foto['tmp_name'];
    $ruta_subida = "$dir_subida/profile.jpg";
    $ext_archivo = preg_replace('/image\//', '', $foto['type']);
    
    if($ext_archivo == 'jpeg' || $ext_archivo == 'png'){

        if(!file_exists($dir_subida)){
            mkdir($dir_subida, 0777);
        }

        $val = move_uploaded_file($nombre_tmp, $ruta_subida);

        if($val){
            //echo "<img class='img-fluid' src='$ruta_subida' alt=''>";
            return true;
        } else{
            trigger_error("No se pudo mover el archivo.", E_USER_ERROR);
        }
    } else{
        trigger_error('No es un archivo de imagen válido.', E_USER_ERROR);
    }
}

?>