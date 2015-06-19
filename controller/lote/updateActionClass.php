<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\loteValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true));
        $desc_lote = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true));
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        
        //$this->Validate($desc_lote, $ubicacion);
        
        validator::validateEdit();
        
        $ids = array(
        loteBaseTableClass::ID => $id
        );

        $data = array(
            loteTableClass::DESC_LOTE => $desc_lote,
            loteTableClass::UBICACION => $ubicacion,
        );

        loteTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('lote', 'index');
      } else {
        routing::getInstance()->redirect('lote', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('lote', 'update');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

  // VALIDACIONES
//  private function Validate($desc_lote, $ubicacion) {
//    $te = false;
//    if (strlen($desc_lote) > loteTableClass::DESC_LOTE_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => loteTableClass::DESC_LOTE_LENGTH)));
//      $te = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, TRUE), TRUE);
//    }
//
//    if (strlen($ubicacion) > loteTableClass::UBICACION_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => loteTableClass::UBICACION_LENGTH)));
//      $te = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::UBICACION_LENGTH, TRUE), TRUE);
//    }
//
//    if (!ereg("^[A-Z a-z_]*$", $desc_lote)) {
//      session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $desc_lote)));
//      $te = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::UBICACION, TRUE), TRUE);
//    }
//
//    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
//    if ($desc_lote === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $te = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, TRUE), TRUE);
//    }
//
//    if ($ubicacion === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $te = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::UBICACION, TRUE), TRUE);
//    }
//
//    if ($te === true) {
//      request::getInstance()->setMethod('GET');
//      request::getInstance()->addParamGet(array(loteTableClass::ID => request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::ID, true))));
//      routing::getInstance()->forward('lote', 'edit');
//    }
//  }

}
