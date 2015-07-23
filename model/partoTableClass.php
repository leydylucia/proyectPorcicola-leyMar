<?php


use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Alexandra Marcela Florez
 */
class partoTableClass extends partoBaseTableClass {
  
   public static function getTotalPages($lines, $where) {
    try {
      $sql = ' SELECT count(' . partoTableClass::ID . ') AS cantidad ' .
              ' FROM ' . partoTableClass::getNameTable() .
              ' WHERE ' . partoTableClass::DELETED_AT . ' is NULL ';
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
  
  
  public static function getNameParto($id) {
    try {
      $sql = 'SELECT ' . partoTableClass::NUM_NACIDOS . ' As nuevo  '
              . ' FROM ' . partoTableClass::getNameTable() . '  '
              . ' WHERE ' . partoTableClass::ID . ' = :id';
      $params = array(
              ':id' => $id
              );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nuevo;
      
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
