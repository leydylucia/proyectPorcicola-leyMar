<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class insertProvActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . proveedorTableClass::getNameTable())) {
        $this->proveedor = session::getInstance()->getAttribute('form_' . proveedorTableClass::getNameTable());
      }
      /* fields para foraneas */
      $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOM_CIUDAD
      );
      $orderBy = array(
          ciudadTableClass::NOM_CIUDAD
      );
      $this->objCiudad = ciudadTableClass::getAll($fields, true, $orderBy, 'ASC');


      $this->defineView('insert', 'proveedor', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
