<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 *  Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo sacrificio venta
 */
class graficaDetalleActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las returniables 
     * @return $valor=> valor
     * @return $tipoVenta=> tipo venta
     * @return $idCerdo=> id cerdo
     * * todas estos datos se pasa en la varible @var $data

     * ** */

    public function execute() {
        try {
//            $objSacrificioNumero = sacrificiovTableClass::getNumero();

            $cantidad = session:: getInstance()->getAttribute('grafica'); /* grafica nombre que se le da para pasarlo al sql */
//            $objSacrificioNumero = sacrificiovTableClass::getcantidadS($cantidad);/*ese proceso se hace para hacer otra casilla*/
//           echo $cantidad;

            $nombre = session:: getInstance()->getAttribute('graficaNombre'); /* grafica nombre que se le da para pasarlo al sql */
            $objSacrificioNumero = sacrificiovTableClass::getcantidadS($cantidad, $nombre); /* ese proceso se hace para hacer otra casilla */
            $objDescripcion = sacrificiovTableClass::getDescripcionS($cantidad, $nombre); /* ese proceso se hace para hacer otra casilla */
//           print_r($objDescripcion);
//          echo  ' <br> ' .  $cantidad . '  ' . $nombre  ;
//exit();
//            $this->arrayPrueba=array();
//            foreach ($objDescripcion as $obj){
//                $this->arrayPrueba[] = $obj;
//            }
//            $this->cosPoints = array(array([$objSacrificioNumero],15), array($objSacrificioNumero,10));
            $this->cosPoints = [[$objDescripcion, $objSacrificioNumero],[$objDescripcion, $objSacrificioNumero]]; /* $objDescripcion=> a la descripcion del producto del cerdo y $objSacrificioNumero=> hace referencia a la cantidad */
           


//            $this->cosPoints= [['2008-08-12 4:00PM',4], ['2008-09-12 4:00PM',6.5], ['2008-10-12 4:00PM',5.7], ['2008-11-12 4:00PM',9], ['2008-12-12 4:00PM',8.2]];
//            $this->cosPoints = array(array($objhojaVida,3), array($objhojaVida,5));
//                rand($objSacrificioNumero, 3),
//                rand($objSacrificioNumero, 5),
//                rand(5, 4),
//                rand(5, 10),
//                rand(4, 10),
//            );




            $this->defineView('grafica', 'reporte2', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
