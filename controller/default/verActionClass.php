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
 *@category modulo default"usuario"
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com>
 */
class verActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fields = array(
                usuarioTableClass::ID,
                usuarioTableClass::USER,
                usuarioTableClass::CREATED_AT
            );
            $where = array(
                usuarioTableClass::ID => request::getInstance()->getRequest(usuarioTableClass::ID)
            );
            $this->objUsuario = usuarioTableClass::getAll($fields, true, null, null, null, nULL, $where);
            $this->defineView('ver', 'default', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}