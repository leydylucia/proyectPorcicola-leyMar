<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description esta funcion es para el eliminado en masa
 *
 * @author Alexandra Florez
 * @category modulo animal
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {/* se grago el and resquest etc.. */
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {



        $idsToDelete = request::getInstance()->getPost('chk'); /* chk para seleccionar con el cheklist */


        foreach ($idsToDelete as $id) {
          $ids = array(
              hojaVidaTableClass::ID => $id
          );
          hojaVidaTableClass::delete($ids, true);
        }
        /* session para  mensaje */
        session::getInstance()->setSuccess('elementos eliminados');
//        session::getInstance()->setSucces();


        routing::getInstance()->redirect('animal', 'index');
      } else {
        routing::getInstance()->redirect('animal', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
