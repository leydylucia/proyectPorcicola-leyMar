<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\validator\insumoValidatorClass as validator;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of indexInsumoActionClass trae datos para visualizarlos en vista indextemplated
 *
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * @category modulo insumo

 */
class indexInsumoActionClass extends controllerClass implements controllerActionInterface {

  /**
   * Description of ejemploClass
   *
   * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
   * 
   */
  public function execute() {
    try {
      /* filtros */
      $where = null; /* where se encuentra nulo para entrar en la sentencia getall */
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter'); /* $filter si se encuentra en la vista?? */

        if (request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $descripcion = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true));

            validator::validateFiltroDescripcion($descripcion);
            if (isset($descripcion) and $descripcion !== null and $descripcion !== '') {
              $where[insumoTableClass::DESC_INSUMO] = $descripcion;
            }
          }
        }

        if (isset($filter['desc_insumo']) and $filter['desc_insumo'] !== null and $filter['desc_insumo'] !== '') {
          $where[insumoTableClass::DESC_INSUMO] = $filter['desc_insumo'];
        }

        if (isset($filter['Precio']) and $filter['Precio'] !== null and $filter['Precio'] !== '') {
          $where[insumoTableClass::PRECIO] = $filter['Precio'];
        }
        if (isset($filter['Tipo_insumo']) and $filter['Tipo_insumo'] !== null and $filter['Tipo_insumo'] !== '') {
          $where[insumoTableClass::TIPO_INSUMO_ID] = $filter['Tipo_insumo'];
        }

        if (isset($filter['Proveedor']) and $filter['Proveedor'] !== null and $filter['Proveedor'] !== '') {
          $where[insumoTableClass::PROVEEDOR_ID] = $filter['Proveedor'];
        }
        if (isset($filter['Fecha_fabricacion']) and $filter['Fecha_fabricacion'] !== null and $filter['Fecha_fabricacion'] !== '') {
          $where[insumoTableClass::FECHA_FABRICACION] = $filter['Fecha_fabricacion'];
        }
        if (isset($filter['Fecha_vencimiento']) and $filter['Fecha_vencimiento'] !== null and $filter['Fecha_vencimiento'] !== '') {
          $where[insumoTableClass::FECHA_VENCIMIENTO] = $filter['Fecha_vencimiento'];
        }
        if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
          $where[insumoTableClass::CREATED_AT] = array(
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
//                session::getInstance()->setAttribute('defaultIndexFilters', $where);
//            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
//                $where = session::getInstance()->getAttribute('defaultIndexFilters');
//            
      }

      /*       * @var $fields trae los campos de model
       * @var $orderBy ordena con el tipo de datos seleccionado
       * @var page paginado
       */

      $fields = array(
          insumoTableClass::ID,
          insumoTableClass::DESC_INSUMO,
//                insumoTableClass::PRECIO,
          insumoTableClass::TIPO_INSUMO_ID,
          insumoTableClass::FECHA_FABRICACION,
          insumoTableClass::FECHA_VENCIMIENTO,
          insumoTableClass::PROVEEDOR_ID,
          insumoTableClass::CREATED_AT
      );
      $orderBy = array(
          insumoTableClass::DESC_INSUMO
      );

      $page = 0; /* paginado */
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /* para mantener filtro con paginado,
       * @return $this para enviar al cntPages"contador de pagina" a la vista 
       * *getTotalPages => se encuentra en insumoTables class
       * * @var $where => para sostener el filtro con el paginado  */
      $this->cntPages = insumoTableClass::getTotalPages(config::getRowGrid(), $where);
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
      $this->objInsumo = insumoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

      /* para filtrar foraneas */
      $fields = array(
          tipoInsumoTableClass::ID,
          tipoInsumoTableClass::DESC_TIPOIN
      );
      $orderBy = array(
          tipoInsumoTableClass::DESC_TIPOIN
      );
      $this->objTipoin = tipoInsumoTableClass::getAll($fields, false, $orderBy, 'ASC');

      $fieldsProveedor = array(/* foranea proveedor */
          proveedorTableClass::ID,
          proveedorTableClass::NOMBRE
      );
      $orderByProvedor = array(
          proveedorTableClass::NOMBRE
      );
      $this->objProv = proveedorTableClass::getAll($fieldsProveedor, true, $orderByProvedor, 'ASC');




      $this->defineView('index', 'insumo', session::getInstance()
                      ->getFormatOutput());
    } catch (PDOException $exc) {

//            session::getInstance()->setFlash('exc', $exc);
//            routing::getInstance()->forward('shfSecurity', 'exception');
      routing::getInstance()->redirect('insumo', 'indexInsumo');
    }
  }

}
