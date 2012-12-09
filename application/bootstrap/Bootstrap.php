<?php
/**
 * The application bootstrap used by Zend_Application
 *
 * @category   Bootstrap
 * @package    Bootstrap
 * @copyright  Copyright (c) 2008 Keith Pope (http://www.thepopeisdead.com)
 * @license    http://www.thepopeisdead.com/license.txt     New BSD License
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDefaultModuleAutoloader ()
    {
        $this->_resourceLoader = new Zend_Application_Module_Autoloader(
            array(
            	'namespace' => 'Caramite', 
        		'basePath' => APPLICATION_PATH . '/modules/caramite')
            );
            
        $this->_resourceLoader->addResourceTypes(
            array(
                'modelResource' => array(
                	'path' => 'models/resources', 
                	'namespace' => 'Resource'
                ), 
                'service' => array(
                	'path' => 'services', 
                	'namespace' => 'Service'
                ),
        		'formFilter' => array(
        				'path' => 'models/filters',
        				'namespace' => 'Filter'
        		),
            )
		);
    }

    /**
     * Setup locale
     */
    protected function _initLocale()
    {
        $locale = new Zend_Locale('en_GB');
        Zend_Registry::set('Zend_Locale', $locale);
    }

    /**
     * Setup the view
     */
    protected function _initViewSettings()
    {
        $this->bootstrap('view');

        $this->_view = $this->getResource('view');

        // set encoding and doctype
        $this->_view->setEncoding('UTF-8');
        $this->_view->doctype('XHTML1_STRICT');

        // set the content type and language
        $this->_view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'en-US');
        $this->_view->headMeta()->appendName('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0');

        // set css links and a special import for the accessibility styles
//         $this->_view->headStyle()->setStyle('@import "/css/access.css";');
        $this->_view->headLink()->appendStylesheet('/css/reset.css');
        $this->_view->headLink()->appendStylesheet('/css/main.css');
//         $this->_view->headLink()->appendStylesheet('/css/form.css');
        
        $this->_view->headScript()->appendFile('/js/jquery-1.8.0.min.js');
        $this->_view->headScript()->appendFile('/js/jquery-ui-1.8.23.custom.min.js');
        $this->_view->headScript()->appendFile('/js/jtable/jquery.jtable.min.js');
        $this->_view->headLink()->appendStylesheet('/js/jtable/themes/lightcolor/orange/jtable.css');
        $this->_view->headLink()->appendStylesheet('/js/jquery-ui/css/ui-lightness/jquery-ui-1.8.23.custom.css');

        // setting the site in the title
        $this->_view->headTitle('Boiler Control');

        // setting a separator string for segments:
        $this->_view->headTitle()->setSeparator(' - ');
        
        
    }
    
    /**
     * Add required routes to the router
     */
    protected function _initRoutes()
    {
        $this->bootstrap('frontController');

        $router = $this->frontController->getRouter();
        
        $editRoute = new Zend_Controller_Router_Route(
        		':controller/:action/:id/*',
        		array(),
        		array('id' => '\d+')
        );
        
        $router->addRoute('short', $editRoute);
        
//         $restRoute = new Zend_Rest_Route($this->frontController, array(), array('api'));
        
//         $router->addRoute('rest', $restRoute);
    }
}
