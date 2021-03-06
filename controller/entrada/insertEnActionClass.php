<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insertActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de insertar datos
 *
 * *@author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo entrada
 */
class insertEnActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . entradaTableClass::getNameTable())) {
        $this->entrada = session::getInstance()->getAttribute('form_' . entradaTableClass::getNameTable());
      }
      /* fields para foraneas */
      $fieldsE = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE,
          empleadoTableClass::APELLIDO
      );
      $orderByE = array(
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsE, true, $orderByE, 'ASC');


      /* fields para foraneas */
      $fields = array(
          proveedorTableClass::ID,
          proveedorTableClass::NOMBRE,
          proveedorTableClass::APELLIDO
      );
      $orderBy = array(
          proveedorTableClass::NOMBRE
      );
      $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');


      $this->defineView('insert', 'entrada', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
