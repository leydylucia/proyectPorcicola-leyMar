<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of detalleHojaBaseTableClass
 *
 *
 */
class detalleHojaBaseTableClass extends tableBaseClass {

  private $id;
  private $created_at;
  private $updated_at;
  private $deleted_at;
  private $peso_cerdo;
  private $unidad_medida_id;
  private $hoja_vida_id;
  private $dosis;
  private $insumo_id;
  private $tipo_insumo_id;

  const ID = 'id';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
  const PESO_CERDO = 'peso_cerdo';
  const UNIDAD_MEDIDA_ID = 'unidad_medida_id';
  const HOJA_VIDA_ID = 'hoja_vida_id';
  const DOSIS = 'dosis';
  const INSUMO_ID = 'insumo_id';
  const TIPO_INSUMO_ID = 'tipo_insumo_id';

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

  function getPeso_cerdo() {
      return $this->peso_cerdo;
  }

  function getUnidad_medida_id() {
      return $this->unidad_medida_id;
  }

  function getHoja_vida_id() {
      return $this->hoja_vida_id;
  }

  function getDosis() {
      return $this->dosis;
  }

  function getInsumo_id() {
      return $this->insumo_id;
  }

  function getTipo_insumo_id() {
      return $this->tipo_insumo_id;
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

  function setPeso_cerdo($peso_cerdo) {
      $this->peso_cerdo = $peso_cerdo;
  }

  function setUnidad_medida_id($unidad_medida_id) {
      $this->unidad_medida_id = $unidad_medida_id;
  }

  function setHoja_vida_id($hoja_vida_id) {
      $this->hoja_vida_id = $hoja_vida_id;
  }

  function setDosis($dosis) {
      $this->dosis = $dosis;
  }

  function setInsumo_id($insumo_id) {
      $this->insumo_id = $insumo_id;
  }

  function setTipo_insumo_id($tipo_insumo_id) {
      $this->tipo_insumo_id = $tipo_insumo_id;
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
    return 'detalle_hoja';
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