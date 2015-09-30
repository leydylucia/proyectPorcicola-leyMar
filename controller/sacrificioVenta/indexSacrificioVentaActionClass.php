<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\validator\sacrificioVentaValidatorClass as validator;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * DDescription of indexActionClass trae datos para visualizarlos en vista indextemplated
 *
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * * @category sacrificio venta

 */
class indexSacrificioVentaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');

        if (isset($filter['valor']) and $filter['valor'] !== null and $filter['valor'] !== '') {
          $where[sacrificiovTableClass::VALOR] = $filter['valor'];
        }

        if (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CANTIDAD, true)) and empty(mvc\request\requestClass::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CANTIDAD, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $cantidad = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CANTIDAD, true));

            validator::validateFiltroCantidad();
            if (isset($cantidad) and $cantidad !== null and $cantidad !== '') {
              $where[sacrificiovTableClass::CANTIDAD] = $cantidad;
            }
          }
        }


//                if (isset($filter['cantidad']) and $filter['cantidad'] !== null and $filter['cantidad'] !== '') {
//                    $where[sacrificiovTableClass::CANTIDAD] = $filter['cantidad'];
//                }

        if (isset($filter['Tipo_venta']) and $filter['Tipo_venta'] !== null and $filter['Tipo_venta'] !== '') {
          $where[sacrificiovTableClass::TIPO_VENTA_ID] = $filter['Tipo_venta'];
        }
        if (isset($filter['Cerdo']) and $filter['Cerdo'] !== null and $filter['Cerdo'] !== '') {
          $where[sacrificiovTableClass::ID_CERDO] = $filter['Cerdo'];
        }

        if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
          $where[sacrificiovTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
              $filter['Date1'],
              $filter['Date2']
          );
        }
        /* para mantener filtro con paginado */
//                print_r($where);
//              echo  $filter['Date2'];
//                exit();
//                session::getInstance()->setAttribute('defaultIndexFilters', $where);
//            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
//                $where = session::getInstance()->getAttribute('defaultIndexFilters');
      }



      $fields = array(
          sacrificiovTableClass::ID,
          sacrificiovTableClass::VALOR,
          sacrificiovTableClass::TIPO_VENTA_ID,
          sacrificiovTableClass::ID_CERDO,
          sacrificiovTableClass::CANTIDAD,
          sacrificiovTableClass::UNIDAD_MEDIDA_ID,
          sacrificiovTableClass::CREATED_AT
      );
      $orderBy = array(
          sacrificiovTableClass::VALOR
      );

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /*       * para mantener filtro con paginado,@var $this para enviar al cntPages"contador de pagina" a la vista 
       * *getTotalPages => se encuentra en insumoTables class
       * * @var $where => para sostener el filtro con el paginado  */
      $this->cntPages = sacrificiovTableClass::getTotalPages(config::getRowGrid(), $where);
      // $page = request::getInstance()->getGet('page');


      /** @var $where => para filtros
       * *@var $page => para el paginado
       * *@var $fileds => para declarar los cmpos de la table en la bd
       * @var $orderBy => ordernar por el campo deseado
       *  true=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */
      $this->objSacrificioV = sacrificiovTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      //estos campo son para llamar las foraneas
      $fieldsa = array(
          tipovTableClass::ID,
          tipovTableClass::DESC_TIPOV
      );
      $orderBy = array(
          tipovTableClass::DESC_TIPOV
      );
      $this->objTipoV = tipovTableClass::getAll($fieldsa, true, $orderBy, 'ASC');

      $fieldsCerdo = array(/* foranea cerdo"hoja de vida" */
          hojaVidaTableClass::ID,
          hojaVidaTableClass::NOMBRE_CERDO
      );
      $orderByCerdo = array(
          hojaVidaTableClass::NOMBRE_CERDO
      );
      $this->objHojaVida = hojaVidaTableClass::getAll($fieldsCerdo, true, $orderByCerdo, 'ASC');


      $this->defineView('indexSacrificioVenta', 'sacrificioVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
//            routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
//            session::getInstance()->setFlash('exc', $exc);
//            routing::getInstance()->forward('shfSecurity', 'exception');
      routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
    }
  }

}
