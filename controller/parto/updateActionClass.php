<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::ID, true));
        $fecha_nacimiento = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true));
        $num_nacidos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true));
        $num_vivos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true));
        $num_muertos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true));
        $num_hembras = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true));
        $num_machos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true));
        $fecha_montada = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true));
        $id_padre = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::ID_PADRE, true));
        $hoja_vida_id = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, true));

        $this->Validate($num_nacidos, $num_vivos, $num_muertos, $num_hembras, $num_machos);

        $ids = array(
            partoTableClass::ID => $id
        );

        $data = array(
            partoTableClass::FECHA_NACIMIENTO => $fecha_nacimiento,
            partoTableClass::NUM_NACIDOS => $num_nacidos,
            partoTableClass::NUM_VIVOS => $num_vivos,
            partoTableClass::NUM_MUERTOS => $num_muertos,
            partoTableClass::NUM_HEMBRAS => $num_hembras,
            partoTableClass::NUM_MACHOS => $num_machos,
            partoTableClass::FECHA_MONTADA => $fecha_montada,
            partoTableClass::ID_PADRE => $id_padre,
            partoTableClass::HOJA_VIDA_ID => $hoja_vida_id
        );

        partoTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('parto', 'edit');
      } else {
        routing::getInstance()->redirect('parto', 'edit');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('parto', 'edit');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

  // VALIDACIONES
  private function Validate($num_nacidos, $num_vivos, $num_muertos, $num_hembras, $num_machos) {
    $be = false;
    
    if ($num_nacidos === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $be = true;
      session::getInstance()->setFlash(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, TRUE), TRUE);
    }

    if ($num_vivos === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $be = true;
      session::getInstance()->setFlash(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, TRUE), TRUE);
    }

    if ($num_muertos === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $be = true;
      session::getInstance()->setFlash(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, TRUE), TRUE);
    }

    if ($num_hembras === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $be = true;
      session::getInstance()->setFlash(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, TRUE), TRUE);
    }

    if ($num_machos === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $be = true;
      session::getInstance()->setFlash(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, TRUE), TRUE);
    }

    if ($be === true) {
      request::getInstance()->setMethod('GET');
      request::getInstance()->addParamGet(array(partoTableClass::ID => request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::ID, true))));
      routing::getInstance()->forward('parto', 'edit');
    }
  }

}
