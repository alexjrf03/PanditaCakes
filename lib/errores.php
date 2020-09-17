<?php

// En la funcion "gestorErrores, se deben pasar los parámetros que se aprecian en ese mismo orden. 

    function gestorErrores($nmr_error, $texto_error, $archivo_error, $linea_error){
       if( !(error_reporting() && $nmr_error )){
           return;
       }

       switch($nmr_error){
           case E_USER_ERROR:
            echo "
                <div class='alerta alerta_error'>
                    <div class='alerta_icon'>
                        <img class='icon-logo' src='img/advertencia.svg'>
                    </div>

                    <a href='#' class='close_err'><img class='icon-close' src='img/cerrar (1).svg'></a>

                    <div class='alerta_wrapper'> Error: $texto_error
                    </div>
                </div>
            ";
           break;

           case E_USER_WARNING:
            echo "
                <div class='alerta alerta_warning'>
                    <div class='alerta_icon'>
                    <img class='icon-logo' src='img/alerta.svg'>
                    </div>

                    <a href='#' class='close_err'><img class='icon-close' src='img/cerrar (2).svg'></a>

                    <div class='alerta_wrapper'> Error: [$nmr_error] $texto_error, este error se encuentra en la línea $linea_error, en el archivo $archivo_error <br> <a href='#'>Ayuda</a>
                    </div> 
                </div>
            ";
           break;

           case E_USER_NOTICE:
            echo "
            <div class='alerta alerta_info'>
                <div class='alerta_icon'>
                <img class='icon-logo' src='img/informacion.svg'>
                </div>

                <a href='#' class='close_err'><img class='icon-close' src='img/cerrar (2).svg'></a>

                <div class='alerta_wrapper'> $texto_error
                </div> 
            </div>
            ";
           break;
       }
    }

    // Estableciendo errores personalizados:

    set_error_handler("gestorErrores");