<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/*
 * DESCRIPCION DE LA CLASE
 * @autor Alexandra Marcela Florez
 */

class reportEnActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            /* filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                 
        if (isset($filter['empleado']) and $filter['empleado'] !== null and $filter['empleado'] !== '') {
          $where[entradaTableClass::EMPLEADO_ID] = $filter['empleado'];
        }
        if (isset($filter['proveedor']) and $filter['proveedor'] !== null and $filter['proveedor'] !== '') {
          $where[entradaTableClass::PROVEEDOR_ID] = $filter['proveedor'];
        }

                
                /* para mantener filtro con paginado */
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }



            $fields = array(
                entradaTableClass::ID,
                entradaTableClass::EMPLEADO_ID,
                entradaTableClass::PROVEEDOR_ID,
            );
            $orderBy = array(
                entradaTableClass::EMPLEADO_ID
            );



            /*             * para mantener filtro con paginado,@var $this para enviar al cntPages"contador de pagina" a la vista 
             * *getTotalPages => se encuentra en insumoTables class
             * * @var $where => para sostener el filtro con el paginado  */

            // $page = request::getInstance()->getGet('page');


            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objEntrada = entradaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
            
             /* fields para foraneas */
      $fieldsE = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $orderByE = array(
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsE, true, $orderByE, 'ASC');


      /* fields para foraneas */
      $fields = array(
          proveedorTableClass::ID,
          proveedorTableClass::NOMBRE
      );
      $orderBy = array(
          proveedorTableClass::NOMBRE
      );
      $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');


            $this->defineView('index', 'entrada', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}