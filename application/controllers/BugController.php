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

                $bugModel = new Model_Bug();

                // if the form is valid then create the new bug
                $result = $bugModel->createBug(
                    $bugReportForm->getValue('author'),
                    $bugReportForm->getValue('email'),
                    $bugReportForm->getValue('date'),
                    $bugReportForm->getValue('url'),
                    $bugReportForm->getValue('description'),
                    $bugReportForm->getValue('priority'),
                    $bugReportForm->getValue('status')
                );

                // if the createBug method returns a result
                // then the bug was successfully created
                if ($result) {
                    $this->_forward('confirm');
                }
            }
        }
        $this->view->form = $bugReportForm;
    }

    public function confirmAction()
    {
        // action body
    }

    public function listAction()
    {
        // get the filter form
        $listToolsForm = new Form_BugReportListToolsForm();

        // set the default values to null
        $sort = null;
        $filter = null;

        // if this request is a postback and is valid, then add the sort
        // filter criteria
        if ($this->getRequest()->isPost()) {
            if ($listToolsForm->isValid($_POST)) {
                $sortValue = $listToolsForm->getValue('sort');
                if ($sortValue != '0') {
                    $sort = $sortValue;
                }
                $filterFieldValue = $listToolsForm->getValue('filter_field');
                if ($filterFieldValue != '0') {
                    $filter[$filterFieldValue] = $listToolsForm->getValue('filter');
                }
            }
        }

        // fetch the current bugs
        $bugModel = new Model_Bug();
        $this->view->bugs = $bugModel->fetchBugs($filter, $sort);
        $listToolsForm->setAction('/bug/list');
        $listToolsForm->setMethod('post');
        $this->view->listToolsForm = $listToolsForm;
    }
}