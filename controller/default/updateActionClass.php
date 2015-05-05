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
 * @author leydy lucia castillo mosquera<leydylucia@hotmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
        $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
        $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));

        $ids = array(
            usuarioTableClass::ID => $id
        );

        $this->Validate($user, $pass1, $pass2);
        
        $data = array(
            usuarioTableClass::USER => $usuario,
            usuarioTableClass::PASSWORD => $password
        );

        usuarioTableClass::update($ids, $data);
      }

      routing::getInstance()->redirect('default', 'index');
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }
private function Validate($user, $pass1, $pass2) {
        $flag = false;
        if (strlen($user) > usuarioTableClass::USER_LENGTH) {
            session::getInstance()->setError(i18n::__(00004, null, 'errors', array('%user%' => $user, '%caracteres%' => usuarioTableClass::USER_LENGTH)));
            $flag = true;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
        }
        
         if (!ereg("^[A-Z a-z_]*$", $user)) {//validacion de tan solo letras
            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $user)));
            $flag = true;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, TRUE), TRUE);
        }
        
          if ($user === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
        }

        if ($pass1 !== $pass2) {
            session::getInstance()->setError(i18n::__(00005, null, 'errors'));
            $flag = true;
            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true), true);
        }
        if ($flag === true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('default', 'insert');
        }
    }

}
