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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(controlTableClass::ID)) {
        $fields = array(
            controlTableClass::ID,
            controlTableClass::PESO_CERDO,
            controlTableClass::EMPLEADO_ID
        );

        $where = array(
            controlTableClass::ID => request::getInstance()->getRequest(controlTableClass::ID)
        );
        $this->objControl = controlTableClass::getAll($fields, true, null, null, null, null, $where);
        
        // para editar foraneas
        $fieldsA = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $orderByA = array(
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsA, true, $orderByA, 'ASC');
        //fin
        
        // para editar foraneas
        $fields = array(
        hojaVidaTableClass::ID
        );
        $orderBy = array(
            hojaVidaTableClass::ID
        );
        $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        $this->defineView('edit', 'control', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('control', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
