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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          controlTableClass::ID,
          controlTableClass::UNIDAD_MEDIDA_ID,
          controlTableClass::PESO_CERDO,
          controlTableClass::EMPLEADO_ID,
          controlTableClass::HOJA_VIDA,
          controlTableClass::CREATED_AT
      );
      $where = array(
          controlTableClass::ID => request::getInstance()->getRequest(controlTableClass::ID)
      );
      $this->objControl = controlTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('ver', 'control', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
