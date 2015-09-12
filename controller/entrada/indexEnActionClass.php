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
 *
 * @author Alexandra Florez
 */
class indexEnActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            /* filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['Empleado']) and $filter['Empleado'] !== null and $filter['Empleado'] !== '') {
                    $where[entradaTableClass::EMPLEADO_ID] = $filter['Empleado'];
                }
                if (isset($filter['Proveedor']) and $filter['Proveedor'] !== null and $filter['Proveedor'] !== '') {
                    $where[entradaTableClass::PROVEEDOR_ID] = $filter['Proveedor'];
                }
            }
            if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                $where[entradaTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
                    $filter['Date1'],
                    $filter['Date2']
                );
            }


            $fields = array(
                entradaTableClass::ID,
                entradaTableClass::EMPLEADO_ID,
                entradaTableClass::PROVEEDOR_ID,
                entradaTableClass::CREATED_AT
            );
            $orderBy = array(
                entradaTableClass::EMPLEADO_ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            /* para mantener filtro con paginado,@var $where=>filtro */
            $this->cntPages = entradaTableClass::getTotalPages(config::getRowGrid(), $where);
            //$page = request::getInstance()->getGet('page');


            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objEntrada = entradaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            //estos campo son para llamar filtrar con  foraneas
            $fields = array(/* foranea  empleado */
                empleadoTableClass::ID,
                empleadoBaseTableClass::NOMBRE
            );
            $orderBy = array(
                empleadoTableClass::NOMBRE
            );
            $this->objEmpleado = empleadoTableClass::getAll($fields, true, $orderBy, 'ASC');

            $fields = array(/* foranea  empleado */
                proveedorTableClass::ID,
                proveedorTableClass::NOMBRE
            );
            $orderBy = array(
                proveedorTableClass::NOMBRE
            );
            $this->objProv = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');



            $this->defineView('index', 'entrada', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
