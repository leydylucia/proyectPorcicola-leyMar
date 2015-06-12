<?php

use mvc\model\modelClass as model;
//use mvc\config\myConfigClass as config;
use mvc\config\configClass as config;

/**
 * Description of usuarioCredencialTableClass
 *
 * @author leydy lucia castillo mosquera<leydylucia@hotmail.com>
 */
class salidaBodegaTableClass extends salidaBodegaBaseTableClass {
     
    /**
   * Método para el paginado
   *
   * @var $where para mantener el filtro y va al controller
   
   */

    public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . salidaBodegaTableClass::ID . ') AS cantidad ' ./*DEJAR ESPACIO EN EL AND BETWEEN Y NULL*/
                    ' FROM ' . salidaBodegaTableClass::getNameTable() .
                    ' WHERE ' . salidaBodegaTableClass::DELETED_AT . ' is NULL ';
            if (is_array($where) === true) {
                foreach ($where as $field => $value) {
                    if (is_array($value)) {
                        $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'");
                    } else {
                        $sql = $sql . ' AND ' . $field . '=' . ((is_numeric($value)) ? $value : "'$value'") . '';
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
 /**
   * Método public static function getNameInsumo($id)  para foreanea
   *
   * 
   
   */
    
    public static function getNameSalidaBodega($id) {
        try {
            $sql = 'SELECT ' . salidaBodegaTableClass::EMPLEADO_ID . ' As empleado '
//                    . salidaBodegaTableClass::FECHA_FABRICACION . ' As fecha_fabricacion '
//                    . salidaBodegaTableClass::FECHA_VENCIMIENTO . ' As fecha_vencimiento '
//                    . salidaBodegaTableClass::PRECIO . ' As precio '
//                    . salidaBodegaTableClass::PROVEEDOR_ID . ' As proveedor '
//                    . salidaBodegaTableClass::TIPO_INSUMO_ID . ' As tipo_insumo '
                    . ' FROM ' . salidaBodegaTableClass::getNameTable() . '  '
                    . ' WHERE ' . salidaBodegaTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id);

            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->empleado;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
  
}

