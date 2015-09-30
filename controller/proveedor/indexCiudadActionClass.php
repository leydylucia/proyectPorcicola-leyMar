<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\ciudadValidatorClass as validator;

/**
 * Description of indexCiudadActionClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo proveedor
 */
class indexCiudadActionClass extends controllerClass implements controllerActionInterface {
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

        if (request::getInstance()->hasPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true)) and empty(mvc\request\requestClass::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $nom_ciudad = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true));

            validator::validateFiltroCiudad();
            if (isset($nom_ciudad) and $nom_ciudad !== null and $nom_ciudad !== '') {
              $where[ciudadTableClass::NOM_CIUDAD] = $nom_ciudad;
            }
          }
        }

//        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
//          $where[ciudadTableClass::NOM_CIUDAD] = $filter['nombre'];
//        }

        if (isset($filter['depto']) and $filter['depto'] !== null and $filter['depto'] !== '') {
          $where[ciudadTableClass::DEPTO_ID] = $filter['depto'];
        }
      }
      if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
        $where[ciudadTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
            $filter['Date1'],
            $filter['Date2']
        );
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

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /* para mantener filtro con paginado,@var $where=>filtro */
      $this->cntPages = ciudadTableClass::getTotalPages(config::getRowGrid(), $where);
      //$page = request::getInstance()->getGet('page');


      /*       * * @return $filter=> es que hace el filtro de los campos de la base de datos
       * @return $fields=> son los campos que trae de la base de datos
       * @return $orderBy=> es para dar orden ascendente o descendente de los datos que provienen de la base de datos
       * @param true Descriptiontrue=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente 
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */


      $this->objCiudad = ciudadTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

      $fields = array(
          deptoTableClass::ID,
          deptoTableClass::NOM_DEPTO
      );
      $orderBy = array(
          deptoTableClass::NOM_DEPTO
      );
      $this->objDepto = deptoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $this->defineView('indexCiudad', 'proveedor', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('proveedor', 'indexCiudad');
    }
  }

}
