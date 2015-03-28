<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class editProvActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(proveedorTableClass::ID)) {
        $fields = array(
            proveedorTableClass::ID,
            proveedorTableClass::NOMBRE,
            proveedorTableClass::APELLIDO,
            proveedorTableClass::DIRECCION,
            proveedorTableClass::CORREO,
            proveedorTableClass::TELEFONO,
            proveedorTableClass::CIUDAD_ID
        );

        $where = array(
            proveedorTableClass::ID => request::getInstance()->getRequest(proveedorTableClass::ID)
        );
        $this->objProveedor = proveedorTableClass::getAll($fields, true, null, null, null, null, $where);
        // para editar foraneas
         $fields = array(
            ciudadTableClass::ID,
            ciudadTableClass::NOM_CIUDAD
            );
            $orderBy = array(
           ciudadTableClass::NOM_CIUDAD
            );
            $this->objCiudad = ciudadTableClass::getAll($fields, true , $orderBy,'ASC');
            //fin
        $this->defineView('edit', 'proveedor', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexProv');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
