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

class reportCiudadActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        // aqui validar datos de filtros

        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== '') {
          $where[ciudadTableClass::NOM_CIUDAD] = $filter['ciudad'];
        }
        if (isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '' and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
          $where[proveedorTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($filter['Date1'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($filter['Date2'] . ' 23:59:59'))
          );
        }
        /* para mantener filtro con paginado */
        session::getInstance()->setAttribute('defaultIndexFilters', $where);
      } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
        $where = session::getInstance()->getAttribute('defaultIndexFilters');
      }


      $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOM_CIUDAD,
          ciudadTableClass::DEPTO_ID
              //ciudadTableClass::CREATED_AT
      );
      $orderBy = array(
          ciudadTableClass::NOM_CIUDAD
      );

      
      $this->objCiudad = ciudadTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
       $fields = array(
          deptoTableClass::ID,
          deptoTableClass::NOM_DEPTO
              //ciudadTableClass::CREATED_AT
      );
      $orderBy = array(
          deptoTableClass::NOM_DEPTO
      );

      
      $this->objDepto = deptoTableClass::getAll($fields, false, $orderBy, 'ASC');
      
      
      $this->defineView('indexCiudad', 'proveedor', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
