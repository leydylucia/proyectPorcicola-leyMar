<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description esta cumple una funcion es para el eliminado en masa
 *
 * @author Alexandra Florez
 * @category modulo credencial
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {/* se grago el and resquest etc.. */
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {



        $idsToDelete = request::getInstance()->getPost('chk');/*el chk es para escojer varios dator por medio del cheklist*/


        foreach ($idsToDelete as $id) {
          $ids = array(
              credencialTableClass::ID => $id
          );
          credencialTableClass::delete($ids, true);
        }
        /* session para  mensaje */
        session::getInstance()->setSuccess('elementos eliminados');
//        session::getInstance()->setSucces();


        routing::getInstance()->redirect('credencial', 'index');
      } else {
        routing::getInstance()->redirect('credencial', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
