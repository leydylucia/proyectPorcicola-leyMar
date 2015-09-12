<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 * @var $this->objInsumo para pasar variable a la vista
 * @category moudulo usuarioCredencial
 * @author leydy lucia castillo
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            $id = array(
            sacrificiovTableClass::ID =>  request::getInstance()->getRequest(sacrificiovTableClass::ID)
            );
//            print_r($id);
//            exit();
            session::getInstance()->setAttribute('idRegistro', $id);
          
            $fields = array(
                tipovTableClass::ID,
                tipovTableClass::DESC_TIPOV
            );
            $orderBy = array(
                tipovTableClass::DESC_TIPOV
            );
            $this->objTipoV = tipovTableClass::getAll($fields, true, $orderBy, 'ASC');

            $fields = array(/* foranea cerdo"hoja de vida" */
                hojaVidaTableClass::ID,
                hojaVidaTableClass::NOMBRE_CERDO,
            );
            $orderBy = array(
                hojaVidaTableClass::NOMBRE_CERDO
            );
            $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC');

 


            $this->defineView('insert', 'reporte', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
