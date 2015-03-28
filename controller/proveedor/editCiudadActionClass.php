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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editCiudadActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(ciudadTableClass::ID)) {
        $fields = array(
            ciudadTableClass::ID,
            ciudadTableClass::NOM_CIUDAD,
            ciudadTableClass::DEPTO_ID
                      
        );
        $where = array(
            ciudadTableClass::ID => request::getInstance()->getRequest(ciudadTableClass::ID)
        );
        $this->objCiudad = ciudadTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('editCiudad', 'proveedor', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexCiudad');
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
