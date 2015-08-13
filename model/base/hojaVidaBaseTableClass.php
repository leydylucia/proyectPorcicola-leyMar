<?php use mvc\model\table\tableBaseClass;

/**
 * Description of credencialBaseTableClass
 *
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 */
class hojaVidaBaseTableClass extends tableBaseClass {

  private $id;
  private $created_at;
  private $updated_at;
  private $deleted_at;
  private $fecha_nacimiento;
  private $estado_id;
  private $lote_id;
  private $raza_id;
  private $genero_id;
  private $nombre_cerdo;

  //private $id_madre;

  const ID = 'id';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
  const FECHA_NACIMIENTO = 'fecha_nacimiento';
  const ESTADO_ID = 'estado_id';
  const LOTE_ID = 'lote_id';
  const RAZA_ID = 'raza_id';
  const GENERO_ID = 'genero_id';
  const NOMBRE_CERDO = 'nombre_cerdo';
  const NOMBRE_CERDO_LENGTH = 10;

  //const ID_MADRE = 'id_madre';

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

  function getEstado_id() {
    return $this->estado_id;
  }

  function getLote_id() {
    return $this->lote_id;
  }

  function getRaza_id() {
    return $this->raza_id;
  }
  
  function getGenero_id() {
    return $this->genero_id;
  }
  
  function getNombre_cerdo() {
    return $this->nombre_cerdo;
  }

//  function getId_madre() {
//    return $this->id_madre;
//  }

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

  function setEstado_id($estado_id) {
    $this->estado_id = $estado_id;
  }

  function setLote_id($lote_id) {
    $this->lote_id = $lote_id;
  }

  function setRaza_id($raza_id) {
    $this->raza_id = $raza_id;
  }
  
  function setGenero_id($genero_id) {
    $this->genero_id = $genero_id;
  }
  
  function setNombre_cerdo($nombre_cerdo) {
    $this->nombre_cerdo = $nombre_cerdo;
  }

//  function setId_madre($id_madre) {
//    $this->id_madre = $id_madre;
//  }

    
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
    return 'hoja_vida';
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
   * los campos y su valor  sería el valor a insertar. Ejemplo:
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

