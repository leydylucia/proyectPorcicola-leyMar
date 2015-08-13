

<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $desc_tipoV = tipovTableClass::DESC_TIPOV ?>
<?php $id = tipovTableClass::ID ?>
<?php $created_at = tipovTableClass::CREATED_AT ?>

<div class="container container-fluid">



    <button type="button" class="btn btn-info btn-xs"><a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexTipov') ?>"><?php echo i18n::__('return') ?> </a></button>

</div>



<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>

                    <th class="info">Datos</th>

                </tr>        
            </thead>
            <tbody>
                <?php foreach ($objTipoV as $tipoV): ?>  
                    <tr >
                        <th class="active"><?php echo i18n::__('describe') ?></th>
                   
                        <td class="active"><?php echo $tipoV->$desc_tipoV ?></td>
                    </tr>

                    <tr >
                        <th class="info"><?php echo i18n::__('date_creation') ?></th>
                    
                        <td class="info"><?php echo $tipoV->$created_at ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>



        </table>    
    </div>
</div>

