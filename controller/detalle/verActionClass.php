<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of verInsumoActionClass  sirve para ver un dato en la grilla
 * @category modulo insumo
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com>
 */
class verActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                detalleEntradaTableClass::ID,
                detalleEntradaTableClass::CANTIDAD,
                detalleEntradaTableClass::VALOR,
                detalleEntradaTableClass::ENTRADA_BODEGA_ID,
                detalleEntradaTableClass::INSUMO_ID,
                detalleEntradaTableClass::UNIDAD_MEDIDA_ID,
                detalleEntradaTableClass::CREATED_AT,
            );
            $where = array(
                detalleEntradaTableClass::ID => request::getInstance()->getRequest(detalleEntradaTableClass::ID)
            );
            $this->objDetalle = detalleEntradaTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->detalleEntradaId = request::getInstance()->getGet(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true));
            $this->defineView('ver', 'detalle', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
