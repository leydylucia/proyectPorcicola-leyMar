<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/*
 * DESCRIPCION DE LA CLASE
 * @autor Alexandra Marcela Florez
 */

class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[hojaVidaTableClass::GENERO_ID] = $filter['nombre'];
        }
//        if (isset($filter['madre']) and $filter['madre'] !== null and $filter['madre'] !== '') {
//          $where[hojaVidaTableClass::ID_MADRE] = $filter['madre'];
//        }


        /* para mantener filtro con paginado */
        session::getInstance()->setAttribute('defaultIndexFilters', $where);
      } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
        $where = session::getInstance()->getAttribute('defaultIndexFilters');
      }



      $fields = array(
          hojaVidaTableClass::ID,
          hojaVidaTableClass::GENERO_ID,
          hojaVidaTableClass::FECHA_NACIMIENTO,
          hojaVidaTableClass::ESTADO_ID,
          hojaVidaTableClass::LOTE_ID,
          hojaVidaTableClass::RAZA_ID,
          hojaVidaTableClass::NOMBRE_CERDO,
          hojaVidaTableClass::CREATED_AT
              //hojaVidaTableClass::ID_MADRE
      );
      $orderBy = array(
          hojaVidaTableClass::ID,
          hojaVidaTableClass::NOMBRE_CERDO
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
      $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
      $fields = array(
          generoTableClass::ID,
          generoTableClass::DESCRIPCION
      );
      $orderBy = array(
          generoTableClass::DESCRIPCION
      );
      $this->objGenero = generoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $this->defineView('index', 'animal', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
