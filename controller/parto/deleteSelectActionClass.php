<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description esta cumple una funcion es para el eliminado en masa
 *
 * @author Alexandra Florez
 * @category modulo parto
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        
        $idsToDelete = request::getInstance()->getPost('chk');/*el chk es para escojer varios dator por medio del cheklist*/
        
        foreach ($idsToDelete as $id) {
          $ids = array(
            partoTableClass::ID => $id
          );
          partoTableClass::delete($ids, true);
        }
        
        routing::getInstance()->redirect('parto', 'index');
      } else {
        routing::getInstance()->redirect('parto', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
