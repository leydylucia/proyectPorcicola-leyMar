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
 *@category modulo insumo
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com>
 */
class verInsumoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                insumoTableClass::ID,
                insumoTableClass::DESC_INSUMO,
                insumoTableClass::PRECIO,
                insumoTableClass::TIPO_INSUMO_ID,
                insumoTableClass::FECHA_FABRICACION,
                insumoTableClass::FECHA_VENCIMIENTO,
                insumoTableClass::PROVEEDOR_ID,
                insumoTableClass::CREATED_AT
            );
            $where = array(
                insumoTableClass::ID => request::getInstance()->getRequest(insumoTableClass::ID)
            );
            $this->objInsumo = insumoTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('ver', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
