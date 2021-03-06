<?php
class Admin_PageController extends Zend_Controller_Action
{

    public function init()
    {

		// check if user is authenticated
		// if no, redirect to login page
		// if yes, proceed as normal    	
	    if (!Zend_Auth::getInstance()->hasIdentity()) {
	    	//$url = $this->getRequest()->getHttpHost() . $this->view->url();
	    	$url = $this->view->url();	    	
			$this->_redirect('/user/login?Redirect='.$url);
		}    	
		
        /* Initialize action controller here */
    	$this->_helper->layout->setLayout('admin');
		
    }

    public function indexAction()
    {
        // action body
		//$industries = new  DirectroyIn_Model_Category();
		
		$q = Doctrine_Query::create()
			->from('Directory_Model_Page p')
			->where("p.Controller = ?",'page')
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
				$page->Controller = 'page';
				$session = new Zend_Session_Namespace('Directory.auth');
				$page->UserID = $session->user['ID'];
				
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
				->where('p.ID = ? and p.Controller =?', array($id,'page'));
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
    
    
}

