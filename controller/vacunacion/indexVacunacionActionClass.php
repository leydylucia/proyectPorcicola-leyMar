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
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * @category modulo vacunacion

 */
class indexVacunacionActionClass extends controllerClass implements controllerActionInterface {

    /**
     * Description of ejemploClass
     *
     * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
     * 
     */
    public function execute() {
        try {
            /* filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['dosis']) and $filter['dosis'] !== null and $filter['dosis'] !== '') {
                    $where[vacunacionTableClass::DOSIS] = $filter['dosis'];
                }
                if (isset($filter['hora']) and $filter['hora'] !== null and $filter['hora'] !== '') {
                    $where[vacunacionTableClass::HORA] = $filter['hora'];
                }
                 if (isset($filter['Insumo']) and $filter['Insumo'] !== null and $filter['Insumo'] !== '') {
                    $where[vacunacionTableClass::INSUMO_ID] = $filter['Insumo'];
                }

                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[vacunacionTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
                        $filter['Date1'],
                        $filter['Date2']
                    );
                }
                /* para mantener filtro con paginado */
//                print_r($where);
//              echo  $filter['Date2'];
//                exit();
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }



            $fields = array(
                vacunacionTableClass::ID,
                vacunacionTableClass::DOSIS,
                vacunacionTableClass::HORA,
                vacunacionTableClass::INSUMO_ID,
                vacunacionTableClass::ID_CERDO,
                vacunacionTableClass::CREATED_AT
               
            );
            $orderBy = array(
                vacunacionTableClass::DOSIS
            );

            $page = 0; /* paginado */
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            /* para mantener filtro con paginado,@var $this para enviar al cntPages"contador de pagina" a la vista 
             * *getTotalPages => se encuentra en insumoTables class
             * * @var $where => para sostener el filtro con el paginado  */
            $this->cntPages = vacunacionTableClass::getTotalPages(config::getRowGrid(), $where);
            // $page = request::getInstance()->getGet('page');


            /**
             *  
             * @var $where => para filtros
             * @var $page => para el paginado
             * @var $fileds => para declarar los campos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true 
             * sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o 
             * desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      
             *
             * */
            $this->objVacunacion = vacunacionTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'vacunacion', session::getInstance()
                            ->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
