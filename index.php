<?php 
session_start();

if(isset($_SESSION['nombre']) && isset($_SESSION['idUsuario'])){
    header("Location: admin.php");
}
?>

<?php require 'inc/cabecera.inc'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class=" mt-5 ">Portal Web</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class=" col-sm-4 caja col-centrar p-3">
                <form action="login.php" method="post" role="form">
                    <legend>Log In</legend>
                    <hr>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="text" name="email" placeholder="Email..">
                    </div>

                    <div class="form-group" >
                        <input id="my-input" class="form-control" type="password" name="clave" placeholder="Contraseña..">
                    </div>

                        <button type="submit" class="btn btn-primary">Ingresar</button>
                        <a class="float-right" href="registrar.php">Registrarse</a>
                </form>
                
            </div>
        </div>
    </div>

    <?php require 'inc/footer.inc'; ?>

   
            






