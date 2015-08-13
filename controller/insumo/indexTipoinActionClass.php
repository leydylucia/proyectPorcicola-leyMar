<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\tipoInsumoValidatorClass as validator;

/**
 * Description of indexTipoInActionClass trae datos para visualizarlos en vista indextemplated
 *
  @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo insumo
 */
class indexTipoinActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            /* filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter[tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)]) and empty($filter[tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)]) === false) {
                    if (request::getInstance()->isMethod('POST')) {
                        $descripcion = $filter[tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)];
                        validator::validateFiltroDescripcion($filter);
                        if (isset($filter[tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)]) and empty($filter[tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)]) === false) {
                            $where[tipoInsumoTableClass::DESC_TIPOIN] = $filter[tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)];
                        }
                    }
                }
//  echo ('descripcion');
//                       exit();
//                if (isset($filter['tipoInsumo']) and $filter['tipoInsumo'] !== null and $filter['tipoInsumo'] !== '') {
//                    $where[tipoInsumoTableClass::DESC_TIPOIN] = $filter['tipoInsumo'];
//                }
//                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
//                    $where[proveedorTableClass::CREATED_AT] = array(
////                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
////                        date(config::getFormatTimestamp(), strtotime($filter['Date2'])),
//                        $filter['Date1'],
//                        $filter['Date2']
//                    );
                //  }
                /* para mantener el filtro */
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }


            /*             * @var $fields trae los campos de model
             * @var $orderBy ordena con el tipo de datos seleccionado
             * @var page paginado
             */

            $fields = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESC_TIPOIN,
                tipoInsumoTableClass::CREATED_AT
            );

            $orderBy = array(
                tipoInsumoTableClass::DESC_TIPOIN
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            /* para mantener filtro con paginado,
             * @var $this para enviar al cntPages"contador de pagina" a la vista 
             * getTotalPages => se encuentra en tipoinsumoTables class
             * @var $where => para sostener el filtro con el paginado* */
            $this->cntPages = tipoInsumoTableClass::getTotalPages(config::getRowGrid(), $where);
            //  $page = request::getInstance()->getGet('page');


            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objTipoin para enviar los datos a la vista      */
            $this->objTipoin = tipoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('indexTipoin', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
//            routing::getInstance()->redirect('insumo', 'indexTipoIn');

        }
    }

}
