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
    <div class="container container-fluid" id="cuerpo">
    <br><br><br>
    
    <h1>COMPILACION DE PETICIONES</h1>
    <br>
    <table id="tabla" class="table table-bordered table-responsive">
    <tr>
      <th> PHP 5.4 o superior </th><th><?php echo PHP_VERSION ?></th>
    </tr>
    <tr>
      <th>json </th> <th><?php echo get_loaded_extensions()[array_search('json', get_loaded_extensions())] ?></th>
    </tr>
    <tr>
      <th>PDO </th> <th><?php echo get_loaded_extensions()[array_search('PDO', get_loaded_extensions())] ?></th>
    </tr>
    <tr>
      <th>pdo_pgsql </th><th><?php echo get_loaded_extensions()[array_search('pdo_pgsql', get_loaded_extensions())] ?></th>
    </tr>
    <tr>
     <th> pdo_mysql  </th> <th><?php echo get_loaded_extensions()[array_search('pdo_mysql', get_loaded_extensions())] ?></th>
    </tr>
    <tr>
      <th><button type="button" class="btn btn-info"><a href="index.php?step=2">Siguiente</a></button></th>
    </tr>
    </table>
    </div>
  </body>
</html>
