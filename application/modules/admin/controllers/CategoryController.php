<?php

class Admin_CategoryController extends Zend_Controller_Action
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
			->from('Directory_Model_Category c')
			->orderBy('c.ID DESC');
			
		$result = $q->fetchArray();
		//print_r($result);
		$this->view->records = $result;		
		//var_dump($result);
		if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
			$this->view->messages = $this->_helper
			->getHelper('FlashMessenger')->getMessages();
		} 
    }

	public function addAction()
	{
		$form = new Admin_Form_Category();
		$form->submit->setLabel('Add');
		$this->view->form = $form;
		// process form
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$input = $form->getValues();
				$category = new Directory_Model_Category;
				$category->fromArray($form->getValues());
				$category->Created = date('Y-m-d H:i:s', mktime());
				//$category->Created = time();
				$category->save();
				$id = $category->ID;
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'New category created #' . $id );
				$this->_redirect('/admin/category');			
			} else {
				$form->populate($formData);
			}
		}
	}		
	
	public function editAction(){
		$form = new Admin_Form_Category();
		$form->submit->setLabel('Edit');
		$this->view->form = $form;
		// process form 
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$input = $form->getValues();
				$category = Doctrine::getTable('Directory_Model_Category')->find($input['ID']);
				$category->fromArray($input);
				$category->Modified = date('Y-m-d H:i:s', mktime());
				//$category->Modified = time();
				$category->save();
				$id = $category->ID;
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'Category updated  #' . $id );
				$this->_redirect('/admin/category');			
			} else {
				$form->populate($formData);
			}
		}
		else{
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$q = Doctrine_Query::create()
				->from('Directory_Model_Category C')
				->where('C.ID = ?', $id);
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
				->delete('Directory_Model_Category  c')
				->where('c.ID = ?', array($id));
				$result = $q->execute();		
				$this->_helper->getHelper('FlashMessenger')->addMessage(
				'Category deleted #' . $id );				
			}
			$this->_helper->redirector('index');
		} else {
			$id = $this->_getParam('id', 0);
			$q = Doctrine_Query::create()
				->from('Directory_Model_Category C')
				->where('C.ID = ?', $id);
			$result = $q->fetchArray();
			if (count($result) == 1) {
			// perform adjustment for date selection lists
			$this->view->category = $result[0];
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

