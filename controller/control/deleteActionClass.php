<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of deleteActionClass
 * @author Alexandra Florez
 * 
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::ID, true));

        $ids = array(
            controlTableClass::ID => $id
        );
        controlTableClass::delete($ids, true); /* el true es para el borrado logico false si no lo tiene */
        //routing::getInstance()->redirect('parto', 'index');
        $this->arrayAjax = array(
            'code' => 200,
            'msg' => 'la eliminacion fue exitosa'
        );
        $this->defineView('delete', 'control', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('Registro Exitoso');
      } else {
        routing::getInstance()->redirect('detalle', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
