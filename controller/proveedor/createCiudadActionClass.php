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
class createCiudadActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nom_ciudad = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::NOM_CIUDAD, true));
                $depto_id = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::DEPTO_ID, true));
                //validaciones
                //caracteres especiales
                if (ereg("^{a-zA-Z0-9}{3,20}$", $nom_ciudad) == false) {
                    throw new PDOException(i18n::__(10002, null, 'errors')); //falta poner en diccionario el error adecuado
                }
                if (strlen($nom_ciudad) > ciudadTableClass::NOM_CIUDAD_LENGTH) {
                    throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => ciudadTableClass::NOM_CIUDAD_LENGTH)), 00001);
                }

                $data = array(
                    ciudadTableClass::NOM_CIUDAD => $nom_ciudad,
                    ciudadTableClass::DEPTO_ID => $depto_id
                );
                ciudadTableClass::insert($data);
                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mendaje exitoso*/
                routing::getInstance()->redirect('proveedor', 'indexCiudad');
            } else {
                routing::getInstance()->redirect('proveedor', 'indexCiudad');
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
