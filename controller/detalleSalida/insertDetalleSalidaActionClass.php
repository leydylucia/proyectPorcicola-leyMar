<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insertInsumoActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de insertar datos
 * @var $this->objInsumo para pasar variable a la vista
 * @category moudulo insumo
 * @author leydy lucia castillo
 */
class insertDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (session::getInstance()->hasAttribute('form_' . detalleSalidaTableClass::getNameTable())) {
                $this->detalleSalida = session::getInstance()->getAttribute('form_' . detalleSalidaTableClass::getNameTable());
            }
            //estos campo son para llamar las foraneas
            $fields = array(/* foranea salidaBodega */
                salidaBodegaTableClass::ID,
            );
            $orderBy = array(
                salidaBodegaTableClass::ID,
            );
            $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, true, $orderBy, 'ASC');

            $fieldsInsumo = array(/* foranea insumo */
                insumoTableClass::ID,
                insumoTableClass::DESC_INSUMO
            );
            $orderByInsumo = array(
                insumoTableClass::DESC_INSUMO
            );
            $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');



            $this->id_salida_bodega =  request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true));/*manda el id a la vista*/
            $this->defineView('insertDetalleSalida', 'detalleSalida', session::getInstance()->getFormatOutput());
            
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
