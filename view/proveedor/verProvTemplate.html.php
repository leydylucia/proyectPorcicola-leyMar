

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $nombre = proveedorTableClass::NOMBRE ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $correo = proveedorTableClass::CORREO ?>
<?php $telefono = proveedorTableClass::TELEFONO ?>
<?php $ciudad_id = proveedorTableClass::CIUDAD_ID ?>
<?php $nom_ciudad = ciudadTableClass::NOM_CIUDAD ?>
<?php $created_at = proveedorTableClass::CREATED_AT ?>

<div class="container container-fluid">


        <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexProv') ?>"><?php echo i18n::__('return') ?> </a>

    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        
                        <th>datos de proveedor</th>
                           
                            
                        
                    </tr>        
                </thead>
                <tbody>
                  <tr><?php foreach ($objProveedor as $proveedor): ?> </tr>
                        <tr>
                            <th><?php echo i18n::__('name') ?></th>
                            
                            <td><?php echo $proveedor->$nombre ?></td>
                            
                             <tr>
                            <th><?php echo i18n::__('lastname') ?></th>
                            
                            <td><?php echo $proveedor->$apellido ?></td>
                             <tr>
                            <th><?php echo i18n::__('direction') ?></th>
                            
                            <td><?php echo $proveedor-> $direccion ?></td>
                             <tr>
                            <th><?php echo i18n::__('email') ?></th>
                            
                            <td><?php echo $proveedor-> $correo ?></td>
                            <tr>
                            <th><?php echo i18n::__('telephone') ?></th>
                            
                            <td><?php echo $proveedor-> $telefono ?></td>
                            <tr>
                            <th><?php echo i18n::__('city_id') ?></th>
                            
                            <td><?php echo ciudadTableClass::getNameCiudad($proveedor->$ciudad_id) ?></td>
                            <tr>
                            <th><?php echo i18n::__('date_creation') ?></th>
                            <td><?php echo $proveedor->$created_at ?></td>
                             
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  