<?php


use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class generoTableClass extends generoBaseTableClass {
  
  public static function getTotalPages($lines, $where) {
    
    try {
      $sql = ' SELECT count(' . generoTableClass::ID . ') AS cantidad ' .
              ' FROM ' . generoTableClass::getNameTable() .
              ' WHERE ' . generoTableClass::DELETED_AT . ' is NULL ';
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

  public static function getNameGenero($id) {
    try {
      $sql = 'SELECT ' . generoTableClass::DESCRIPCION . ' As genero '
              . ' FROM ' . generoTableClass::getNameTable() . '  '
              . ' WHERE ' . generoTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id);

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->genero;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
}

