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
 * @category modulo usuarioCredencial
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com>
 */
class verSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                salidaBodegaTableClass::ID,
                salidaBodegaTableClass::EMPLEADO_ID,
                salidaBodegaTableClass::CREATED_AT
            );
            $where = array(
                salidaBodegaTableClass::ID => request::getInstance()->getRequest(salidaBodegaTableClass::ID)
            );
            $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('verSalidaBodega', 'salidaBodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
