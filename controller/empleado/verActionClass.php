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
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE,
          empleadoTableClass::USUARIO_ID,
          empleadoTableClass::TIPO_ID_ID,
          empleadoTableClass::APELLIDO,
          empleadoTableClass::DIRECCION,
          empleadoTableClass::CORREO,
          empleadoTableClass::TELEFONO,
          empleadoTableClass::CREATED_AT
      );
      $where = array(
          empleadoTableClass::ID => request::getInstance()->getRequest(empleadoTableClass::ID)
      );
      $this->objEmpleado = empleadoTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('ver', 'empleado', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
