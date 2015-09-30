<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of  esta clase sirve para realizar los reportes
 *
 * @author Alexandra Florez
 * @category modulo credencial
 */

class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      /* filtros en reporte */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');


        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[credencialTableClass::NOMBRE] = $filter['nombre'];
        }
        /* para mantener filtro con paginado */
        session::getInstance()->setAttribute('defaultIndexFilters', $where);
      } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
        $where = session::getInstance()->getAttribute('defaultIndexFilters');
      }

      $fields = array(
          credencialTableClass::ID,
          credencialTableClass::NOMBRE,
          credencialTableClass::CREATED_AT
      );
      $orderBy = array(
          credencialTableClass::NOMBRE
      );



      /*       * para mantener filtro con paginado,@var $this para enviar al cntPages"contador de pagina" a la vista 
       * *getTotalPages => se encuentra en insumoTables class
       * * @var $where => para sostener el filtro con el paginado  */

      // $page = request::getInstance()->getGet('page');


      /** @var $where => para filtros
       * @var $fileds => para declarar los cmpos de la table en la bd
       * @var $orderBy => ordernar por el campo deseado
       *  true=> es el borrado logico si lo tienes en la bd pones true sino false
       * @var $this->objCredencial para enviar los datos a la vista      */
      $this->objCredencial = credencialTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

      $this->defineView('index', 'credencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
