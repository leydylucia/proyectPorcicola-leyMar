<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/*
 Description of reportActionClass esta clase sirve para realizar los reportes
 * @autor leydy lucia castillo mosquera
 * * @category insumo
 */

class reportTipoInActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            /* reporte con filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                // aqui validar datos de filtros

                if (isset($filter['tipoInsumo']) and $filter['tipoInsumo'] !== null and $filter['tipoInsumo'] !== '') {
                    $where[tipoInsumoTableClass::DESC_TIPOIN] = $filter['tipoInsumo'];
                }
                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[proveedorTableClass::CREATED_AT] = array(
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
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESC_TIPOIN,
                tipoInsumoTableClass::CREATED_AT
            );

            $orderBy = array(
                tipoInsumoTableClass::DESC_TIPOIN
            );




            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objTipoin para enviar los datos a la vista      */
            $this->objTipoin = tipoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
            $this->defineView('indexTipoin', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }

    }

}
