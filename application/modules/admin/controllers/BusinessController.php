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
		//$form = new Directory_Form_Example();
		$q = Doctrine_Query::create()
			->from('Directory_Model_Listing l')
			->leftJoin('l.Directory_Model_Page')
			->orderBy('l.PageID DESC');
			
		$result = $q->fetchArray();
		$this->view->records = $result;		
		//var_dump($result);
		if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
			$this->view->messages = $this->_helper
			->getHelper('FlashMessenger')->getMessages();
		} 
    }	
    
    public function addAction(){
		$form = new Admin_Form_Listing();
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
				$session = new Zend_Session_Namespace('Directory.auth');
				$page->UserID = $session->user['ID'];		
				
				$page->save();
				$pageID = $page->ID;
				
				$listing = new Directory_Model_Listing();
				$listing->fromArray($form->getValues());
				$listing->PageID = $pageID;
				$listing->save();
				
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'New listing created #' . $pageID );
				$this->_redirect('/admin/business');			
			} else {
				$form->populate($formData);
			}
		}    	
    }

	public function editAction(){
		$form = new Admin_Form_Page();
		$form->submit->setLabel('Update');
		$this->view->form = $form;
		// process form 
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$input = $form->getValues();
				$page = Doctrine::getTable('Directory_Model_Page')->find($input['ID']);
				$page->fromArray($input);
				$page->Modified = date('Y-m-d H:i:s', mktime());
				//$page->Modified = time();
				$page->save();
				$id = $page->ID;
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'page updated  #' . $id );
				$this->_redirect('/admin/page');			
			} else {
				$form->populate($formData);
			}
		}
		else{
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$q = Doctrine_Query::create()
				->from('Directory_Model_Page p')
				->where('p.ID = ?', $id);
				$result = $q->fetchArray();
				if (count($result) == 1) {
				// perform adjustment for date selection lists
				$form->populate($result[0]); 
				} else {
				throw new Zend_Controller_Action_Exception('Page not found', 404);
				}			
			}			
		} //endof  else ($this->getRequest()->isPost()) {
		
	} //endof editAction()
	
	public function deleteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') { 
				$id = $this->getRequest()->getPost('id');
				//echo $id; 
				$q = Doctrine_Query::create()
				->delete('Directory_Model_Page  p')
				->where('p.ID = ?', array($id));
				$result = $q->execute();		
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'Page deleted #' . $id );				
			}
			$this->_helper->redirector('index');
		} else {
			$id = $this->_getParam('id', 0);
			$q = Doctrine_Query::create()
				->from('Directory_Model_Page p')
				->where('p.ID = ?', $id);
			$result = $q->fetchArray();
			if (count($result) == 1) {
			// perform adjustment for date selection lists
			$this->view->page = $result[0];
			} else {
				throw new Zend_Controller_Action_Exception('Page not found', 404);
			}			
		}
	}
    
} /// end of classs

