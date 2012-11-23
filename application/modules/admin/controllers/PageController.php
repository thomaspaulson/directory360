<?php

class Admin_PageController extends Zend_Controller_Action
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
		
		$q = Doctrine_Query::create()
			->from('Directory_Model_Page p')
			->orderBy('p.ID DESC');
			
		$result = $q->fetchArray();
		$this->view->records = $result;		
		//var_dump($result);
		if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
			$this->view->messages = $this->_helper
			->getHelper('FlashMessenger')->getMessages();
		} 
    }	
    

    public function addAction(){
		$form = new Admin_Form_Page();
		$form->submit->setLabel('Add');
		$this->view->form = $form;
		// process form
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$input = $form->getValues();
				$page = new Directory_Model_Page();
				$page->fromArray($form->getValues());
				$page->Created = date('Y-m-d H:i:s', mktime());
				//$page->Created = time();
				$page->save();
				$id = $page->ID;
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'New page created #' . $id );
				$this->_redirect('/admin/page');			
			} else {
				$form->populate($formData);
			}
		}    	
    }
}

