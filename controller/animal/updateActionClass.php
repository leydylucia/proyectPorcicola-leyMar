<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\animalValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true));
        $genero = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true));
        $fecha_nacimiento = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true));
        $estado_id = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, true));
        $lote_id = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, true));
        $raza_id = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, true));
        $id_madre = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true));


 //       $this->Validate($genero, $id_madre);
        
        validator::validateEdit();

        $ids = array(
            hojaVidaTableClass::ID => $id
        );

        $data = array(
            hojaVidaTableClass::GENERO => $genero,
            hojaVidaTableClass::FECHA_NACIMIENTO => $fecha_nacimiento,
            hojaVidaTableClass::ESTADO_ID => $estado_id,
            hojaVidaTableClass::LOTE_ID => $lote_id,
            hojaVidaTableClass::RAZA_ID => $raza_id,
            hojaVidaTableClass::ID_MADRE => $id_madre
        );

        hojaVidaTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('animal', 'index');
      } else {
        routing::getInstance()->redirect('animal', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('animal', 'update');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

  // VALIDACIONES
//  private function Validate($genero, $id_madre) {
//    $je = false;
//    if (strlen($genero) > hojaVidaTableClass::GENERO_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => hojaVidaTableClass::GENERO_LENGTH)));
//      $je = true;
//      session::getInstance()->setFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, TRUE), TRUE);
//    }
//
//    if (!is_numeric($id_madre)) {
//      session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
//      $je = true;
//      session::getInstance()->setFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, TRUE), TRUE);
//    }
//
//    if (!ereg("^[A-Z a-z_]*$", $genero)) {
//      session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $genero)));
//      $je = true;
//      session::getInstance()->setFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, TRUE), TRUE);
//    }
//
//    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
//    if ($genero === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $je = true;
//      session::getInstance()->setFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, TRUE), TRUE);
//    }
//
//    if ($id_madre === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $je = true;
//      session::getInstance()->setFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, TRUE), TRUE);
//    }
//    if ($je === true) {
//      request::getInstance()->setMethod('GET');
//      request::getInstance()->addParamGet(array(hojaVidaTableClass::ID => request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true))));
//      routing::getInstance()->forward('animal', 'edit');
//    }
//  }

}
