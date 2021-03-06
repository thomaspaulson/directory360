<?php

class Admin_LocationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
		$this->_helper->layout->setLayout('admin');
    }

    public function indexAction()
    {
        // action body
		//$industries = new  Directory_Model_Location();		
		$q = Doctrine_Query::create()
			->from('Directory_Model_Location c')
			->orderBy('c.ID DESC');
		$result = $q->fetchArray();
		
		$this->view->records = $result;		
		//var_dump($result);
		if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
			$this->view->messages = $this->_helper
			->getHelper('FlashMessenger')->getMessages();
		} 
    }

	public function addAction()
	{
		$form = new Admin_Form_Location();
		$form->submit->setLabel('Add');
		$this->view->form = $form;
		// process form
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$input = $form->getValues();
				$location = new Directory_Model_Location;
				$location->fromArray($form->getValues());
				$location->Created = date('Y-m-d H:i:s', mktime());
				$location->save();
				$id = $location->ID;
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'New category created #' . $id );
				$this->_redirect('/admin/location');			
			} else {
				$form->populate($formData);
			}
		}
	}		
	
	public function editAction(){
		$form = new Admin_Form_Location();
		$form->submit->setLabel('Edit');
		$this->view->form = $form;
		// process form 
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$input = $form->getValues();
				$location = Doctrine::getTable(Directory_Model_Location)->find($input['ID']);
				$location->fromArray($input);
				$location->Modified = date('Y-m-d H:i:s', mktime());
				$location->save();
				$id = $location->ID;
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'Category updated  #' . $id );
				$this->_redirect('/admin/location');			
			} else {
				$form->populate($formData);
			}
		}
		else{
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$q = Doctrine_Query::create()
				->from('Directory_Model_Location C')
				->where('C.ID = ?', array($id));
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
				$q = Doctrine_Query::create()
				->delete('Directory_Model_Location C')
				->where('C.ID = ?', $id);
				$result = $q->execute();		
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'Category deleted #' . $id );				
			}
			$this->_helper->redirector('index');
		} else {
			$id = $this->_getParam('id', 0);
			$q = Doctrine_Query::create()
				->from('Directory_Model_Location C')
				->where('C.ID = ?', $id);
			$result = $q->fetchArray();
			if (count($result) == 1) {
			// perform adjustment for date selection lists
			$this->view->location = $result[0];
			} else {
				throw new Zend_Controller_Action_Exception('Page not found', 404);
			}			
		}
	}
	
	public function succesAction(){
		if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
			$this->view->messages = $this->_helper
			->getHelper('FlashMessenger')->getMessages();
		} else {
			$this->_redirect('/');
		} 
	}


}

