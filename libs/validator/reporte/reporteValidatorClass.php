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
    class reporteValidatorClass extends validatorClass {

        public static function validateInsert() {
            $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
            $soloLetras = "/^[a-zA-Z ]+$/i";
            $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
            $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';

 //----no igualdad de pass1 com pass2----      
          

            $fechaInicial = request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::CREATED_AT, true) . '_1');
            $fechaFin = request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::CREATED_AT, true) . '_2');
            if (strtotime($fechaInicial) < strtotime($fechaFin)) {
                $flag = true;
                session::getInstance()->setFlash('inputFecha2', true); /* input usuario biene del formulario */
                session::getInstance()->setError('el campo fecha vencimiento no puede ser mayor al de fabricacion', 'inputFecha2');
            }

            

            if ($flag === true) {
                //request::getInstance()->setMethod('GET');
                routing::getInstance()->forward('reporte', 'grafica');
            }
        }

    }

}

