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
 * @category modulo vacunacion
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com>
 */
class verVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                vacunacionTableClass::ID,
                vacunacionTableClass::DOSIS,
//                vacunacionTableClass::HORA,
                vacunacionTableClass::INSUMO_ID,
                vacunacionTableClass::ID_CERDO,
                vacunacionTableClass::CREATED_AT
            );
            $where = array(
                vacunacionTableClass::ID => request::getInstance()->getRequest(vacunacionTableClass::ID)
            );
            $this->objVacunacion = vacunacionTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('ver', 'vacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
