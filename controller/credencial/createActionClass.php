<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\credencialValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        
        $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
        
       //$this->Validate($nombre);
        
         validator::validateInsert(); /*para validas los campos de la tabla y se redirige al validator*/

        $data = array(
            credencialTableClass::NOMBRE => $nombre,
        );

        credencialTableClass::insert($data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('credencial', 'index');
      } else {
        routing::getInstance()->redirect('credencial', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

  // VALIDACIONES
//  private function Validate($nombre) {
//    $ca = false;
//      if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
//        session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => credencialTableClass::NOMBRE_LENGTH)));
//        $ca = true;
//        session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
//      }
//  
//      
//      // validacion string
//      if (!ereg("^[A-Z a-z_]*$", $nombre)) {
//        session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $nombre)));
//        $ca = true;
//        session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
//      }
//      
//      
//      // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
//      if ($nombre === '') {
//        session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//        $ca = true;
//        session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
//      }
//  
//      
//
//    if ($ca === true) {
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('credencial', 'insert');
//    }
//  }

}
