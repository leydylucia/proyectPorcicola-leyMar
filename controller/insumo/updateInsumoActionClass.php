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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateInsumoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, true));
                $desc_insumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true));
                $precio = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRECIO, true));
                $tipoInsumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true));
                $fechaFabricacion = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true));
                $fechaVencimiento = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true));
                $proveedorId = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, true));

                $ids = array(
                    insumoTableClass::ID => $id
                );
$this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);
                $data = array(
                    insumoTableClass::DESC_INSUMO => $desc_insumo,
                    insumoTableClass::PRECIO => $precio,
                    insumoTableClass::TIPO_INSUMO_ID => $tipoInsumo,
                    insumoTableClass::FECHA_FABRICACION => $fechaFabricacion,
                    insumoTableClass::FECHA_VENCIMIENTO => $fechaVencimiento,
                    insumoTableClass::PROVEEDOR_ID => $proveedorId,
                );

                insumoTableClass::update($ids, $data);
            }

            routing::getInstance()->redirect('insumo', 'indexInsumo');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
    
     static public function Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento) {
        $flag = false;
        if (strlen($desc_insumo) > insumoTableClass::DESC_INSUMO_LENGTH) {
            session::getInstance()->setError(i18n::__('errorLength', null, 'default', array('%insumo%' => $desc_insumo, '%caracteres%' => insumoTableClass::DESC_INSUMO_LENGTH)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true), true);
        }

        if (!ereg("^[A-Z a-z_]*$", $desc_insumo)) {
            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $desc_insumo)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, TRUE), TRUE);
        }

        if (!is_numeric($precio)) {//validacion de numeros
            session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true), true);
        }

        if ($desc_insumo === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true), true);
        }

        if ($precio === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true), true);
        }
        if ($fechaFabricacion === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }
        if ($fechaVencimiento === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }



        if ($flag === true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('insumo', 'updateInsumo');
        }
    }

}
