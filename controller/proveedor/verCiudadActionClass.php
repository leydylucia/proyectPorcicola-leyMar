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
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com.com>
 */
class verCiudadActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                ciudadTableClass::ID,
            ciudadTableClass::NOM_CIUDAD,
            ciudadTableClass::DEPTO_ID,
            ciudadTableClass::CREATED_AT
            );
            $where = array(
            ciudadTableClass::ID => request::getInstance()->getRequest(ciudadTableClass::ID)
            );
            $this->objCiudad = ciudadTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('verCiudad', 'proveedor', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
