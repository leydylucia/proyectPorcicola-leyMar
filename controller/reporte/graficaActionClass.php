<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
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
class graficaActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las returniables
   * @return $valor=> valor
   * @return $tipoVenta=> tipo venta
   * @return $idCerdo=> id cerdo
   * * todas estos datos se pasa en la varible @var $data

   * ** */

  public function execute() {
    try {
      $id_reporte = request::getInstance()->getPost(reporteTableClass::getNameField(reporteTableClass::ID, TRUE));
      if (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) === false
              and ( request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1') === false
              or request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1') === '')
              and ( request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2') === false
              or
              request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2') === '')
      ) {
        $cerdo[0] = 0;
      } else if (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) === false and request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1') === true and request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2') === true) {
        $fechaInicial = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1');
        $fechaFin = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2');
        $cerdo = null;
      } else if (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) === true
              and ( request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1') === false
              or
              request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1') === ''
              or
              request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2') === false
              or request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2') === '')
      ) {
        $fechaInicial = null;
        $fechaFin = null;
        $cerdo = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true));
      } else {
        $cerdo = null;
      }

      $where = null; //session::getInstance()->getAttribute('graficaWhere');

      if (session::getInstance()->hasAttribute('dateReportSacrificio') === true) {/* decision para el devolver en detalle hoja vida se guardo la informacion en session */
        /* aqui se prepara para enviar los datos visualiza la parte inferior ahi se declaran */
        $dato = session::getInstance()->getAttribute('dateReportSacrificio');

        $this->cosPoints = $dato['cosPoints'];
        $this->labels = $dato['labels'];
        $this->datoMaximo = $dato['datoMaximo'];
        $this->cerdos = $dato['cerdos'];
      } /* fin de llaves */ else {

        $fields = array(
            sacrificiovTableClass::CANTIDAD,
            sacrificiovTableClass::TIPO_VENTA_ID,
            sacrificiovTableClass::ID_CERDO,
            sacrificiovTableClass::CREATED_AT
        );
        $orderBy = array(
            sacrificiovTableClass::ID_CERDO,
            sacrificiovTableClass::TIPO_VENTA_ID
        );


        $strWhere = null;
        if ($cerdo !== null) {
          $strWhere = '(';
          foreach ($cerdo as $idCerdo) {
            if ($idCerdo == 0) {
              $strWhere = null;
            } else {
              $strWhere .= sacrificiovTableClass::ID_CERDO . ' = ' . $idCerdo . ' OR ';
//                     ' AND ' . '(' . sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }

        if ($strWhere !== null) {
          $strWhere = substr($strWhere, 0, -4) . ') ';
        }

        /**
         * Hay que notar que lo que se hizo fue crear algo así como lo siguiente
         * (id_cerdo = 1 OR id_cerdo = 2 OR id_cerdo = 3)
         */
        if ($strWhere === null) {
          $where = $strWhere;
        } else {
          $where = array($strWhere);
        }

        if (isset($fechaInicial) and $fechaInicial !== null and isset($fechaFin) and $fechaFin !== null) {
          $where = array(
              sacrificiovTableClass::CREATED_AT => array(
                  $fechaInicial, $fechaFin
              )
          );
        }

//                  print_r($where);
//                   exit();

        $objSacrificioV = sacrificiovTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

        $cosPoints = array();
        $cerdos = array();

        /* $datoMaximo => es para dar el numero mas grande en grafico
          $labels =>
         * $cerdo => para sacar la informacion en grilla */
        $x = -1;
        $cerdo = null;
        $labels = array();
        $datoMaximo = 0;
        foreach ($objSacrificioV as $objeto) {
          if ($objeto->id_cerdo != $cerdo) {
            $cerdo = $objeto->id_cerdo;
            $labels[] = hojaVidaTableClass::getNameHojaVida($objeto->id_cerdo);
            $cerdos[$x] = array(
                'id' => $objeto->id_cerdo,
                'nombre' => hojaVidaTableClass::getNameHojaVida($objeto->id_cerdo),
                'fecha' => $objeto->created_at
            );
            $x++;
          }
          if ($objeto->cantidad > $datoMaximo) {
            $datoMaximo = $objeto->cantidad + 1;
          }
          $cosPoints[$x][] = array(
              tipovTableClass::getNameTipov($objeto->tipo_venta_id),
              $objeto->cantidad
          );

          // $cosPoints[0][] = array(hojaVidaTableClass::getNameHojaVida($objeto->id_cerdo). ' ' .tipovTableClass::getNameTipov($objeto->tipo_venta_id), $objeto->cantidad);
//        $cosPoints[1][] = array(tipovTableClass::getNameTipov($objeto->tipo_venta_id), $objeto->cantidad);
//       $cosPoints[2][] = array(tipovTableClass::getNameTipov($objeto->tipo_venta_id), $objeto->cantidad);/*hay que ser un ciclo*/
        }
        

        $this->cosPoints = $cosPoints;
        $this->labels = $labels;
        $this->datoMaximo = $datoMaximo;
        $this->cerdos = $cerdos;
        /* datos de session esta es la que nesecitas como se declaran */
        session::getInstance()->setAttribute('dateReportSacrificio', array(
            'cosPoints' => $cosPoints,
            'labels' => $labels,
            'datoMaximo' => $datoMaximo,
            'cerdos' => $cerdos,
            'where' => $where
        ));
      }



//
////            $objSacrificioNumero = sacrificiovTableClass::getNumero();
//
//            $cantidad = session:: getInstance()->getAttribute('grafica'); /* grafica nombre que se le da para pasarlo al sql */
////            $objSacrificioNumero = sacrificiovTableClass::getcantidadS($cantidad);/*ese proceso se hace para hacer otra casilla*/
////           echo $cantidad;
//
//            $nombre = session:: getInstance()->getAttribute('graficaNombre'); /* grafica nombre que se le da para pasarlo al sql */
//            $objSacrificioNumero = sacrificiovTableClass::getcantidadS($cantidad, $nombre); /* ese proceso se hace para hacer otra casilla */
//            $objDescripcion = sacrificiovTableClass::getDescripcionS($cantidad, $nombre); /* ese proceso se hace para hacer otra casilla */
////           print_r($objDescripcion);
////          echo  ' <br> ' .  $cantidad . '  ' . $nombre  ;
////exit();
////            $this->arrayPrueba=array();
////            foreach ($objDescripcion as $obj){
////                $this->arrayPrueba[] = $obj;
////            }
////            $this->cosPoints = array(array([$objSacrificioNumero],15), array($objSacrificioNumero,10));
//            $this->cosPoints = [[$objDescripcion, $objSacrificioNumero],[$objDescripcion, $objSacrificioNumero]]; /* $objDescripcion=> a la descripcion del producto del cerdo y $objSacrificioNumero=> hace referencia a la cantidad */
//
//
//
////            $this->cosPoints= [['2008-08-12 4:00PM',4], ['2008-09-12 4:00PM',6.5], ['2008-10-12 4:00PM',5.7], ['2008-11-12 4:00PM',9], ['2008-12-12 4:00PM',8.2]];
////            $this->cosPoints = array(array($objhojaVida,3), array($objhojaVida,5));
////                rand($objSacrificioNumero, 3),
////                rand($objSacrificioNumero, 5),
////                rand(5, 4),
////                rand(5, 10),
////                rand(4, 10),
////            );
//
      //$this->objSacrificioV = sacrificiovTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, null);
      $this->id_reporte = $id_reporte;
      $this->defineView('grafica', 'reporte', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */
    } catch (PDOException $exc) {

      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
