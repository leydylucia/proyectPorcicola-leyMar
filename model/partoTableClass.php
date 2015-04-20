<?php


use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Alexandra Marcela Florez
 */
class partoTableClass extends partoBaseTableClass {
  
  public static function getNameParto($id) {
    try {
      $sql = 'SELECT ' . partoTableClass::FECHA_MONTADA . ' As fecha  '
              . ' FROM ' . partoTableClass::getNameTable() . '  '
              . ' WHERE ' . partoTableClass::ID . ' = :id';
      $params = array(
              ':id' => $id
              );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->fecha;
      
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
