<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of credencialBaseTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class partoBaseTableClass extends tableBaseClass {

  private $id;
  private $created_at;
  private $updated_at;
  private $deleted_at;
  private $fecha_nacimiento;
  private $num_nacidos;
  private $num_vivos;
  private $num_muertos;
  private $num_hembras;
  private $num_machos;
  private $fecha_montada;
  private $id_padre;
  

  const ID = 'id';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
  const FECHA_NACIMIENTO = 'fecha_nacimiento';
  const FECHA_NACIMIENTO_LENGTH = 10;
  const NUM_NACIDOS = 'num_nacidos';
  const NUM_VIVOS = 'num_vivos';
  const NUM_MUERTOS = 'num_muertos';
  const NUM_HEMBRAS= 'num_hembras';
  const NUM_MACHOS = 'num_machos';
  const FECHA_MONTADA = 'fecha_montada';
  const ID_PADRE = 'id_padre';
  
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

  function getFecha_nacimiento() {
    return $this->fecha_nacimiento;
  }

  function getNum_nacidos() {
    return $this->num_nacidos;
  }

  function getNum_vivos() {
    return $this->num_vivos;
  }

  function getNum_muertos() {
    return $this->num_muertos;
  }

  function getNum_hembras() {
    return $this->num_hembras;
  }

  function getNum_machos() {
    return $this->num_machos;
  }

  function getFecha_montada() {
    return $this->fecha_montada;
  }

  function getId_padre() {
    return $this->id_padre;
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

  function setFecha_nacimiento($fecha_nacimiento) {
    $this->fecha_nacimiento = $fecha_nacimiento;
  }

  function setNum_nacidos($num_nacidos) {
    $this->num_nacidos = $num_nacidos;
  }

  function setNum_vivos($num_vivos) {
    $this->num_vivos = $num_vivos;
  }

  function setNum_muertos($num_muertos) {
    $this->num_muertos = $num_muertos;
  }

  function setNum_hembras($num_hembras) {
    $this->num_hembras = $num_hembras;
  }

  function setNum_machos($num_machos) {
    $this->num_machos = $num_machos;
  }

  function setFecha_montada($fecha_montada) {
    $this->fecha_montada = $fecha_montada;
  }

  function setId_padre($id_padre) {
    $this->id_padre = $id_padre;
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
    return 'parto';
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

