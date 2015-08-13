<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\empleadoValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        
        if (request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) and empty(mvc\request\requestClass::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $nombre = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true));

            validator::validateFiltroNombre();
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
              $where[empleadoTableClass::NOMBRE] = $nombre;
            }
          }
        }

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[empleadoTableClass::NOMBRE] = $filter['nombre'];
        }
        
        if (request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $apellido = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true));

            validator::validateFiltroApellido();
            if (isset($apellido) and $apellido !== null and $apellido !== '') {
              $where[empleadoTableClass::APELLIDO] = $apellido;
            }
          }
        }
        
        if (isset($filter['apellido']) and $filter['apellido'] !== null and $filter['apellido'] !== '') {
          $where[empleadoTableClass::APELLIDO] = $filter['apellido'];
        }
      }
      if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
        $where[empleadoTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
            $filter['Date1'],
            $filter['Date2']
        );
      }


      $fields = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE,
          empleadoTableClass::USUARIO_ID,
          empleadoTableClass::TIPO_ID_ID,
          empleadoTableClass::DOCUMENTO,
          empleadoTableClass::APELLIDO,
          empleadoTableClass::DIRECCION,
          empleadoTableClass::CORREO,
          empleadoTableClass::TELEFONO,
          empleadoTableClass::CREATED_AT
      );
      $orderBy = array(
          empleadoTableClass::NOMBRE
      );

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /* para mantener filtro con paginado,@var $where=>filtro */
      $this->cntPages = empleadoTableClass::getTotalPages(config::getRowGrid(), $where);
      //$page = request::getInstance()->getGet('page');


      /** @var $where => para filtros
       * *@var $page => para el paginado
       * *@var $fileds => para declarar los cmpos de la table en la bd
       * @var $orderBy => ordernar por el campo deseado
       *  true=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */
      $this->objEmpleado = empleadoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('index', 'empleado', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      //session::getInstance()->setFlash('exc', $exc);
      
      routing::getInstance()->redirect('empleado', 'index');
      //routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
