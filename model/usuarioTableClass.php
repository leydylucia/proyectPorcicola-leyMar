<?php

use mvc\model\modelClass as model;
//use mvc\config\myConfigClass as config;
use mvc\config\myConfigClass as config;

/**
 * Description of usuarioTableClass
 *
 * @author leydy lucia castillo mosquera<leydylucia@hotmail.com>*/
class usuarioTableClass extends usuarioBaseTableClass {

  public static function verifyUser($usuario, $password) {
    try {
      $sql = 'SELECT ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' as credencial,
	' . usuarioTableClass::getNameField(usuarioTableClass::USER) . ' as usuario,
	' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' as id_usuario
    FROM ' . usuarioTableClass::getNameTable() . ' LEFT JOIN ' . usuarioCredencialTableClass::getNameTable() . ' ON ' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' = ' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID) . '
    LEFT JOIN ' . credencialTableClass::getNameTable() . ' ON ' . credencialTableClass::getNameField(credencialTableClass::ID) . ' = ' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID) . '
    WHERE ' . usuarioTableClass::getNameField(usuarioTableClass::ACTIVED) . ' = :actived
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::DELETED_AT) . ' IS NULL
    AND ' . credencialTableClass::getNameField(credencialTableClass::DELETED_AT) . ' IS NULL
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::USER) . ' = :user
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::PASSWORD) . ' = :pass';
      $params = array(
          ':user' => $usuario,
          ':pass' => md5($password),
          ':actived' => ((config::getDbDriver() === 'mysql') ? 1 : 't')
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) > 0 ) ? $answer : false;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function setRegisterLastLoginAt($id) {
    try {
      $sql = 'UPDATE ' . usuarioTableClass::getNameTable() . '
              SET ' . usuarioTableClass::LAST_LOGIN_AT . ' = :last_login_at
              WHERE ' . usuarioTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id,
          ':last_login_at' => date(config::getFormatTimestamp())
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      return true;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
 /*funcion para el paginado*/ 
  public static function getTotalPages($lines,$where) {
    try {
      $sql = 'SELECT count('.usuarioTableClass::ID .') AS cantidad ' .  
              ' FROM ' . usuarioTableClass::getNameTable() . 
              ' WHERE ' .usuarioTableClass::DELETED_AT. ' is NULL ';
      
      if(is_array($where)===true){
          foreach ($where as $field=>$value){
              if (is_array($value)){
                  $sql=$sql.' AND '.$field.' BETWEEN '.((is_numeric($value[0]))? $value[0]:"'$value[0]'"). ' AND '.((is_numeric($value[1]))? $value[1]:"'$value[1]]'");
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
  
 public static function getNameUsuario($id) {
    try {
      $sql = 'SELECT ' . usuarioTableClass::USER . ' AS user  '
              . ' FROM ' . usuarioTableClass::getNameTable() . '  '
              . ' WHERE ' . usuarioTableClass::ID . ' = :id';

      $params = array(
          ':id' => $id
      );

      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->user;
    } catch (PDOException $exc) {
      throw $exc;
    }
  
}

}
