

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $peso_cerdo = controlTableClass::PESO_CERDO ?>
<?php $empleado_id = controlTableClass::EMPLEADO_ID ?>
<?php $created_at = controlTableClass::CREATED_AT ?>

<div class="container container-fluid">


  <button type="button" class="btn btn-info btn-xs" > <a href="<?php echo routing::getInstance()->getUrlWeb('control', 'index') ?>"><?php echo i18n::__('return') ?> </a> </button>

</div>

<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr class="active">

          <th>Datos Contro Peso</th>
</tr>        
      </thead>
      <tbody>
      <?php foreach ($objControl as $control): ?> 
          <tr class="info">
            <th><?php echo i18n::__('pig weight') ?></th>
            <td><?php echo $control->$peso_cerdo ?></td>
          <tr class="active">

            <th><?php echo i18n::__('employee') ?></th>
            <td><?php echo empleadoTableClass::getNameEmpleado($control->$empleado_id) ?></td>
          <tr class="info">
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $control->$created_at ?></td>

<?php endforeach ?>
      </tbody>



    </table>    
  </div>
</div>

  