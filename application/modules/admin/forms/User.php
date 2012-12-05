<?php
class Admin_Form_User extends Zend_Form
{
	public function init()
	{
		// initialize form
		$this->setAction('')
		->setAttribs(array(
		'class' => 'form',
		'id' => 'Page'
		))
		->setMethod('post');
		
		$id = new Zend_Form_Element_Hidden('ID');
		$id->addFilter('Int');
		
		// create text input for title 
		$firstName = new Zend_Form_Element_Text('FirstName');
		$firstName->setLabel('First name:')
		->setOptions(array('size' => '35'));
		$firstName->setRequired(true);

		// create text input for title 
		$lastName = new Zend_Form_Element_Text('LastName');
		$lastName->setLabel('Last name:')
		->setOptions(array('size' => '35'));
		//$url->setRequired(true);

		// create text input for title 
		$email = new Zend_Form_Element_Text('Email');
		$email->setLabel('Email:')
		->setOptions(array('size' => '35'));
		$email->setRequired(true);

		// create checkbox for role
		$role = new Zend_Form_Element_Select('Role');
		$role->setLabel('Role:')
		->setRequired(true)
		->setMultiOptions(array(
		'' => 'select',
		'user' => 'User',
		'admin' => 'Administrator',
		));				
		
		$role->setValue('');		
		
		// create checkbox for Status
		$status = new Zend_Form_Element_Select('Status');
		$status->setLabel('Status:')
		->setRequired(true)
		->setMultiOptions(array(
		'' => 'select',
		'1' => 'Publish',
		'0' => 'Draft',
		));				
		$status->setValue(0);		
		

		
		
		// attach elements to form
		
		$this->addElement($id)
		->addElement($firstName)
		->addElement($lastName)
		->addElement($email)
		->addElement($role)
		->addElement($status);	
				
		
		
		// create submit button
		$submit = new Zend_Form_Element_Submit('submit', array(
		'label' => 'Submit',
		'class' => 'submit'
		));
		
		$this->addElement($submit);
		
		
	}
	
}