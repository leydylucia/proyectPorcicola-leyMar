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
class deleteEnActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(entradaTableClass::getNameField(entradaTableClass::ID, true));
        
        $ids =  array(
            entradaTableClass::ID => $id
        );
        entradaTableClass::delete($ids, true);/*el true es para el borrado logico false si no lo tiene*/
        //routing::getInstance()->redirect('parto', 'index');
        $this->arrayAjax=array(
           'code'=>200,
           'msg' =>'la eliminacion fue exitosa'
            
        );
        $this->defineView('deleteEn', 'entrada',session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('Registro Exitoso');
      } else {
        routing::getInstance()->redirect('entrada', 'indexEn');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
