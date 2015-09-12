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
      if (session::getInstance()->hasAttribute('form_' . partoTableClass::getNameTable())) {
        $this->parto = session::getInstance()->getAttribute('form_' . partoTableClass::getNameTable());
      }
      // para editar foraneas tabla estado
        $fields = array(
        hojaVidaTableClass::ID,
        hojaVidaTableClass::NOMBRE_CERDO
        );
        $orderBy = array(
            hojaVidaTableClass::NOMBRE_CERDO
        );
        $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        
      
      $this->defineView('insert', 'parto', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
