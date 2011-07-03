<?php

class ControllerTestCase
    extends Zend_Test_PHPUnit_ControllerTestCase
{

    protected $_application;

    public function setUp ()
    {
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
    }

    public function appBootstrap ()
    {
        $this->application = new Zend_Application(APPLICATION_ENV,
            APPLICATION_ENV . '/configs/application.ini');
    }
}