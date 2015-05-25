<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $empleado_id = entradaTableClass::EMPLEADO_ID ?>
<?php $proveedor_id = entradaTableClass::PROVEEDOR_ID ?>
<?php $created_at = entradaTableClass::CREATED_AT ?>

<div class="container container-fluid">


  <a href="<?php echo routing::getInstance()->getUrlWeb('entrada', 'indexEn') ?>"><?php echo i18n::__('return') ?> </a>

</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

          <th>Datos de Entrada Bodega</th>



        </tr>        
      </thead>
      <tbody>
        <tr><?php foreach ($objEntrada as $entrada): ?> </tr>
          <tr>
            <th><?php echo i18n::__('employee') ?></th>
            <td><?php echo empleadoTableClass::getNameEmpleado($entrada->$empleado_id) ?></td>
          <tr>
            <th><?php echo i18n::__('supplier') ?></th>
            <td><?php echo proveedorTableClass::getNameProveedor($entrada->$proveedor_id) ?></td>
          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $entrada->$created_at ?></td>

<?php endforeach ?>
      </tbody>

    </table>    
  </div>
</div>  