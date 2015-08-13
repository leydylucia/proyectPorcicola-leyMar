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
 * @var $filter para hacer filtros
 */
class reportVacunacionActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
     try {
            /* reporte con filtros */
               $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['dosis']) and $filter['dosis'] !== null and $filter['dosis'] !== '') {
                    $where[vacunacionTableClass::DOSIS] = $filter['dosis'];
                }
                if (isset($filter['hora']) and $filter['hora'] !== null and $filter['hora'] !== '') {
                    $where[vacunacionTableClass::HORA] = $filter['hora'];
                }

               
                /* para mantener filtro con paginado */
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }



            $fields = array(
                vacunacionTableClass::ID,
                vacunacionTableClass::DOSIS,
//                vacunacionTableClass::HORA,
                vacunacionTableClass::INSUMO_ID,
                vacunacionTableClass::ID_CERDO,
                
            );
            $orderBy = array(
                vacunacionTableClass::DOSIS
            );

          
         
           

            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objVacunacion = vacunacionTableClass::getAll($fields, true, $orderBy, 'ASC',null, null, $where);
            
      $this->defineView('index', 'vacunacion', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}


