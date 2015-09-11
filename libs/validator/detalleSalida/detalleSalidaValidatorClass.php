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
    class detalleSalidaValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo cantidad-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::CANTIDAD, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo cantidad no puede estar vacio', 'inputCantidad');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::CANTIDAD, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('El campo cantidad no permite letras, solo numeros', 'inputCantidad');
            }
            //---------------------------------------------campo insumo--------------------------------------------
            if (self::notBlank(request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::INSUMO_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputInsumo', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo insumo debe ser seleccionada no puede estar vacio', 'inputInsumo');
            } 
            
              //---------------------------------------------campo unidadMedida--------------------------------------------
            if (self::notBlank(request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::UNIDAD_MEDIDA_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputUnidadMedida', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo unidad medida debe ser seleccionada no puede estar vacio', 'inputUnidadMedida');
            } 
            
                //---------------------------------------------campo lote--------------------------------------------
            if (self::notBlank(request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::LOTE_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputLote', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo lote debe ser seleccionada no puede estar vacio', 'inputLote');
            } 
            
            $detalleSalidaId= request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::SALIDA_BODEGA_ID, true));;
            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::SALIDA_BODEGA_ID,true) => $detalleSalidaId));
                routing::getInstance()->forward('detalleSalida', 'insertDetalleSalida');
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
            if (self::notBlank(request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::CANTIDAD, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo cantidad no puede estar vacio', 'inputCantidad');
            }  //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::CANTIDAD, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('El campo cantidad no permite letras, solo numeros', 'inputCantidad');
            }
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::INSUMO_ID, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputInsumo', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo insumo debe ser seleccionada no puede estar vacio', 'inputInsumo');
            }

            $detalleSalidaId= request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::SALIDA_BODEGA_ID, true));;
            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::SALIDA_BODEGA_ID,true) => $detalleSalidaId));
                request::getInstance()->addParamGet(array(\detalleSalidaTableClass::ID => request::getInstance()->getPost(\detalleSalidaTableClass::getNameField(\detalleSalidaTableClass::ID, true))));
                routing::getInstance()->forward('detalleSalida', 'editDetalleSalida');
            }
        }

    }

}