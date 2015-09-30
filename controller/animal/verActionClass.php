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
 *
 * @author Alexandra Florez
 */
class verActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $genero_id=> genero (bigint)
   * @return $fecha_nacimiento=> fecha nacimiento (date)
   * @return $estado_id=> estado (bigint)
   * @return $lote_id=> lote(bigint)
   * @return $raza_id=> raza(bigint)
   * @return $nombre_cerdo =>nombre del cerdo (varchar)
   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {

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
      $where = array(
          hojaVidaTableClass::ID => request::getInstance()->getRequest(hojaVidaTableClass::ID)
      );
      $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('ver', 'animal', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
