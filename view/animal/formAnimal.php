<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>

<?php $id = hojaVidaTableClass::ID ?>
<?php $fecha_nacimiento = hojaVidaTableClass::FECHA_NACIMIENTO ?>
<?php $nombre_cerdo = hojaVidaTableClass::NOMBRE_CERDO ?>
<//?php $id_madre = hojaVidaTableClass::ID_MADRE ?>
<//?php $id_madre_h = hojaVidaTableClass::ID_MADRE ?>
<?php $genero_id_b = hojaVidaTableClass::GENERO_ID ?>
<?php $genero_id = generoTableClass::ID ?>
<?php $descripcion = generoTableClass::DESCRIPCION ?>
<?php $estado_id_p = hojaVidaTableClass::ESTADO_ID ?>
<?php $estado_id = estadoTableClass::ID ?>
<?php $desc_estado = estadoTableClass::DESC_ESTADO ?>
<?php $lote_id_e = hojaVidaTableClass::LOTE_ID ?>
<?php $lote_id = loteTableClass::ID ?>
<?php $desc_lote = loteTableClass::DESC_LOTE ?>
<?php $raza_id_a = hojaVidaTableClass::RAZA_ID ?>
<?php $raza_id = razaTableClass::ID ?>
<?php $desc_raza = razaTableClass::DESC_RAZA ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objHojaVida)) ? 'update' : 'create')) ?>">
  <?php if (isset($objHojaVida) == true): ?>
    <input name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true) ?>" value="<?php echo $objHojaVida[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    
    
    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('genre') ?>:</label>
      <div class="col-xs-9">
        <select class="form-control" id="<?php hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, TRUE) ?>" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputNombre') or request::getInstance()->hasPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, true))) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, true)) : ((isset($objHojaVida[0])) ? $objHojaVida[0]->$genero_id_b : '') ?>"  type="text" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, true) ?>" placeholder="<?php echo i18n::__('genre') ?>">Seleccione Genero</option>
<?php foreach ($objGenero as $genero): ?>
            <option <?php echo (request::getInstance()->hasPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, true)) === true and request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO_ID, true)) == $genero->$genero_id) ? 'selected' : (isset($objHojaVida[0]->$genero_id_b) === true and $objHojaVida[0]->$genero_id_b == $genero->$genero_id) ? 'selected' : '' ?> value="<?php echo $genero->$genero_id ?>"><?php echo $genero->$descripcion ?></option> <!--sostenimiento de dato en foranea ?>-->  
<?php endforeach; ?>
        </select>
      </div>
    </div>

    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('name_pig') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO, true) ?>" class="form-control" value="<?php echo ((isset($objHojaVida) == true) ? $objHojaVida[0]->$nombre_cerdo : '') ?><?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO, true)) === true) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO, true)) : '' ?>" type="text" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO, true) ?>">
        <?php if (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
<!--    <div class="form-group </?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="</?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true) ?>" class="control-label col-xs-3"></?php echo i18n::__('genre') ?>:</label>
      <div class="col-xs-9">
        <input id="</?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true) ?>" class="form-control" value="</?php echo ((isset($objHojaVida) == true) ? $objHojaVida[0]->$genero : '') ?></?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true)) === true) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true)) : '' ?>" type="text" name="</?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true) ?>">
        
        </?php if (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        </?php endif ?>
      </div>
    </div>-->

    <div class="form-group <?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_birth') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true) ?>" class="form-control" value="<?php echo ((isset($objHojaVida) == true) ? $objHojaVida[0]->$fecha_nacimiento : '') ?><?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true)) === true) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true)) : '' ?>" type="date" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true) ?>">
        <?php if (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    
    <?php if(session::getInstance()->hasError('inputEstado')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputEstado') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->
    
    
    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('state') ?>:</label>
    <div class="col-xs-9">
        <select class="form-control" id="<?php hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, TRUE) ?>" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputEstado') or request::getInstance()->hasPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, true))) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, true)) : ((isset($objHojaVida[0])) ? $objHojaVida[0]->$estado_id_p : '') ?>"  type="text" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, true) ?>" placeholder="<?php echo i18n::__('state') ?>">Seleccione Estado</option>
<?php foreach ($objEstado as $estado): ?>
             <option <?php echo (request::getInstance()->hasPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, true)) === true and request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, true)) == $estado->$estado_id) ? 'selected' : (isset($objHojaVida[0]->$estado_id_p) === true and $objHojaVida[0]->$estado_id_p == $estado->$estado_id) ? 'selected' : '' ?> value="<?php echo $estado->$estado_id ?>"><?php echo $estado->$desc_estado ?></option> <!--sostenimiento de dato en foranea ?>-->  
