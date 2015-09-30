<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\view\viewClass as view;
use mvc\validator\ciudadValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class updateCiudadActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::ID, true));
        $nom_ciudad = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true));
        $deptoId = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true));

        // $this->Validate($nom_ciudad);

        validator::validateEdit();

        $ids = array(
            ciudadTableClass::ID => $id
        );

        $data = array(
            ciudadTableClass::NOM_CIUDAD => $nom_ciudad,
            ciudadTableClass::DEPTO_ID => $deptoId
        );
        ciudadTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('proveedor', 'editCiudad');
      } else {
        routing::getInstance()->redirect('proveedor', 'editCiudad');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('proveedor', 'editCiudad');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

// VALIDACIONES
//  private function Validate($nom_ciudad) {
//    $pom = false;
//    if (strlen($nom_ciudad) > ciudadTableClass::NOM_CIUDAD_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => ciudadTableClass::NOM_CIUDAD_LENGTH)));
//      $pom = true;
//      session::getInstance()->setFlash(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, TRUE), TRUE);
//    }
//
//    if (!ereg("^[A-Z a-z_]*$", $nom_ciudad)) {
//      session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $nom_ciudad)));
//      $pom = true;
//      session::getInstance()->setFlash(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, TRUE), TRUE);
//    }
//
//    if ($nom_ciudad === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $pom = true;
//      session::getInstance()->setFlash(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, TRUE), TRUE);
//    }
//
//    if ($pom === true) {
//      request::getInstance()->setMethod('GET');
//      request::getInstance()->addParamGet(array(ciudadTableClass::ID => request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::ID, true))));
//      routing::getInstance()->forward('proveedor', 'editCiudad');
//    }
//  }
}
