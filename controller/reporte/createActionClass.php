<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo reporte
 */
class createActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @var $cantidad=> cantidad
     * @var $nombre=> nombre

     * ** */

    public function execute() {
        try {

            $id = session::getInstance()->getAttribute('idRegistro');

            foreach ($id as $value) {
                
            }
            session::getInstance()->setAttribute('idGrafica', $value);

            $where = null;

            if ($value == 1) {
                if ((request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true)) and empty(mvc\request\requestClass::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true))) === false) and ( request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true))) === false)) {

                    if (request::getInstance()->isMethod('POST')) {
                        $tipoVenta = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true));
                        $nombre = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true));
                        $fechaInicial = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1');
                        $fechaFin = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2');

//                    print_r($value);
//                   exit();
//                    echo $tipoVenta . '   ' . $nombre;
//                    exit();
                        $where[] = sacrificiovTableClass::ID_CERDO . ' = ' . $nombre;
                        sacrificiovTableClass::TIPO_VENTA_ID . ' = ' . $tipoVenta . ' ' . ' AND ' .
                                $where = null;
                        session::getInstance()->setAttribute('graficaWhere', $where);

//                    print_r($where);
//                    exit();
                    }
                }
            }
            routing::getInstance()->redirect('reporte', 'grafica');
            $this->defineView('grafica', 'reporte', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('reporte', 'insert');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }

}
