<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>

<?php $id = proveedorTableClass::ID ?>
<?php $nombre = proveedorTableClass::NOMBRE ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $correo = proveedorTableClass::CORREO ?>
<?php $telefono = proveedorTableClass::TELEFONO ?>
</?php $ciudad_id = proveedorTableClass::CIUDAD_ID ?>
<?php $ciudad_id = ciudadTableClass::ID ?>
<?php $nom_ciudad = ciudadTableClass::NOM_CIUDAD ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->
  <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', ((isset($objProveedor)) ? 'updateProv' : 'createProv')) ?>">
    <?php if (isset($objProveedor) == true): ?>
      <input name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true) ?>" value="<?php echo $objProveedor[0]->$id ?>" type="hidden">
    <?php endif ?>


    <div class="form-group">
      <label for="ombre" class="control-label col-xs-3"><?php echo i18n::__('name') ?>:</label>
      <div class="col-xs-9"><input id="nombre" class="form-control" value="<?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$nombre : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true) ?>"> </div>
    </div>
        
    <div class="form-group">       
      <label for="apellido" class="control-label col-xs-3"><?php echo i18n::__('lastname') ?>:</label>
      <div class="col-xs-9"><input id="apellido" class="form-control" value="<?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$apellido : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true) ?>"> </div>
    </div>

    <div class="form-group"> 
      <label for="direccion" class="control-label col-xs-3"><?php echo i18n::__('direction') ?>:</label>
      <div class="col-xs-9"><input id="direccion" class="form-control" value="<?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$direccion : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true) ?>"> </div>
    </div>

    <div class="form-group"> 
      <label for="correo" class="control-label col-xs-3"><?php echo i18n::__('email') ?>:</label>
      <div class="col-xs-9"><input id="correo" class="form-control" value="<?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$correo : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CORREO, true) ?>"> </div>
    </div>

    <div class="form-group"> 
      <label for="telefono" class="control-label col-xs-3"><?php echo i18n::__('telephone') ?>:</label>
      <div class="col-xs-9"><input id="telefono" class="form-control" value="<?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$telefono : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true) ?>"> </div>
    </div>

       <div class="form-group">
            <label for="<//?php echo proveedorTableClass::getNameField(proveedorTableClass::ID,true)?>" class="control-label col-xs-3"><?php echo i18n::__('city_id') ?>:</label>

            <div class="col-xs-9">
                <select class="form-control" id="<?php proveedorTableClass::getNameField(proveedorTableClass::CIUDAD_ID, TRUE) ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CIUDAD_ID, TRUE); ?>">
                    <option>Seleccione el tipo insumo</option>
<?php foreach ($objCiudad as $ciudad): ?>
                        <option value="<?php echo $ciudad->id ?>"><?php echo $ciudad->$nom_ciudad ?></option>
<?php endforeach; ?>
                </select>
            </div>
        </div>

      
<!--    <div class="form-group"> 
      <label for="ciudad" class="control-label col-xs-3"></?php echo i18n::__('city_id') ?>:</label>
      <div class="col-xs-9"><input id="ciudad" class="form-control" value="</?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$ciudad_id : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CIUDAD_ID, true) ?>"> </div>
    </div>
</div>-->

<br>
<br>

<input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objProveedor)) ? 'update' : 'register')) ?>">

<a href="http://localhost/proyectPorcicola-leyMar/web/index.php/proveedor"><?php echo i18n::__('return') ?> </a>
</form>
</div>

