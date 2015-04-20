

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $peso_cerdo = controlTableClass::PESO_CERDO ?>
<?php $empleado_id = controlTableClass::EMPLEADO_ID ?>
<?php $created_at = controlTableClass::CREATED_AT ?>

<div class="container container-fluid">


  <a href="<?php echo routing::getInstance()->getUrlWeb('control', 'index') ?>"><?php echo i18n::__('return') ?> </a>

</div>

<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

          <th>Datos Contro Peso</th>
</tr>        
      </thead>
      <tbody>
      <?php foreach ($objControl as $control): ?> 
          <tr>
            <th><?php echo i18n::__('pig weight') ?></th>
            <td><?php echo $control->$peso_cerdo ?></td>
          <tr>

            <th><?php echo i18n::__('employee') ?></th>
            <td><?php echo empleadoTableClass::getNameEmpleado($control->$empleado_id) ?></td>
          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $control->$created_at ?></td>

<?php endforeach ?>
      </tbody>



    </table>    
  </div>
</div>

  