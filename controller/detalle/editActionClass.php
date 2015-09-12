<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log;/*linea de la bitacora*/

/**
 * Description of editInsumoActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de modificar datos
 *
 * @author leydy lucia castillo moaquera
 *  @category modulo insumo
 */
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet(detalleEntradaTableClass::ID)) {
                $fields = array(
                    detalleEntradaTableClass::ID,
                    detalleEntradaTableClass::CANTIDAD,
                    detalleEntradaTableClass::VALOR,
                    detalleEntradaTableClass::ENTRADA_BODEGA_ID,
                    detalleEntradaTableClass::INSUMO_ID,
                    detalleEntradaTableClass::UNIDAD_MEDIDA_ID
                );
                $where = array(
                    detalleEntradaTableClass::ID => request::getInstance()->getGet(detalleEntradaTableClass::ID)
                );
                $this->objDetalle = detalleEntradaTableClass::getAll($fields, true, null, null, null, null, $where);

                //estos campo son para llamar las foraneas
                $fields = array(/* foranea salidaBodega */
                    entradaTableClass::ID,
                );
                $orderBy = array(
                    entradaTableClass::ID,
                );
                $this->objEntrada = entradaTableClass::getAll($fields, true, $orderBy, 'ASC');

                $fieldsInsumo = array(/* foranea insumo */
                    insumoTableClass::ID,
                    insumoTableClass::DESC_INSUMO
                );
                $orderByInsumo = array(
                    insumoTableClass::DESC_INSUMO
                );
                $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');

                $fieldsUnidad = array(
                    unidadMedidaTableClass::ID,
                    unidadMedidaTableClass::DESCRIPCION
                );
                $orderByUnidad = array(
                    unidadMedidaTableClass::DESCRIPCION
                );
                $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');


//                $this->id_salida_bodega =  request::getInstance()->getGet(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::SALIDA_BODEGA_ID, true));/*manda el id a la vista*/
                $this->defineView('edit', 'detalle', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */


//                 log::register('editar',  detalleEntradaTableClass::getNameTable());//linea de bitacora
            } else {
                routing::getInstance()->redirect('detalle', 'index');
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
            }
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}

//echo '$ ' . number_format($precio, 0, ',', '.');
