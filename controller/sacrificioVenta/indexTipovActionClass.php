<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\tipoVentaValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of indexActionClass trae datos para visualizarlos en vista indextemplated
 *
  @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * * @category sacrificio venta
 */
class indexTipovActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        // aqui validar datos de filtros

        if (isset($filter[tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true)]) and empty($filter[tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {
            $descripcion = $filter[tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true)];

            validator::validateFiltroTipo($descripcion);
            if (isset($filter[tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true)]) and empty($filter[tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true)]) === false) {
              $where[tipovTableClass::DESC_TIPOV] = $filter[tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true)];
            }
          }
        }
//
//                if (isset($filter['tipoVenta']) and $filter['tipoVenta'] !== null and $filter['tipoVenta'] !== '') {
//                    $where[tipovTableClass::DESC_TIPOV] = $filter['tipoVenta'];
//                }
        if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
          $where[tipovTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2'])),
              $filter['Date1'],
              $filter['Date2']
          );
        }
        /* para mantener el filtro */
        session::getInstance()->setAttribute('defaultIndexFilters', $where);
      } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
        $where = session::getInstance()->getAttribute('defaultIndexFilters');
      }




      $fields = array(
          tipovTableClass::ID,
          tipovTableClass::DESC_TIPOV,
          tipovTableClass::CREATED_AT
      );

      $orderBy = array(
          tipovTableClass::DESC_TIPOV
      );

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = tipovTableClass::getTotalPages(config::getRowGrid(), $where);
      //  $page = request::getInstance()->getGet('page');


      $this->objTipoV = tipovTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('indexTipov', 'sacrificioVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
