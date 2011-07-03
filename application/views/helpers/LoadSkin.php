<?php
/**
 *
 * @author Eier
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * {1} helper
 *
 * @uses viewHelper {0}
 */
class Zend_View_Helper_LoadSkin extends Zend_View_Helper_Abstract
{

    /**
     * @var Zend_View_Interface 
     */
    public $view;

    /**
     *  
     */
    public function loadSkin ($skin) {
        // load the skin config file
        $skinData = new Zend_Config_Xml("./skins/" . $skin . "/skin.xml");
        $stylesheets = $skinData->stylesheets->stylesheet->toArray();
        // append each stylesheet
        if (is_array($stylesheets)) {
            foreach ($stylesheets as $stylesheet) {
                $this->view->headLink()->appendStylesheet('/skins/' . $skin .
        			'/css/' . $stylesheet);
            }    
        }
    }

    /**
     * Sets the view field 
     * @param $view Zend_View_Interface
     */
    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }
}
