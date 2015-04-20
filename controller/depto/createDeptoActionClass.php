<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 */
class createDeptoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nom_depto = request::getInstance()->getPost(deptoTableClass::getNameField(deptoTableClass::NOM_DEPTO, true));


                //caracteres especiales
                if (ereg("^{a-zA-Z0-9}{3,20}$", $nom_depto) == true) {
                    throw new PDOException(i18n::__(10002, null, 'errors')); //falta poner en diccionario el error adecuado
                }
                
                if (strlen($nom_depto) > deptoTableClass::NOM_DEPTO_LENGTH) {
                    throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => deptoTableClass::NOM_DEPTO_LENGTH)), 00001);
                }

                $data = array(
                    deptoTableClass::NOM_DEPTO => $nom_depto,
                );
                deptoTableClass::insert($data);
                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mendaje exitoso*/
                routing::getInstance()->redirect('depto', 'indexDepto');
            } else {
                routing::getInstance()->redirect('depto', 'indexDepto');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
