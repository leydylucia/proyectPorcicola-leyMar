<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\sacrificioVentaValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 * @category modulo sacrificio venta
 * @author leydy lucia castillo mosquera
 */
class updateSacrificioVentaActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @var $valor=> valor
     * @var $tipoVenta=> tipo venta
     * @var $idCerdo=> id cerdo
     * @var $id=> id de la tabla

     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $valor = trim(request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true)));
                $tipoVenta = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true));
                $idCerdo = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true));
                $id = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true));
                $cantidad = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CANTIDAD, true));
                $unidad_medida = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::UNIDAD_MEDIDA_ID, true));

//                $this->Validate($valor, $idCerdo);/*@ $this->validate para validar campos*/
                validator::validateEdit();
                $ids = array(
                    sacrificiovTableClass::ID => $id
                );

                $data = array(
                    sacrificiovTableClass::VALOR => $valor,
                    sacrificiovTableClass::TIPO_VENTA_ID => $tipoVenta,
                    sacrificiovTableClass::ID_CERDO => $idCerdo,
                    sacrificiovTableClass::CANTIDAD => $cantidad,
                    sacrificiovTableClass::UNIDAD_MEDIDA_ID => $unidad_medida,
                );

                sacrificiovTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Registro se modifico con  Exitoso');
                routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
            } else {

                routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->forward('sacrificioVenta', 'editSacrificioVenta');
            session::getInstance()->setFlash('exc', $exc);
        }
    }

    /* @ function para validar campos de formulario */
//static public function Validate($valor,$idCerdo) {
//        $flag = false;
//        
//        if (!is_numeric($valor)) {//validacion de numeros
//            session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true), true);
//        }
//
//
//        if ($valor === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true), true);
//        }
//        if ($idCerdo === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true), true);
//        }
//       
//
//         if ($flag === true) {
//            request::getInstance()->setMethod('GET');
//            request::getInstance()->addParamGet(array(sacrificiovTableClass::ID => request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true))));
//            routing::getInstance()->forward('sacrificioVenta', 'editSacrificioVenta');
//        }
//    }
}
