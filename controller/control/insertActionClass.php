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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . controlTableClass::getNameTable())) {
        $this->control = session::getInstance()->getAttribute('form_' . controlTableClass::getNameTable());
      }
      
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


      
      $this->defineView('insert', 'control', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}