<?php

use mvc\inerfaces\controllerActionInerface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execue() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $desc_lote = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true));
        $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
        

        $this->Validae($desc_lote, $ubicacion);

        $data = array(
            loteTableClass::DESC_LOTE => $desc_lote,
            loteTableClass::UBICACION => $ubicacion,
        );

        loteTableClass::insert($data);

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

  // VALIDACIONES
  private function Validae($desc_lote, $ubicacion) {
    $e = false;
    if (strlen($desc_lote) > loteTableClass::DESC_LOTE_LENGTH) {
      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => loteTableClass::DESC_LOTE_LENGTH)));
      $e = true;
      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, TRUE), TRUE);
    }

    if (strlen($ubicacion) > loteTableClass::UBICACION_LENGTH) {
      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => loteTableClass::UBICACION_LENGTH)));
      $e = true;
      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::UBICACION_LENGTH, TRUE), TRUE);
    }

    if (!ereg("^[A-Z a-z_]*$", $desc_lote)) {
      session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%exto%' => $desc_lote)));
      $e = true;
      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::UBICACION, TRUE), TRUE);
    }

    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
    if ($desc_lote === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $e = true;
      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, TRUE), TRUE);
    }

    if ($ubicacion === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $e = true;
      session::getInstance()->setFlash(loteTableClass::getNameField(loteTableClass::UBICACION, TRUE), TRUE);
    }

    if ($e === true) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('lote', 'insert');
    }
  }

}
