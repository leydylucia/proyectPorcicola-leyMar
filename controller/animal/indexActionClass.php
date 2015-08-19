<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\animalValidatorClass as validator;

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

        if (isset($filter['genero']) and $filter['genero'] !== null and $filter['genero'] !== '') {
          $where[hojaVIdaTableClass::GENERO_ID] = $filter['genero'];
        }
//        if (isset($filter['madre']) and $filter['madre'] !== null and $filter['madre'] !== '') {
//          $where[hojaVidaTableClass::ID_MADRE] = $filter['madre'];
//        }
      }
      if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
        $where[hojaVidaTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
            $filter['Date1'],
            $filter['Date2']
        );
      }


      $fields = array(
          hojaVidaTableClass::ID,
          hojaVidaTableClass::GENERO_ID,
          hojaVidaTableClass::FECHA_NACIMIENTO,
          hojaVidaTableClass::ESTADO_ID,
          hojaVidaTableClass::LOTE_ID,
          hojaVidaTableClass::RAZA_ID,
          hojaVidaTableClass::NOMBRE_CERDO,
          //hojaVidaTableClass::ID_MADRE,
          hojaVidaTableClass::CREATED_AT
      );
      $orderBy = array(
          hojaVidaTableClass::ID,
          hojaVidaTableClass::NOMBRE_CERDO
      );

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /* para mantener filtro con paginado,@var $where=>filtro */
      $this->cntPages = hojaVidaTableClass::getTotalPages(config::getRowGrid(), $where);
      //$page = request::getInstance()->getGet('page');


      /** @var $where => para filtros
       * *@var $page => para el paginado
       * *@var $fileds => para declarar los cmpos de la table en la bd
       * @var $orderBy => ordernar por el campo deseado
       *  true=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */
      
      $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
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
      routing::getInstance()->redirect('animal', 'index');
    }
  }
}
