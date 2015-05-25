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
   <div class="container container-fluid body2" style="margin-bottom: 10px; margin-top: 30px">  
      
        <div class="container container-fluid">
    <div class="page-header titulo2">
        <center>     <h1>Configuracion del Sistema</h1> </center>
    </div>
</div>
    <form   class="form-horizontal" role="form" action="index.php?step=4" method="POST">
      
      <div class="form-group">
        <div class="col-sm-10">
      <input class="form-control"  value="<?php echo (isset($_POST['RowGrid'])) ? $_POST['RowGrid'] : '' ?>" type="text" name="RowGrid" placeholder="Numero de lineas por regilla"><br>
      </div>
           
    
      </div>
      
      
      
      <div class="form-group">
        <div class="col-sm-10">
      <input class="form-control" value="<?php echo (isset($_POST['PathAbsolute'])) ? $_POST['PathAbsolute'] : '' ?>"  type="text" name="PathAbsolute" placeholder="Dirección en servidor de la carpeta raíz  /var/www/html/nombre-carpeta/"><br>
      </div>
      </div>
      
      
      <div class="form-group">
        <div class="col-sm-10">
      <input class="form-control" value="<?php echo (isset($_POST['UrlBase'])) ? $_POST['UrlBase'] : '' ?>" type="text" name="UrlBase" placeholder="Dirección de la web http://www.ejemplo.com/"><br>
      </div>
      </div>
      
      
      
      <div class="form-group">
        <div class="col-sm-10">
      <select class="form-control" name="Scope">
        <option value="">Seleccione modo de instalación</option>
        <option value="dev">Desarrollo</option>
        <option value="prod">Producción</option>
      </select>
      </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-10">
      <select class="form-control" name="idioma">
        <option value="">Seleccione idioma</option>
        <option value="es">Español</option>
        <option value="en">English</option>
      </select><br>
      </div>
      </div>
      
      
      <div class="form-group">
        <div class="col-sm-10">
      <input  class="form-control" value="<?php echo (isset($_POST['FormatTimestamp'])) ? $_POST['FormatTimestamp'] : '' ?>" type="text" name="FormatTimestamp" value="Y-m-d H:i:s" placeholder="Formato de fecha y hora ejemplo Y-m-d H:i:s"><br>
      </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-10">
     <input class="btn btn-lg btn-info btn-xs" type="submit" value="Instalar">
 
    </div>
      </div>
    
    </form>
      
      
     
    </div>
  </body>
</html>
