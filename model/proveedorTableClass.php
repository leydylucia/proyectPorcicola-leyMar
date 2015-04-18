<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Alexandra Florez
 */
class proveedorTableClass extends proveedorBaseTableClass {

  public static function getTotalPages($lines, $where) {
    try {
      $sql = ' SELECT count(' . proveedorTableClass::ID . ') AS cantidad ' .
              ' FROM ' . proveedorTableClass::getNameTable() .
              ' WHERE ' . proveedorTableClass::DELETED_AT . ' is NULL ';
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

  public static function getNameProveedor($id) {
    try {
      $sql = 'SELECT ' . proveedorTableClass::NOMBRE . ' As nombre '
//              . proveedorTableClass::APELLIDO . ' As apellido '
//              . proveedorTableClass::DIRECCION . ' As direccion '
//              . proveedorTableClass::CORREO . ' As correo '
//              . proveedorTableClass::TELEFONO . ' As telefono '
//              . proveedorTableClass::CIUDAD_ID . ' As ciudad '
              . ' FROM ' . proveedorTableClass::getNameTable() . '  '
              . ' WHERE ' . proveedorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id);

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nombre;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
