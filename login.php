<?php session_start(); ?>
<?php require 'inc/cabecera.inc'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class=" col-sm-6 col-centrar p-3">
                
            <?php 

            

            if($_POST){
                require 'lib/errores.php';
                require 'lib/conexion.php';

                spl_autoload_register(function($clase){
                    require_once "lib/$clase.php";
                });

                extract($_POST, EXTR_OVERWRITE);

                $nombre = strtolower($nombre);


                if($email && $clave){

                    $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_CHARSET);

                    $validarEmail = $db->validarDatos('email', 'usuarios', $email);
                    $expregular = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

                    if(preg_match($expregular, $email)){
                        
                        if($validarEmail != 0){


                            $db->preparar("SELECT id_usuario, CONCAT(nombre, ' ', apellido) AS Nombre_Completo, clave, email, imagen FROM usuarios WHERE email = '$email'");
                            $db->ejecutar();
                            $db->prep()->bind_result($id, $dbnombre_completo, $dbclave, $dbemail, $dbrutaimg);
                            $db->resultado();

                            if($email == $dbemail){

                                if($clave == $dbclave){

                                    $_SESSION['idUsuario'] = $id;
                                    $_SESSION['nombre'] = $dbnombre_completo;
                                    $_SESSION['imagen'] = $dbrutaimg;

                                    $db->cerrar();

                                    header("Location: admin.php");

                                } else{
                                    trigger_error("Esta contraseña no coincide con la del correo, serás redireccionado en 5 segundos..", E_USER_ERROR);
                                    header("Refresh:5; url=index.php");
                                }

                            } else{
                                trigger_error("Culo", E_USER_ERROR);
                            }

                        } else{
                            trigger_error("Este email no existe, por favor ingresa otro o registrate, serás redireccionado en 5 segundos..", E_USER_ERROR);
                            header("Refresh:5; url=index.php");
                        }

                    } else{
                        trigger_error("Email erróneo, por favor ingresa un email válido, serás redireccionado en 5 segundos..", E_USER_ERROR);
                        header("Refresh:5; url=index.php");
                    }

                }
            }

            ?>

        </div>
    </div>
</div>

<?php require 'inc/footer.inc'; ?>