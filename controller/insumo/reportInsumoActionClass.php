<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
  Description of reportInsumoActionClass esta clase sirve para realizar los reportes
 * ** @category insumo
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * @var $filter para hacer filtros,$where
 */
class reportInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
     try {
            /* reporte con filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
              
                if (isset($filter['insumo']) and $filter['insumo'] !== null and $filter['insumo'] !== '') {
                    $where[insumoTableClass::DESC_INSUMO] = $filter['insumo'];
                }
                if (isset($filter['Precio']) and $filter['Precio'] !== null and $filter['Precio'] !== '') {
                    $where[insumoTableClass::PRECIO] = $filter['Precio'];
                }
//         if (isset($filter['Tipo_insumo']) and $filter['Tipo_insumo'] !== null and $filter['Tipo_insumo'] !== '') {
//          $where[insumoTableClass::TIPO_INSUMO_ID] = $filter['Tipo_insumo'];
//        }
                if (isset($filter['Fecha_fabricacion']) and $filter['Fecha_fabricacion'] !== null and $filter['Fecha_fabricacion'] !== '') {
                    $where[insumoTableClass::FECHA_FABRICACION] = $filter['Fecha_fabricacion'];
                }
                if (isset($filter['Fecha_vencimiento']) and $filter['Fecha_vencimiento'] !== null and $filter['Fecha_vencimiento'] !== '') {
                    $where[insumoTableClass::FECHA_VENCIMIENTO] = $filter['Fecha_vencimiento'];
                }
                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[proveedorTableClass::CREATED_AT] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
                        date(config::getFormatTimestamp(), strtotime($filter['Date2'])),
                    );
                }
                /* para mantener filtro con paginado */
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }



            $fields = array(
                insumoTableClass::ID,
                insumoTableClass::DESC_INSUMO,
//                insumoTableClass::PRECIO,
                insumoTableClass::FECHA_FABRICACION,
                insumoTableClass::FECHA_VENCIMIENTO,
                insumoTableClass::PROVEEDOR_ID,
                insumoTableClass::TIPO_INSUMO_ID
            );
            $orderBy = array(
                insumoTableClass::DESC_INSUMO
            );

          
         
           

            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objInsumo = insumoTableClass::getAll($fields, true, $orderBy, 'ASC',null, null, $where);
            
      $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}


