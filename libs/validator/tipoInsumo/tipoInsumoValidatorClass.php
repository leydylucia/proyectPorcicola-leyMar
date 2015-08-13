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
     * @category modulo insumo
     */
    class tipoInsumoValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';


            //-------------------------------campo desc tipo insumo-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoIn', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo descripcion tipo insumo no puede estar vacio', 'inputDescTipoIn');
            } //----sobre pasar los caracteres----
            else if (strlen(request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true))) > \tipoInsumoTableClass::DESC_TIPOIN_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoIn', true);
                session::getInstance()->setError('el tipo insumo digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescTipoIn');
            }
            //----solo permitir letras----
            else if (!preg_match($soloLetras, (request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true))))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoIn', true);
                session::getInstance()->setError('El campo descripcion tipo insumo no permite numeros, solo letras', 'inputDescTipoIn');
            }


            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('insumo', 'insertTipoin');
            }
        }

        public static function validateEdit() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';



            //-------------------------------campo desc tipo insumo-----------------------------
            //----campo nulo----
            if (self::notBlank(request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true)))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoIn', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo descripcion tipo insumo no puede estar vacio', 'inputDescTipoIn');
            } //----sobre pasar los caracteres----
            else if (strlen(request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true))) > \tipoInsumoTableClass::DESC_TIPOIN_LENGTH) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoIn', true);
                session::getInstance()->setError('el tipo insumo digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescTipoIn');
            }
            //----solo permitir letras----
            else if (!preg_match($soloLetras, (request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true))))) {
                $flag = true;
                session::getInstance()->setFlash('inputDescTipoIn', true);
                session::getInstance()->setError('El campo descripcion tipo insumo no permite numeros, solo letras', 'inputDescTipoIn');
            }


            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                request::getInstance()->addParamGet(array(\tipoInsumoTableClass::ID => request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::ID, true))));
                routing::getInstance()->forward('insumo', 'editTipoin');
            }
        }

        public static function validateFiltroDescripcion($filter) {

            $soloLetras = "/^[a-z]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';

//            
            if (strlen(request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true))) > \tipoInsumoTableClass::DESC_TIPOIN_LENGTH) {
                session::getInstance()->setError('el tipo insumo digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescInsumo');
            }
//            //----solo permitir letras----
            else if (!preg_match($soloLetras, (request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true))))) {
               session::getInstance()->setError('El campo descripcion tipo insumo no permite numeros, solo letras', 'inputDescTipoIn');
            }
             //----solo numeros----      
            else if (!is_numeric(request::getInstance()->getPost(\tipoInsumoTableClass::getNameField(\tipoInsumoTableClass::DESC_TIPOIN, true)))) {
              session::getInstance()->setError('El campo precio no permite letras, solo numeros', 'inputDescTipoIn');
            }
        }

    }

}