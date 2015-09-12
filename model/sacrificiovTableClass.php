<?php

use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;

/**
 * Description of usuarioCredencialTableClass
 *
 * @author leydy lucia castillo mosquera<leydylucia@hotmail.com>
 */
class sacrificiovTableClass extends sacrificiovBaseTableClass {

    /**
     * Método para el paginado
     *
     * @var $where para mantener el filtro y va al controller

     */
    public static function getcantidadS($cantidad, $nombre) {
        try {
            $sql = ' SELECT ' . tipovTableClass::DESC_TIPOV . ' as ' . ' descripcion ' . ' , ' . hojaVidaTableClass::NOMBRE_CERDO . ' as ' . ' nombre ' . ' , ' . sacrificiovTableClass::CANTIDAD . ' as ' . ' cantidad ' .
                    ' FROM ' . sacrificiovTableClass::getNameTable() . ' , ' . tipovTableClass::getNameTable() . ' , ' . hojaVidaTableClass::getNameTable() .
                    ' WHERE ' . sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID) . ' = ' . tipovTableClass::getNameField(tipovTableClass::ID) .
                    ' AND ' . sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO) . ' = ' . hojaVidaTableClass::getNameField(HojaVidaTableClass::ID) .
                    ' AND ' . '(' . hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO) . ' LIKE ' . '\'' . $nombre . '%\'  '
                    . 'OR ' . hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO) . ' LIKE ' . '\'%' . $nombre . '%\' '
                    . 'OR ' . hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO) . ' LIKE ' . '\'%' . $nombre . '\') ' .
                    ' AND ' . '(' . tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV) . ' LIKE ' . '\'' . $cantidad . '%\'  '
                    . 'OR ' . tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV) . ' LIKE ' . '\'%' . $cantidad . '%\' '
                    . 'OR ' . tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV) . ' LIKE ' . '\'%' . $cantidad . '\') ';
   
            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//            print_r($sql);
//exit();
            return  $answer[0]->cantidad; /*->cantidad*/
//             $answer[0]->descripcion . ' ' .
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
     public static function getDescripcionS($cantidad,$nombre) {
        try {
            $sql = ' SELECT ' . tipovTableClass::DESC_TIPOV . ' as ' . ' descripcion ' . ' , ' . hojaVidaTableClass::NOMBRE_CERDO . ' as ' . ' nombre ' . ' , ' . sacrificiovTableClass::CANTIDAD . ' as ' . ' cantidad ' .
                    ' FROM ' . sacrificiovTableClass::getNameTable() . ' , ' . tipovTableClass::getNameTable() . ' , ' . hojaVidaTableClass::getNameTable() .
                    ' WHERE ' . sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID) . ' = ' . tipovTableClass::getNameField(tipovTableClass::ID) .
                    ' AND ' . sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO) . ' = ' . hojaVidaTableClass::getNameField(HojaVidaTableClass::ID) .
                    ' AND ' . '(' . hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO) . ' LIKE ' . '\'' . $nombre . '%\'  '
                    . 'OR ' . hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO) . ' LIKE ' . '\'%' . $nombre . '%\' '
                    . 'OR ' . hojaVidaTableClass::getNameField(hojaVidaTableClass::NOMBRE_CERDO) . ' LIKE ' . '\'%' . $nombre . '\') ' .
                    ' AND ' . '(' . tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV) . ' LIKE ' . '\'' . $cantidad . '%\'  '
                    . 'OR ' . tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV) . ' LIKE ' . '\'%' . $cantidad . '%\' '
                    . 'OR ' . tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV) . ' LIKE ' . '\'%' . $cantidad . '\') ';
   
            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//            print_r($sql);
//exit();
            return  $answer[0]->nombre; /*->cantidad*/
//             $answer[0]->descripcion . ' ' .
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getNumero() {
        try {
            $sql = ' SELECT count( ' . sacrificiovTableClass::ID . ') as cantidad ' .
                    ' FROM ' . sacrificiovTableClass::getNameTable() .
                    ' WHERE ' . sacrificiovTableClass::DELETED_AT . ' IS NULL ';


            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->cantidad;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getTotalPages($lines, $where) {
        try {
            $sql = 'SELECT count(' . sacrificiovTableClass::ID . ') AS cantidad ' . /* DEJAR ESPACIO EN EL AND BETWEEN Y NULL */
                    ' FROM ' . sacrificiovTableClass::getNameTable() .
                    ' WHERE ' . sacrificiovTableClass::DELETED_AT . ' is NULL ';
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
    public static function getNameSacrificioV($id) {
        try {
            $sql = 'SELECT ' . sacrificiovTableClass::VALOR . ' As valor '
                    . sacrificiovTableClass::TIPO_VENTA_ID . ' As tipo_venta '
                    . sacrificiovTableClass::ID_CERDO . ' As cerdo '
                    . sacrificiovTableClass::CREATED_AT . ' As fecha '
                    . ' FROM ' . sacrificiovTableClass::getNameTable() . '  '
                    . ' WHERE ' . sacrificiovTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id);

            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->valor;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

}
