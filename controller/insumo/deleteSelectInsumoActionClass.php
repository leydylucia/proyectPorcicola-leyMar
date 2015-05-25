<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;

use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
/**
 * Description of ejemploClass
 *@class deleteSelectInsumoActionClass borrado en masa
 * @author leydy lucia castillo mosquera
 *  @category modulo insumo
 */
class deleteSelectInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk'))  {
          
          
        
        $idsToDelete = request::getInstance()->getPost('chk');/*@ $idsToDelete para el borrado en masa y chk para la seleccion*/
        
        
        foreach ($idsToDelete as $id) {
          $ids = array(
          insumoTableClass::ID => $id
          );
          insumoTableClass::delete($ids, true);
        }
        /*session para  mensaje*/
        session::getInstance()->setSuccess('los Elementos seleccionas fueron eliminados con exito');
//        session::getInstance()->setSucces();
        
        
        routing::getInstance()->redirect('insumo', 'indexInsumo');
      } else {
        routing::getInstance()->redirect('insumo', 'indexInsumo');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
