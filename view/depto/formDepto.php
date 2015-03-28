<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $idDepto = deptoTableClass::ID ?>
<?php $nomDepto = deptoTableClass::NOM_DEPTO ?>



<!--esto es boostrap no te el olvides de cerrar el div-->
<div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->
    <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('depto', ((isset($objDepto)) ? 'updateDepto' : 'createDepto' )) ?>">
  <?php if(isset($objDepto) == true): ?>
  <input name="<?php echo deptoTableClass::getNameField(deptoTableClass::ID,true) ?>" value="<?php echo $objDepto[0]->$idDepto ?>" type="hidden">
  <?php endif ?>
    
    
        <div class="form-group">
            <label for="nom_ciudad" class="control-label col-xs-3"><?php echo i18n::__('name_dept') ?>:</label>

            <div class="col-xs-9"><input id="nom_depto" class="form-control" value="<?php echo ((isset($objDepto) == true) ? $objDepto[0]->$nomDepto : '') ?>" type="text" name="<?php echo deptoTableClass::getNameField(deptoTableClass::NOM_DEPTO, true) ?>"> </div>
        </div>

        <br>
 
 <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objDepto)) ? 'update' : 'register')) ?>">
 
 <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/depto"><?php echo i18n::__('return') ?> </a>
 


    </form>
</div>

