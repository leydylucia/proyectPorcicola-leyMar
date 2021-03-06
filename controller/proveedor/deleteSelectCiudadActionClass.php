<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of deleteSelectCiudadActionClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo proveedor
 */
class deleteSelectCiudadActionClass extends controllerClass implements controllerActionInterface {

  /**
   * * @return $idsToDelete => permite hacer un borrado masivo con el checkList 
   * Todas estos datos se pasan en la variable @var $data 
   * * 
   * */
  public function execute() {
    try {/* se grago el and resquest etc.. */
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {



        $idsToDelete = request::getInstance()->getPost('chk');


        foreach ($idsToDelete as $id) {
          $ids = array(
              ciudadTableClass::ID => $id
          );
          ciudadTableClass::delete($ids, true);
        }
        /* session para  mensaje */
        session::getInstance()->setSuccess('elementos eliminados');
//        session::getInstance()->setSucces();


        routing::getInstance()->redirect('proveedor', 'indexCiudad');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexCiudad');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
