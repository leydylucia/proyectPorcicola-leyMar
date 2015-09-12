<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\ciudadValidatorClass as validator;
//use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo proveedor
 */
class createCiudadActionClass extends controllerClass implements controllerActionInterface {
  
  /* public function execute inicializa las variables 
     * @return $nom_ciudad=> nombre de la ciudad (string)
     * @return $depto_id => departamento al que pertenece el proveedor (numeric)
     * Todas estos datos se pasan en la variable @var $data 
     * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nom_ciudad = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true));
        $depto_id = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true));

        // $this->Validate($nom_ciudad);
        
        validator::validateInsert();

         /** @return $data recorre el campo  o campos seleccionados de la tabla deseada* */
        $data = array(
            ciudadTableClass::NOM_CIUDAD => $nom_ciudad,
            ciudadTableClass::DEPTO_ID => $depto_id
        );
        ciudadTableClass::insert
                ($data);

        session::getInstance()->setSuccess('Registro Exitoso');
 
//        log::register('insertar', ciudadTableClass::getNameTable());

        routing::getInstance()->redirect('proveedor', 'indexCiudad');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexCiudad');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
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
//      routing::getInstance()->forward('proveedor', 'insertCiudad');
//    }
//  }

}
