<?php

class Model_Bug extends Zend_Db_Table_Abstract
{
    protected $_name = 'bugs';

    public function createBug($name, $email, $date, $url, $description,
        $priority, $status)
    {
        $row = $this->createRow();

        // set the row data
        $row->author = $name;
        $row->email = $email;
        $dateObject = new Zend_Date($date);
        $row->date = $dateObject->get(Zend_Date::TIMESTAMP);
        $row->url = $url;
        $row->description = $description;
        $row->priority = $priority;
        $row->status = $status;

        // save the new row
        $row->save();

        // now fetch the id of the row you just created and return it
        $id = $this->_db->lastInsertId();
        return $id;
    }
}