<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of usuarioCredencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class razaTableClass extends razaBaseTableClass {
  
  public static function getTotalPages($lines, $where) {
    
    try {
      $sql = ' SELECT count(' . razaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . razaTableClass::getNameTable() .
              ' WHERE ' . razaTableClass::DELETED_AT . ' is NULL ';
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

  public static function getNameRaza($id) {
    try {
      $sql = 'SELECT ' . razaTableClass::DESC_RAZA . ' As raza '
              . ' FROM ' . razaTableClass::getNameTable() . '  '
              . ' WHERE ' . razaTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id);

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->raza ;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
}

