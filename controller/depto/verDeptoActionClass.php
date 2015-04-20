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
class verDeptoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                deptoTableClass::ID,
            deptoTableClass::NOM_DEPTO,
            deptoTableClass::CREATED_AT
            );
            $where = array(
            deptoTableClass::ID => request::getInstance()->getRequest(deptoTableClass::ID)
            );
            $this->objDepto = deptoTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('verDepto', 'depto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
