<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class verProvActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                proveedorTableClass::ID,
            proveedorTableClass::NOMBRE,
            proveedorTableClass::APELLIDO,
            proveedorTableClass::DIRECCION,
            proveedorTableClass::CORREO,
            proveedorTableClass::TELEFONO,
            proveedorTableClass::CIUDAD_ID,
            proveedorTableClass::CREATED_AT
            );
            $where = array(
            proveedorTableClass::ID => request::getInstance()->getRequest(proveedorTableClass::ID)
            );
            $this->objProveedor = proveedorTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('verProv', 'proveedor', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
