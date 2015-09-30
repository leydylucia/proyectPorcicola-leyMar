x<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\proveedorValidatorClass as validator;

/**
 * Description of indexProvActionClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo proveedor
 */
class indexProvActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $where=> se encuentra nulo para entrar en la sentencia getAll
   * Todas estos datos se pasan en la variable @var $data 
   * ** */

  public function execute() {
    try {

      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        if (request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true)) and empty(mvc\request\requestClass::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true));

            validator::validateFiltroNombre();
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
              $where[proveedorTableClass::NOMBRE] = $nombre;
            }
          }
        }

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[proveedorTableClass::NOMBRE] = $filter['nombre'];
        }

        if (request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)) and empty(mvc\request\requestClass::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true));

            validator::validateFiltroApellido();
            if (isset($apellido) and $apellido !== null and $apellido !== '') {
              $where[proveedorTableClass::APELLIDO] = $apellido;
            }
          }
        }

        if (isset($filter['apellido']) and $filter['apellido'] !== null and $filter['apellido'] !== '') {
          $where[proveedorTableClass::APELLIDO] = $filter['apellido'];
        }

        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== '') {
          $where[proveedorTableClass::CIUDAD_ID] = $filter['ciudad'];
        }
      }
      if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
        $where[proveedorTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
            $filter['Date1'],
            $filter['Date2']
        );
      }


      $fields = array(
          proveedorTableClass::ID,
          proveedorTableClass::NOMBRE,
          proveedorTableClass::APELLIDO,
          proveedorTableClass::DIRECCION,
          proveedorTableClass::CORREO,
          proveedorTableClass::TELEFONO,
          proveedorTableClass::CIUDAD_ID,
          proveedorTableClass::CREATED_AT
      );
      $orderBy = array(
          proveedorTableClass::NOMBRE
      );

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /* para mantener filtro con paginado,@var $where=> para sostener el filtro con el paginado
       * getTotalPages => se encuentra en proveedorTablesclass
       * @var $this para enviar al cntPages"contador de pagina" a la vista 
       *  */
      $this->cntPages = proveedorTableClass::getTotalPages(config::getRowGrid(), $where);
      //$page = request::getInstance()->getGet('page');


      /*       * * @return $filter=> es que hace el filtro de los campos de la base de datos
       * @return $fields=> son los campos que trae de la base de datos
       * @return $orderBy=> es para dar orden ascendente o descendente de los datos que provienen de la base de datos
       * @param true Descriptiontrue=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente 
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */


      $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOM_CIUDAD
      );
      $orderBy = array(
          ciudadTableClass::NOM_CIUDAD
      );
      $this->objCiudad = ciudadTableClass::getAll($fields, true, $orderBy, 'ASC');

      $this->defineView('index', 'proveedor', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {


      routing::getInstance()->redirect('proveedor', 'indexProv');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo '<pre>';
//      print_r($exc->getTrace());
//      echo '</pre>';
    }
  }

}
