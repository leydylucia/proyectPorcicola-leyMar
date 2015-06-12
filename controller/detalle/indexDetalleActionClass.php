<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 * @category modulo proveedor 
 */
class indexDetalleActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
//
//            /* filtros */
//            $where = null;
//            if (request::getInstance()->hasPost('filter')) {
//                $filter = request::getInstance()->getPost('filter');
//
//                if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
//                    $where[proveedorTableClass::NOMBRE] = $filter['nombre'];
//                }
//                if (isset($filter['apellido']) and $filter['apellido'] !== null and $filter['apellido'] !== '') {
//                    $where[proveedorTableClass::APELLIDO] = $filter['apellido'];
//                }
//         
//                
//                }
//                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
//                    $where[proveedorTableClass::CREATED_AT] = array(
////                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
////                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
//                        $filter['Date1'],
//                        $filter['Date2']
//                    );
//                }


            $fields = array(
                detalleEntradaTableClass::ID,
                detalleEntradaTableClass::CANTIDAD,
                detalleEntradaTableClass::VALOR,
                detalleEntradaTableClass::ENTRADA_BODEGA_ID,
                detalleEntradaTableClass::LOTE_ID,
                detalleEntradaTableClass::INSUMO_ID,
                detalleEntradaTableClass::CREATED_AT
            );
            $orderBy = array(
                detalleEntradaTableClass::CANTIDAD
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            /* para mantener filtro con paginado,@var $where=> para sostener el filtro con el paginado
             * getTotalPages => se encuentra en proveedorTablesclass
             * @var $this para enviar al cntPages"contador de pagina" a la vista 
             *  */
            $this->cntPages = detalleEntradaTableClass::getTotalPages(config::getRowGrid(), $where);
            //$page = request::getInstance()->getGet('page');


            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objProveedor para enviar los datos a la vista      */
            $this->objDetalle = detalleEntradaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('indexDetalle', 'entrada', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
