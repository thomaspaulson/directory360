<?php
class Directory_Form_Login extends Zend_Form
{
	public function init()
	{
	
		// 	initialize form
	
		$view = Zend_Layout::getMvcInstance()->getView();
		
		$this->setAction($view->baseUrl().'/user/login')
		->setMethod('post');
	
		// create text input for name 
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email:')
		->setOptions(array('size' => '30'))
		->setRequired(true)
		//->addFilter('HtmlEntities')
		->addFilter('StringTrim');
		
		// create text input for password
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password:')
		->setOptions(array('size' => '30'))
		->setRequired(true)
		//->addFilter('HtmlEntities')
		->addFilter('StringTrim');
		
		// create submit button
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Log In')
		->setOptions(array('class' => 'submit'));
		// attach elements to form
		$this->addElement($email)
		->addElement($password)
		->addElement($submit);
	}
}
