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
 * @category modulo lote
 */
class createActionClass extends controllerClass implements controllerActionInterface {
  
  /* public function execute inicializa las variables 
     * @var $nombre=> nombre del lote
     * @var $apellido=> apellido del lote
     * @var $direccion=> direccion del lote
     * @var $correo=> correo del lote
     * @var $telefono=> telefono del lote
     * @var $ciudad_id =>ciudad a la que pertenece el lote
     * ** */
  

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $desc_lote = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true));
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));


  //      $this->Validate($desc_lote, $ubicacion);
        
        validator::validateInsert();  /*para validas los campos de la tabla y se redirige al validator*/

        $data = array(
            loteTableClass::DESC_LOTE => $desc_lote,
            loteTableClass::UBICACION => $ubicacion,
        );

        loteTableClass::insert
                ($data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('lote', 'index');
      } else {
        routing::getInstance()->redirect('lote', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('lote', 'insert');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

   /* @ function para validar campos de formulario*/
//  private function Validate($desc_lote, $ubicacion) {
//    $as = false;
//    if (strlen($desc_lote) > loteTableClass::DESC_LOTE_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => loteTableClass::DESC_LOTE_LENGTH)));
//      $as = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, TRUE), TRUE);
//    }
//
//    if (strlen($ubicacion) > loteTableClass::UBICACION_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthLastName', null, 'default', array('%apellido%' => loteTableClass::UBICACION_LENGTH)));
//      $as = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::UBICACION, TRUE), TRUE);
//    }
//
//    
//    if (!ereg("^[A-Z a-z_]*$", $desc_lote)) {
//      session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $desc_lote)));
//      $as = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, TRUE), TRUE);
//    }
//    
//    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
//    if ($desc_lote === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $as = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, TRUE), TRUE);
//    }
//
//    if ($ubicacion === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $as = true;
//      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::UBICACION, TRUE), TRUE);
//    }
//
//    if ($as === true) {
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('lote', 'insert');
//    }
//  }

}
