<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\partoValidatorClass as validator;

/**
 *Description of indexActionClass trae datos para visualizarlos en vista indextemplated
 *
 * @author Alexandra Florez
 * @category modulo parto
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      /* filtros */
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        
        if (request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) and empty(mvc\request\requestClass::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $num_nacidos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true));

            validator::validateFiltroNacidos();
            if (isset($num_nacidos) and $num_nacidos !== null and $num_nacidos !== '') {
              $where[partoTableClass::NUM_NACIDOS] = $num_nacidos;
            }
          }
        }

        if (isset($filter['nacidos']) and $filter['nacidos'] !== null and $filter['nacidos'] !== '') {
          $where[partoTableClass::NUM_NACIDOS] = $filter['nacidos'];
        }
        
        if (request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) and empty(mvc\request\requestClass::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $num_vivos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true));

            validator::validateFiltroVivos();
            if (isset($num_vivos) and $num_vivos !== null and $num_vivos !== '') {
              $where[partoTableClass::NUM_VIVOS] = $num_vivos;
            }
          }
        }
        
        if (isset($filter['vivos']) and $filter['vivos'] !== null and $filter['vivos'] !== '') {
          $where[partoTableClass::NUM_VIVOS] = $filter['vivos'];
        }
      }
      if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
        $where[partoTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
            $filter['Date1'],
            $filter['Date2']
        );
      }


      $fields = array(
          partoTableClass::ID,
          partoTableClass::FECHA_NACIMIENTO,
          partoTableClass::NUM_NACIDOS,
          partoTableClass::NUM_VIVOS,
          partoTableClass::NUM_MUERTOS,
          partoTableClass::NUM_HEMBRAS,
          partoTableClass::NUM_MACHOS,
          partoTableClass::FECHA_MONTADA,
          partoTableClass::ID_PADRE,
          partoTableClass::HOJA_VIDA_ID,
          partoTableClass::CREATED_AT
      );
      $orderBy = array(
          partoTableClass::NUM_NACIDOS
      );

      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      /* para mantener filtro con paginado,@var $where=>filtro */
      $this->cntPages = partoTableClass::getTotalPages(config::getRowGrid(), $where);
      //$page = request::getInstance()->getGet('page');


      /** @var $where => para filtros
       * *@var $page => para el paginado
       * *@var $fileds => para declarar los cmpos de la table en la bd
       * @var $orderBy => ordernar por el campo deseado
       *  true=> es el borrado logico si lo tienes en la bd pones true sino false
       * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
       * config::getRowGrid()=> va con el paginado y hace una funcion
       * @var $this->objInsumo para enviar los datos a la vista      */
      $this->objParto = partoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $this->defineView('index', 'parto', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      //session::getInstance()->setFlash('exc', $exc);
      //routing::getInstance()->forward('shfSecurity', 'exception');
      routing::getInstance()->redirect('parto', 'index');
    }
  }

}




