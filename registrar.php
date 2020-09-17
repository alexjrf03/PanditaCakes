<?php require 'inc/cabecera.inc'; ?>

<div class="container-fluid">
        <div class="row justify-content-center">
            <div class=" col-sm-6 col-centrar p-3">

<?php
                require 'lib/conexion.php';
                require 'lib/errores.php';
                require 'lib/validarFoto.php';

                spl_autoload_register(function($clase){
                    require_once "lib/$clase.php";
                });


                if($_POST){
                    extract($_POST, EXTR_OVERWRITE);

                    if(!file_exists("fotos")){
                        mkdir("fotos", 0777);
                    }


                    $nombre = strtolower($nombre);

                    

                   

                    if($nombre && $email && $password && $confirm_password){

                        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_CHARSET);
                        
                        $expregular = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

                        if(preg_match($expregular, $email)){

                            if(strlen($password) >6 ){

                                if($password == $confirm_password){
                                    $validarEmail = $db->validarDatos('email', 'usuarios', $email);

                                    if($validarEmail == 0){

                                        if(validacion($nombre)){
                                            //echo "<img class='img-fluid' src='$ruta_subida' alt=''>";
                                            if($db->preparar("INSERT INTO usuarios VALUES (NULL, '$nombre', '$apellido', '$email', '$password', $cedula, $telefono, '$direccion', $edad, '$ciudad', '$departamento', $codigo_postal, '$ruta_subida')")){
                                                $db->ejecutar();

                                                trigger_error("Te has registrado perfectamente.", E_USER_NOTICE);
                                                $ok = true;
                                                $db->cerrar();
                                            }

                                        } else{
                                            echo $error;
                                        }

                                    } else{

                                        trigger_error("Ese email ya existe, prueba con otro.", E_USER_ERROR);
                                    }

                                } else{

                                    trigger_error("Las contraseñas no coinciden, por favor ingresa las contraseñas correctamente.", E_USER_ERROR);
                                }

                            } else{
                                
                                trigger_error("La contraseña debe tener más de 6 caractéres.", E_USER_ERROR);
                            }

                        } else{
                            
                            trigger_error("Email erróneo, por favor ingresa un email válido.", E_USER_ERROR);
                            
                        }
                    } else{
                        
                    }

                }


                /* $array = $db->getClientes();

                echo "<table class='table table-cell'>
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Nombre</td>
                                    <td>Apellido</td>
                                    <td>Ciudad</td>
                                    <td>Departamento</td>
                                    <td>Cédula</td>
                                    <td>Edad</td>
                                    <td>Teléfono</td>
                                </tr>

                            <tbody>

                ";

                foreach($array as $value){
                    echo "<tr>";
                    foreach($value as  $value2){
                            echo "<td>$value2</td>";
                        }
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>"; */

                /* $db->preparar('SELECT nombre, apellido, ciudad FROM clientes');
                $db->ejecutar();
                $db->prep()->bind_result($nombre, $apellido, $ciudad);

                echo "<table class='table table-cell'>
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Nombre</td>
                                    <td>Apellido</td>
                                    <td>Ciudad</td>
                                </tr>

                            <tbody>

                ";

                while($db->resultado()){
                    echo "<tr>
                            <td></td>
                            <td>$nombre</td>
                            <td>$apellido</td>
                            <td>$ciudad</td>
                         </tr>";

                }

                
                

                echo "</tbody>";
                echo "</table>";

                $db->validarDatos('ciudad', 'clientes', 'Caracas'); */
    ?>
        </div>
    </div>
</div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class=" mt-5 ">Portal Web</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class=" col-sm-6 caja col-centrar p-3">
 

            <?php if($ok) : ?>

                <h2>Saludos <?php echo $nombre ?></h2>
                <img class="img-thumbnail" src="<?php echo $ruta_subida ?>" alt="">

                <p>
                    Te has registrado correctamente, dirígete a la página de inicio para logearte.
                </p>

                <a class="btn btn-primary" href="index.php">Logearse</a>

            <?php else : ?>


                <form action="" method="post" enctype="multipart/form-data" role="form">
                    <legend>Registrate</legend>
                    <hr>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="nombre" placeholder="Nombre..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="apellido" placeholder="Apellido..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="email" placeholder="Email..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="password" name="password" placeholder="Contraseña..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="password" name="confirm_password" placeholder="Confirmar Contraseña..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="cedula" placeholder="Cédula..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="telefono" placeholder="Teléfono..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="direccion" placeholder="Dirección..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="edad" placeholder="Edad..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="ciudad" placeholder="Ciudad..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="departamento" placeholder="Departamento..">
                    </div>

                    <div class="form-group mb-5" >
                        <input id="my-input" class="form-control" type="text" name="codigo_postal" placeholder="Código Postal..">
                    </div>

                    <div class="form-group mb-5">
                        <label for="my-input">Elija su foto de Perfil..</label>
                        <input id="my-input" class="form-control-file" type="file" name="foto">
                    </div>

                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a class="float-right" href="index.php">Ya tengo una cuenta</a>
                </form>
                
            <?php endif; ?>

            </div>
        </div>
    </div>

    <?php require 'inc/footer.inc'; ?>