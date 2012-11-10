<?php
class Directory_Form_Register extends Zend_Form
{
	public function init()
	{
	
		// 	initialize form
	
		$view = Zend_Layout::getMvcInstance()->getView();
		
		$this->setAction($view->baseUrl().'/user/register')
		->setMethod('post');
	
		// create text input for name 
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email:')
		->setOptions(array('size' => '30'))
		->setRequired(true)
		->addFilter('HtmlEntities')
		->addFilter('StringTrim');
		
        $validator = new Zend_Validate_Db_NoRecordExists(
	 	   array(
	        'table' => 'user',
	        'field' => 'Email',
			));

			
		$validator->setMessage('Email already exists, please try user login', Zend_Validate_Db_Abstract::ERROR_RECORD_FOUND);
		
		$email->addValidator($validator);
		
		
		// create text input for password
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password:')
		->setOptions(array('size' => '30'))
		->setRequired(true)
		->addFilter('HtmlEntities')
		->addFilter('StringTrim');
		
		$password->addValidator(new My_Validate_PasswordConfirmation());

		// create text input for confirm_password
		$confirm_password = new Zend_Form_Element_Password('confirm_password');
		$confirm_password->setLabel('confirm_password:')
		->setOptions(array('size' => '30'))
		->setRequired(true)
		->addFilter('HtmlEntities')
		->addFilter('StringTrim');

		
		// create submit button
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Log In')
		->setOptions(array('class' => 'submit'));
		// attach elements to form
		
		$this->addElement($email)
		->addElement($password)
		->addElement($confirm_password)
		->addElement($submit)
		;
	}
}



    class My_Validate_PasswordConfirmation extends Zend_Validate_Abstract
    {
        const NOT_MATCH = 'notMatch';
     
        protected $_messageTemplates = array(
            self::NOT_MATCH => 'Password confirmation does not match'
        );
     
        public function isValid($value, $context = null)
        {
            $value = (string) $value;
            $this->_setValue($value);
     
            if (is_array($context)) {
                if (isset($context['confirm_password'])
                    && ($value == $context['confirm_password']))
                {
                    return true;
                }
            } elseif (is_string($context) && ($value == $context)) {
                return true;
            }
     
            $this->_error(self::NOT_MATCH);
            return false;
        }
    }

