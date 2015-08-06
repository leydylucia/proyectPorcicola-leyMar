<?php

namespace mvc\validator {

    use mvc\validator\validatorClass;
    use mvc\session\sessionClass as session;
    use mvc\request\requestClass as request;
    use mvc\routing\routingClass as routing;
    use mvc\config\myConfigClass as config;

    /**
     * Description of manoObraValidatorClass
     *
     * @author leydy lucia castillo <leydylucia@hotmail.com>
     * @category modulo entrada
     */
    class entradaValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo empleado-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\entradaTableClass::getNameField(\entradaTableClass::EMPLEADO_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputEmpleado', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo empleado debe ser seleccionado', 'inputEmpleado');
            } 
            
             //-------------------------------campo proveedor-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\entradaTableClass::getNameField(\entradaTableClass::PROVEEDOR_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputProveedor', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo proveedor debe ser seleccionado', 'inputProveedor');
            } 
            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('entrada', 'insertEn');
            }
        }

        public static function validateEdit() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo desc entrada-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\entradaTableClass::getNameField(\entradaTableClass::DESC_INSUMO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescInsumo', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo descripcion entrada no puede estar vacio', 'inputDescInsumo');
            } //----sobre pasar los caracteres----
            

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\entradaTableClass::ID => request::getInstance()->getPost(\entradaTableClass::getNameField(\entradaTableClass::ID, true))));
                routing::getInstance()->forward('entrada', 'editInsumo');
            }
        }

    }

}