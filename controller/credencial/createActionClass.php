<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\credencialValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 *  Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo credencial
 */
class createActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $nombre=> nombre del a credencial (string)

   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));

        //$this->Validate($nombre);

        validator::validateInsert(); /* para validas los campos de la tabla y se redirige al validator */

        /** @return $data recorre el campo  o campos seleccionados de la tabla deseada* */
        $data = array(
            credencialTableClass::NOMBRE => $nombre,
        );

        credencialTableClass::insert($data);

        session::getInstance()->setSuccess('Registro Exitoso');

        log::register('insertar', credencialTableClass::getNameTable());

        routing::getInstance()->redirect('credencial', 'index');
      } else {
        routing::getInstance()->redirect('credencial', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('credencial', 'insert');
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
