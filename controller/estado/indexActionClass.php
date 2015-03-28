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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          estadoTableClass::ID,
          estadoTableClass::DESC_ESTADO,
          estadoTableClass::CREATED_AT
      );
      $orderBy = array(
          estadoTableClass::DESC_ESTADO
      );
      $this->objEstado = estadoTableClass::getAll($fields, true, $orderBy, 'ASC');
      $this->defineView('index', 'estado', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
