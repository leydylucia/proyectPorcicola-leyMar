<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insumoTableClass
 *
 * @author leydy lucia castillo 
 */
class unidadMedidaTableClass extends unidadMedidaBaseTableClass {
    
    
    
    /**
   * Método para el paginado
   *
   * @var $where para mantener el filtro y va al controller
   
   */

//    public static function getTotalPages($lines, $where) {
//        try {
//            $sql = 'SELECT count(' . insumoTableClass::ID . ') AS cantidad ' ./*DEJAR ESPACIO EN EL AND BETWEEN Y NULL*/
//                    ' FROM ' . insumoTableClass::getNameTable() .
//                    ' WHERE ' . insumoTableClass::DELETED_AT . ' is NULL ';
//            if (is_array($where) === true) {
//                foreach ($where as $field => $value) {
//                    if (is_array($value)) {
//                        $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1])) ? $value[1] : "'$value[1]'");
//                    } else {
//                        $sql = $sql . ' AND ' . $field . '=' . ((is_numeric($value)) ? $value : "'$value'") . '';
//                    }
//                }
//            }
//
//            $answer = model::getInstance()->prepare($sql);
//            $answer->execute();
//            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//            return ceil($answer[0]->cantidad / $lines);
//        } catch (PDOException $exc) {
//            throw $exc;
//        }
//    }
 /**
   * Método public static function getNameInsumo($id)  para foreanea
   *
   * 
   
   */
    
    public static function getNameUnidadMedida($id) {
        try {
            $sql = 'SELECT ' . unidadMedidaTableClass::DESCRIPCION . ' As descripcion '
//                    
                    . ' FROM ' . unidadMedidaTableClass::getNameTable() . '  '
                    . ' WHERE ' . unidadMedidaTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id);

            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->descripcion;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

}
