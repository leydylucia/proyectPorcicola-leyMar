<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detalleEntradaTableClass extends detalleEntradaBaseTableClass {

  public static function getTotalPages($lines, $where) {

    try {
      $sql = ' SELECT count(' . detalleEntradaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . detalleEntradaTableClass::getNameTable() .
              ' WHERE ' . detalleEntradaTableClass::DELETED_AT . ' is NULL ';
      if (is_array($where) === true) {
        foreach ($where as $field => $value) {
          if (is_array($value)) {
            $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'");
          } else {
            $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . '';
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

  public static function getNameDetalle($id) {
    try {
      $sql = 'SELECT ' . detalleEntradaTableClass::CANTIDAD . ' As cant '
              . ' FROM ' . detalleEntradaTableClass::getNameTable() . '  '
              . ' WHERE ' . detalleEntradaTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id);

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->cant;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
