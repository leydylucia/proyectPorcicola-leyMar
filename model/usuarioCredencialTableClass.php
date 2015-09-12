<?php

use mvc\model\modelClass as model;
//use mvc\config\myConfigClass as config;
use mvc\config\myConfigClass as config;

/**
 * Description of usuarioCredencialTableClass
 *
 * @author leydylucia castillo mosquera<leydylucia@hotmail.com>
 */
class usuarioCredencialTableClass extends usuarioCredencialBaseTableClass {
  /*Description funcion getTotalPages para el paginado */  
   public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . usuarioCredencialTableClass::ID . ') AS cantidad ' ./*DEJAR ESPACIO EN EL AND BETWEEN Y NULL*/
                    ' FROM ' . usuarioCredencialTableClass::getNameTable();
            if (is_array($where) === true) {
                foreach ($where as $field => $value) {
                    if (is_array($value)) {
                        $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'");
                    } else {
                        $sql = $sql . ' WHERE ' . $field . '=' . ((is_numeric($value)) ? $value : "'$value'") . '';
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
}