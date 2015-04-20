<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $idRaza = razaTableClass::ID ?>
<?php $desc_raza = razaTableClass::DESC_RAZA ?>


<!--esto es boostrap no te el olvides de cerrar el div-->
<div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->
    <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('raza', ((isset($objRaza)) ? 'update' : 'create' )) ?>">
  <?php if(isset($objRaza) == true): ?>
  <input name="<?php echo razaTableClass::getNameField(razaTableClass::ID,true) ?>" value="<?php echo $objRaza[0]->$idRaza ?>" type="hidden">
  <?php endif ?>
    
    
        <div class="form-group">
            <label for="desc_raza" class="control-label col-xs-3"><?php echo i18n::__('desc_raza') ?>:</label>

            <div class="col-xs-9"><input id="desc_raza" class="form-control" value="<?php echo ((isset($objRaza) == true) ? $objRaza[0]->$desc_raza : '') ?>" type="text" name="<?php echo razaTableClass::getNameField(razaTableClass::DESC_RAZA, true) ?>">
        </div>


        <br>
 
 <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objRaza)) ? 'update' : 'register')) ?>">
 
 <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/raza"><?php echo i18n::__('volver') ?> </a>
 


    </form>
</div>

