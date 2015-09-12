<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
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
class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (session::getInstance()->hasAttribute('form_' . detalleHojaTableClass::getNameTable())) {
                $this->detalle = session::getInstance()->getAttribute('form_' . detalleHojaTableClass::getNameTable());
            }
            //estos campo son para llamar las foraneas
                $fields = array(/* foranea salidaBodega */
                    hojaVidaTableClass::ID,
                );
                $orderBy = array(
                    hojaVidaTableClass::ID,
                );
                $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC');

                $fieldsInsumo = array(/* foranea insumo */
                    insumoTableClass::ID,
                    insumoTableClass::DESC_INSUMO
                );
                $orderByInsumo = array(
                    insumoTableClass::DESC_INSUMO
                );
                $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');
                
                $fieldsTipoInsumo = array(/* foranea insumo */
                    tipoInsumoTableClass::ID,
                    tipoInsumoTableClass::DESC_TIPOIN
                );
                $orderByTipoInsumo = array(
                    tipoInsumoTableClass::DESC_TIPOIN
                );
                $this->objTipoin = tipoInsumoTableClass::getAll($fieldsTipoInsumo, true, $orderByTipoInsumo, 'ASC');

                $fieldsUnidad = array(
                    unidadMedidaTableClass::ID,
                    unidadMedidaTableClass::DESCRIPCION
                );
                $orderByUnidad = array(
                    unidadMedidaTableClass::DESCRIPCION
                );
                $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');



            $this->id_hoja_vida = request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true)); /* manda el id a la vista */
            $this->defineView('insert', 'detalleHoja', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
