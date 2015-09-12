<?php

use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Alexandra Marcela Florez
 */
class deptoTableClass extends deptoBaseTableClass {

  public static function getTotalPages($lines, $where) {
        try {
            $sql = ' SELECT count(' . deptoTableClass::ID . ') AS depto ' .
                    ' FROM ' . deptoTableClass::getNameTable() .
                    ' WHERE ' . deptoTableClass::DELETED_AT . ' is NULL ';
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
            return ceil($answer[0]->depto / $lines);
        } catch (PDOException $exc) {
            throw $exc;
        }
    }


  public static function getNameDepto($id) {
    try {
      $sql = 'SELECT ' . deptoTableClass::NOM_DEPTO . ' AS nom_depto  '
              . ' FROM ' . deptoTableClass::getNameTable() . '  '
              . ' WHERE ' . deptoTableClass::ID . ' = :id';

      $params = array(
          ':id' => $id
      );

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nom_depto;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  
}
