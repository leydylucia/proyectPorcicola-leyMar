<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
//use mvc\config\myConfigClass as config;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\defaultValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

/**
 *  Description of updateActionClass esta clase sirve para 
 *  el update carge datos de la tabla y cumple con la funcion de modificar
 * @category modulo default "usuario"
 * @author leydy lucia castillo
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
                $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));

                if (request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true))) {
                    $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
                }

                $ids = array(
                    usuarioTableClass::ID => $id
                );

//                $this->Validate($usuario);
                validator::validateEdit();

                $data = array(
                usuarioTableClass::USER => $usuario,
//                usuarioTableClass::PASSWORD => $password
                usuarioTableClass::PASSWORD => md5($pass1)
                );

                usuarioTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Registro se modifico con  Exitoso');
                routing::getInstance()->redirect('default', 'index');
            }else{

            routing::getInstance()->redirect('default', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

//    private function Validate($usuario) {
//        $flag = false;
//        if (strlen($usuario) > usuarioTableClass::USER_LENGTH) {
//            session::getInstance()->setError(i18n::__(00004, null, 'errors', array('%user%' => $usuario, '%caracteres%' => usuarioTableClass::USER_LENGTH)));
//            $flag = true;
//            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
//        }
//
////         if (!ereg("^[A-Z a-z_]*$", $usuario)) {//validacion de tan solo letras
////            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $usuario)));
////            $flag = true;
////            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, TRUE), TRUE);
////        }
//
//        if ($usuario === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
//        }
////      if ($usuario === $usuario) {// validacion de campo vacio
////            session::getInstance()->setError(i18n::__(23505, null, 'errors', array('%user%' => $usuario)));
////            $flag = true;
////            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
////        }
//
//
//        if ($flag === true) {
//            request::getInstance()->setMethod('GET');
//            request::getInstance()->addParamGet(array(usuarioTableClass::ID => request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true))));
//            routing::getInstance()->forward('default', 'edit');
//        }
//    }
}
