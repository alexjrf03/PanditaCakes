<?php 

session_start();

if(!$_SESSION['idUsuario'] && !$_SESSION['nombre']){
    header("Location: index.php");
    exit;
}

?>

<?php require 'inc/cabecera.inc'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-4 caja text-center">
            <h2 class=" mt-5 "> <?php echo "Hola " . ucwords($_SESSION['nombre']) . "! "; ?> <br> Bienvenido a la Administración</h2>
            <img class="img-responsive img-thumbnail" src='<?php echo $_SESSION['imagen']; ?>' alt="">
            <br>
            <br>
            <a class="btn btn-primary" href="logout.php">Cerrar Sesión</a>
        </div>
    </div>
</div>

    <?php require 'inc/footer.inc'; ?>