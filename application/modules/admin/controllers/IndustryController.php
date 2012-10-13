<?php

class Admin_IndustryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
		$this->_helper->layout->setLayout('admin');
    }

    public function indexAction()
    {
        // action body
		//$industries = new  DirectroyIn_Model_Category();
		$form = new DirectoryIn_Form_Example();
		$q = Doctrine_Query::create()
			->from('DirectoryIn_Model_Category c');
		$result = $q->fetchArray();
		$this->view->records = $result;		
		var_dump($result);
    }


}

