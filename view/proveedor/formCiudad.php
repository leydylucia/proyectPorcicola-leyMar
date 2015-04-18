<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>


<?php $idCiudad = ciudadTableClass::ID ?>
<?php $nomCiudad = ciudadTableClass::NOM_CIUDAD ?>
<?php $depto_id_c = ciudadTableClass::DEPTO_ID ?>
    <?php $depto_id = deptoTableClass::ID ?>
    <?php $nom_depto = deptoTableClass::NOM_DEPTO ?><!--manejo de foranea para traer datos-->


<!--esto es boostrap no te el olvides de cerrar el div-->
<div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->
  <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', ((isset($objCiudad)) ? 'updateCiudad' : 'createCiudad')) ?>">
<?php if (isset($objCiudad) == true): ?>
      <input name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::ID, true) ?>" value="<?php echo $objCiudad[0]->$idCiudad ?>" type="hidden">
<?php endif ?>


        <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('name_city') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true) ?>" class="form-control" value="<?php echo ((isset($objCiudad) == true) ? $objCiudad[0]->$nom_ciudad : '') ?><?php echo (session::getInstance()->hasFlash(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) === true) ? request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) : '' ?>" type="text" name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true) ?>">
<?php if (session::getInstance()->hasFlash(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
      </div>
    </div>


    <!--            <div class="form-group">
                <label for="depto_id" class="control-label col-xs-3"></?php echo i18n::__('name_dept') ?>:</label>
    
                <div class="col-xs-9"><input id="depto_id" class="form-control" value="</?php echo ((isset($objCiudad) == true) ? $objCiudad[0]->$depto_id : '') ?>" type="text" name="</?php echo ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true) ?>"> </div>
            </div>-->

    <div class="form-group">
      <label for="nom_ciudad" class="control-label col-xs-3"><?php echo i18n::__('name_dept') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, TRUE) ?>" name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, TRUE); ?>">
          <option>Seleccione Departamento</option>
<?php foreach ($objDepto as $depto): ?>
            <option <?php echo (isset($objCiudad[0]->$depto_id_c) === true and $objCiudad[0]->$depto_id_c == $depto->$depto_id) ? 'selected' : '' ?> value="<?php echo $depto->$depto_id ?>">
  <?php echo $depto->$nom_depto ?>
            </option>
<?php endforeach; ?>
        </select>
      </div>
    </div>


    <!--<div class="form-group">
   
       <label for="nom_ciudad" class="control-label col-xs-3"></?php echo i18n::__('name_dept') ?>:</label>
       <div class="col-xs-9">
                   <select class="form-control" id="</?php ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, TRUE) ?>" name="</?php echo ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, TRUE); ?>">
                       <option>Seleccione departamento</option>
   </?php foreach ($objDepto as $depto): ?>
                           <option value="</?php echo $depto->id ?>"></?php echo $depto->$nom_depto ?></option>
   </?php endforeach; ?>
                   </select>
               </div>
   
    </div>-->
    <br>

    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objCiudad)) ? 'update' : 'register')) ?>">

    <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexCiudad') ?>"><?php echo i18n::__('return') ?> </a>



  </form>
</div>

