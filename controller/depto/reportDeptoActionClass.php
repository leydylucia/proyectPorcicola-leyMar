<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/*
 * DESCRIPCION DE LA CLASE
 * @autor Alexandra Marcela Florez
 */

class reportDeptoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          deptoTableClass::ID,
          deptoTableClass::NOM_DEPTO,
          deptoTableClass::CREATED_AT
      );
      $this->objDepto = deptoTableClass::getAll($fields, FALSE);
      $this->defineView('indexDepto', 'depto', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
