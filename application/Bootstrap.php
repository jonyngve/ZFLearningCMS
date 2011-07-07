<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    /**
     * These resource types define folders to namespaces
     * for autoloading. There is also a directive in the application.ini
     * that can be used I think: autoloaderNamespaces[] = "Application_"
     * @var unknown_type
     */
    public static $RESOURCE_TYPES = array(
		'form' => array(
			'path'      => 'forms/' ,
			'namespace' => 'Form_'
        ) ,
        'model' => array(
        	'path'	    => 'models/' ,
        	'namespace' => 'Model_')
    );

    protected function _initView()
    {
        // Initialize view
        $view = new Zend_View();
        $view->doctype('HTML5');
        $view->headTitle('BabylonCMS');
        $view->skin = 'blues';

        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
        $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);

        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
        	'ViewRenderer');
        $viewRenderer->setView($view);

        // Return it, so that it can be stored by the bootstrap
        return $view;
    }

    protected function _initMenus ()
    {
        $view = $this->getResource('view');
        $view->mainMenuId = 1;
        $view->adminMenuId = 2;
    }

    protected function _initAutoload ()
    {
        // Add autoloader empty namespace
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $autoLoader->registerNamespace('CMS_');
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
        	'basePath'      => APPLICATION_PATH ,
        	'namespace'     => '' ,
        	'resourceTypes' => self::$RESOURCE_TYPES)
        );

        // Return it so that it can be stored by the bootstrap
        return $autoLoader;
    }
}