<?php endforeach; ?>
        </select>
      </div>
  </div>
    
    
     <?php if(session::getInstance()->hasError('inputLote')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputLote') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->
    
    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('batch') ?>:</label>
      <div class="col-xs-9">
        <select class="form-control" id="<?php hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, TRUE) ?>" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputLote') or request::getInstance()->hasPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, true))) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, true)) : ((isset($objHojaVida[0])) ? $objHojaVida[0]->$lote_id_e : '') ?>"  type="text" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, true) ?>" placeholder="<?php echo i18n::__('state') ?>">Seleccione Lote</option>
<?php foreach ($objLote as $lote): ?>
            <option <?php echo (request::getInstance()->hasPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, true)) === true and request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, true)) == $lote->$lote_id) ? 'selected' : (isset($objHojaVida[0]->$lote_id_e) === true and $objHojaVida[0]->$lote_id_e == $lote->$lote_id) ? 'selected' : '' ?> value="<?php echo $lote->$lote_id ?>"><?php echo $lote->$desc_lote ?></option> <!--sostenimiento de dato en foranea ?>-->  
<?php endforeach; ?>
        </select>
      </div>
    </div>


    
    <?php if(session::getInstance()->hasError('inputRaza')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputRaza') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->
    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('race') ?>:</label>
      <div class="col-xs-9">
        <select class="form-control" id="<?php hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, TRUE) ?>" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputRaza') or request::getInstance()->hasPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, true))) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, true)) : ((isset($objHojaVida[0])) ? $objHojaVida[0]->$raza_id_a : '') ?>"  type="text" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, true) ?>" placeholder="<?php echo i18n::__('race') ?>">Seleccione Raza</option>
<?php foreach ($objRaza as $raza): ?>
            <option <?php echo (request::getInstance()->hasPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, true)) === true and request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, true)) == $raza->$raza_id) ? 'selected' : (isset($objHojaVida[0]->$raza_id_a) === true and $objHojaVida[0]->$raza_id_a == $raza->$raza_id) ? 'selected' : '' ?> value="<?php echo $raza->$raza_id ?>"><?php echo $raza->$desc_raza ?></option> <!--sostenimiento de dato en foranea ?>-->  
<?php endforeach; ?>
        </select>
      </div>
    </div>
    
    
<!--    <div class="form-group">
      <label for="" class="control-label col-xs-3"></?php echo i18n::__('mother') ?>:</label>-->

<!--      <div class="col-xs-9">
        <select class="form-control" id="</?php hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, TRUE) ?>" name="</?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, TRUE); ?>">
          <option>Seleccione Madre</option>
          </?php foreach ($objHojaVida as $hojaVida): ?>
            <option </?php echo (isset($objHojaVida[0]->$id_madre) === true and $objHojaVida[0]->$id_madre == $hojaVida->$id_madre) ? 'selected' : '' ?> value="</?php echo $hojaVida->$id_madre ?>">
              </?php echo $hojaVida->$id_madre ?>
            </option>
          </?php endforeach; ?>
        </select>
      </div>
    </div>-->

<!-- no utilizar esto esta mas elaborado -->
<!--    <div class="form-group <//?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<//?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true) ?>" class="control-label col-xs-3"><//?php echo i18n::__('mother') ?>:</label>
      <div class="col-xs-9">
        <input id="<//?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true) ?>" class="form-control" value="<//?php echo ((isset($objHojaVida) == true) ? $objHojaVida[0]->$id_madre : '') ?><//?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true)) === true) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true)) : '' ?>" type="text" name="<//?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true) ?>">
        <//?php if (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <//?php endif ?>
      </div>
    </div>   -->


    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objHojaVida)) ? 'update' : 'register')) ?>">

    <button type="button" class="btn btn-info" > <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>"><?php echo i18n::__('return') ?> </a> </button>
</form>
</div>
