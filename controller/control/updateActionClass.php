<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\controlValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::ID, true));
        $peso_cerdo = request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true));
        $empleado_id = request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::EMPLEADO_ID, true));
        $hoja_vida_id = request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::HOJA_VIDA, true));


        //$this->Validate($peso_cerdo);
        
        validator::validateEdit();

        $ids = array(
            controlTableClass::ID => $id
        );

        $data = array(
            controlTableClass::PESO_CERDO => $peso_cerdo,
            controlTableClass::EMPLEADO_ID => $empleado_id,
            controlTableClass::HOJA_VIDA => $hoja_vida_id
        );

        controlTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('control', 'index');
      } else {
        routing::getInstance()->redirect('control', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('control', 'update');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

  // VALIDACIONESS
//  private function Validate($peso_cerdo) {
//    if (!is_numeric($peso_cerdo)) {
//      session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
//      $luz = true;
//      session::getInstance()->setFlash(controlTableClass::getNameField(controlTableClass::PESO_CERDO, TRUE), TRUE);
//    }
//
//    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
//    if ($peso_cerdo === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $luz = true;
//      session::getInstance()->setFlash(controlTableClass::getNameField(controlTableClass::PESO_CERDO, TRUE), TRUE);
//    }
//
//    if ($luz === true) {
//      request::getInstance()->setMethod('GET');
//      request::getInstance()->addParamGet(array(controlTableClass::ID => request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::ID, true))));
//      routing::getInstance()->forward('control', 'edit');
//    }
//  }

}
