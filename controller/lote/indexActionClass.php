<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\loteValidatorClass as validator;

/**
 * Description of indexActionClass trae datos para visualizarlos en vista indextemplated
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo credencia
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        if (request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true)) and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $desc_lote = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true));

            validator::validateFiltroLote();
            if (isset($desc_lote) and $desc_lote !== null and $desc_lote !== '') {
              $where[loteTableClass::DESC_LOTE] = $desc_lote;
            }
          }
        }

        if (isset($filter['desc_lote']) and $filter['desc_lote'] !== null and $filter['desc_lote'] !== '') {
          $where[loteTableClass::DESC_LOTE] = $filter['desc_lote'];
        }

//        if (request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::UBICACION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true))) === false) {
//
//          if (request::getInstance()->isMethod('POST')) {
//            $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
//
//            validator::validateFiltroUbibacion();
//            if (isset($ubicacion) and $ubicacion !== null and $ubicacion !== '') {
//              $where[loteTableClass::UBICACION] = $ubicacion;
//            }
//          }
//        }

        if (isset($filter['ubicacion']) and $filter['ubicacion'] !== null and $filter['ubicacion'] !== '') {
          $where[loteTableClass::UBICACION] = $filter['ubicacion'];
        }
      }
      if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
        $where[loteTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
            $filter['Date1'],
            $filter['Date2']
        );
      }


      $fields = array(
          loteTableClass::ID,
          loteTableClass::DESC_LOTE,
          loteTableClass::UBICACION,
          loteTableClass::CREATED_AT
      );
      $orderBy = array(
          loteTableClass::ID
      );

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /* para mantener filtro con paginado,@var $where=>filtro */
      $this->cntPages = loteTableClass::getTotalPages(config::getRowGrid(), $where);
      //$page = request::getInstance()->getGet('page');


      /** @var $where => para filtros
       * *@var $page => para el paginado
       * *@var $fileds => para declarar los cmpos de la table en la bd
       * @var $orderBy => ordernar por el campo deseado
       *  true=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('index', 'lote', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('lote', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo '<pre>';
//      print_r($exc->getTrace());
//      echo '</pre>';
    }
  }

}
