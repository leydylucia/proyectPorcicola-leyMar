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
 * @autor leydy lucia castillo mosquera
 * * @category sacrificio venta
 */

class reportTipovActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            /* filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                // aqui validar datos de filtros

                if (isset($filter['tipoVenta']) and $filter['tipoVenta'] !== null and $filter['tipoVenta'] !== '') {
                    $where[tipovTableClass::DESC_TIPOV] = $filter['tipoVenta'];
                }
                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[tipovTableClass::CREATED_AT] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
                        date(config::getFormatTimestamp(), strtotime($filter['Date2'])),
                    );
                }
                /* para mantener el filtro */
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }




            $fields = array(
                tipovTableClass::ID,
                tipovTableClass::DESC_TIPOV,
                tipovTableClass::CREATED_AT
            );

            $orderBy = array(
                tipovTableClass::DESC_TIPOV
            );



            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this-v>objTipoin para enviar los datos a la vista      */
            $this->objTipoV = tipovTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
            $this->defineView('indexTipov', 'sacrificioVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }

    }

}
