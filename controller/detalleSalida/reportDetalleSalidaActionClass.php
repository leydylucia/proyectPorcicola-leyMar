<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
  Description of reportActionClass esta clase sirve para realizar los reportes
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo detallSalida
 */
class reportDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      /* reporte con filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        if (isset($filter['Cantidad']) and $filter['Cantidad'] !== null and $filter['Cantidad'] !== '') {
          $where[detalleSalidaTableClass::CANTIDAD] = $filter['Cantidad'];
        }
        if (isset($filter['SalidaBodega']) and $filter['SalidaBodega'] !== null and $filter['SalidaBodega'] !== '') {
          $where[detalleSalidaTableClass::SALIDA_BODEGA_ID] = $filter['SalidaBodega'];
        }

        if (isset($filter['Insumo']) and $filter['Insumo'] !== null and $filter['Insumo'] !== '') {
          $where[detalleSalidaTableClass::INSUMO_ID] = $filter['Insumo'];
        }

        if (isset($filter['Lote']) and $filter['Lote'] !== null and $filter['Lote'] !== '') {
          $where[detalleSalidaTableClass::LOTE_ID] = $filter['Lote'];
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
          detalleSalidaTableClass::ID,
          detalleSalidaTableClass::CANTIDAD,
          detalleSalidaTableClass::SALIDA_BODEGA_ID,
          detalleSalidaTableClass::INSUMO_ID,
          detalleSalidaTableClass::UNIDAD_MEDIDA_ID,
          detalleSalidaTableClass::LOTE_ID,
      );
      $orderBy = array(
          detalleSalidaTableClass::CANTIDAD,
      );





      /** @var $where => para filtros
       * *@var $page => para el paginado
       * *@var $fileds => para declarar los cmpos de la table en la bd
       * @var $orderBy => ordernar por el campo deseado
       *  true=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */
      $this->objDetalleSalida = detalleSalidaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

      //estos campo son para llamar las foraneas
      $fields = array(/* foranea salidaBodega */
          salidaBodegaTableClass::ID,
      );
      $orderBy = array(
          salidaBodegaTableClass::ID,
      );
      $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fieldsInsumo = array(/* foranea insumo */
          insumoTableClass::ID,
          insumoTableClass::DESC_INSUMO
      );
      $orderByInsumo = array(
          insumoTableClass::DESC_INSUMO
      );
      $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');

      $fieldsUnidad = array(
          unidadMedidaTableClass::ID,
          unidadMedidaTableClass::DESCRIPCION
      );
      $orderByUnidad = array(
          unidadMedidaTableClass::DESCRIPCION
      );
      $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');

      $fieldsLote = array(
          loteTableClass::ID,
          loteTableClass::DESC_LOTE
      );
      $orderByLote = array(
          loteTableClass::DESC_LOTE
      );
      $this->objLote = loteTableClass::getAll($fieldsLote, true, $orderByLote, 'ASC');



      $this->defineView('indexDetalleSalida', 'detalleSalida', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
