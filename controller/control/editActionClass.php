<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

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
            controlTableClass::EMPLEADO_ID,
            controlTableClass::HOJA_VIDA,
            controlTableClass::UNIDAD_MEDIDA_ID
        );

        $where = array(
            controlTableClass::ID => request::getInstance()->getRequest(controlTableClass::ID)
        );
        $this->objControl = controlTableClass::getAll($fields, true, null, null, null, null, $where);
        
        /* fields para foraneas */
        $fieldsF = array(
            unidadMedidaTableClass::ID,
            unidadMedidaTableClass::DESCRIPCION
        );
        $orderByF = array(
            unidadMedidaTableClass::DESCRIPCION
        );
        $this->objUnidad = unidadMedidaTableClass::getAll($fieldsF, true, $orderByF, 'ASC'); 

        /* fields para foraneas */
        $fieldsA = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE,
            empleadoTableClass::APELLIDO
        );
        $orderByA = array(
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsA, true, $orderByA, 'ASC');


        /* fields para foraneas */
        $fields = array(
            hojaVidaTableClass::ID,
            hojaVidaTableClass::NOMBRE_CERDO
        );
        $orderBy = array(
            hojaVidaTableClass::NOMBRE_CERDO
        );
        $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC');


        $this->defineView('edit', 'control', session::getInstance()->getFormatOutput());

        log::register('editar', controlTableClass::getNameTable());

        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('control', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
