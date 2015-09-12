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
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com.com>
 * * @category sacrificio venta
 */
class verSacrificioVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                sacrificiovTableClass::ID,
                sacrificiovTableClass::VALOR,
                sacrificiovTableClass::TIPO_VENTA_ID,
                sacrificiovTableClass::ID_CERDO,
                sacrificiovTableClass::CANTIDAD,
                sacrificiovTableClass::UNIDAD_MEDIDA_ID,
                sacrificiovTableClass::CREATED_AT
            );
            $where = array(
                sacrificiovTableClass::ID => request::getInstance()->getRequest(sacrificiovTableClass::ID)
            );
            $this->objSacrificioV = sacrificiovTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('ver', 'sacrificioVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
