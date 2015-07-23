<?php

use mvc\interfaces\detalleEntradalerActionInterface;
use mvc\detalleEntradaler\detalleEntradalerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {/* se grago el and resquest etc.. */
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {



        $idsToDelete = request::getInstance()->getPost('chk');


        foreach ($idsToDelete as $id) {
          $ids = array(
              detalleEntradaTableClass::ID => $id
          );
          detalleEntradaTableClass::delete($ids, true);
        }
        /* session para  mensaje */
        session::getInstance()->setSuccess('elementos eliminados');
//        session::getInstance()->setSucces();


        routing::getInstance()->redirect('detalle', 'index');
      } else {
        routing::getInstance()->redirect('detalle', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
