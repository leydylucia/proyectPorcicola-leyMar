<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deptoTableClass extends deptoBaseTableClass {

  public static function getNameDepto($id) {
    try {
      $sql = 'SELECT ' . deptoTableClass::NOM_DEPTO . ' As nom_depto  '
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
