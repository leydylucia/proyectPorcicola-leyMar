<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of verActionClass  sirve para ver un dato en la grilla 
 * @category modulo usuarioCredencial
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com>
 */
class verUsuarioCredencialActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          usuarioCredencialTableClass::ID,
          usuarioCredencialTableClass::USUARIO_ID,
          usuarioCredencialTableClass::CREDENCIAL_ID,
          usuarioCredencialTableClass::CREATED_AT
      );
      $where = array(
          usuarioCredencialTableClass::ID => request::getInstance()->getRequest(usuarioCredencialTableClass::ID)
      );
      $this->objUsuarioCredencial = usuarioCredencialTableClass::getAll($fields, false, null, null, null, nULL, $where);
      $this->defineView('verUsuarioCredencial', 'usuarioCredencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
