<?php

class Default_UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $session = new Zend_Session_Namespace('directoryin.auth');
        print_r($session->user);
    }


    // login action
	public function loginAction()
	{
		$form = new DirectoryIn_Form_Login;
		$this->view->form = $form;
		// check for valid input
		// authenticate using adapter
		// persist user record to session
		// redirect to original request URL if present
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($this->getRequest()->getPost())) {
				$values = $form->getValues();
				$adapter = new DirectoryIn_Auth_Adapter_Doctrine($values['email'], $values['password']);
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($adapter);
				if ($result->isValid()) {
					$session = new Zend_Session_Namespace('directoryin.auth');
					$session->user = $adapter->getResultArray('Password'); 
					if (isset($session->requestURL)) {
						$url = $session->requestURL;
						unset($session->requestURL);
						$this->_redirect($url);
					} else {
						$this->_helper->getHelper('FlashMessenger')
						->addMessage('You were successfully logged in.');
						$this->_redirect('/user/index');
					}
				} else {
					$this->view->message =	'You could not be logged in. Please try again.';
				}
			}
		}
	}
	
	public function registerAction(){
		$form = new DirectoryIn_Form_Register;
		$this->view->form = $form;
		// check for valid input
		// authenticate using adapter
		// persist user record to session
		// redirect to original request URL if present
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($this->getRequest()->getPost())) {
				$values = $form->getValues();
			}
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
		$this->_redirect('/user/login');
	}	
}

