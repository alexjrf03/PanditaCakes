<?php
    session_start();
    session_unset();
    session_destroy();

    header("Refresh:5; url=index.php");
?>

<?php require 'inc/cabecera.inc'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-4 caja text-center">
            <h4>Has cerrado sesión, serás redireccionado a la página de inicio a continuación...</h4>
        </div>
    </div>
</div>