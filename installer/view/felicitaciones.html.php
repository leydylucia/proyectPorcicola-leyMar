<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--esta linea se puede omitir para hacer banda de hancho fijo del video 28-->
    <title>INSTALADOR</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <?php if(isset($_GET['error']) and $_GET['error'] === true): ?>
    Ocurrio un error
    <?php endif ?>
    
<div class="container">      
            <div class="row">
                <div class="col-xs-12" id="exito">         
                   <img class="img-responsive" src="../img/felicidades.jpg" alt="test">
 
                </div>
            </div>
        </div> 
    
<!--<div class="container container-fluid">
    <div class="page-header titulo2">
         <h1>configuracion y carga de archivos realizada con exito</h1> 
    </div>

   -->
   
    <tr><th><button type="button" class="btn btn-info btn-xs"><a href="index.php?step=2">Siguiente</a></button></th></tr>
    
  </body>
</html>
