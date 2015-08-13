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
     * @category modulo sacrificioVenta
     */
    class sacrificioVentaValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo valor-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::VALOR, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo valor no puede estar vacio', 'inputValor');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::VALOR, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('El campo Valor no permite letras, solo numeros', 'inputValor');
            }

            //-------------------------------campo cantidad-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::CANTIDAD, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo cantidad no puede estar vacio', 'inputCantidad');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::CANTIDAD, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('El campo cantidad no permite letras, solo numeros', 'inputCantidad');
            }
            //-------------------------------campo unidad medida-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::UNIDAD_MEDIDA_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputUnidadMedida', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo unidad medida no puede estar vacio', 'inputUnidadMedida');
            }

            //-----------------------------------------cerdo-----------------------------//
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::ID_CERDO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputTipov', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo cerdo debe ser seleccionado', 'inputTipov');
            }

            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::ID_CERDO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCerdo', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo tipo venta debe ser seleccionado', 'inputCerdo');
            }

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('sacrificioVenta', 'insertSacrificioVenta');
            }
        }

        public static function validateEdit() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo valor-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::VALOR, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo valor no puede estar vacio', 'inputValor');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::VALOR, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('El campo Valor no permite letras, solo numeros', 'inputValor');
            }

            //-------------------------------campo cantidad-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::CANTIDAD, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo cantidad no puede estar vacio', 'inputCantidad');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::CANTIDAD, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('El campo cantidad no permite letras, solo numeros', 'inputCantidad');
            }
            //-------------------------------campo unidad medida-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::UNIDAD_MEDIDA_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputUnidadMedida', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo unidad medida no puede estar vacio', 'inputUnidadMedida');
            } //----sobre pasar los caracteres----
           


            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\sacrificiovTableClass::ID => request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::ID, true))));
                routing::getInstance()->forward('sacrificioVenta', 'editSacrificioVenta');
            }
        }

        public static function validateFiltroCantidad() {

            //-------------------------------campo desc insumo-----------------------------
            if (!is_numeric(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::CANTIDAD, true)))) {
                session::getInstance()->setError('El campo cantidad no permite letras, solo numeros', 'inputCantidad');
            }
        }

    }

}