<?php


use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class loteTableClass extends loteBaseTableClass {
  
  public static function getTotalPages($lines, $where) {
    
    try {
      $sql = ' SELECT count(' . loteTableClass::ID . ') AS cantidad ' .
              ' FROM ' . loteTableClass::getNameTable() .
              ' WHERE ' . loteTableClass::DELETED_AT . ' is NULL ';
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

  public static function getNameLote($id) {
    try {
      $sql = 'SELECT ' . loteTableClass::DESC_LOTE . ' As lote '
              . ' FROM ' . loteTableClass::getNameTable() . '  '
              . ' WHERE ' . loteTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id);

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->lote;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  
}

