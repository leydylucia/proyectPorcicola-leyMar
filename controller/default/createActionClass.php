<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
//use mvc\config\myConfigClass as config;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\defaultValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log; /* linea de la bitacora */

/**

/**
 *  Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo default"usuario"
 * 
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') === true) {
                /* public function execute inicializa las returniables 
     * @return $user=> usuario
     * @return $pass1=> password
     * @return $pass2=> password verificar contraseñas
     * * todas estos datos se pasa en la varible @var $data*/
                
                //trim para borrar los espacios en blanco del principio y del fin
                $user = trim(request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true)));
                $pass1 = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_1');
                $pass2 = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_2');

//          echo $user.'-'.$pass1.'-'.$pass2;
//           exit();   //esto es para imprimir la informacion
//                $this->Validate($user, $pass1, $pass2);
                validator::validateInsert(); 
                $data = array(
                    usuarioTableClass::USER => $user,
                    usuarioTableClass::PASSWORD => md5($pass1)
                );

                usuarioTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
                log::register('insertar', usuarioTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('default', 'index');
            } else {
                routing::getInstance()->redirect('default', 'index');
            }
//      if (request::getInstance()->isMethod('POST')) {
//
//        $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
//        $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
//
//        if (strlen($usuario) > usuarioTableClass::USER_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => usuarioTableClass::USER_LENGTH)), 00001);
//        }
//
//        $data = array(
//            usuarioTableClass::USER => $usuario,
//            usuarioTableClass::PASSWORD => md5($password)
//        );
//        usuarioTableClass::insert($data);
//        
//         session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
//         log::register('insertar',  usuarioTableClass::getNameTable());//linea de bitacora
//        routing::getInstance()->redirect('default', 'index');
//      } else {
//        routing::getInstance()->redirect('default', 'index');
//      }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

//    private function Validate($user, $pass1, $pass2) {
//        $flag = false;
//        if (strlen($user) > usuarioTableClass::USER_LENGTH) {
//            session::getInstance()->setError(i18n::__(00004, null, 'errors', array('%user%' => $user, '%caracteres%' => usuarioTableClass::USER_LENGTH)));
//            $flag = true;
//            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
//        }
//        
////         if (!ereg("^[A-Z a-z_]*$", $user)) {//validacion de tan solo letras
////            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $user)));
////            $flag = true;
////            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, TRUE), TRUE);
////        }
//        
//          if ($user === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
//        }
//
////         if ($user === $user) {// validacion de nombre repetitivo
////            session::getInstance()->setError(i18n::__(23505, null, 'errors'));
////            $flag = true;
////            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
////        }
//        
//        if ($pass1 !== $pass2) {
//            session::getInstance()->setError(i18n::__(00005, null, 'errors'));
//            $flag = true;
//            session::getInstance()->setFlash(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true), true);
//        }
//        if ($flag === true) {
//            request::getInstance()->setMethod('GET');
//            //request::getInstance()->addParamGet(array(usuarioTableClass::ID => request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true))));
//            routing::getInstance()->forward('default', 'insert');
//        }
//    }

}
