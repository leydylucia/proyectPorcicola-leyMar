<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of verActionClass  sirve para ver un dato en la grilla
 *@author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * @category modulo detalle hoja*/

class verActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $peso_cerdo=> peso_cerdo(bigint)
   * @return $unidad_medida=> unidad medida (bigint)
   * @return $hoja_vida=> id hoja de vida (bigint)
   * @return $insumo=> insumo(bigint)
   * @return $dosis=> dosis(integer)
   * @return $tipo_insumo =>tipo insumo (bigint)
   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {

      $fields = array(
          detalleHojaTableClass::ID,
          detalleHojaTableClass::PESO_CERDO,
          detalleHojaTableClass::UNIDAD_MEDIDA_ID,
          detalleHojaTableClass::DOSIS,
          detalleHojaTableClass::INSUMO_ID,
          detalleHojaTableClass::TIPO_INSUMO_ID,
          detalleHojaTableClass::CREATED_AT,
      );
      $where = array(
          detalleHojaTableClass::ID => request::getInstance()->getRequest(detalleHojaTableClass::ID)
      );
      $this->objDetalleHoja = detalleHojaTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->detalleHojaId = request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true));
      $this->defineView('ver', 'detalleHoja', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
