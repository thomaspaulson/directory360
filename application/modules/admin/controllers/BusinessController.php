<?php

class Admin_BusinessController extends Zend_Controller_Action
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
		$form = new Directory_Form_Example();
		$q = Doctrine_Query::create()
			->from('Directory_Model_Category c')
			->orderBy('c.ID DESC');
			
		$result = $q->fetchArray();
		$this->view->records = $result;		
		//var_dump($result);
		if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
			$this->view->messages = $this->_helper
			->getHelper('FlashMessenger')->getMessages();
		} 
    }	

}

