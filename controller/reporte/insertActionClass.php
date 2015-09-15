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
          

          session::getInstance()->deleteAttribute('dateReportSacrificio');/*se agrega esta linea para limpiar la informacion de la grafica hacia el formulario*/
          $id_reporte = request::getInstance()->getGet(reporteTableClass::getNameField(reporteTableClass::ID, TRUE));


//            $id = array(
//            sacrificiovTableClass::ID =>  request::getInstance()->getRequest(sacrificiovTableClass::ID)
//            );
////            print_r($id);
////            exit();
//            session::getInstance()->setAttribute('idRegistro', $id);
          
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
            $this->id_reporte = $id_reporte;
 

//$this->id_reporte = request::getInstance()->getGet(reporteTableClass::getNameField(reporteTableClass::ID, true)); /* manda el id a la vista */
            $this->defineView('insert', 'reporte', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
