<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class tipoIdTableClass extends tipoIdBaseTableClass {

  public static function getTotalPages($lines, $where) {
    try {
      $sql = ' SELECT count(' . tipoIdTableClass::ID . ') AS tipo ' .
              ' FROM ' . tipoIdTableClass::getNameTable() .
              ' WHERE ' . tipoIdTableClass::DELETED_AT . ' is NULL ';
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
      return ceil($answer[0]->tipo / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getNameTipo($id) {
    try {
      $sql = 'SELECT ' . tipoIdTableClass::DESC_TIPO_ID . ' AS desc_tipo  '
              . ' FROM ' . tipoIdTableClass::getNameTable() . '  '
              . ' WHERE ' . tipoIdTableClass::ID . ' = :id';

      $params = array(
          ':id' => $id
      );

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->desc_tipo;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
