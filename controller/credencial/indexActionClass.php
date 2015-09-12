<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\credencialValidatorClass as validator;
/**
 * Description of indexProvActionClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo credencial
 */
class indexActionClass extends controllerClass implements controllerActionInterface {
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
        
        if (request::getInstance()->hasPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true)) and empty(mvc\request\requestClass::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));

            validator::validateFiltroNombre();
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
              $where[credencialTableClass::NOMBRE] = $nombre;
            }
          }
        }

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[credencialTableClass::NOMBRE] = $filter['nombre'];
        }
        
      }
      if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
        $where[credencialTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
            $filter['Date1'],
            $filter['Date2']
        );
      }


      $fields = array(
          credencialTableClass::ID,
          credencialTableClass::NOMBRE,
          credencialTableClass::CREATED_AT
      );
      $orderBy = array(
          credencialTableClass::NOMBRE
      );

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /* para mantener filtro con paginado,@var $where=> para sostener el filtro con el paginado
       * getTotalPages => se encuentra en credencialTablesclass
       * @var $this para enviar al cntPages"contador de pagina" a la vista 
       *  */
      $this->cntPages = credencialTableClass::getTotalPages(config::getRowGrid(), $where);
      //$page = request::getInstance()->getGet('page');


      /*       * * @return $filter=> es que hace el filtro de los campos de la base de datos
       * @return $fields=> son los campos que trae de la base de datos
       * @return $orderBy=> es para dar orden ascendente o descendente de los datos que provienen de la base de datos
       * @param true Descriptiontrue=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente 
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */
      
      $this->objCredencial = credencialTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('index', 'credencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      //session::getInstance()->setFlash('exc', $exc);
      //routing::getInstance()->forward('shfSecurity', 'exception');
      routing::getInstance()->redirect('credencial', 'index');
    }
  }

}
