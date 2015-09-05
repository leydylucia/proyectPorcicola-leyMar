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
     * @category modulo salidaBodega
     */
    class detalleHojaValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo cantidad-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::PESO_CERDO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo peso cerdo no puede estar vacio', 'inputCantidad');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::PESO_CERDO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('El campo peso cerdo no permite letras, solo numeros', 'inputCantidad');
            }
            
            //-------------------------------campo valor-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::DOSIS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo dosis no puede estar vacio', 'inputValor');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::DOSIS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('El campo dosis no permite letras, solo numeros', 'inputValor');
            }
            //-----------------------------campo insumo--------
            if (self::notBlank(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::INSUMO_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputInsumo', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo insumo debe ser seleccionada no puede estar vacio', 'inputInsumo');
            }
            
            //-----------------------------campo tipo insumo--------
            if (self::notBlank(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::INSUMO_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputTipoInsumo', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo tipo insumo debe ser seleccionada no puede estar vacio', 'inputInsumo');
            }
            
            //---------------------------------------------campo unidadMedida--------------------------------------------
            if (self::notBlank(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::INSUMO_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputUnidadMedida', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo unidad medida debe ser seleccionada no puede estar vacio', 'inputUnidadMedida');
            } 
            
            
            $detalleHojaId= request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::HOJA_VIDA_ID, true));;
            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::HOJA_VIDA_ID,true) => $detalleHojaId));
                routing::getInstance()->forward('detalleHoja', 'insert');
            }
        }

        public static function validateEdit() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo cantidad-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::PESO_CERDO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo peso cerdo no puede estar vacio', 'inputCantidad');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::PESO_CERDO, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('El campo peso cerdo no permite letras, solo numeros', 'inputCantidad');
            }
            
            //-------------------------------campo valor-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::DOSIS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo dosis no puede estar vacio', 'inputValor');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::DOSIS, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputValor', true);
                session::getInstance()->setError('El campo dosis no permite letras, solo numeros', 'inputValor');
            }

            $detalleHojaId= request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::HOJA_VIDA_ID, true));;
            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::HOJA_VIDA_ID,true) => $detalleHojaId));
                request::getInstance()->addParamGet(array(\detalleHojaTableClass::ID => request::getInstance()->getPost(\detalleHojaTableClass::getNameField(\detalleHojaTableClass::ID, true))));
                routing::getInstance()->forward('detalleHoja', 'edit');
            }
        }

    }

}