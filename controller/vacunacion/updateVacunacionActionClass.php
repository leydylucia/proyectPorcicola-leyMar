<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\vacunacionValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 * @category modulo vacunacion
 * @author leydy lucia castillo
 * 
 */
class updateVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::ID, true));
                $dosis = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true));
//                $hora = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true));
                $insumoId = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::INSUMO_ID, true));
                $idCerdo = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true));

//$this->Validate($dosis, $hora,$insumoId); /* @ $this->validate para validar campos */
                validator::validateEdit();
                $ids = array(
                    vacunacionTableClass::ID => $id
                );

                $data = array(
                    vacunacionTableClass::DOSIS => $dosis,
//                    vacunacionTableClass::HORA => $hora,
                    vacunacionTableClass::INSUMO_ID => $insumoId,
                    vacunacionTableClass::ID_CERDO => $idCerdo,
                );

                vacunacionTableClass::update($ids, $data);
                routing::getInstance()->redirect('vacunacion', 'editVacunacion');
            } else {
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
                routing::getInstance()->redirect('vacunacion', 'editVacunacion');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->forward('vacunacion', 'editVacunacion');
            session::getInstance()->setFlash('exc', $exc);
        }
    }

//    private function Validate($dosis, $hora, $insumoId) {
//        $flag = false;
//        if (strlen($dosis) > vacunacionTableClass::DOSIS_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorLength', null, 'default', array('%insumo%' => $dosis, '%caracteres%' => vacunacionTableClass::DOSIS_LENGTH)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true), true);
//        }
//
//
//
//
//        if ($dosis === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true), true);
//        }
//
//        if ($hora === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true), true);
//        }
//
////        if ($insumoId === '') {// validacion de campo vacio
////            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
////            $flag = true;
////            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::INSUMO_ID, true), true);
////        }
//
//
//        if ($flag === true) {
//            request::getInstance()->setMethod('GET');
//            request::getInstance()->addParamGet(array(vacunacionTableClass::ID => request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::ID, true))));
//            routing::getInstance()->forward('vacunacion', 'editVacunacion');
//        }
//    }

}
