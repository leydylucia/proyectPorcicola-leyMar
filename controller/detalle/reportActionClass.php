<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
  Description of reportInsumoActionClass esta clase sirve para realizar los reportes
 * ** @category insumo
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * @var $filter para hacer filtros,$where
 */
class reportActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            /* reporte con filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['Cantidad']) and $filter['Cantidad'] !== null and $filter['Cantidad'] !== '') {
                    $where[detalleEntradaTableClass::CANTIDAD] = $filter['Cantidad'];
                }
                if (isset($filter['Valor']) and $filter['Valor'] !== null and $filter['Valor'] !== '') {
                    $where[detalleEntradaTableClass::VALOR] = $filter['Valor'];
                }
                if (isset($filter['Insumo']) and $filter['Insumo'] !== null and $filter['Insumo'] !== '') {
                    $where[detalleEntradaTableClass::INSUMO_ID] = $filter['Insumo'];
                }

                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[proveedorTableClass::CREATED_AT] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
                        date(config::getFormatTimestamp(), strtotime($filter['Date2'])),
                    );
                }
                /* para mantener filtro con paginado */
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }



            $fields = array(
                detalleEntradaTableClass::ID,
                detalleEntradaTableClass::CANTIDAD,
                detalleEntradaTableClass::VALOR,
                detalleEntradaTableClass::ENTRADA_BODEGA_ID,
                detalleEntradaTableClass::INSUMO_ID,
                detalleEntradaTableClass::UNIDAD_MEDIDA_ID
            );
            $orderBy = array(
                detalleEntradaTableClass::CANTIDAD,
            );





            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objDetalle = detalleEntradaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

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



            $this->defineView('index', 'detalle', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
