<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use mvc\validator\reporteValidatorClass as validator;
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
//      validator::validateInsert();
//      $id_reporte = request::getInstance()->getPost(reporteTableClass::getNameField(reporteTableClass::ID, TRUE));

      /* Esta desicion corresponde  a escojer entre fecha o escojer cerdo */
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
        /* $dato=> 'dateReportSacrificio' se enviara a la vista en el
         * boton volver en detalleHoja para enviar los datos de session  */
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

        /* $strWhere=> aqui se hace una desicion para escojer entre un cerdo o varios */
        $strWhere = null;
        if ($cerdo !== null) {
          $strWhere = '(';
          foreach ($cerdo as $idCerdo) {
            if ($idCerdo == 0) {
              $strWhere = null;
            } else {
              $strWhere .= sacrificiovTableClass::ID_CERDO . ' = ' . $idCerdo . ' OR ';
//                     
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

/*validacion de fecha*/
      $fechaInicial = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1');
      $fechaFin = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2');

      if (strtotime($fechaFin) < strtotime($fechaInicial)) {
        session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
//              session::getInstance()->setFlash('modalFilters', true);
        routing::getInstance()->forward('reporte', 'insert');
      }
/*fin validacion de fecha*/

      $this->defineView('grafica', 'reporte', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */
    } catch (PDOException $exc) {

      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
