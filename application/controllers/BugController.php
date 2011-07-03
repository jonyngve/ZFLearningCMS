<?php

class BugController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function createAction()
    {
        // action body
    }

    public function submitAction()
    {
        $bugReportForm = new Form_BugReportForm();
        $bugReportForm->setAction('/bug/submit');
        $bugReportForm->setMethod('post');
        if ($this->getRequest()->isPost()) {
            if ($bugReportForm->isValid($_POST)) {
                // just dump the data for now
                $data = $bugReportForm->getValues();
                // process the data
                //echo "<pre>" . print_r($data, 1)  .  "</pre>";
$db = new Zend_Db_Adapter_Pdo_Mysql(array(
    'host'     => '127.0.0.1',
    'username' => 'root',
    'password' => '123',
    'dbname'   => 'babylon'
));
//$select = new Zend_Db_Select($db);
$select = $db->select()->from('babylon.bug_report');
$statement = $db->query($select);
$bugreports = $statement->fetchAll();
echo "<pre>" . print_r($bugreports, 1)  .  "</pre>";
                foreach ($data as $field => $value) {


                    echo $value . "<br />";
//                    echo $formField->author;
//                    echo $formField->email;
//                    echo $formField->date;
//                    echo $formField->url;
//                    echo $formField->description;
//                    echo $formField->priority;
//                    echo $formField->status;
                }
            }
        }
        $this->view->form = $bugReportForm;
    }
}