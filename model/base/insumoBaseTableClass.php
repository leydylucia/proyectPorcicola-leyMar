<?php

use mvc\model\table\tableBaseClass;

/**
 * Description of credencialBaseTableClass
 *
 * @author leydy lucia castillo mosquera<leydylucia@hotmail.com>
 */
class insumoBaseTableClass extends tableBaseClass {
  private $id;
  private $createdAt;
  private $updatedAt;
  private $deletedAt;
  private $desc_insumo;
  private $precio;
  private $tipo_insumo_id;
  private $fecha_fabricacion;
  private $fecha_vencimiento;
  private $proveedor_id;

    const ID = 'id';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
  const DESC_INSUMO = 'desc_insumo';
  const DESC_INSUMO_LENGTH = 80;
  const PRECIO='precio';
  const TIPO_INSUMO_ID='tipo_insumo_id';
  const FECHA_FABRICACION='fecha_fabricacion';
  const FECHA_VENCIMIENTO='fecha_vencimiento';
  const PROVEEDOR_ID='proveedor_id';
  

  function getId() {
      return $this->id;
  }

  function getCreatedAt() {
      return $this->createdAt;
  }

  function getUpdatedAt() {
      return $this->updatedAt;
  }

  function getDeletedAt() {
      return $this->deletedAt;
  }

  function getDesc_insumo() {
      return $this->desc_insumo;
  }

  function getPrecio() {
      return $this->precio;
  }

  function getTipo_insumo_id() {
      return $this->tipo_insumo_id;
  }

  function getFecha_fabricacion() {
      return $this->fecha_fabricacion;
  }

  function getFecha_vencimiento() {
      return $this->fecha_vencimiento;
  }

  function getProveedor_id() {
      return $this->proveedor_id;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setCreatedAt($createdAt) {
      $this->createdAt = $createdAt;
  }

  function setUpdatedAt($updatedAt) {
      $this->updatedAt = $updatedAt;
  }

  function setDeletedAt($deletedAt) {
      $this->deletedAt = $deletedAt;
  }

  function setDesc_insumo($desc_insumo) {
      $this->desc_insumo = $desc_insumo;
  }

  function setPrecio($precio) {
      $this->precio = $precio;
  }

  function setTipo_insumo_id($tipo_insumo_id) {
      $this->tipo_insumo_id = $tipo_insumo_id;
  }

  function setFecha_fabricacion($fecha_fabricacion) {
      $this->fecha_fabricacion = $fecha_fabricacion;
  }

  function setFecha_vencimiento($fecha_vencimiento) {
      $this->fecha_vencimiento = $fecha_vencimiento;
  }

  function setProveedor_id($proveedor_id) {
      $this->proveedor_id = $proveedor_id;
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
    return 'insumo';
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

