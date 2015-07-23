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
          $where[empleadoTableClass::NOMBRE] = $filter['nombre'];
        }
        if (isset($filter['apellido']) and $filter['apellido'] !== null and $filter['apellido'] !== '') {
          $where[empleadoTableClass::APELLIDO] = $filter['apellido'];
        }


        /* para mantener filtro con paginado */
        session::getInstance()->setAttribute('defaultIndexFilters', $where);
      } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
        $where = session::getInstance()->getAttribute('defaultIndexFilters');
      }

      $fields = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE,
          empleadoTableClass::USUARIO_ID,
          empleadoTableClass::TIPO_ID_ID,
          empleadoTableClass::APELLIDO,
          empleadoTableClass::DIRECCION,
          empleadoTableClass::CORREO,
          empleadoTableClass::TELEFONO,
          empleadoTableClass::CREATED_AT
      );
      $orderBy = array(
          empleadoTableClass::NOMBRE
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
      $this->objEmpleado = empleadoTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

      $this->defineView('index', 'empleado', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
