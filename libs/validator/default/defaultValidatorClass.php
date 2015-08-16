<?php

namespace mvc\validator {

    use mvc\validator\validatorClass;
    use mvc\session\sessionClass as session;
    use mvc\request\requestClass as request;
    use mvc\routing\routingClass as routing;
    use mvc\config\myConfigClass as config;

    /**
     * Description of defaultValidatorClass son validaciones para insertar y modificar
     * en los campos requeridos
     *
     * @author leydy lucia castillo <leydylucia@hotmail.com>
     * @category modulo default
     */
    class defaultValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo usuatio-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::USER, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputUsuario', true); /* input usuario biene del formulario */
                session::getInstance()->setError('El campo del usuario no puede esta vacio', 'inputUsuario');
            } //----sobre pasar los caracteres----
            else if (strlen(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::USER, true))) > \usuarioTableClass::USER_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputUsuario', true);
                session::getInstance()->setError('El usuario no puede esceder en cantidad de caracteres a lo permitido', 'inputUsuario');
            } //----nombre repetitivo---
            else if (self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::USER, true))), \usuarioTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('inputUsuario', true);
                session::getInstance()->setError('El usuario digitado ya existe', 'inputUsuario');
            }



            //----solo email----
//        else if (!preg_match($emailcorrecto, (request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::USER, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputUsuario', true);
//        session::getInstance()->setError('Por favor digite un corre válido ', 'inputUsuario');
//      }   //----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUsuario')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUsuario', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUsuario');
//      }
            //------------------------------------campo password---------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_1')) or self::notBlank(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_2'))) {
                $flag = true;
                session::getInstance()->setFlash('inputPass1', true);
                session::getInstance()->setError('La contraseña es requerida', 'inputPass1');
            } //----no igualdad de pass1 com pass2----      
            else if (request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_1') !== (request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_2'))) {
                $flag = true;
                session::getInstance()->setFlash('inputPass1', true);
                session::getInstance()->setError('Las contraseñas no coinciden', 'inputPass1');
            } //----sobre pasar los caracteres campo 1----
            else if (strlen(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_1')) > \usuarioTableClass::PASSWORD_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputPass1', true);
                session::getInstance()->setError('El password digitado es mayor en cantidad de caracteres a lo permitido', 'inputPass1');
            }//----sobre pasar los caracteres campo 2----
            else if (strlen(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_2')) > \usuarioTableClass::PASSWORD_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputPass2', true);
                session::getInstance()->setError('El password digitado es mayor en cantidad de caracteres a lo permitido', 'inputPass2');
            }

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('default', 'insert');
            }
        }

        public static function validateEdit() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo usuatio-----------------------------
             //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::USER, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputUsuario', true); /* input usuario biene del formulario */
                session::getInstance()->setError('El campo del usuario no puede esta vacio', 'inputUsuario');
            } //----sobre pasar los caracteres----
            else if (strlen(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::USER, true))) > \usuarioTableClass::USER_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputUsuario', true);
                session::getInstance()->setError('El usuario no puede esceder en cantidad de caracteres a lo permitido', 'inputUsuario');
            } //----nombre repetitivo---
            else if (self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::USER, true))), \usuarioTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('inputUsuario', true);
                session::getInstance()->setError('El usuario digitado ya existe', 'inputUsuario');
            }
//    
//----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUser', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
//      }
            //------------------------------------campo password---------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_1')) or self::notBlank(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_2'))) {
                $flag = true;
                session::getInstance()->setFlash('inputPass1', true);
                session::getInstance()->setError('La contraseña es requerida', 'inputPass1');
            } //----no igualdad de pass1 com pass2----      
            else if (request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_1') !== (request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_2'))) {
                $flag = true;
                session::getInstance()->setFlash('inputPass1', true);
                session::getInstance()->setError('Las contraseñas no coinciden', 'inputPass1');
            } //----sobre pasar los caracteres campo 1----
            else if (strlen(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_1')) > \usuarioTableClass::PASSWORD_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputPass1', true);
                session::getInstance()->setError('El password digitado es mayor en cantidad de caracteres a lo permitido', 'inputPass1');
            }//----sobre pasar los caracteres campo 2----
            else if (strlen(request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::PASSWORD, true) . '_2')) > \usuarioTableClass::PASSWORD_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputPass2', true);
                session::getInstance()->setError('El password digitado es mayor en cantidad de caracteres a lo permitido', 'inputPass2');
            }

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\usuarioTableClass::ID => request::getInstance()->getPost(\usuarioTableClass::getNameField(\usuarioTableClass::ID, true))));
                routing::getInstance()->forward('default', 'edit');
            }
        }
        
        
         public static function validateFiltroUsusario($descripcion) {
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


             if (strlen($descripcion) > \usuarioTableClass::USER_LENGTH) {
//                 echo $descripcion;
//                 exit();
                session::getInstance()->setError('el tipo usuario digitado es mayor en cantidad de caracteres a lo permitido', 'inputUsuario');
            }
//            //----solo permitir letras----
            else if (!preg_match($soloLetras, ($descripcion))) {
               session::getInstance()->setError('El campo usuario insumo no permite numeros, solo letras', 'inputUsuario');
            }
        }

    }

}