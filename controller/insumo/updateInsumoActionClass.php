<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\validator\insumoValidatorClass as validator;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 *  Description of updateActionClass esta clase sirve para 
 *  el update carge datos de la tabla y cumple con la funcion de modificar
 * @category modulo insumo
 * @author leydy lucia castillo
 * 
 */
class updateInsumoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                /* public function execute inicializa las variables 
                 * @return $desc_insumo=> descripcion insumo (string)
                 * @return $precio=> precio (numerico)
                 * @return $tipoInsumo=> id tipo insumo (bigint)
                 * @return $fechaFabricacion=> fecha fabricacion(date)
                 * @return $fechaVencimiento=> fecha vencimiento(date)
                 * @return $proveedorId =>id del proveedor (bigint)
                 * todas estos datos se pasa en la varible @var $data
                 * ** */

                $id = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, true));
                $desc_insumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true));
//                $precio = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRECIO, true));
                $tipoInsumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true));
                $fechaFabricacion = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true));
                $fechaVencimiento = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true));
                $proveedorId = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, true));

//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/* @validate para inicializar varivles para validar*/
                validator::validateEdit();

                $ids = array(
                    insumoTableClass::ID => $id
                );
/**@var $data recorre los datos de la tabla en model
 
 */
                $data = array(
                    insumoTableClass::DESC_INSUMO => $desc_insumo,
//                    insumoTableClass::PRECIO => $precio,
                    insumoTableClass::TIPO_INSUMO_ID => $tipoInsumo,
                    insumoTableClass::FECHA_FABRICACION => $fechaFabricacion,
                    insumoTableClass::FECHA_VENCIMIENTO => $fechaVencimiento,
                    insumoTableClass::PROVEEDOR_ID => $proveedorId,
                );

                insumoTableClass::update($ids, $data);
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
                routing::getInstance()->redirect('insumo', 'indexInsumo');
            } else {
                
                routing::getInstance()->redirect('insumo', 'indexInsumo');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->forward('insumo', 'editInsumo');
            session::getInstance()->setFlash('exc', $exc);
        }
    }

    /* @ funcion para validar campos */
//    private function Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento) {
//        $flag = false;
//        if (strlen($desc_insumo) > insumoTableClass::DESC_INSUMO_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorLength', null, 'default', array('%insumo%' => $desc_insumo, '%caracteres%' => insumoTableClass::DESC_INSUMO_LENGTH)));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true), true);
//        }
//
//        if (!ereg("^[A-Z a-z_]*$", $desc_insumo)) {
//            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $desc_insumo)));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, TRUE), TRUE);
//        }
//
//        if (!is_numeric($precio)) {//validacion de numeros
//            session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true), true);
//        }
//
//        if ($desc_insumo === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true), true);
//        }
//
//        if ($precio === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true), true);
//        }
//        if ($fechaFabricacion === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
//        }
//        if ($fechaVencimiento === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
//        }
//
//
//
//        if ($flag === true) {
//            request::getInstance()->setMethod('GET');
//            request::getInstance()->addParamGet(array(insumoTableClass::ID => request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, true))));
//            routing::getInstance()->forward('insumo', 'editInsumo');
//        }
//    }
}
