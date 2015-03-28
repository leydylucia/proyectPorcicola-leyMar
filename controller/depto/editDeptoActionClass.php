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
class editDeptoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(deptoTableClass::ID)) {
        $fields = array(
            deptoTableClass::ID,
            deptoTableClass::NOM_DEPTO          
        );
        $where = array(
            deptoTableClass::ID => request::getInstance()->getRequest(deptoTableClass::ID)
        );
        $this->objDepto = deptoTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('editDepto', 'depto', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('depto', 'indexDepto');
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
