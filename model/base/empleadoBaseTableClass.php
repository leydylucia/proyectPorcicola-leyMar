<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of credencialBaseTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class empleadoBaseTableClass extends tableBaseClass {

  private $id;
  private $created_at;
  private $updated_at;
  private $deleted_at;
  private $nombre;
  private $usuario_id;
  private $tipo_id_id;
  private $apellido;
  private $direccion;
  private $correo;
  private $telefono;
  

  const ID = 'id';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
  const NOMBRE = 'nombre';
  const NOMBRE_LENGTH = 80;
  const USUARIO_ID = 'usuario_id';
  const TIPO_ID_ID = 'tipo_id_id';
  const APELLIDO = 'apellido';
  const APELLIDO_LENGTH = 80;
  const DIRECCION = 'direccion';
  const DIRECCION_LENGTH = 100;
  const CORREO = 'correo';
  const CORREO_LENGTH = 50;
  const TELEFONO = 'telefono';
  const telefono_LENGTH = 12;
  
  function getId() {
    return $this->id;
  }

  function getCreated_at() {
    return $this->created_at;
  }

  function getUpdated_at() {
    return $this->updated_at;
  }

  function getDeleted_at() {
    return $this->deleted_at;
  }

  function getNombre() {
    return $this->nombre;
  }

  function getUsuario_id() {
    return $this->usuario_id;
  }

  function getTipo_id_id() {
    return $this->tipo_id_id;
  }

  function getApellido() {
    return $this->apellido;
  }

  function getDireccion() {
    return $this->direccion;
  }

  function getCorreo() {
    return $this->correo;
  }

  function getTelefono() {
    return $this->telefono;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setCreated_at($created_at) {
    $this->created_at = $created_at;
  }

  function setUpdated_at($updated_at) {
    $this->updated_at = $updated_at;
  }

  function setDeleted_at($deleted_at) {
    $this->deleted_at = $deleted_at;
  }

  function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  function setUsuario_id($usuario_id) {
    $this->usuario_id = $usuario_id;
  }

  function setTipo_id_id($tipo_id_id) {
    $this->tipo_id_id = $tipo_id_id;
  }

  function setApellido($apellido) {
    $this->apellido = $apellido;
  }

  function setDireccion($direccion) {
    $this->direccion = $direccion;
  }

  function setCorreo($correo) {
    $this->correo = $correo;
  }

  function setTelefono($telefono) {
    $this->telefono = $telefono;
  }

  
  /**
   * Método para obtener el nombre del campo más la tabla ya sea en formato
   * DB (.) o en formato HTML (_)
   *
   * @param string $field Nombre del campo
   * @param string $html [optional] Por defecto traerá el nombre del campo en
   * versión DB
   * @return string
   */
  public static function getNameField($field, $html = false, $table = null) {
    return parent::getNameField($field, self::getNameTable(), $html);
  }

  /**
   * Obtiene el nombre de la tabla
   * @return string
   */
  public static function getNameTable() {
    return 'empleado';
  }

  /**
   * Método para borrar un registro de una tabla X en la base de datos
   *
   * @param array $ids Array con los campos por posiciones
   * asociativas y los valores por valores a tener en cuenta para el borrado.
   * Ejemplo $fieldsAndValues['id'] = 1
   * @param boolean $deletedLogical [optional] Borrado lógico [por defecto] o
   * borrado físico de un registro en una tabla de la base de datos
   * @return PDOException|boolean
   */
  public static function delete($ids, $deletedLogical = true, $table = null) {
    return parent::delete($ids, $deletedLogical, self::getNameTable());
  }

  /**
   * Método para insertar en una tabla usuario
   *
   * @param array $data Array asociativo donde las claves son los nombres de
   * los campos y su valor sería el valor a insertar. Ejemplo:
   * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
   * @return PDOException|boolean
   */
  public static function insert($data, $table = null) {
    return parent::insert(self::getNameTable(), $data);
  }

  /**
   * Método para leer todos los registros de una tabla
   *
   * @param array $fields Array con los nombres de los campos a solicitar
   * @param boolean $deletedLogical [optional] Indicación de borrado lógico
   * o borrado físico
   * @param array $orderBy [optional] Array con el o los nombres de los campos
   * por los cuales se ordenará la consulta
   * @param string $order [optional] Forma de ordenar la consulta
   * (por defecto NULL), pude ser ASC o DESC
   * @param integer $limit [optional] Cantidad de resultados a mostrar
   * @param integer $offset [optional] Página solicitadad sobre la cantidad
   * de datos a mostrar
   * @return mixed una instancia de una clase estandar, la cual tendrá como
   * variables publica los nombres de las columnas de la consulta o una
   * instancia de \PDOException en caso de fracaso.
   */
  public static function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null) {
    return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
  }

  /**
   * Método para actualizar un registro en una tabla de una base de datos
   *
   * @param array $ids Array asociativo con las posiciones por nombres de los
   * campos y los valores son quienes serían las llaves a buscar.
   * @param array $data Array asociativo con los datos a modificar,
   * las posiciones por nombres de las columnas con los valores por los nuevos
   * datos a escribir
   * @return PDOException|boolean
   */
  public static function update($ids, $data, $table = null) {
    return parent::update($ids, $data, self::getNameTable());
  }

}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

