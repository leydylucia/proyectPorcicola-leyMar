<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of usuarioCredencialTableClass
 * @var public static function getTotalPages para hacer el conteo de paginas
 *
 * @author leydy lucia castillo mosquera<leydylucia@hotmail.com>
 */
class tipoInsumoTableClass extends tipoInsumoBaseTableClass {
      public static function getTotalPages($lines,$where) {
    try {
      $sql = 'SELECT count('.tipoInsumoTableClass::ID .') AS cantidad ' .  
              ' FROM ' . tipoInsumoTableClass::getNameTable() . 
              ' WHERE ' .tipoInsumoTableClass::DELETED_AT. ' is NULL ';
      
      if(is_array($where)===true){
          foreach ($where as $field=>$value){
              if (is_array($value)){
                  $sql=$sql.' AND '.$field.' BETWEEN '.((is_numeric($value[0]))? $value[0]:"'$value[0]'"). ' AND '.((is_numeric($value[1]))? $value[1]:"'$value'");
              }else{
                  $sql=$sql.' AND '.$field.'='.((is_numeric($value))?$value:"'$value'").'';
              }
          }
      }
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0] -> cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
   public static function getNameTipoin($id) {
    try {
      $sql = 'SELECT ' . tipoInsumoTableClass::DESC_TIPOIN . ' AS desc_tipoin  '
              . ' FROM ' . tipoInsumoTableClass::getNameTable() . '  '
              . ' WHERE ' . tipoInsumoTableClass::ID . ' = :id';

      $params = array(
          ':id' => $id
      );

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->desc_tipoin;
    } catch (PDOException $exc) {
      throw $exc;
    }
  
}
}


