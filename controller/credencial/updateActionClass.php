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
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID, true));
        $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));

       // $this->Validate($nombre);
        
        validator::validateEdit();

        $ids = array(
            credencialTableClass::ID => $id
        );

        $data = array(
            credencialTableClass::NOMBRE => $nombre,
        );

        credencialTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('credencial', 'index');
      } else {
        routing::getInstance()->redirect('credencial', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('credencial', 'update');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

  // VALIDACIONES
//  private function Validate($nombre) {
//    $pez = false;
//    if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => credencialTableClass::NOMBRE_LENGTH)));
//      $pez = true;
//      session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
//    }
//
//
//    if (!ereg("^[A-Z a-z_]*$", $nombre)) {
//      session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $nombre)));
//      $pez = true;
//      session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
//    }
//
//    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
//    if ($nombre === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $pez = true;
//      session::getInstance()->setFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE), TRUE);
//    }
//
//
//    if ($pez === true) {
//      request::getInstance()->setMethod('GET');
//      request::getInstance()->addParamGet(array(credencialTableClass::ID => request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID, true))));
//      routing::getInstance()->forward('credencial', 'edit');
//    }
//  }

}
