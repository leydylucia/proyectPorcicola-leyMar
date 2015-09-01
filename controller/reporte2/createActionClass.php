<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
//use mvc\validator\usuarioCredencialValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo reporte
 */
class createDetalleActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @var $usuario=> desc usuario
     * @var $credencial=> desc credencial

     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                if (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true)) and empty(mvc\request\requestClass::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true))) === false) {

                    if (request::getInstance()->isMethod('POST')) {
                        $cantidad = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true));
                        /* validar */
//                        $objSacrificio = sacrificiovTableClass::getcantidadS($cantidad); /* getcantidadS es la funcion que va para el sql */
                        session::getInstance()->setAttribute('grafica', $cantidad);
                    }
                }//siviene lleno la casilla pase el dato para utilizarlo en el sql

                if (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true))) === false) {

                    if (request::getInstance()->isMethod('POST')) {
                        $nombre = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true));
                        /* validar */
//                      $objSacrificio = sacrificiovTableClass::getcantidadS($nombre); /* getcantidadS es la funcion que va para el sql */
                        session::getInstance()->setAttribute('graficaNombre', $nombre);
                    }
                }//siviene lleno la casilla pase el dato para utilizarlo en el sql


                routing::getInstance()->redirect('reporte2', 'grafica');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('reporte2', 'insert');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }

}
