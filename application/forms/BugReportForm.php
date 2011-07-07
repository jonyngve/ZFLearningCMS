<?php

class Form_BugReportForm extends Zend_Form
{

    public function init ()
    {
        $this->_addHiddenField();
        $this->_addAuthorTextbox();
        $this->_addEmailTextBox();
        $this->_addDateTextBox();
        $this->_addUrlTextBox();
        $this->_addDescriptionTextArea();
        $this->_addPrioritySelectBox();
        $this->_addStatusSelectBox();
        $this->_addSubmitButton();
    }

    private function _addHiddenField()
    {
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);
    }

    private function _addAuthorTextbox ()
    {
        $author = $this->createElement('text', 'author');
        $author->setLabel('Enter your name:');
        $author->setRequired(TRUE);
        $author->setAttrib('size', 30);
        $this->addElement($author);
    }

    private function _addEmailTextBox ()
    {
        $email = $this->createElement('text', 'email');
        $email->setLabel('Your email address:');
        $email->setRequired(TRUE);
        $email->addValidator(new Zend_Validate_EmailAddress());
        $email->addFilters(array(
            new Zend_Filter_StringTrim(),
            new Zend_Filter_StringToLower()
        ));
        $email->setAttrib('size', 40);
        $this->addElement($email);
    }

    private function _addDateTextBox()
    {
        $date = $this->createElement('text', 'date');
        $date->setLabel('Date the issue occurred (yyyy-mm-dd):');
        $date->setRequired(TRUE);
        $date->addValidator(new Zend_Validate_Date('YYYY-MM-DD'));
        $date->setAttrib('size', 20);
        $this->addElement($date);
    }

    private function _addUrlTextBox()
    {
        $url = $this->createElement('text', 'url');
        $url->setLabel('Issue URL:');
        $url->setRequired(TRUE);
        $url->setAttrib('size', 50);
        $this->addElement($url);
    }

    private function _addDescriptionTextArea()
    {
        $description = $this->createElement('textarea',  'description');
        $description->setLabel('Issue description:');
        $description->setRequired(TRUE);
        $description->setAttrib('cols', 50);
        $description->setAttrib('rows', 4);
        $this->addElement($description);
    }

    private function _addPrioritySelectBox()
    {
        $priority = $this->createElement('select', 'priority');
        $priority->setLabel('Issue priority:');
        $priority->setRequired(TRUE);
        $priority->addMultiOptions(array(
            'low' => 'Low',
            'med' => 'Medium',
            'high' => 'High'
        ));
        $this->addElement($priority);
    }

    private function _addStatusSelectBox()
    {
        $status = $this->createElement('select',  'status');
        $status->setLabel('Current status:');
        $status->setRequired(TRUE);
        $status->addMultiOption('new', 'New');
        $status->addMultiOption('in_progress', 'In Progress');
        $status->addMultiOption('resolved', 'Resolved');
        $this->addElement($status);
    }

    private function _addSubmitButton()
    {
        $this->addElement('submit', 'submit', array('label' => 'Submit'));
    }
}