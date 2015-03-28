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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(estadoTableClass::ID)) {
        $fields = array(
            estadoTableClass::ID,
            estadoTableClass::DESC_ESTADO,
          
        );
        $where = array(
            estadoTableClass::ID => request::getInstance()->getRequest(estadoTableClass::ID)
        );
        $this->objEstado = estadoTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('edit', 'estado', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('estado', 'index');
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
