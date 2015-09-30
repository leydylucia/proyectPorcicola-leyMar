<?php

use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insumoTableClass
 *
 * @author leydy lucia castillo 
 */
class insumoTableClass extends insumoBaseTableClass {
    
    
    
    /**
   * Método para el paginado
   *
   * @var $where para mantener el filtro y va al controller
   
   */

    public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . insumoTableClass::ID . ') AS cantidad ' ./*DEJAR ESPACIO EN EL AND BETWEEN Y NULL*/
                    ' FROM ' . insumoTableClass::getNameTable() .
                    ' WHERE ' . insumoTableClass::DELETED_AT . ' is NULL ';
            if (is_array($where) === true) {
                foreach ($where as $field => $value) {
                    if (is_array($value)) {
                        $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'");
                    } else {
                        $sql = $sql . ' AND ' . $field . '=' . ((is_numeric($value)) ? $value : "'$value'") . '';
                    }
                }
            }

            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / $lines);
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
 /**
   * Método public static function getNameInsumo($id)  para foreanea
   *
   * 
   
   */
    
    public static function getNameInsumo($id) {
        try {
            $sql = 'SELECT ' . insumoTableClass::DESC_INSUMO . ' As desc_insumo '
//                    . insumoTableClass::FECHA_FABRICACION . ' As fecha_fabricacion '
//                    . insumoTableClass::FECHA_VENCIMIENTO . ' As fecha_vencimiento '
//                    . insumoTableClass::PRECIO . ' As precio '
//                    . insumoTableClass::PROVEEDOR_ID . ' As proveedor '
//                    . insumoTableClass::TIPO_INSUMO_ID . ' As tipo_insumo '
                    . ' FROM ' . insumoTableClass::getNameTable() . '  '
                    . ' WHERE ' . insumoTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id);

            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->desc_insumo;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getInventario($idInsumo){
    try {
      $sql = 'SELECT ' . '  '. 'SUM ('. detalleEntradaTableClass::CANTIDAD  . ') ' . ' As total'
             . '  FROM ' . detalleEntradaTableClass::getNameTable() . ',' . insumoTableClass::getNameTable() . ',' . tipoInsumoTableClass::getNameTable() . '  ' 
             . ' WHERE ' .  detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID) . ' = '. insumoTableClass::getNameField(insumoTableClass::ID) . ' AND ' .  insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID) . ' = '. tipoinsumoTableClass::getNameField(tipoinsumoTableClass::ID) .'  '
             . ' AND ' . insumoTableClass::getNameTable() . '.'. insumoTableClass::ID . ' = ' . $idInsumo. '  '
              ;
    
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//       print_r($sql);
//     exit();
      return $answer[0]->total;
      
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }

}
