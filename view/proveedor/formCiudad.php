<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>


<?php $id = ciudadTableClass::ID ?>
<?php $ciudad = ciudadTableClass::NOM_CIUDAD?>
<?php $depto_id_c = ciudadTableClass::DEPTO_ID ?>
<?php $depto_id = deptoTableClass::ID ?>
<?php $nom_depto = deptoTableClass::NOM_DEPTO ?><!--manejo de foranea para traer datos-->


<!--esto es boostrap no te el olvides de cerrar el div-->
<div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->
  <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', ((isset($objCiudad)) ? 'updateCiudad' : 'createCiudad')) ?>">
<?php if (isset($objCiudad) == true): ?>
      <input name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::ID, true) ?>" value="<?php echo $objCiudad[0]->$id ?>" type="hidden">
<?php endif ?>


        <?php view::includeHandlerMessage() ?>
    <?php if(session::getInstance()->hasError('inputCiu')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCiu') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->  
      
    <div class="form-group <?php echo (session::getInstance()->hasFlash(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('city') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) ? request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) : ((isset($objCiudad) == true) ? $objCiudad[0]->$ciudad : '') ?>" type="text" name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true) ?>">
        <?php if (session::getInstance()->hasFlash(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


      <?php if(session::getInstance()->hasError('inputCiudad')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCiudad') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->
  

    <div class="form-group">
      <label for="nom_ciudad" class="control-label col-xs-3"><?php echo i18n::__('name_dept') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, TRUE) ?>" name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputCiudad') or request::getInstance()->hasPost(ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true))) ? request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true)) : ((isset($objCiudad[0])) ? $objCiudad[0]->$depto_id_c : '') ?>"  type="text" name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true) ?>" placeholder="<?php echo i18n::__('name_dept') ?>">Seleccione Departamento</option>
<?php foreach ($objDepto as $depto): ?>
            <option <?php echo (request::getInstance()->hasPost(ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true)) === true and request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true)) == $depto->$depto_id) ? 'selected' : (isset($objDepto[0]->$depto_id_c) === true and $objDepto[0]->$depto_id_c == $depto->$depto_id) ? 'selected' : '' ?> value="<?php echo $depto->$depto_id ?>"><?php echo $depto->$nom_depto ?></option><!--sostenimiento de dato en foranea-->
            </option>
<?php endforeach; ?>
        </select>
      </div>
    </div>


    <br>

    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objCiudad)) ? 'update' : 'register')) ?>">

    <a class="btn btn-info" href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexCiudad') ?>"><?php echo i18n::__('return') ?> </a>



  </form>
</div>

