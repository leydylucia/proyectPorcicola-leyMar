<?php

namespace mvc\validator {

    use mvc\validator\validatorClass;
    use mvc\session\sessionClass as session;
    use mvc\request\requestClass as request;
    use mvc\routing\routingClass as routing;
    use mvc\config\myConfigClass as config;

    /**
     * Description of manoObraValidatorClass
     * @author leydy lucia castillo <leydylucia@hotmail.com>
     * @category modulo sacrificioVenta
     */
    class tipoVentaValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo descripcion tipo venta----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::DESC_TIPOV, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoV', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo descripcion no puede estar vacio', 'inputDescTipoV');
            } //----sobre pasar los caracteres----
            else if (strlen(request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::DESC_TIPOV, true))) > \tipovTableClass::DESC_TIPOV_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoV', true);
                session::getInstance()->setError('el tipo venta digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescTipoV');
            } //----solo permitir letras----
            else if (!preg_match($soloLetras, (request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::DESC_TIPOV, true))))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoIn', true);
                session::getInstance()->setError('el campo descripcion tipo venta no permite numeros, solo letras', 'inputDescTipoIn');
            }


            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('sacrificioVenta', 'insertTipov');
            }
        }

        public static function validateEdit() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::DESC_TIPOV, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoV', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo descripcion no puede estar vacio', 'inputDescTipoV');
            } //----sobre pasar los caracteres----
            else if (strlen(request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::DESC_TIPOV, true))) > \tipovTableClass::DESC_TIPOV_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoV', true);
                session::getInstance()->setError('el tipo venta digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescTipoV');
            } //----solo permitir letras----
            else if (!preg_match($soloLetras, (request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::DESC_TIPOV, true))))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoIn', true);
                session::getInstance()->setError('el campo descripcion tipo venta no permite numeros, solo letras', 'inputDescTipoIn');
            }

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\tipovTableClass::ID => request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::ID, true))));
                routing::getInstance()->forward('sacrificioVenta', 'editTipov');
            }
        }

        public static function validateFiltroTipo() {
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo desc insumo-----------------------------
            if (strlen(request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::DESC_TIPOV, true))) > \tipovTableClass::DESC_TIPOV_LENGTH) {
                session::getInstance()->setError('el tipo venta digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescTipoV');
            } //----solo permitir letras----
            else if (!preg_match($soloLetras, (request::getInstance()->getPost(\tipovTableClass::getNameField(\tipovTableClass::DESC_TIPOV, true))))) {
                session::getInstance()->setError('el campo descripcion tipo venta no permite numeros, solo letras', 'inputDescTipoIn');
            }
             
        }

    }

}