<?php


use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author marcela florez
 */
class controlTableClass extends controlBaseTableClass {
     public static function getTotalPages($lines, $where) {
    try {
      $sql = ' SELECT count(' . controlTableClass::ID . ') AS peso ' .
              ' FROM ' . controlTableClass::getNameTable() .
              ' WHERE ' . controlTableClass::DELETED_AT . ' is NULL ';
      if (is_array($where) === true) {
        foreach ($where as $field => $value) {
          if (is_array($value)) {
            $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value'");
          } else {
            $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . '';
          }
        }
      }
     $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->peso;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getNameControl($id) {
    try {
      $sql = 'SELECT ' . controlTableClass::PESO_CERDO. ' As cerdo '
              . ' FROM ' . controlTableClass::getNameTable() . '  '
              . ' WHERE ' . controlTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id);

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->cerdo;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
}
