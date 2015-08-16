<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
//use mvc\config\myConfigClass as config;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
//use mvc\validator\defaultValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of indexActionClass trae datos para visualizarlos en vista indextemplated
 *
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * @category modulo default "usuario"
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            /* filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                // aqui validar datos de filtros

                if (isset($filter[usuarioTableClass::getNameField(usuarioTableClass::USER, true)]) and empty($filter[usuarioTableClass::getNameField(usuarioTableClass::USER, true)]) === false) {
                    if (request::getInstance()->isMethod('POST')) {
                        $descripcion = $filter[usuarioTableClass::getNameField(usuarioTableClass::USER, true)];

//                        validator::validateFiltroUsuario($descripcion);
                        if (isset($filter[usuarioTableClass::getNameField(usuarioTableClass::USER, true)]) and empty($filter[usuarioTableClass::getNameField(usuarioTableClass::USER, true)]) === false) {
                            $where[usuarioTableClass::USER] = $filter[usuarioTableClass::getNameField(usuarioTableClass::USER, true)];
                        }
                    }
                }

                if (isset($filter['usuario']) and $filter['usuario'] !== null and $filter['usuario'] !== '') {
                    $where[usuarioTableClass::USER] = $filter['usuario'];
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
                usuarioTableClass::ID,
                usuarioTableClass::USER,
                usuarioTableClass::CREATED_AT
            );
            $orderBy = array(
                usuarioTableClass::USER
            );


            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            /*             * para mantener filtro con paginado,@var $this para enviar al cntPages"contador de pagina" a la vista 
             * *getTotalPages => se encuentra en insumoTables class
             * * @var $where => para sostener el filtro con el paginado  */
            $this->cntPages = usuarioTableClass::getTotalPages(config::getRowGrid(), $where);
            // $page = request::getInstance()->getGet('page');


            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objUsuario = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'default', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
