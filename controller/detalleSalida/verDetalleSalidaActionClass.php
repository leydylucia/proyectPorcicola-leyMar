<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of verInsumoActionClass  sirve para ver un dato en la grilla
 * @category modulo insumo
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com>
 */
class verDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                detalleSalidaTableClass::ID,
                detalleSalidaTableClass::CANTIDAD,
                detalleSalidaTableClass::SALIDA_BODEGA_ID,
                detalleSalidaTableClass::INSUMO_ID,
                detalleSalidaTableClass::CREATED_AT,
            );
            $where = array(
                detalleSalidaTableClass::ID => request::getInstance()->getRequest(detalleSalidaTableClass::ID)
            );
            $this->objDetalleSalida = detalleSalidaTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('verDetalleSalida', 'detalleSalida', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
