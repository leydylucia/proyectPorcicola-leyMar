<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>


<?php $nombre = empleadoTableClass::NOMBRE ?>
<?php $usuario_id = empleadoTableClass::USUARIO_ID ?>
<?php $tipo_id_id = empleadoTableClass::TIPO_ID_ID ?>
<?php $apellido = empleadoTableClass::APELLIDO ?>
<?php $direccion = empleadoTableClass::DIRECCION ?>
<?php $correo = empleadoTableClass::CORREO ?>
<?php $telefono = empleadoTableClass::TELEFONO ?>
<?php $created_at = empleadoTableClass::CREATED_AT ?>


<div class="container container-fluid">

  <button type="button" class="btn btn-info" > <a href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'index') ?>"><?php echo i18n::__('return') ?> </a> </button>
  <br>
  <br>


</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

          <th>Datos Empleado</th>



        </tr>        
      </thead>
      <tbody>
        <tr><?php foreach ($objEmpleado as $empleado): ?> </tr>
          <tr>
            <th><?php echo i18n::__('name') ?></th>

            <td><?php echo $empleado->$nombre. ' ' . $empleado->$apellido ?></td>

          <tr>
            <th><?php echo i18n::__('name_user') ?></th>

            <td><?php echo usuarioTableClass::getNameUsuario($empleado->$usuario_id) ?></td>
          <tr>
            <th><?php echo i18n::__('type_id') ?></th>

            <td><?php echo tipoIdTableClass::getNameTipo($empleado->$tipo_id_id) ?></td>
          <tr>
            <th><?php echo i18n::__('direction') ?></th>

            <td><?php echo $empleado->$direccion ?></td>
          <tr>
            <th><?php echo i18n::__('email') ?></th>

            <td><?php echo $empleado->$correo ?></td>
          <tr>
            <th><?php echo i18n::__('telephone') ?></th>

            <td><?php echo $empleado->$telefono ?></td>
          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $empleado->$created_at ?></td>

          <?php endforeach ?>
      </tbody>



    </table>    
  </div>
</div>

