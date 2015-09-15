<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de defautl.
 */
class reportActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   usuarioTableClass::ID retorna (integer),
    usuarioTableClass::USUARIO retorna  (string),
    usuarioTableClass::CREATED_AT retorna  (timestamp),
    usuarioTableClass::ACTIVED retorna  (integer),
   * estos datos retornan en la variable $fields
   */
  public function execute() {
    try {

      //$this->mensaje = 'Hola a todos';
//            $where = null;
      $where = null;

      if (session::getInstance()->hasAttribute('dateReportSacrificio')) {
        
        $dateReportSacrificio= session::getInstance()->getAttribute('dateReportSacrificio');
        $where=$dateReportSacrificio['where'];

        $fields = array(
            sacrificiovTableClass::CANTIDAD,
            sacrificiovTableClass::TIPO_VENTA_ID,
            sacrificiovTableClass::ID_CERDO,
            sacrificiovTableClass::UNIDAD_MEDIDA_ID,
            sacrificiovTableClass::CREATED_AT
        );
        $orderBy = array(
            sacrificiovTableClass::ID_CERDO,
            sacrificiovTableClass::TIPO_VENTA_ID
        );
        
        $this->objSacrificioV = sacrificiovTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

        $this->defineView('index', 'reporte', session::getInstance()->getFormatOutput());
 }//cierre del try
  } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }//cierre del catch
  }

//cierre de la funcion execute
}

//cierre de la clase