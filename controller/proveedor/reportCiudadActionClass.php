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
 * @autor Alexandra Marcela Florez
 */

class reportCiudadActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        // aqui validar datos de filtros

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[ciudadTableClass::NOM_CIUDAD] = $filter['nombre'];
        }
        if (isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '' and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
          $where[proveedorTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($filter['Date1'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($filter['Date2'] . ' 23:59:59'))
          );
        }
        /* para mantener filtro con paginado */
        session::getInstance()->setAttribute('defaultIndexFilters', $where);
      } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
        $where = session::getInstance()->getAttribute('defaultIndexFilters');
      }

      $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOM_CIUDAD,
          ciudadTableClass::DEPTO_ID,
          ciudadTableClass::CREATED_AT
      );
      $orderBy = array(
          ciudadTableClass::NOM_CIUDAD
      );



      /*       * para mantener filtro con paginado,@var $this para enviar al cntPages"contador de pagina" a la vista 
       * *getTotalPages => se encuentra en insumoTables class
       * * @var $where => para sostener el filtro con el paginado  */

      // $page = request::getInstance()->getGet('page');


      /** @var $where => para filtros
       * *@var $page => para el paginado
       * *@var $fileds => para declarar los cmpos de la table en la bd
       * @var $orderBy => ordernar por el campo deseado
       *  true=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */
      $this->objCiudad = ciudadTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

      $this->defineView('indexCiudad', 'proveedor', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
