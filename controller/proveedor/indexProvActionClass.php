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
 */
class indexProvActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            /* filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
                    $where[proveedorTableClass::NOMBRE] = $filter['nombre'];
                }
                if (isset($filter['apellido']) and $filter['apellido'] !== null and $filter['apellido'] !== '') {
                    $where[proveedorTableClass::APELLIDO] = $filter['apellido'];
                }
         
                
                }
                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[proveedorTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
                        $filter['Date1'],
                        $filter['Date2']
                    );
                }


            $fields = array(
                proveedorTableClass::ID,
                proveedorTableClass::NOMBRE,
                proveedorTableClass::APELLIDO,
                proveedorTableClass::DIRECCION,
                proveedorTableClass::CORREO,
                proveedorTableClass::TELEFONO,
                proveedorTableClass::CIUDAD_ID,
                proveedorTableClass::CREATED_AT
            );
            $orderBy = array(
                proveedorTableClass::NOMBRE
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            /* para mantener filtro con paginado,@var $where=>filtro */
            $this->cntPages = proveedorTableClass::getTotalPages(config::getRowGrid(), $where);
            //$page = request::getInstance()->getGet('page');


            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'proveedor', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
