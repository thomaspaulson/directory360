<?php

class Default_UserController extends Directory_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	parent::init();
    }

    public function indexAction()
    {
        // action body
        $session = new Zend_Session_Namespace('Directory.auth');
        if(!isset($session->user)){
        	$this->_redirect('user/login');
        }
    	if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
			$this->view->messages = $this->_helper
			->getHelper('FlashMessenger')
			->getMessages();
		}                
		
        $this->view->user = $session->user;  
        
    }


    // login action
	public function loginAction()
	{
		$form = new Directory_Form_Login;
		$this->view->form = $form;
		// check for valid input
		// authenticate using adapter
		// persist user record to session
		// redirect to original request URL if present
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($this->getRequest()->getPost())) {
				$values = $form->getValues();
				$adapter = new Directory_Auth_Adapter_Doctrine($values['email'], $values['password']);
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($adapter);
				if ($result->isValid()) {
					$session = new Zend_Session_Namespace('Directory.auth');
					$session->user = $adapter->getResultArray(array('Password','Created','Modified')); 
					if (isset($session->requestURL)) {
						$url = $session->requestURL;
						unset($session->requestURL);
						$this->_redirect($url);
					} else {
						$this->_helper->getHelper('FlashMessenger')
						->addMessage('You were successfully logged in.');
						$this->_redirect('/dashboard/index');
					}
				} else {
					$this->view->message =	'You could not be logged in. Please try again.';
				}
			}
		}
	}
	
	public function registerAction(){
		$form = new Directory_Form_Register;
		$this->view->form = $form;
		// check for valid input
		// authenticate using adapter
		// persist user record to session
		// redirect to original request URL if present
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($this->getRequest()->getPost())) {
				$values = $form->getValues();
				$user = new Directory_Model_User();
				$user->fromArray($form->getValues());
				//$user->Password = md5($values['Password']);
				$user->Created = date('Y-m-d H:i:s', mktime());
				$user->Role = 'user';
				$user->save();
				$session = new Zend_Session_Namespace('Directory.auth');		    
				$session->user = $user->getRecordArray(array('Password','Created','Modified'));
				$this->_helper->getHelper('FlashMessenger')
				->addMessage('User registration successful.');
				$redirectUrl = $values['Redirect'];
				if($redirectUrl!='')
					$this->_redirect($redirectUrl);
				else 
					$this->_redirect('user');
			}
		}
		else{
			$redirectUrl = $this->_getParam('redirect',null);
			$form->Redirect->setValue($redirectUrl);
		}
	}

	public function successAction() 
	{
		if ($this->_helper->getHelper('FlashMessenger')->getMessages()) {
		$this->view->messages = $this->_helper
		->getHelper('FlashMessenger')
		->getMessages();
		} else {
		$this->_redirect('/');
		}
	}

	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		Zend_Session::destroy();
		$this->_redirect('user/login');
	}	
}

