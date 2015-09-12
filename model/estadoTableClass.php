<?php


use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class estadoTableClass extends estadoBaseTableClass {
  
  public static function getTotalPages($lines, $where) {
    
    try {
      $sql = ' SELECT count(' . estadoTableClass::ID . ') AS cantidad ' .
              ' FROM ' . estadoTableClass::getNameTable() .
              ' WHERE ' . estadoTableClass::DELETED_AT . ' is NULL ';
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

  public static function getNameEstado($id) {
    try {
      $sql = 'SELECT ' . estadoTableClass::DESC_ESTADO . ' As estado '
              . ' FROM ' . estadoTableClass::getNameTable() . '  '
              . ' WHERE ' . estadoTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id);

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->estado;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
}

